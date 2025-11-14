@include('frontend.layouts.header')

<section class="account-shipments-wrapper">

    @include('frontend.layouts.sidebar-2')

    <div class="shipments-panel">
        <div class="shipments-header">
            <span class="shipments-title">Account Overview / Shipments</span>
        </div>

        @if($shipments->isEmpty())
            <div class="shipments-message">
                You have no shipments
            </div>
        @else
            @foreach($shipments as $shipment)
                <div class="shipment-card" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 8px; background:#fff; box-shadow:0 2px 6px rgba(0,0,0,0.05);">
                    <strong>Order #{{ $shipment->id }}</strong><br>
                    Date: {{ $shipment->created_at->format('d M Y') }}<br>
                    Status: {{ ucfirst($shipment->status) }}<br>
                    Total: ${{ number_format($shipment->total_amount, 2) }}<br><br>

                    {{-- View Order Button --}}
                    <a href="#" 
                    class="view-order-btn" 
                    data-order-id="{{ $shipment->id }}">
                        View Order
                    </a>

                    {{-- Download Invoice Button --}}
                    <a href="{{ route('order.pdf', $shipment->id) }}" 
                    class="download-invoice-btn">
                        Download Invoice
                    </a>
                </div>

                {{-- Popup Modal --}}
                <div id="order-modal-{{ $shipment->id }}" class="order-modal">
                    <div class="order-modal-content">
                        {{-- Modal Header with Order Number + Close --}}
                        <div class="order-modal-header">
                            <h2>Order #{{ $shipment->id }}</h2>
                            <span class="close-modal" data-order-id="{{ $shipment->id }}">&times;</span>
                        </div>

                        <div class="order-modal-body">
                            <p><strong>Date:</strong> {{ $shipment->created_at->format('d M Y') }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($shipment->status) }}</p>
                            <p><strong>Total:</strong> ${{ number_format($shipment->total_amount, 2) }}</p>

                            <h3>Items</h3>
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shipment->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>

<style>
/* View Order Button */
.view-order-btn {
    display: inline-block;
    padding: 8px 16px;
    background: #007bff;
    color: #fff !important;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: 0.3s ease;
}
.view-order-btn:hover {
    background: #0056b3;
}

/* Download Invoice Button */
.download-invoice-btn {
    display: inline-block;
    padding: 8px 16px;
    background: #28a745;
    color: #fff !important;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: 0.3s ease;
    margin-left: 8px;
}
.download-invoice-btn:hover {
    background: #1e7e34;
}

/* Modal Styling */
.order-modal {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.6);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.order-modal-content {
    background: #fff;
    width: 75%;
    max-width: 950px;
    padding: 25px;
    border-radius: 12px;
    position: relative;
    box-shadow: 0 6px 18px rgba(0,0,0,0.25);
    animation: fadeIn 0.3s ease;
}

/* Modal Header */
.order-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #007bff;
    color: #fff;
    padding: 14px 20px;
    border-radius: 12px 12px 0 0;
}

.order-modal-header h2 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
}

.order-modal-body {
    padding: 20px;
}

/* Close Button (inside header now) */
.order-modal-header .close-modal {
    font-size: 26px;
    font-weight: bold;
    cursor: pointer;
    color: #fff;
    transition: 0.2s;
}
.order-modal-header .close-modal:hover {
    color: #ffcccc;
}

/* Headings */
.order-modal-content h2 {
    margin-bottom: 12px;
    font-size: 22px;
    border-bottom: 1px solid #eee;
    padding-bottom: 8px;
}
.order-modal-content h3 {
    margin-top: 20px;
    font-size: 18px;
}

/* Table Styling */
.order-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
.order-table th, .order-table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    text-align: left;
}
.order-table th {
    background: #f9f9f9;
    font-weight: 600;
}
.order-table tr:hover {
    background: #fdfdfd;
}

/* Animation */
@keyframes fadeIn {
    from {opacity: 0; transform: scale(0.95);}
    to {opacity: 1; transform: scale(1);}
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Open modal
        document.querySelectorAll(".view-order-btn").forEach(function (link) {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                let id = this.getAttribute("data-order-id");
                document.getElementById("order-modal-" + id).style.display = "flex";
            });
        });

        // Close modal
        document.querySelectorAll(".close-modal").forEach(function (btn) {
            btn.addEventListener("click", function () {
                let id = this.getAttribute("data-order-id");
                document.getElementById("order-modal-" + id).style.display = "none";
            });
        });

        // Close when clicking outside content
        document.querySelectorAll(".order-modal").forEach(function (modal) {
            modal.addEventListener("click", function (e) {
                if (e.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
    });
</script>

@include('frontend.layouts.footer')
