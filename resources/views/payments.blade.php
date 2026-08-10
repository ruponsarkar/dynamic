<!--modified -->
@extends('layouts.app')

@section('title', 'Payments')

@section('content')
    <style>
        .payments-page {
            --payments-blue: #0d3b8e;
            --payments-accent: #0ea5e9;
            --payments-gold: #f4b400;
            --payments-bg: #eef4ff;
            --payments-border: #d7e3ff;
        }

        .payments-hero {
            background: linear-gradient(135deg, var(--payments-blue), #0a64c5);
            color: #fff;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 18px 40px rgba(13, 59, 142, 0.18);
        }

        .payments-kicker {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .payment-card {
            background: #fff;
            border: 1px solid var(--payments-border);
            border-radius: 22px;
            padding: 24px;
            height: 100%;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        }

        .payment-card-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
        }

        .payment-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 22px;
        }

        .payment-icon-upi {
            background: linear-gradient(135deg, #16a34a, #22c55e);
        }

        .payment-icon-paypal {
            background: linear-gradient(135deg, #003087, #0070ba);
        }

        .payment-icon-bank {
            background: linear-gradient(135deg, #7c3aed, #2563eb);
        }

        .payment-icon-razorpay {
            background: linear-gradient(135deg, #1a4fff, #4f7cff);
        }

        .payment-qr-box {
            min-height: 240px;
            border: 2px dashed #b7cdfd;
            border-radius: 18px;
            background: var(--payments-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            overflow: hidden;
        }

        .payment-qr-box img {
            width: 100%;
            max-width: 240px;
            border-radius: 16px;
            object-fit: contain;
            background: #fff;
            padding: 10px;
        }

        .payment-placeholder {
            text-align: center;
            color: #37517e;
        }

        .payment-placeholder i {
            font-size: 48px;
            display: block;
            margin-bottom: 12px;
        }

        .payment-meta {
            background: #f8fbff;
            border: 1px solid #deebff;
            border-radius: 16px;
            padding: 16px;
            margin-top: 18px;
        }

        .payment-meta strong {
            color: #0f172a;
        }

        .payment-bank-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .payment-bank-list li {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 11px 0;
            border-bottom: 1px solid #e9eef8;
        }

        .payment-bank-list li:last-child {
            border-bottom: 0;
        }

        .payment-bank-label {
            color: #475569;
            font-weight: 600;
        }

        .payment-bank-value {
            color: #0f172a;
            font-weight: 700;
            text-align: right;
        }

        .payment-note {
            border-left: 4px solid var(--payments-gold);
            background: #fff8db;
            color: #5f4b00;
            border-radius: 12px;
            padding: 14px 16px;
        }

        .payment-list {
            margin: 0;
            padding-left: 18px;
            color: #334155;
        }

        .payment-list li {
            margin-bottom: 10px;
        }

        .payment-contact {
            background: linear-gradient(135deg, #f8fbff, #eef4ff);
            border: 1px solid #d7e3ff;
            border-radius: 18px;
            padding: 20px;
        }

        .payment-select {
            border: 1px solid #cfe0ff;
            border-radius: 14px;
            padding: 12px 14px;
            background: #f8fbff;
        }

        .payment-select-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #0f172a;
        }

        .payment-input {
            border: 1px solid #cfe0ff;
            border-radius: 14px;
            padding: 12px 14px;
            background: #fff;
        }

        .payment-action {
            border: 0;
            border-radius: 14px;
            padding: 13px 18px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #1a4fff, #0d3b8e);
            width: 100%;
        }

        .payment-action:disabled {
            opacity: 0.65;
        }

        #paypal-button-container {
            min-height: 46px;
        }

        .gateway-status {
            display: none;
            margin-top: 14px;
            border-radius: 12px;
            padding: 12px 14px;
            font-weight: 600;
        }

        .gateway-status.is-success {
            display: block;
            background: #eafaf0;
            color: #166534;
        }

        .gateway-status.is-error {
            display: block;
            background: #fef2f2;
            color: #b91c1c;
        }

        .gateway-status.is-info {
            display: block;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .payment-tax-note {
            margin-top: 10px;
            color: #475569;
            font-size: 0.92rem;
        }

        .payment-tax-modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, 0.55);
            z-index: 1055;
        }

        .payment-tax-modal.is-visible {
            display: flex;
        }

        .payment-tax-dialog {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.28);
        }

        .payment-tax-breakdown {
            margin: 18px 0;
            padding: 0;
            list-style: none;
        }

        .payment-tax-breakdown li {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }

        .payment-tax-breakdown li:last-child {
            border-bottom: 0;
            padding-bottom: 0;
            font-weight: 700;
            color: #0f172a;
        }

        .payment-tax-actions {
            display: flex;
            gap: 12px;
        }

        .payment-secondary-action {
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 13px 18px;
            font-weight: 700;
            color: #0f172a;
            background: #fff;
            width: 100%;
        }

        @media (max-width: 767px) {
            .payments-hero {
                padding: 24px;
                border-radius: 18px;
            }

            .payment-bank-list li {
                flex-direction: column;
                gap: 6px;
            }

            .payment-bank-value {
                text-align: left;
            }
        }
    </style>

    <div class="payments-page">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-9">
                    <div class="payments-hero mb-4">
                        <div class="payments-kicker">
                            <i class="bi bi-credit-card-2-front"></i>
                            Secure Payments
                        </div>
                        <h1 class="mt-3 mb-2 fw-bold">Payment Information</h1>
                        <p class="mb-0">
                            Choose the payment method that works best for you. Indian authors can make payments via UPI QR Code, Direct Bank Transfer, or Razorpay by selecting INR (₹). International authors can pay through Bank Transfer (SWIFT), Razorpay by selecting USD ($), or PayPal. All payment details are provided below for your convenience. 
                        </p>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="payment-card">
                                <div class="payment-card-title">
                                    <span class="payment-card-icon payment-icon-upi">
                                        <i class="bi bi-qr-code-scan"></i>
                                    </span>
                                    <span>For Indian Payments</span>
                                </div>

                                <div class="payment-qr-box">
                                    @if (!empty($paymentConfig['qr_image']))
                                        <img src="{{ asset($paymentConfig['qr_image']) }}" alt="Indian payment QR code">
                                    @else
                                        <div class="payment-placeholder">
                                            <i class="bi bi-qr-code"></i>
                                            <strong>QR code not added yet</strong>
                                            <div class="mt-2">Set <code>PAYMENTS_QR_IMAGE</code> to show your QR image.</div>
                                        </div>
                                    @endif
                                </div>

                                <div class="payment-meta">
                                    <div><strong>UPI Name:</strong> {{ $paymentConfig['upi_name'] }}</div>
                                    <div class="mt-2"><strong>UPI ID:</strong> {{ $paymentConfig['upi_id'] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="payment-card">
                                <div class="payment-card-title">
                                    <span class="payment-card-icon payment-icon-razorpay">
                                        <i class="bi bi-phone"></i>
                                    </span>
                                    <span>Pay Online with Razorpay</span>
                                    
                                </div>
                                <div>
                                    (For Indian & International Authors)
                                </div>
                                

                                <p class="text-muted">
                                    Indian and international authors can pay securely using Razorpay. INR and USD payments are supported.
                                </p>

                                <div class="payment-select mb-3">
                                    <label class="payment-select-label" for="razorpay-currency-option">Select currency</label>
                                    <select class="form-select" id="razorpay-currency-option">
                                        @foreach ($paymentConfig['razorpay_supported_currencies'] ?? [] as $currencyOption)
                                            <option value="{{ $currencyOption['key'] }}" @selected(($currencyOption['key'] ?? '') === 'USD')>
                                                {{ $currencyOption['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="payment-select mb-3">
                                    <label class="payment-select-label" for="razorpay-amount-option">Select payment amount</label>
                                    <select class="form-select" id="razorpay-amount-option">
                                        @foreach (($paymentConfig['razorpay_amount_options']['USD'] ?? []) as $option)
                                            <option value="{{ $option['key'] }}">
                                                {{ $option['label'] }} - {{ $option['amount'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="small text-muted mt-2" id="razorpay-amount-description">
                                        {{ $paymentConfig['razorpay_amount_options']['USD'][0]['description'] ?? '' }}
                                    </div>
                                    <div class="payment-tax-note" id="razorpay-tax-note"></div>
                                </div>

                                @if (!empty($razorpayConfig['key_id']))
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <input type="text" class="form-control payment-input" id="razorpay-name" placeholder="Full name">
                                        </div>
                                        <div class="col-12">
                                            <input type="email" class="form-control payment-input" id="razorpay-email" placeholder="Email address">
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control payment-input" id="razorpay-phone" placeholder="Phone number">
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="payment-action" id="razorpay-pay-button">Pay with Razorpay</button>
                                        </div>
                                    </div>

                                    <div id="razorpay-status" class="gateway-status"></div>
                                @else
                                    <div class="payment-note">
                                        Add <code>RAZORPAY_KEY_ID</code> and <code>RAZORPAY_KEY_SECRET</code> in your environment to enable the live Razorpay checkout on this page.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="payment-card">
                                <div class="payment-card-title">
                                    <span class="payment-card-icon payment-icon-paypal">
                                        <i class="bi bi-globe2"></i>
                                    </span>
                                    <span>For International Payments</span>
                                </div>

                                <p class="text-muted">
                                    Use PayPal for international payments. Select the payment type below, then complete checkout.
                                </p>

                                <div class="payment-select mb-3">
                                    <label class="payment-select-label" for="paypal-amount-option">Select payment amount</label>
                                    <select class="form-select" id="paypal-amount-option">
                                        @foreach ($paymentConfig['paypal_amount_options'] ?? [] as $option)
                                            <option value="{{ $option['key'] }}">
                                                {{ $option['label'] }} - {{ $option['currency'] }} {{ $option['amount'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="small text-muted mt-2" id="paypal-amount-description">
                                        {{ $paymentConfig['paypal_amount_options'][0]['description'] ?? '' }}
                                    </div>
                                    <div class="payment-tax-note" id="paypal-tax-note"></div>
                                </div>

                                @if (!empty($paypalConfig['client_id']))
                                    <button type="button" class="payment-action" id="paypal-open-modal-button">Review Total & PayPal</button>
                                    <div id="paypal-status" class="gateway-status"></div>
                                @else
                                    <div class="payment-note">
                                        Add <code>PAYPAL_CLIENT_ID</code> and <code>PAYPAL_CLIENT_SECRET</code> in your environment to enable the live PayPal button on this page.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="payment-card">
                                <div class="payment-card-title">
                                    <span class="payment-card-icon payment-icon-bank">
                                        <i class="bi bi-bank"></i>
                                    </span>
                                    <span>Bank Details</span>
                                </div>

                                <ul class="payment-bank-list">
                                    <li>
                                        <span class="payment-bank-label">Account Name</span>
                                        <span class="payment-bank-value">{{ $paymentConfig['bank']['account_name'] }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-bank-label">Account Number</span>
                                        <span class="payment-bank-value">{{ $paymentConfig['bank']['account_number'] }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-bank-label">Bank Name</span>
                                        <span class="payment-bank-value">{{ $paymentConfig['bank']['bank_name'] }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-bank-label">Branch</span>
                                        <span class="payment-bank-value">{{ $paymentConfig['bank']['branch'] }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-bank-label">IFSC Code</span>
                                        <span class="payment-bank-value">{{ $paymentConfig['bank']['ifsc'] }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-bank-label">SWIFT Code</span>
                                        <span class="payment-bank-value">{{ $paymentConfig['bank']['swift'] }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="payment-note">
                                After payment, please share your payment reference with the editorial office so your submission can be verified quickly.
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="payment-card">
                                <div class="payment-card-title">
                                    <span class="payment-card-icon payment-icon-bank">
                                        <i class="bi bi-card-checklist"></i>
                                    </span>
                                    <span>Payment Instructions</span>
                                </div>

                                <ul class="payment-list">
                                    <li>Authors should make the payment only after receiving the manuscript acceptance letter.</li>
                                    <li>After completing the payment, authors must send the payment receipt or transaction proof to the editorial office.</li>
                                    <li>The editorial team will verify the payment and proceed with the publication process.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="payment-card">
                                <div class="payment-card-title">
                                    <span class="payment-card-icon payment-icon-paypal">
                                        <i class="bi bi-exclamation-circle"></i>
                                    </span>
                                    <span>Important Notes</span>
                                </div>

                                <ul class="payment-list">
                                    <li>Submission of manuscripts is completely free of charge.</li>
                                    <li>The publication fee is non-refundable once the article enters the production stage.</li>
                                    {{-- <li>Payment of the processing fee does not guarantee acceptance of the manuscript.</li> --}}
                                    <li>All manuscripts undergo a strict peer-review process before acceptance.</li>
                                    <li>Additional processing charges may apply for lengthy manuscripts.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="payment-contact">
                                <h4 class="fw-bold mb-3">Contact for Payment Assistance</h4>
                                <div class="mb-1"><strong>IRGS Publisher</strong></div>
                                <div class="mb-1">International Research &amp; Global Society</div>
                                <div><strong>Phone:</strong> +91-7002207076</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    @include('partials.quicklinks1')
                    @include('partials.top_editors')
                </div>
            </div>
        </div>
    </div>

    <div class="payment-tax-modal" id="payment-tax-modal" aria-hidden="true">
        <div class="payment-tax-dialog" role="dialog" aria-modal="true" aria-labelledby="payment-tax-modal-title">
            <h3 class="fw-bold mb-2" id="payment-tax-modal-title">Confirm payment total</h3>
            <p class="text-muted mb-0" id="payment-tax-modal-message"></p>
            <ul class="payment-tax-breakdown" id="payment-tax-breakdown"></ul>
            <div class="payment-tax-actions">
                <button type="button" class="payment-secondary-action" id="payment-tax-cancel-button">Cancel</button>
                <button type="button" class="payment-action" id="payment-tax-confirm-button">Continue to payment</button>
            </div>
            <div id="payment-tax-paypal-wrap" style="display: none; margin-top: 14px;">
                <div id="payment-tax-paypal-container"></div>
            </div>
        </div>
    </div>

    <script>
        function updateGatewayStatus(element, message, type) {
            if (!element) {
                return;
            }

            element.textContent = message;
            element.className = 'gateway-status' + (type ? ' ' + type : '');
        }

        const paymentTaxConfig = @json($paymentConfig['tax'] ?? []);
        const paymentTaxModal = document.getElementById('payment-tax-modal');
        const paymentTaxModalMessage = document.getElementById('payment-tax-modal-message');
        const paymentTaxBreakdown = document.getElementById('payment-tax-breakdown');
        const paymentTaxCancelButton = document.getElementById('payment-tax-cancel-button');
        const paymentTaxConfirmButton = document.getElementById('payment-tax-confirm-button');
        const paymentTaxPaypalWrap = document.getElementById('payment-tax-paypal-wrap');
        let pendingPaymentConfirmation = null;
        let paymentTaxModalMode = 'confirm';

        function formatPaymentAmount(amount, currency) {
            const numericAmount = Number(amount || 0);

            return numericAmount.toLocaleString(undefined, {
                style: 'currency',
                currency: currency || 'USD',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function calculatePaymentTotals(option) {
            const amount = option && option.amount ? option.amount : 0;
            const baseAmount = Number(amount || 0);
            const tax = option && option.tax ? option.tax : {};
            const isTaxEnabled = !paymentTaxConfig || paymentTaxConfig.enabled !== false;
            const taxType = String(tax.type || '').toLowerCase();
            const taxValue = Number(tax.value || 0);
            let taxAmount = 0;

            if (isTaxEnabled && taxType === 'percentage') {
                taxAmount = Number((baseAmount * taxValue / 100).toFixed(2));
            } else if (isTaxEnabled && taxType === 'fixed') {
                taxAmount = Number(taxValue.toFixed(2));
            }

            const totalAmount = Number((baseAmount + taxAmount).toFixed(2));
            let taxText = paymentTaxConfig.label || 'Tax';

            if (taxAmount > 0 && taxType === 'percentage') {
                taxText += ' (' + taxValue + '%)';
            } else if (taxAmount > 0 && taxType === 'fixed') {
                taxText += ' (Fixed)';
            }

            return {
                baseAmount: baseAmount,
                taxType: taxType,
                taxValue: taxValue,
                taxAmount: taxAmount,
                totalAmount: totalAmount,
                taxLabel: taxText
            };
        }

        function renderTaxNote(element, option, currency) {
            if (!element) {
                return;
            }

            const totals = calculatePaymentTotals(option || {});

            if (totals.taxAmount <= 0) {
                element.textContent = 'Total payable: ' + formatPaymentAmount(totals.totalAmount, currency);
                return;
            }

            element.textContent = totals.taxLabel + ': ' + formatPaymentAmount(totals.taxAmount, currency) + '. Total payable: ' + formatPaymentAmount(totals.totalAmount, currency);
        }

        function hidePaymentTaxModal() {
            if (!paymentTaxModal) {
                return;
            }

            paymentTaxModal.classList.remove('is-visible');
            paymentTaxModal.setAttribute('aria-hidden', 'true');
            pendingPaymentConfirmation = null;
            paymentTaxModalMode = 'confirm';

            if (paymentTaxConfirmButton) {
                paymentTaxConfirmButton.style.display = '';
            }

            if (paymentTaxPaypalWrap) {
                paymentTaxPaypalWrap.style.display = 'none';
            }
        }

        function showPaymentTaxModal(config) {
            if (!paymentTaxModal || !paymentTaxModalMessage || !paymentTaxBreakdown || !paymentTaxConfirmButton) {
                return Promise.resolve(true);
            }

            pendingPaymentConfirmation = null;
            paymentTaxModalMode = config.mode || 'confirm';

            paymentTaxModalMessage.textContent = config.message;
            paymentTaxBreakdown.innerHTML = '';

            config.rows.forEach(function(row) {
                const rowElement = document.createElement('li');
                const labelElement = document.createElement('span');
                const valueElement = document.createElement('span');

                labelElement.textContent = row.label;
                valueElement.textContent = row.value;

                rowElement.appendChild(labelElement);
                rowElement.appendChild(valueElement);
                paymentTaxBreakdown.appendChild(rowElement);
            });

            paymentTaxConfirmButton.style.display = paymentTaxModalMode === 'paypal' ? 'none' : '';

            if (paymentTaxPaypalWrap) {
                paymentTaxPaypalWrap.style.display = paymentTaxModalMode === 'paypal' ? 'block' : 'none';
            }

            paymentTaxModal.classList.add('is-visible');
            paymentTaxModal.setAttribute('aria-hidden', 'false');

            if (paymentTaxModalMode === 'paypal') {
                return Promise.resolve(true);
            }

            return new Promise(function(resolve) {
                pendingPaymentConfirmation = resolve;
            });
        }

        if (paymentTaxCancelButton) {
            paymentTaxCancelButton.addEventListener('click', function() {
                if (pendingPaymentConfirmation) {
                    pendingPaymentConfirmation(false);
                }

                hidePaymentTaxModal();
            });
        }

        if (paymentTaxConfirmButton) {
            paymentTaxConfirmButton.addEventListener('click', function() {
                if (pendingPaymentConfirmation) {
                    pendingPaymentConfirmation(true);
                }

                hidePaymentTaxModal();
            });
        }

        if (paymentTaxModal) {
            paymentTaxModal.addEventListener('click', function(event) {
                if (event.target === paymentTaxModal) {
                    if (pendingPaymentConfirmation) {
                        pendingPaymentConfirmation(false);
                    }

                    hidePaymentTaxModal();
                }
            });
        }
    </script>

    @if (!empty($razorpayConfig['key_id']))
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            const razorpayStatus = document.getElementById('razorpay-status');
            const razorpayCurrencySelect = document.getElementById('razorpay-currency-option');
            const razorpayAmountSelect = document.getElementById('razorpay-amount-option');
            const razorpayAmountDescription = document.getElementById('razorpay-amount-description');
            const razorpayAmountOptions = @json($paymentConfig['razorpay_amount_options'] ?? []);
            const razorpaySupportedCurrencies = @json($paymentConfig['razorpay_supported_currencies'] ?? []);
            const razorpayPayButton = document.getElementById('razorpay-pay-button');
            const razorpayName = document.getElementById('razorpay-name');
            const razorpayEmail = document.getElementById('razorpay-email');
            const razorpayPhone = document.getElementById('razorpay-phone');
            const razorpayTaxNote = document.getElementById('razorpay-tax-note');

            function getSelectedRazorpayCurrency() {
                if (!razorpayCurrencySelect) {
                    return 'USD';
                }

                return razorpayCurrencySelect.value || 'USD';
            }

            function getSelectedRazorpayCurrencyLabel() {
                const selectedCurrency = razorpaySupportedCurrencies.find(function(currencyOption) {
                    return currencyOption.key === getSelectedRazorpayCurrency();
                });

                return selectedCurrency && selectedCurrency.symbol ? selectedCurrency.symbol : getSelectedRazorpayCurrency();
            }

            function getRazorpayOptionsForCurrency() {
                return razorpayAmountOptions[getSelectedRazorpayCurrency()] || [];
            }

            function rebuildRazorpayAmountOptions() {
                if (!razorpayAmountSelect) {
                    return;
                }

                const options = getRazorpayOptionsForCurrency();
                razorpayAmountSelect.innerHTML = '';

                options.forEach(function(option) {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.key;
                    optionElement.textContent = option.label + ' - ' + option.amount;
                    razorpayAmountSelect.appendChild(optionElement);
                });
            }

            function updateRazorpayDescription() {
                if (!razorpayAmountSelect || !razorpayAmountDescription) {
                    return;
                }

                const selectedOption = getRazorpayOptionsForCurrency().find(function(option) {
                    return option.key === razorpayAmountSelect.value;
                });

                if (!selectedOption) {
                    razorpayAmountDescription.textContent = '';
                    return;
                }

                const currencyLabel = getSelectedRazorpayCurrencyLabel();
                const description = selectedOption.description ? selectedOption.description + '. ' : '';
                razorpayAmountDescription.textContent = description + 'Selected amount: ' + currencyLabel + ' ' + selectedOption.amount;
                renderTaxNote(razorpayTaxNote, selectedOption, getSelectedRazorpayCurrency());
            }

            function getSelectedRazorpayOption() {
                return getRazorpayOptionsForCurrency().find(function(option) {
                    return option.key === (razorpayAmountSelect ? razorpayAmountSelect.value : '');
                });
            }

            function setRazorpayButtonLoading(isLoading) {
                if (!razorpayPayButton) {
                    return;
                }

                razorpayPayButton.disabled = isLoading;
                razorpayPayButton.textContent = isLoading ? 'Processing...' : 'Pay with Razorpay';
            }

            if (razorpayPayButton) {
                razorpayPayButton.addEventListener('click', async function() {
                    updateGatewayStatus(razorpayStatus, '', '');

                    if (!razorpayName.value.trim() || !razorpayEmail.value.trim()) {
                        updateGatewayStatus(razorpayStatus, 'Name and email are required to continue with Razorpay.', 'is-error');
                        return;
                    }

                    const selectedOption = getSelectedRazorpayOption();

                    if (!selectedOption) {
                        updateGatewayStatus(razorpayStatus, 'Please select a valid payment amount to continue.', 'is-error');
                        return;
                    }

                    const totals = calculatePaymentTotals(selectedOption);
                    const shouldContinue = await showPaymentTaxModal({
                        message: 'Please review the payable amount before opening Razorpay checkout.',
                        rows: [
                            { label: 'Base amount', value: formatPaymentAmount(totals.baseAmount, getSelectedRazorpayCurrency()) },
                            { label: totals.taxLabel, value: formatPaymentAmount(totals.taxAmount, getSelectedRazorpayCurrency()) },
                            { label: 'Total payable', value: formatPaymentAmount(totals.totalAmount, getSelectedRazorpayCurrency()) }
                        ]
                    });

                    if (!shouldContinue) {
                        return;
                    }

                    setRazorpayButtonLoading(true);
                    updateGatewayStatus(razorpayStatus, 'Creating Razorpay order...', 'is-info');

                    fetch('/razorpay/orders', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            amount_option: razorpayAmountSelect ? razorpayAmountSelect.value : null,
                            currency: getSelectedRazorpayCurrency(),
                            name: razorpayName.value.trim(),
                            email: razorpayEmail.value.trim(),
                            phone: razorpayPhone ? razorpayPhone.value.trim() : ''
                        })
                    }).then(function(response) {
                        return response.json().then(function(payload) {
                            if (!response.ok) {
                                throw new Error(payload.message || 'Unable to create Razorpay order.');
                            }

                            return payload;
                        });
                    }).then(function(payload) {
                        const razorpay = new Razorpay({
                            key: '{{ $razorpayConfig['key_id'] }}',
                            amount: payload.amount,
                            currency: payload.currency,
                            name: payload.name,
                            description: payload.description,
                            order_id: payload.id,
                            handler: function(response) {
                                updateGatewayStatus(razorpayStatus, 'Verifying Razorpay payment...', 'is-info');

                                fetch('/razorpay/verify', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify(response)
                                }).then(function(verifyResponse) {
                                    return verifyResponse.json().then(function(verifyPayload) {
                                        if (!verifyResponse.ok) {
                                            throw new Error(verifyPayload.message || 'Unable to verify Razorpay payment.');
                                        }

                                        return verifyPayload;
                                    });
                                }).then(function(verifyPayload) {
                                    const paymentId = verifyPayload.order && verifyPayload.order.razorpay_payment_id ? verifyPayload.order.razorpay_payment_id : '';
                                    const message = 'Payment completed successfully' + (paymentId ? ' (Payment ID: ' + paymentId + ')' : '.');
                                    updateGatewayStatus(razorpayStatus, message, 'is-success');
                                }).catch(function(error) {
                                    updateGatewayStatus(razorpayStatus, error && error.message ? error.message : 'Razorpay payment verification failed.', 'is-error');
                                }).finally(function() {
                                    setRazorpayButtonLoading(false);
                                });
                            },
                            prefill: payload.prefill || {},
                            theme: {
                                color: '{{ $razorpayConfig['theme_color'] ?? '#0d3b8e' }}'
                            },
                            modal: {
                                ondismiss: function() {
                                    updateGatewayStatus(razorpayStatus, 'Razorpay checkout was closed before payment completion.', 'is-error');
                                    setRazorpayButtonLoading(false);
                                }
                            }
                        });

                        razorpay.open();
                    }).catch(function(error) {
                        updateGatewayStatus(razorpayStatus, error && error.message ? error.message : 'Razorpay payment could not be started. Please try again.', 'is-error');
                        setRazorpayButtonLoading(false);
                    });
                });
            }

            updateRazorpayDescription();

            if (razorpayAmountSelect) {
                razorpayAmountSelect.addEventListener('change', updateRazorpayDescription);
            }

            if (razorpayCurrencySelect) {
                razorpayCurrencySelect.addEventListener('change', function() {
                    rebuildRazorpayAmountOptions();
                    updateRazorpayDescription();
                });
            }

            rebuildRazorpayAmountOptions();
            updateRazorpayDescription();
        </script>
    @endif

    @if (!empty($paypalConfig['client_id']))
        <script src="https://www.paypal.com/sdk/js?client-id={{ urlencode($paypalConfig['client_id']) }}&currency={{ urlencode($paypalConfig['currency'] ?? 'USD') }}&intent={{ urlencode(strtolower($paypalConfig['intent'] ?? 'CAPTURE')) }}"></script>
        <script>
            const paypalStatus = document.getElementById('paypal-status');
            const amountSelect = document.getElementById('paypal-amount-option');
            const amountDescription = document.getElementById('paypal-amount-description');
            const amountOptions = @json($paymentConfig['paypal_amount_options'] ?? []);
            const paypalTaxNote = document.getElementById('paypal-tax-note');
            const paypalOpenModalButton = document.getElementById('paypal-open-modal-button');

            function updateAmountDescription() {
                if (!amountSelect || !amountDescription) {
                    return;
                }

                const selectedOption = amountOptions.find(function(option) {
                    return option.key === amountSelect.value;
                });

                amountDescription.textContent = selectedOption && selectedOption.description ? selectedOption.description : '';
                renderTaxNote(paypalTaxNote, selectedOption || {}, selectedOption ? selectedOption.currency : 'USD');
            }

            if (window.paypal) {
                paypal.Buttons({
                    style: {
                        layout: 'vertical',
                        color: 'gold',
                        shape: 'rect',
                        label: 'paypal'
                    },
                    createOrder: function() {
                        updateGatewayStatus(paypalStatus, '', '');

                        return fetch('/paypal/orders', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                amount_option: amountSelect ? amountSelect.value : null
                            })
                        }).then(function(response) {
                            return response.json().then(function(payload) {
                                if (!response.ok) {
                                    throw new Error(payload.message || 'Unable to create PayPal order.');
                                }

                                return payload.id;
                            });
                        });
                    },
                    onApprove: function(data) {
                        return fetch('/paypal/orders/' + data.orderID + '/capture', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        }).then(function(response) {
                            return response.json().then(function(payload) {
                                if (!response.ok) {
                                    throw new Error(payload.message || 'Unable to capture PayPal order.');
                                }

                                const payerName = payload.order && payload.order.payer_name ? payload.order.payer_name : 'Customer';
                                const transactionId = payload.order && payload.order.paypal_capture_id ? payload.order.paypal_capture_id : '';
                                const message = 'Payment completed successfully for ' + payerName + (transactionId ? ' (Transaction ID: ' + transactionId + ')' : '.');
                                updateGatewayStatus(paypalStatus, message, 'is-success');
                            });
                        });
                    },
                    onError: function(error) {
                        updateGatewayStatus(paypalStatus, error && error.message ? error.message : 'PayPal payment could not be completed. Please try again.', 'is-error');
                    }
                }).render('#payment-tax-paypal-container');
            }

            if (paypalOpenModalButton) {
                paypalOpenModalButton.addEventListener('click', function() {
                    updateGatewayStatus(paypalStatus, '', '');

                    const selectedOption = amountOptions.find(function(option) {
                        return option.key === (amountSelect ? amountSelect.value : '');
                    });

                    if (!selectedOption) {
                        updateGatewayStatus(paypalStatus, 'Please select a valid PayPal payment amount.', 'is-error');
                        return;
                    }

                    const totals = calculatePaymentTotals(selectedOption);
                    showPaymentTaxModal({
                        mode: 'paypal',
                        message: 'Please review the payable amount, then click the PayPal button below.',
                        rows: [
                            { label: 'Base amount', value: formatPaymentAmount(totals.baseAmount, selectedOption.currency) },
                            { label: totals.taxLabel, value: formatPaymentAmount(totals.taxAmount, selectedOption.currency) },
                            { label: 'Total payable', value: formatPaymentAmount(totals.totalAmount, selectedOption.currency) }
                        ]
                    });
                });
            }

            updateAmountDescription();

            if (amountSelect) {
                amountSelect.addEventListener('change', updateAmountDescription);
            }
        </script>
    @endif
@endsection
