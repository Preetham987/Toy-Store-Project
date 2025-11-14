<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Invoice</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        .invoice-box {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h2 { margin: 0; font-size: 22px; text-transform: uppercase; }
        .order-meta { text-align: right; margin-bottom: 20px; }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 15px 0 8px 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            color: #444;
        }
        table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        th { background: #f8f8f8; font-weight: bold; text-align: center; }
        td { vertical-align: top; }
        .totals { text-align: right; font-size: 14px; font-weight: bold; margin-top: 10px; }
        .customer-info, .address-info, .payment-info { margin-bottom: 15px; }
        .address-info p, .payment-info p { margin: 2px 0; }
    </style>
</head>
<body>
<div class="invoice-box">
    <div class="header">
        <h2>Invoice</h2>
        <small>Thank you for your purchase!</small>
    </div>

    <div class="order-meta">
        <p><strong>Order #:</strong> {{ $order->order_number }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
    </div>

    <div class="customer-info">
        <div class="section-title">Customer Information</div>
        <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
    </div>

    @if($order->address)
    <div class="address-info">
        <div class="section-title">Shipping Address</div>
        <p>{{ $order->address->first_name }} {{ $order->address->last_name }}</p>
        <p>{{ $order->address->address_line1 }}</p>
        @if($order->address->address_line2)
            <p>{{ $order->address->address_line2 }}</p>
        @endif
        <p>{{ $order->address->city }}, {{ $order->address->state }}</p>
        <p>{{ $order->address->postal_code }}</p>
        <p>{{ $order->address->country }}</p>
    </div>
    @endif

    {{-- Payment Status Section --}}
    <div class="payment-info">
        <div class="section-title">Payment Status</div>
        <p>{{ ucfirst($order->payment_status) }} ({{ ucfirst($order->payment_method) }})</p>
    </div>

    <div class="section-title">Order Items</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th style="text-align:left">Product</th>
                <th>Qty</th>
                <th>Price (₹)</th>
                <th>Total (₹)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $key => $item)
                <tr>
                    <td style="text-align:center">{{ $key+1 }}</td>
                    <td>{{ $item->product_name ?? 'N/A' }}</td>
                    <td style="text-align:center">{{ $item->quantity }}</td>
                    <td style="text-align:right">{{ number_format($item->price,2) }}</td>
                    <td style="text-align:right">{{ number_format($item->price * $item->quantity,2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        Grand Total: ₹ {{ number_format($order->total_amount,2) }}
    </div>
</div>
</body>
</html>
