{{-- resources/views/account-preorders.blade.php --}}

@include('frontend.layouts.header')

<section class="account-preorders-wrapper">

    @include('frontend.layouts.sidebar-2')

    <div class="preorder-panel">
        <div class="preorder-header">
            <span class="preorder-title">Account Overview / Pre-orders</span>
        </div>
        <div class="preorder-actions">
            <a href="{{ url('address-book') }}" class="edit-all-link">Edit Shipping Address for all Pre-orders</a>
            <a href="{{ url('wallet') }}" class="edit-all-link">Edit Payment Method for all Pre-orders</a>
        </div>
        <div class="preorder-message">
            You have no pre-orders
        </div>
    </div>
</section>

@include('frontend.layouts.footer')
