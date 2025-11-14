<nav class="account-sidebar">
    <div class="sidebar-section">
        <div class="sidebar-title">My Orders</div>
        <ul>
            <li><a href="{{ url('orders') }}">Orders</a></li>
            <li><a href="{{ url('pre-order') }}">Pre-orders</a></li>
            <li><a href="{{ url('shipment') }}">Shipments</a></li>
        </ul>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-title">My Account</div>
        <ul>
            <li><a href="{{ url('account') }}">Account Overview</a></li>
            <li><a href="{{ url('address-book') }}">Address Book</a></li>
            <!-- <li><a href="{{ url('wallet') }}">Wallet</a></li> -->
            <li><a href="{{ url('change-password') }}">Change Password</a></li>
        </ul>
    </div>
</nav>
