<?php

namespace App\Http\Controllers;

use App\Models\RazorpayOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class RazorpayController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'amount_option' => 'required|string',
            'currency' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
        ]);

        $currency = $this->findSupportedCurrency($request->currency);
        $option = $this->findAmountOption($request->amount_option, $currency);

        if (!$option || !$currency) {
            return response()->json([
                'message' => 'Invalid payment amount or currency selected.',
            ], 422);
        }

        $keyId = config('services.razorpay.key_id');
        $keySecret = config('services.razorpay.key_secret');

        if (!$keyId || !$keySecret) {
            return response()->json([
                'message' => 'Razorpay is not configured correctly.',
            ], 500);
        }

        $amountInSubunits = $this->convertToSubunits($option['amount']);
        $receipt = 'irgs_' . now()->format('YmdHis') . '_' . str_pad((string) random_int(1, 999999), 6, '0', STR_PAD_LEFT);

        $response = Http::withBasicAuth($keyId, $keySecret)
            ->acceptJson()
            ->post($this->razorpayBaseUrl() . '/v1/orders', [
                'amount' => $amountInSubunits,
                'currency' => $currency,
                'receipt' => $receipt,
                'notes' => [
                    'amount_option_key' => $option['key'],
                    'amount_option_label' => $option['label'],
                    'currency' => $currency,
                    'payer_name' => $request->name,
                    'payer_email' => $request->email,
                    'payer_phone' => $request->phone,
                ],
            ]);

        $payload = $response->json();

        if (!$response->successful()) {
            return response()->json([
                'message' => 'Unable to create Razorpay order.',
                'details' => $payload,
            ], 500);
        }

        RazorpayOrder::create([
            'razorpay_order_id' => $payload['id'] ?? null,
            'receipt' => $payload['receipt'] ?? $receipt,
            'status' => $payload['status'] ?? 'created',
            'currency_code' => $currency,
            'amount_value' => $option['amount'],
            'amount_in_subunits' => $amountInSubunits,
            'amount_option_key' => $option['key'],
            'amount_option_label' => $option['label'],
            'amount_option_description' => $option['description'] ?? null,
            'payer_name' => $request->name,
            'payer_email' => $request->email,
            'payer_phone' => $request->phone,
            'created_by_ip' => $request->ip(),
            'raw_create_payload' => json_encode($payload),
        ]);

        return response()->json([
            'id' => $payload['id'] ?? null,
            'amount' => $amountInSubunits,
            'currency' => $currency,
            'name' => config('services.razorpay.company_name', 'IRGS Publisher'),
            'description' => $option['label'],
            'prefill' => [
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->phone,
            ],
        ]);
    }

    public function verifyPayment(Request $request)
    {
        $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        $order = RazorpayOrder::where('razorpay_order_id', $request->razorpay_order_id)->first();

        if (!$order) {
            return response()->json([
                'message' => 'Razorpay order was not found locally.',
            ], 404);
        }

        $keySecret = config('services.razorpay.key_secret');

        if (!$keySecret) {
            return response()->json([
                'message' => 'Razorpay is not configured correctly.',
            ], 500);
        }

        $generatedSignature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . '|' . $request->razorpay_payment_id,
            $keySecret
        );

        if (!hash_equals($generatedSignature, $request->razorpay_signature)) {
            $order->status = 'signature_verification_failed';
            $order->raw_error_payload = json_encode($request->all());
            $order->save();

            return response()->json([
                'message' => 'Razorpay signature verification failed.',
            ], 422);
        }

        $paymentPayload = $this->fetchPaymentDetails($request->razorpay_payment_id);

        $order->razorpay_payment_id = $request->razorpay_payment_id;
        $order->razorpay_signature = $request->razorpay_signature;
        $order->status = $paymentPayload['status'] ?? 'paid';
        $order->payment_method = $paymentPayload['method'] ?? null;
        $order->payer_email = $paymentPayload['email'] ?? $order->payer_email;
        $order->payer_phone = $paymentPayload['contact'] ?? $order->payer_phone;
        $order->paid_at = isset($paymentPayload['created_at'])
            ? Carbon::createFromTimestamp($paymentPayload['created_at'])
            : now();
        $order->raw_verify_payload = json_encode($request->all());
        $order->raw_payment_payload = $paymentPayload ? json_encode($paymentPayload) : null;
        $order->raw_error_payload = null;
        $order->save();

        return response()->json([
            'message' => 'Payment verified successfully.',
            'order' => [
                'razorpay_order_id' => $order->razorpay_order_id,
                'razorpay_payment_id' => $order->razorpay_payment_id,
                'payer_name' => $order->payer_name,
                'payer_email' => $order->payer_email,
                'payer_phone' => $order->payer_phone,
                'status' => $order->status,
                'amount' => $order->amount_value,
                'currency' => $order->currency_code,
                'payment_method' => $order->payment_method,
            ],
        ]);
    }

    protected function findAmountOption($key, $currency)
    {
        $optionsByCurrency = config('payments.razorpay_amount_options', []);
        $options = $optionsByCurrency[$currency] ?? [];

        foreach ($options as $option) {
            if (($option['key'] ?? null) === $key) {
                return $option;
            }
        }

        return null;
    }

    protected function findSupportedCurrency($currency)
    {
        $currencies = config('payments.razorpay_supported_currencies', []);

        foreach ($currencies as $supportedCurrency) {
            if (($supportedCurrency['key'] ?? null) === $currency) {
                return $supportedCurrency['key'];
            }
        }

        return null;
    }

    protected function convertToSubunits($amount)
    {
        return (int) round(((float) $amount) * 100);
    }

    protected function fetchPaymentDetails($paymentId)
    {
        $keyId = config('services.razorpay.key_id');
        $keySecret = config('services.razorpay.key_secret');

        if (!$keyId || !$keySecret) {
            return null;
        }

        $response = Http::withBasicAuth($keyId, $keySecret)
            ->acceptJson()
            ->get($this->razorpayBaseUrl() . '/v1/payments/' . $paymentId);

        if (!$response->successful()) {
            return null;
        }

        return $response->json();
    }

    protected function razorpayBaseUrl()
    {
        return rtrim(config('services.razorpay.base_url', 'https://api.razorpay.com'), '/');
    }
}
