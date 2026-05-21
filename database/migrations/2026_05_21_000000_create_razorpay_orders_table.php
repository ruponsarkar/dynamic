<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('razorpay_orders', function (Blueprint $table) {
            $table->id();
            $table->string('razorpay_order_id')->nullable()->unique();
            $table->string('razorpay_payment_id')->nullable()->unique();
            $table->string('razorpay_signature')->nullable();
            $table->string('receipt')->nullable()->unique();
            $table->string('status')->nullable();
            $table->string('currency_code', 10)->nullable();
            $table->decimal('amount_value', 10, 2)->nullable();
            $table->unsignedBigInteger('amount_in_subunits')->nullable();
            $table->string('amount_option_key')->nullable();
            $table->string('amount_option_label')->nullable();
            $table->text('amount_option_description')->nullable();
            $table->string('payer_name')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('payer_phone', 30)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('created_by_ip', 45)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->longText('raw_create_payload')->nullable();
            $table->longText('raw_verify_payload')->nullable();
            $table->longText('raw_payment_payload')->nullable();
            $table->longText('raw_error_payload')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('razorpay_orders');
    }
};
