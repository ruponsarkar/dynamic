<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorpayOrder extends Model
{
    use HasFactory;

    protected $table = 'razorpay_orders';

    protected $fillable = [
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'receipt',
        'status',
        'currency_code',
        'amount_value',
        'amount_in_subunits',
        'amount_option_key',
        'amount_option_label',
        'amount_option_description',
        'payer_name',
        'payer_email',
        'payer_phone',
        'payment_method',
        'created_by_ip',
        'paid_at',
        'raw_create_payload',
        'raw_verify_payload',
        'raw_payment_payload',
        'raw_error_payload',
    ];
}
