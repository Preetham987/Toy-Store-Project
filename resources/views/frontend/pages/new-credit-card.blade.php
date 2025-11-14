{{-- resources/views/account-payment-add.blade.php --}}

@include('frontend.layouts.header')

<section class="account-payment-add-wrapper">

    @include('frontend.layouts.sidebar-2')

    <div class="payment-add-panel">
        <div class="required-note">* indicates a required field.</div>
        <form class="add-payment-form" method="POST" action="{{ url('account/payment-methods/store') }}">
            @csrf
            <fieldset>
                <legend>Credit Card Details</legend>
                <div class="form-group">
                    <label for="card-number">Card Number<span class="asterisk">*</span></label>
                    <input type="text" id="card-number" name="card_number" required>
                </div>
                <div class="form-group">
                    <label for="card-code">Card Security Code<span class="asterisk">*</span></label>
                    <input type="text" id="card-code" name="card_code" required>
                </div>
                <div class="form-group-inline">
                    <div>
                        <label for="exp-month">Expiration Month<span class="asterisk">*</span></label>
                        <input type="text" id="exp-month" name="expiration_month" placeholder="MM" maxlength="2" required>
                    </div>
                    <div>
                        <label for="exp-year">Expiration Year<span class="asterisk">*</span></label>
                        <input type="text" id="exp-year" name="expiration_year" placeholder="YYYY" maxlength="4" required>
                    </div>
                </div>
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="make-preferred" name="make_preferred" checked>
                    <label for="make-preferred">
                        Make this my preferred payment method
                    </label>
                </div>
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="save-btn">Add Payment Method</button>
                <button type="button" class="cancel-btn" onclick="window.history.back()">Cancel</button>
            </div>
        </form>
    </div>
</section>

@include('frontend.layouts.footer')
