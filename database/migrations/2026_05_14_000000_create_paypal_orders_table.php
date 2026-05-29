<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('paypal_orders', function (Blueprint $table) {
            $table->id();
            $table->string('paypal_order_id')->nullable()->unique();
            $table->string('paypal_capture_id')->nullable()->unique();
            $table->string('paypal_payer_id')->nullable();
            $table->string('payer_name')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('status')->nullable();
            $table->string('intent')->nullable();
            $table->string('currency_code', 10)->nullable();
            $table->decimal('amount_value', 10, 2)->nullable();
            $table->string('amount_option_key')->nullable();
            $table->string('amount_option_label')->nullable();
            $table->text('amount_option_description')->nullable();
            $table->string('created_by_ip', 45)->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('captured_at')->nullable();
            $table->longText('raw_create_payload')->nullable();
            $table->longText('raw_capture_payload')->nullable();
            $table->longText('raw_error_payload')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paypal_orders');
    }
};
