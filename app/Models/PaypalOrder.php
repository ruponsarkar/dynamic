<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalOrder extends Model
{
    use HasFactory;

    protected $table = 'paypal_orders';

    protected $fillable = [
        'paypal_order_id',
        'paypal_capture_id',
        'paypal_payer_id',
        'payer_name',
        'payer_email',
        'status',
        'intent',
        'currency_code',
        'amount_value',
        'amount_option_key',
        'amount_option_label',
        'amount_option_description',
        'created_by_ip',
        'approved_at',
        'captured_at',
        'raw_create_payload',
        'raw_capture_payload',
        'raw_error_payload',
    ];
}
