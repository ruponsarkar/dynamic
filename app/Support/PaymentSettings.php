<?php

namespace App\Support;

/**
 * Merges admin-saved payment settings over config/payments.php, config/services.php and .env.
 * Anything not saved in the admin panel keeps its existing value.
 */
class PaymentSettings
{
    private const PAYPAL_URLS = [
        'sandbox' => 'https://api-m.sandbox.paypal.com',
        'live' => 'https://api-m.paypal.com',
    ];

    private static $effective = null;

    /**
     * Current values, including credentials for gateways that are switched off.
     * Remembered because apply() later blanks those credentials in config.
     */
    public static function effective(): array
    {
        if (self::$effective !== null) {
            return self::$effective;
        }

        $envPaypalUrl = config('services.paypal.base_url', self::PAYPAL_URLS['sandbox']);
        $paypalCurrency = SiteSettings::get('payment_paypal_currency', config('services.paypal.currency', 'USD'));

        return self::$effective = [
            'methods' => [
                'upi' => SiteSettings::get('payment_upi_enabled', '1') === '1',
                'razorpay' => SiteSettings::get('payment_razorpay_enabled', '1') === '1',
                'paypal' => SiteSettings::get('payment_paypal_enabled', '1') === '1',
                'bank' => SiteSettings::get('payment_bank_enabled', '1') === '1',
            ],
            'paypal' => [
                'client_id' => SiteSettings::get('payment_paypal_client_id', config('services.paypal.client_id')),
                'client_secret' => SiteSettings::secret('payment_paypal_client_secret', config('services.paypal.client_secret')),
                'mode' => SiteSettings::get('payment_paypal_mode', strpos($envPaypalUrl, 'sandbox') !== false ? 'sandbox' : 'live'),
                'currency' => $paypalCurrency,
            ],
            'razorpay' => [
                'key_id' => SiteSettings::get('payment_razorpay_key_id', config('services.razorpay.key_id')),
                'key_secret' => SiteSettings::secret('payment_razorpay_key_secret', config('services.razorpay.key_secret')),
                'company_name' => SiteSettings::get('payment_razorpay_company_name', config('services.razorpay.company_name')),
            ],
            'upi' => [
                'id' => SiteSettings::get('payment_upi_id', config('payments.upi_id')),
                'name' => SiteSettings::get('payment_upi_name', config('payments.upi_name')),
                'qr_image' => SiteSettings::get('payment_qr_image', config('payments.qr_image')),
            ],
            'bank' => [
                'account_name' => SiteSettings::get('payment_bank_account_name', config('payments.bank.account_name')),
                'account_number' => SiteSettings::get('payment_bank_account_number', config('payments.bank.account_number')),
                'bank_name' => SiteSettings::get('payment_bank_bank_name', config('payments.bank.bank_name')),
                'branch' => SiteSettings::get('payment_bank_branch', config('payments.bank.branch')),
                'ifsc' => SiteSettings::get('payment_bank_ifsc', config('payments.bank.ifsc')),
                'swift' => SiteSettings::get('payment_bank_swift', config('payments.bank.swift')),
            ],
            'contact' => [
                'name' => SiteSettings::get('payment_contact_name', 'IRGS Publisher'),
                'organisation' => SiteSettings::get('payment_contact_organisation', 'International Research & Global Society'),
                'phone' => SiteSettings::get('payment_contact_phone', '+91-7002207076'),
            ],
            'paypal_amount_options' => array_map(function ($option) use ($paypalCurrency) {
                return ['currency' => $paypalCurrency] + $option;
            }, self::savedOptions('payment_paypal_amounts', config('payments.paypal_amount_options', []))),
            'razorpay_amount_options' => [
                'USD' => self::savedOptions('payment_razorpay_usd_amounts', config('payments.razorpay_amount_options.USD', [])),
                'INR' => self::savedOptions('payment_razorpay_inr_amounts', config('payments.razorpay_amount_options.INR', [])),
            ],
        ];
    }

    /**
     * Runs on every request, so the payment page and both gateway controllers see saved values.
     * A switched-off gateway loses its credentials, which also makes its endpoints refuse orders.
     */
    public static function apply(): void
    {
        $settings = self::effective();
        $paypalOn = $settings['methods']['paypal'];
        $razorpayOn = $settings['methods']['razorpay'];
        $savedMode = SiteSettings::get('payment_paypal_mode');

        config([
            'services.paypal.client_id' => $paypalOn ? $settings['paypal']['client_id'] : null,
            'services.paypal.client_secret' => $paypalOn ? $settings['paypal']['client_secret'] : null,
            'services.paypal.currency' => $settings['paypal']['currency'],
            'services.razorpay.key_id' => $razorpayOn ? $settings['razorpay']['key_id'] : null,
            'services.razorpay.key_secret' => $razorpayOn ? $settings['razorpay']['key_secret'] : null,
            'services.razorpay.company_name' => $settings['razorpay']['company_name'],
            'payments.methods' => $settings['methods'],
            'payments.upi_id' => $settings['upi']['id'],
            'payments.upi_name' => $settings['upi']['name'],
            'payments.qr_image' => $settings['upi']['qr_image'],
            'payments.bank' => $settings['bank'],
            'payments.contact' => $settings['contact'],
            'payments.paypal_amount_options' => $settings['paypal_amount_options'],
            'payments.razorpay_amount_options' => $settings['razorpay_amount_options'],
        ]);

        if (isset(self::PAYPAL_URLS[$savedMode])) {
            config(['services.paypal.base_url' => self::PAYPAL_URLS[$savedMode]]);
        }
    }

    /**
     * Parses one "amount | description" per line. Returns null if any line is invalid.
     *
     * Keys come from the amount, so a payment page left open across a price change
     * fails validation instead of charging a different amount under the same key.
     */
    public static function parseAmountOptions(string $text): ?array
    {
        $options = [];
        $seen = [];

        foreach (preg_split('/\r\n|\r|\n/', $text) as $line) {
            if (trim($line) === '') {
                continue;
            }

            $parts = array_map('trim', explode('|', $line, 2));
            $amount = $parts[0];

            if (!preg_match('/^\d{1,8}(\.\d{1,2})?$/', $amount) || (float) $amount <= 0) {
                return null;
            }

            $amount = number_format((float) $amount, 2, '.', '');
            $key = 'amt_' . str_replace('.', '_', $amount);
            $seen[$key] = ($seen[$key] ?? 0) + 1;

            $options[] = [
                'key' => $seen[$key] > 1 ? $key . '_' . $seen[$key] : $key,
                'label' => 'Amount',
                'amount' => $amount,
                'description' => $parts[1] ?? '',
            ];
        }

        return $options;
    }

    public static function formatAmountOptions(array $options): string
    {
        return implode("\n", array_map(function ($option) {
            return $option['amount'] . ' | ' . ($option['description'] ?? '');
        }, $options));
    }

    private static function savedOptions(string $key, array $default): array
    {
        $saved = json_decode((string) SiteSettings::get($key), true);

        return is_array($saved) && $saved !== [] ? $saved : $default;
    }
}
