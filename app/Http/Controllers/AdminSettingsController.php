<?php

namespace App\Http\Controllers;

use App\Models\PaypalOrder;
use App\Models\RazorpayOrder;
use App\Support\HomeContent;
use App\Support\PaymentSettings;
use App\Support\SiteSettings;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class AdminSettingsController extends Controller
{
    private const SECRET_FIELDS = ['paypal_client_secret', 'razorpay_key_secret'];

    private const AMOUNT_FIELDS = [
        'paypal_amounts' => 'payment_paypal_amounts',
        'razorpay_usd_amounts' => 'payment_razorpay_usd_amounts',
        'razorpay_inr_amounts' => 'payment_razorpay_inr_amounts',
    ];

    private const QR_DIRECTORY = 'assets/payments';

    public function paymentSettings()
    {
        return view('adminpanel.payment-settings', ['settings' => PaymentSettings::effective()]);
    }

    public function savePaymentSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paypal_mode' => 'required|in:sandbox,live',
            'paypal_currency' => ['required', 'regex:/^[A-Z]{3}$/'],
            'paypal_client_id' => 'nullable|string|max:255',
            'paypal_client_secret' => 'nullable|string|max:255',
            'razorpay_key_id' => 'nullable|string|max:255',
            'razorpay_key_secret' => 'nullable|string|max:255',
            'razorpay_company_name' => 'nullable|string|max:255',
            'upi_id' => 'nullable|string|max:255',
            'upi_name' => 'nullable|string|max:255',
            'qr_image' => 'nullable|file|mimes:jpeg,jpg,png,webp|max:2048',
            'bank_account_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'bank_bank_name' => 'nullable|string|max:255',
            'bank_branch' => 'nullable|string|max:255',
            'bank_ifsc' => 'nullable|string|max:255',
            'bank_swift' => 'nullable|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_organisation' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'paypal_amounts' => 'required|string|max:5000',
            'razorpay_usd_amounts' => 'required|string|max:5000',
            'razorpay_inr_amounts' => 'required|string|max:5000',
        ]);

        $amounts = [];
        $validator->after(function ($validator) use ($request, &$amounts) {
            foreach (array_keys(self::AMOUNT_FIELDS) as $field) {
                $parsed = PaymentSettings::parseAmountOptions((string) $request->input($field));

                if (empty($parsed)) {
                    $label = str_replace('_', ' ', $field);
                    $validator->errors()->add($field, "Each line in {$label} must look like: 50.00 | Description");
                }

                $amounts[$field] = $parsed;
            }
        });

        // Secrets are left out so a failed save doesn't copy them into the session.
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->except(self::SECRET_FIELDS));
        }

        $values = [
            'payment_upi_enabled' => $request->boolean('upi_enabled') ? '1' : '0',
            'payment_razorpay_enabled' => $request->boolean('razorpay_enabled') ? '1' : '0',
            'payment_paypal_enabled' => $request->boolean('paypal_enabled') ? '1' : '0',
            'payment_bank_enabled' => $request->boolean('bank_enabled') ? '1' : '0',
        ];

        foreach ([
            'paypal_mode', 'paypal_currency', 'paypal_client_id',
            'razorpay_key_id', 'razorpay_company_name',
            'upi_id', 'upi_name',
            'bank_account_name', 'bank_account_number', 'bank_bank_name', 'bank_branch', 'bank_ifsc', 'bank_swift',
            'contact_name', 'contact_organisation', 'contact_phone',
        ] as $field) {
            $values['payment_' . $field] = trim((string) $request->input($field));
        }

        foreach (self::AMOUNT_FIELDS as $field => $key) {
            $values[$key] = json_encode($amounts[$field]);
        }

        try {
            SiteSettings::putMany($values);

            // A blank secret field means "keep the saved one".
            foreach (self::SECRET_FIELDS as $field) {
                if (trim((string) $request->input($field)) !== '') {
                    SiteSettings::putSecret('payment_' . $field, trim($request->input($field)));
                }
            }

            $this->saveQrImage($request);
        } catch (QueryException $e) {
            return back()->withInput($request->except(self::SECRET_FIELDS))
                ->withErrors(['settings' => 'Could not save. Has the site_settings migration been run?']);
        }

        return redirect('payment-settings')->with('message', 'Payment settings saved.');
    }

    public function paymentTransactions()
    {
        return view('adminpanel.payment-transactions', [
            'paypalOrders' => PaypalOrder::orderBy('id', 'desc')->paginate(25, ['*'], 'paypal_page'),
            'razorpayOrders' => RazorpayOrder::orderBy('id', 'desc')->paginate(25, ['*'], 'razorpay_page'),
        ]);
    }

    public function homeContent()
    {
        return view('adminpanel.home-content', ['content' => HomeContent::all()]);
    }

    public function saveHomeContent(Request $request)
    {
        $data = $request->validate([
            'home_purpose_heading' => 'required|string|max:255',
            'home_purpose_intro' => 'required|string|max:1000',
            'home_mission_title' => 'required|string|max:255',
            'home_mission_text' => 'required|string|max:5000',
            'home_vision_title' => 'required|string|max:255',
            'home_vision_text' => 'required|string|max:5000',
        ]);

        try {
            SiteSettings::putMany($data);
        } catch (QueryException $e) {
            return back()->withInput()
                ->withErrors(['settings' => 'Could not save. Has the site_settings migration been run?']);
        }

        return redirect('home-content')->with('message', 'Mission and vision saved.');
    }

    public function clearCache()
    {
        try {
            Cache::flush();
            Artisan::call('view:clear');
        } catch (Throwable $e) {
            report($e);

            return redirect('admin_index')->withErrors(['cache' => 'The cache could not be fully cleared. See the application log.']);
        }

        return redirect('admin_index')->with('message', 'Cache cleared.');
    }

    private function saveQrImage(Request $request): void
    {
        $current = PaymentSettings::effective()['upi']['qr_image'];
        $upload = $request->file('qr_image');

        if (!$upload && !$request->boolean('remove_qr_image')) {
            return;
        }

        $path = '';

        if ($upload) {
            $name = Str::random(32) . '.' . $upload->extension();
            $upload->move(public_path(self::QR_DIRECTORY), $name);
            $path = self::QR_DIRECTORY . '/' . $name;
        }

        SiteSettings::putMany(['payment_qr_image' => $path]);

        // Only remove files this page uploaded, never a path that came from .env.
        if ($current && Str::startsWith($current, self::QR_DIRECTORY . '/')) {
            @unlink(public_path(self::QR_DIRECTORY . '/' . basename($current)));
        }
    }
}
