<?php

namespace App\Http\Controllers;

use App\Models\PaypalOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class PaypalController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'amount_option' => 'required|string',
        ]);

        $option = $this->findAmountOption($request->amount_option);

        if (!$option) {
            return response()->json([
                'message' => 'Invalid payment amount selected.',
            ], 422);
        }

        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return response()->json([
                'message' => 'PayPal is not configured correctly.',
            ], 500);
        }

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->post($this->paypalBaseUrl() . '/v2/checkout/orders', [
                'intent' => config('services.paypal.intent', 'CAPTURE'),
                'purchase_units' => [
                    [
                        'reference_id' => $option['key'],
                        'description' => $option['label'],
                        'amount' => [
                            'currency_code' => $option['currency'],
                            'value' => $option['amount'],
                        ],
                    ],
                ],
            ]);

        if (!$response->successful()) {
            return response()->json([
                'message' => 'Unable to create PayPal order.',
                'details' => $response->json(),
            ], 500);
        }

        $payload = $response->json();

        PaypalOrder::create([
            'paypal_order_id' => $payload['id'] ?? null,
            'status' => $payload['status'] ?? 'CREATED',
            'intent' => config('services.paypal.intent', 'CAPTURE'),
            'currency_code' => $option['currency'],
            'amount_value' => $option['amount'],
            'amount_option_key' => $option['key'],
            'amount_option_label' => $option['label'],
            'amount_option_description' => $option['description'] ?? null,
            'created_by_ip' => $request->ip(),
            'raw_create_payload' => json_encode($payload),
        ]);

        return response()->json([
            'id' => $payload['id'],
        ]);
    }

    public function captureOrder(Request $request, $paypalOrderId)
    {
        $order = PaypalOrder::where('paypal_order_id', $paypalOrderId)->first();

        if (!$order) {
            return response()->json([
                'message' => 'PayPal order was not found locally.',
            ], 404);
        }

        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return response()->json([
                'message' => 'PayPal is not configured correctly.',
            ], 500);
        }

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->post($this->paypalBaseUrl() . '/v2/checkout/orders/' . $paypalOrderId . '/capture');

        $payload = $response->json();

        if (!$response->successful()) {
            $order->status = 'CAPTURE_FAILED';
            $order->raw_error_payload = json_encode($payload);
            $order->save();

            return response()->json([
                'message' => 'Unable to capture PayPal order.',
                'details' => $payload,
            ], 500);
        }

        $capture = $payload['purchase_units'][0]['payments']['captures'][0] ?? null;
        $payer = $payload['payer'] ?? [];

        $order->paypal_capture_id = $capture['id'] ?? null;
        $order->paypal_payer_id = $payer['payer_id'] ?? null;
        $order->payer_name = trim(($payer['name']['given_name'] ?? '') . ' ' . ($payer['name']['surname'] ?? ''));
        $order->payer_email = $payer['email_address'] ?? null;
        $order->status = $payload['status'] ?? ($capture['status'] ?? 'COMPLETED');
        $order->currency_code = $capture['amount']['currency_code'] ?? $order->currency_code;
        $order->amount_value = $capture['amount']['value'] ?? $order->amount_value;
        $order->approved_at = isset($payload['update_time']) ? Carbon::parse($payload['update_time']) : now();
        $order->captured_at = isset($capture['create_time']) ? Carbon::parse($capture['create_time']) : now();
        $order->raw_capture_payload = json_encode($payload);
        $order->raw_error_payload = null;
        $order->save();

        return response()->json([
            'message' => 'Payment captured successfully.',
            'order' => [
                'paypal_order_id' => $order->paypal_order_id,
                'paypal_capture_id' => $order->paypal_capture_id,
                'payer_name' => $order->payer_name,
                'payer_email' => $order->payer_email,
                'status' => $order->status,
                'amount' => $order->amount_value,
                'currency' => $order->currency_code,
            ],
        ]);
    }

    protected function findAmountOption($key)
    {
        $options = config('payments.paypal_amount_options', []);

        foreach ($options as $option) {
            if (($option['key'] ?? null) === $key) {
                return $option;
            }
        }

        return null;
    }

    protected function getAccessToken()
    {
        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.client_secret');

        if (!$clientId || !$clientSecret) {
            return null;
        }

        $response = Http::asForm()
            ->withBasicAuth($clientId, $clientSecret)
            ->acceptJson()
            ->post($this->paypalBaseUrl() . '/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

        if (!$response->successful()) {
            return null;
        }

        return $response->json()['access_token'] ?? null;
    }

    protected function paypalBaseUrl()
    {
        return rtrim(config('services.paypal.base_url', 'https://api-m.sandbox.paypal.com'), '/');
    }
}
