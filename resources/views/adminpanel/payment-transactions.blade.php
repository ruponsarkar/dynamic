@extends('adminpanel/layout')

@section('title', 'Payment transactions')
@section('breadcrumb', 'Payment transactions')

@section('content')
<section class="content">
    <div class="container-fluid">
        <header class="admin-page-heading">
            <h1>Payment transactions</h1>
            <p>Online payments started through PayPal and Razorpay, newest first. UPI and bank transfers aren't recorded here.</p>
        </header>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Razorpay</h3></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover small">
                    <thead>
                        <tr><th>Date</th><th>Payer</th><th>Amount</th><th>Method</th><th>Status</th><th>Payment ID</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($razorpayOrders as $order)
                            <tr>
                                <td>{{ optional($order->created_at)->format('Y-m-d H:i') }}</td>
                                <td>{{ $order->payer_name }}<br><small>{{ $order->payer_email }} {{ $order->payer_phone }}</small></td>
                                <td>{{ $order->currency_code }} {{ $order->amount_value }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->razorpay_payment_id ?: $order->razorpay_order_id }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">No Razorpay transactions yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $razorpayOrders->links('pagination::bootstrap-4') }}
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">PayPal</h3></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover small">
                    <thead>
                        <tr><th>Date</th><th>Payer</th><th>Amount</th><th>Status</th><th>Capture ID</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($paypalOrders as $order)
                            <tr>
                                <td>{{ optional($order->created_at)->format('Y-m-d H:i') }}</td>
                                <td>{{ $order->payer_name }}<br><small>{{ $order->payer_email }}</small></td>
                                <td>{{ $order->currency_code }} {{ $order->amount_value }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->paypal_capture_id ?: $order->paypal_order_id }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No PayPal transactions yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $paypalOrders->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</section>
@endsection
