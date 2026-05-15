<?php

return [
    'upi_id' => env('PAYMENTS_UPI_ID', 'accounts@irgs'),
    'upi_name' => env('PAYMENTS_UPI_NAME', 'IRGS Publisher'),
    'qr_image' => env('PAYMENTS_QR_IMAGE'),
    'paypal_amount_options' => [
        [
            'key' => 'publication_fee',
            'label' => 'Publication Fee',
            'amount' => '50.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Standard publication processing fee',
        ],
        [
            'key' => 'fast_track_fee',
            'label' => 'Fast Track Fee',
            'amount' => '100.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Priority review and fast-track processing fee',
        ],
        [
            'key' => 'additional_service',
            'label' => 'Additional Service',
            'amount' => '150.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Optional publishing support service',
        ],
    ],
    'bank' => [
        'account_name' => env('PAYMENTS_BANK_ACCOUNT_NAME', 'IRGS Publisher'),
        'account_number' => env('PAYMENTS_BANK_ACCOUNT_NUMBER', 'XXXXXXXXXXXX'),
        'bank_name' => env('PAYMENTS_BANK_NAME', 'Your Bank Name'),
        'branch' => env('PAYMENTS_BANK_BRANCH', 'Main Branch'),
        'ifsc' => env('PAYMENTS_BANK_IFSC', 'IFSC0000000'),
        'swift' => env('PAYMENTS_BANK_SWIFT', 'SWIFTXXXX'),
    ],
];
