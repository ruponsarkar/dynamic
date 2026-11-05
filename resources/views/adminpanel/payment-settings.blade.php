@extends('adminpanel/layout')

@section('title', 'Payment settings')
@section('breadcrumb', 'Payment settings')

@php
    $amountField = function ($name, $options) {
        return old($name, \App\Support\PaymentSettings::formatAmountOptions($options));
    };
    $bankFields = [
        'account_name' => 'Account name',
        'account_number' => 'Account number',
        'bank_name' => 'Bank name',
        'branch' => 'Branch',
        'ifsc' => 'IFSC code',
        'swift' => 'SWIFT code',
    ];
@endphp

@section('content')
<section class="content">
    <div class="container-fluid">
        <header class="admin-page-heading">
            <h1>Payment settings</h1>
            <p>These settings control the public <a href="{{ url('payments') }}" target="_blank" rel="noopener noreferrer">payments page</a>. Switching a method off hides it there and stops new payments through it.</p>
        </header>

        <form action="{{ url('payment-settings') }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">PayPal</h3>
                            <div class="form-check form-switch mb-0">
                                <input type="hidden" name="paypal_enabled" value="0">
                                <input class="form-check-input" type="checkbox" role="switch" id="paypal_enabled" name="paypal_enabled" value="1" {{ old('paypal_enabled', $settings['methods']['paypal']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="paypal_enabled">Enabled</label>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($settings['methods']['paypal'] && (empty($settings['paypal']['client_id']) || empty($settings['paypal']['client_secret'])))
                                <div class="alert alert-warning">PayPal is on but needs a client ID and secret. Customers can't pay with it yet.</div>
                            @endif
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label" for="paypal_mode">Mode</label>
                                    <select class="form-select" id="paypal_mode" name="paypal_mode">
                                        <option value="sandbox" {{ old('paypal_mode', $settings['paypal']['mode']) === 'sandbox' ? 'selected' : '' }}>Sandbox (test payments)</option>
                                        <option value="live" {{ old('paypal_mode', $settings['paypal']['mode']) === 'live' ? 'selected' : '' }}>Live (real payments)</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label" for="paypal_currency">Currency</label>
                                    <input class="form-control" id="paypal_currency" name="paypal_currency" maxlength="3" required value="{{ old('paypal_currency', $settings['paypal']['currency']) }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="paypal_client_id">Client ID</label>
                                <input class="form-control" id="paypal_client_id" name="paypal_client_id" value="{{ old('paypal_client_id', $settings['paypal']['client_id']) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="paypal_client_secret">Client secret</label>
                                <input class="form-control" type="password" id="paypal_client_secret" name="paypal_client_secret" autocomplete="new-password" placeholder="{{ !empty($settings['paypal']['client_secret']) ? 'Saved. Leave blank to keep it.' : 'Not set' }}">
                            </div>
                            <div>
                                <label class="form-label" for="paypal_amounts">Amounts</label>
                                <textarea class="form-control" id="paypal_amounts" name="paypal_amounts" rows="6" required>{{ $amountField('paypal_amounts', $settings['paypal_amount_options']) }}</textarea>
                                <small class="admin-form-help">One per line: <code>50.00 | Description</code></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Razorpay</h3>
                            <div class="form-check form-switch mb-0">
                                <input type="hidden" name="razorpay_enabled" value="0">
                                <input class="form-check-input" type="checkbox" role="switch" id="razorpay_enabled" name="razorpay_enabled" value="1" {{ old('razorpay_enabled', $settings['methods']['razorpay']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="razorpay_enabled">Enabled</label>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($settings['methods']['razorpay'] && (empty($settings['razorpay']['key_id']) || empty($settings['razorpay']['key_secret'])))
                                <div class="alert alert-warning">Razorpay is on but needs a key ID and secret. Customers can't pay with it yet.</div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label" for="razorpay_key_id">Key ID</label>
                                <input class="form-control" id="razorpay_key_id" name="razorpay_key_id" value="{{ old('razorpay_key_id', $settings['razorpay']['key_id']) }}">
                                <small class="admin-form-help">Keys starting <code>rzp_test_</code> take test payments; <code>rzp_live_</code> take real ones.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="razorpay_key_secret">Key secret</label>
                                <input class="form-control" type="password" id="razorpay_key_secret" name="razorpay_key_secret" autocomplete="new-password" placeholder="{{ !empty($settings['razorpay']['key_secret']) ? 'Saved. Leave blank to keep it.' : 'Not set' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="razorpay_company_name">Name shown at checkout</label>
                                <input class="form-control" id="razorpay_company_name" name="razorpay_company_name" value="{{ old('razorpay_company_name', $settings['razorpay']['company_name']) }}">
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label" for="razorpay_usd_amounts">USD amounts</label>
                                    <textarea class="form-control" id="razorpay_usd_amounts" name="razorpay_usd_amounts" rows="6" required>{{ $amountField('razorpay_usd_amounts', $settings['razorpay_amount_options']['USD']) }}</textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="razorpay_inr_amounts">INR amounts</label>
                                    <textarea class="form-control" id="razorpay_inr_amounts" name="razorpay_inr_amounts" rows="6" required>{{ $amountField('razorpay_inr_amounts', $settings['razorpay_amount_options']['INR']) }}</textarea>
                                </div>
                            </div>
                            <small class="admin-form-help">One per line: <code>50.00 | Description</code></small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">UPI / QR code</h3>
                            <div class="form-check form-switch mb-0">
                                <input type="hidden" name="upi_enabled" value="0">
                                <input class="form-check-input" type="checkbox" role="switch" id="upi_enabled" name="upi_enabled" value="1" {{ old('upi_enabled', $settings['methods']['upi']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="upi_enabled">Enabled</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="upi_name">UPI name</label>
                                <input class="form-control" id="upi_name" name="upi_name" value="{{ old('upi_name', $settings['upi']['name']) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="upi_id">UPI ID</label>
                                <input class="form-control" id="upi_id" name="upi_id" value="{{ old('upi_id', $settings['upi']['id']) }}">
                            </div>
                            <div>
                                <label class="form-label" for="qr_image">QR code image</label>
                                @if (!empty($settings['upi']['qr_image']))
                                    <div class="mb-2">
                                        <img src="{{ asset($settings['upi']['qr_image']) }}" alt="Current QR code" width="120" height="120" style="object-fit:contain;border:1px solid #dfe5ec;border-radius:8px;">
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="remove_qr_image" name="remove_qr_image" value="1">
                                        <label class="form-check-label" for="remove_qr_image">Remove this QR code</label>
                                    </div>
                                @endif
                                <input class="form-control" type="file" id="qr_image" name="qr_image" accept="image/jpeg,image/png,image/webp">
                                <small class="admin-form-help">JPG, PNG or WebP, up to 2 MB.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Bank details</h3>
                            <div class="form-check form-switch mb-0">
                                <input type="hidden" name="bank_enabled" value="0">
                                <input class="form-check-input" type="checkbox" role="switch" id="bank_enabled" name="bank_enabled" value="1" {{ old('bank_enabled', $settings['methods']['bank']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="bank_enabled">Enabled</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($bankFields as $field => $label)
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label" for="bank_{{ $field }}">{{ $label }}</label>
                                        <input class="form-control" id="bank_{{ $field }}" name="bank_{{ $field }}" value="{{ old('bank_' . $field, $settings['bank'][$field]) }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Payment assistance contact</h3></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label" for="contact_name">Name</label>
                                    <input class="form-control" id="contact_name" name="contact_name" value="{{ old('contact_name', $settings['contact']['name']) }}">
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label" for="contact_organisation">Organisation</label>
                                    <input class="form-control" id="contact_organisation" name="contact_organisation" value="{{ old('contact_organisation', $settings['contact']['organisation']) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="contact_phone">Phone</label>
                                    <input class="form-control" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['contact']['phone']) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save payment settings</button>
        </form>
    </div>
</section>
@endsection
