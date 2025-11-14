@include('frontend.layouts.header')

<section class="account-dashboard">

    @include('frontend.layouts.sidebar-2')

    <main class="account-main">
        <div class="account-panels">
            <!-- Recent Orders -->
            <div class="panel">
                <div class="panel-title">Recent Orders</div>
                <div class="panel-body">
                    You have placed <strong>0 order(s)</strong> in the past 30 days.
                    <br><br>
                    <a href="{{ url('orders') }}" class="panel-btn">View Order History</a>
                </div>
            </div>

            <!-- Pre-orders -->
            <div class="panel">
                <div class="panel-title">Pre-orders</div>
                <div class="panel-body">
                    You have <strong>0 item(s)</strong> on Pre-order
                    <br><br>
                    <a href="{{ url('pre-order') }}" class="panel-btn">View Pre-orders</a>
                </div>
            </div>

            <!-- Store Credit -->
            
        </div>

        <!-- Account Details -->
        <aside class="account-details">
            <div class="details-section">
                <div class="details-title">Account Details</div>
                <div class="details-item"><b>Name:</b> {{ Auth::user()->name ?? 'Guest' }}</div>
                <div class="details-item"><b>Email:</b> {{ Auth::user()->email ?? 'Not available' }}</div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="signout-btn">Sign Out</button>
                </form>
            </div>
            <div class="panel">
                <div class="panel-title">Store Credit</div>
                <div class="panel-body">
                    You currently have <strong>$0.00</strong> in Store Credit.
                </div>
            </div>
            <!-- Preferred Shipping Address -->
            <!-- <div class="details-section">
                <div class="details-title">Preferred Shipping Address</div>
                <div class="details-highlight">No Preferred Shipping Address selected.</div>
                <a href="{{ url('address-book') }}" class="preference-btn">Change Preference</a>
            </div> -->

            <!-- Preferred Payment -->
            <!-- <div class="details-section">
                <div class="details-title">Preferred Payment</div>
                <div class="details-highlight">No Preferred Payment Method selected.</div>
                <button class="preference-btn">Change Preference</button>
            </div> -->
        </aside>
    </main>
</section>

@include('frontend.layouts.footer')
