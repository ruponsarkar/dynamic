<?php

return [
    'upi_id' => env('PAYMENTS_UPI_ID', '9864820019@okbizaxis'),
    'upi_name' => env('PAYMENTS_UPI_NAME', 'Sanim Mahmud Mazumdar'),
    'qr_image' => env('PAYMENTS_QR_IMAGE'),
    'paypal_amount_options' => [
        [
            'key' => 'publication_fee',
            'label' => 'Amount',
            'amount' => '50.00',
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'description' => 'Standard publication processing fee',
        ],
        [
            'key' => 'fast_track_fee',
            'label' => 'Amount',
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

    'razorpay_amount_options' => [
        'USD' => [
            [
                'key' => '50',
                'label' => 'Amount',
                'amount' => '50.00',
                'description' => 'Standard publication processing fee',
            ],
            [
                'key' => '100',
                'label' => 'Amount',
                'amount' => '100.00',
                'description' => 'Priority review and fast-track processing fee',
            ],
            [
                'key' => '30',
                'label' => 'Amount',
                'amount' => '30.00',
                'description' => 'Optional publishing service',
            ],
            [
                'key' => '40',
                'label' => 'Amount',
                'amount' => '40.00',
                'description' => 'Optional publishing service',
            ],
            [
                'key' => '50_alt',
                'label' => 'Amount',
                'amount' => '50.00',
                'description' => 'Optional publishing service',
            ],
            [
                'key' => '60',
                'label' => 'Amount',
                'amount' => '60.00',
                'description' => 'Optional publishing service',
            ],
            [
                'key' => '90',
                'label' => 'Amount',
                'amount' => '90.00',
                'description' => 'Optional publishing service',
            ],
            [
                'key' => '100_alt',
                'label' => 'Amount',
                'amount' => '100.00',
                'description' => 'Optional publishing service',
            ],
            [
                'key' => '150',
                'label' => 'Amount',
                'amount' => '150.00',
                'description' => 'Optional publishing service',
            ],
            [
                'key' => '200',
                'label' => 'Amount',
                'amount' => '200.00',
                'description' => 'Optional publishing service',
            ],
        ],
        'INR' => [
            [
                'key' => '1',
                'label' => 'Amount',
                'amount' => '1.00',
                'description' => 'Publishing service',
            ],
            [
                'key' => '1000',
                'label' => 'Amount',
                'amount' => '1000.00',
                'description' => 'Publishing service',
            ],
            [
                'key' => '1200',
                'label' => 'Amount',
                'amount' => '1200.00',
                'description' => 'Publishing service',
            ],
            [
                'key' => '1500',
                'label' => 'Amount',
                'amount' => '1500.00',
                'description' => 'Publishing service',
            ],
            [
                'key' => '1800',
                'label' => 'Amount',
                'amount' => '1800.00',
                'description' => 'Publishing service',
            ],
            [
                'key' => '2000',
                'label' => 'Amount',
                'amount' => '2000.00',
                'description' => 'Publishing service',
            ],
            [
                'key' => '2500',
                'label' => 'Amount',
                'amount' => '2500.00',
                'description' => 'Publishing service',
            ],
            [
                'key' => '3000',
                'label' => 'Amount',
                'amount' => '3000.00',
                'description' => 'Publishing service',
            ],
            [
                'key' => '4000',
                'label' => 'Amount',
                'amount' => '4000.00',
                'description' => 'Publishing service',
            ],
            [
                'key' => '5000',
                'label' => 'Amount',
                'amount' => '5000.00',
                'description' => 'Publishing service',
            ],
        ],
    ],

    'razorpay_supported_currencies' => [
        [
            'key' => 'USD',
            'label' => 'USD',
            'symbol' => 'USD',
        ],
        [
            'key' => 'INR',
            'label' => 'INR',
            'symbol' => 'INR',
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
