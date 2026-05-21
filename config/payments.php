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
            'key' => '30',
            'label' => 'Amount',
            'amount' => '30.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Optional publishing service',
        ],
        [
            'key' => '40',
            'label' => 'Amount',
            'amount' => '40.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Optional publishing service',
        ],
        [
            'key' => '50',
            'label' => 'Amount',
            'amount' => '50.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Optional publishing service',
        ],
        [
            'key' => '60',
            'label' => 'Amount',
            'amount' => '60.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Optional publishing service',
        ],
        [
            'key' => '90',
            'label' => 'Amount',
            'amount' => '90.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Optional publishing service',
        ],
        [
            'key' => '100',
            'label' => 'Amount',
            'amount' => '100.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Optional publishing service',
        ],
        [
            'key' => '150',
            'label' => 'Amount',
            'amount' => '150.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Optional publishing service',
        ],
        [
            'key' => '200',
            'label' => 'Amount',
            'amount' => '200.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Optional publishing service',
        ],
    ],


// 30
// 40
// 50
// 60
// 90
// 100
// 150
// 200



    'bank' => [
        'account_name' => env('PAYMENTS_BANK_ACCOUNT_NAME', 'IRGS Publisher'),
        'account_number' => env('PAYMENTS_BANK_ACCOUNT_NUMBER', 'XXXXXXXXXXXX'),
        'bank_name' => env('PAYMENTS_BANK_NAME', 'Your Bank Name'),
        'branch' => env('PAYMENTS_BANK_BRANCH', 'Main Branch'),
        'ifsc' => env('PAYMENTS_BANK_IFSC', 'IFSC0000000'),
        'swift' => env('PAYMENTS_BANK_SWIFT', 'SWIFTXXXX'),
    ],
];
