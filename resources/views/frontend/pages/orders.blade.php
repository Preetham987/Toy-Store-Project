{{-- resources/views/account-orders.blade.php --}}

@include('frontend.layouts.header')

<section class="account-orders-wrapper">

    @include('frontend.layouts.sidebar-2')

<div class="orders-panel">
    <div class="orders-header">
        <span class="orders-title">Account Overview / Order History</span>
    </div>
    <div class="orders-tabs">
        <a href="#" class="order-tab active">All Orders</a>
    </div>

    @if($orders->isEmpty())
        <div class="orders-empty">
            <div class="orders-empty-notice">You have no orders to display.</div>
        </div>
    @else
        <div class="orders-list" style="display: grid; gap: 15px;">
            @foreach($orders as $order)
                <div class="order-card" style="
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 15px;
                    background-color: #fff;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
                ">
                    <div style="font-weight: bold; font-size: 16px; margin-bottom: 8px;">
                        Order #{{ $order->id }}
                    </div>
                    <div style="color: #666; margin-bottom: 4px;">
                        Date: {{ $order->created_at->format('d M Y') }}
                    </div>
                    <div style="color: #444; margin-bottom: 4px;">
                        Status: 
                        <span style="font-weight: bold; color: 
                            {{ $order->status == 'new' ? 'green' : ($order->status == 'cancel' ? 'red' : '#444') }};">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div style="color: #444; margin-bottom: 4px;">
                        Payment: 
                        <span style="font-weight: bold; color: {{ $order->payment_status == 'paid' ? 'green' : 'red' }};">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                    <div style="color: #444; margin-bottom: 8px;">
                        Total: ${{ number_format($order->total_amount, 2) }}
                    </div>

@if($order->status != 'cancel')
    <div style="display: flex; gap: 8px;">
        <!-- View Orders Link -->
        <a href="javascript:void(0)" onclick="openOrderModal({{ $order->id }})" style="
            padding: 6px 14px;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        ">
            View Order
        </a>

        <!-- Cancel Button -->
        <form action="{{ route('order.cancel', $order->id) }}" method="POST" 
            onsubmit="return confirm('Are you sure you want to cancel this order?');">
            @csrf
            @method('PATCH')
            <button type="submit" style="
                padding: 6px 14px;
                background: red;
                color: #fff;
                border-radius: 5px;
                border: none;
                font-size: 14px;
                cursor: pointer;
            ">
                Cancel Order
            </button>
        </form>
    </div>

    <!-- Improved Popup Modal -->
    <div id="orderModal-{{ $order->id }}" style="
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    " onclick="closeOrderModal({{ $order->id }})">
        <div style="
            background: #fff;
            border-radius: 10px;
            padding: 20px 25px;
            width: 700px;
            max-width: 95%;
            position: relative;
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
            animation: fadeIn 0.3s ease;
        " onclick="event.stopPropagation()">

            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0; font-size: 20px; color: #333;">Order #{{ $order->id }}</h2>
                <span onclick="closeOrderModal({{ $order->id }})" style="
                    font-size: 24px;
                    font-weight: bold;
                    color: #666;
                    cursor: pointer;
                ">&times;</span>
            </div>

            <!-- Order Info -->
            <div style="margin-bottom: 15px;">
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p><strong>Status:</strong> 
                    <span style="color: {{ $order->status == 'new' ? 'green' : ($order->status == 'cancel' ? 'red' : '#444') }};">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                <p><strong>Payment:</strong> 
                    <span style="color: {{ $order->payment_status == 'paid' ? 'green' : 'red' }};">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </p>
                <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            </div>

            <!-- Items Table -->
            <h3 style="margin-bottom: 10px;">Order Items</h3>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                    <tr style="background: #f5f5f5; text-align: left;">
                        <th style="padding: 8px; border-bottom: 1px solid #ddd;">Product</th>
                        <th style="padding: 8px; border-bottom: 1px solid #ddd;">Qty</th>
                        <th style="padding: 8px; border-bottom: 1px solid #ddd;">Price</th>
                        <th style="padding: 8px; border-bottom: 1px solid #ddd;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ $item->product_name }}</td>
                            <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ $item->quantity }}</td>
                            <td style="padding: 8px; border-bottom: 1px solid #eee;">${{ number_format($item->price, 2) }}</td>
                            <td style="padding: 8px; border-bottom: 1px solid #eee;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Footer -->
            <div style="text-align: right;">
                <a href="javascript:void(0)" onclick="closeOrderModal({{ $order->id }})" style="
                    padding: 8px 16px;
                    background: #333;
                    color: #fff;
                    border-radius: 5px;
                    text-decoration: none;
                    font-size: 14px;
                ">Close</a>
            </div>
        </div>
    </div>
@endif

</div>
<script>
function openOrderModal(id) {
    document.getElementById('orderModal-' + id).style.display = 'flex';
}

function closeOrderModal(id) {
    document.getElementById('orderModal-' + id).style.display = 'none';
}
</script>

            @endforeach
        </div>
    @endif
</div>
</section>

@include('frontend.layouts.footer')
