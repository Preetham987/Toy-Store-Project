{{-- resources/views/account-payment-methods.blade.php --}}

@include('frontend.layouts.header')

<section class="account-payment-methods-wrapper">

    @include('frontend.layouts.sidebar-2')

    <div class="payment-methods-panel">
        <h1 class="main-title">My Payment Methods</h1>
        <div class="payment-actions">
            <form action="{{ url('new-credit-card') }}" method="post">
                @csrf
                <button class="add-btn">Add New Credit Card</button>
            </form>
            <form action="{{ url('paypal') }}" method="post">
                @csrf
                <button class="add-btn">Add PayPal</button>
            </form>
        </div>
        <div class="no-payment-msg">
            You have not added any Payment Methods.
        </div>
    </div>
</section>

@include('frontend.layouts.footer')
