{{-- resources/views/new-address.blade.php --}}

@include('frontend.layouts.header')

<section class="account-address-form-wrapper">

    @include('frontend.layouts.sidebar-2')

    <div class="address-form-panel">
        <h1 class="main-title">Address Book / Address Book</h1>
        <div class="address-form-card">
            <form method="POST" action="{{ url('account/address/create') }}">
                @csrf
                <div class="address-form-row">
                    <label class="form-label">
                        <input type="checkbox" name="preferred" checked />
                        Make this my Preferred Address
                    </label>
                </div>
                <div class="address-form-row">
                    <label for="first-name" class="form-label">First Name<span class="asterisk">*</span></label>
                    <input type="text" id="first-name" name="first_name" placeholder="First name" required />
                </div>
                <div class="address-form-row">
                    <label for="last-name" class="form-label">Last Name<span class="asterisk">*</span></label>
                    <input type="text" id="last-name" name="last_name" placeholder="Last name" required />
                </div>
                <div class="address-form-row">
                    <label for="address1" class="form-label">Address Line 1<span class="asterisk">*</span></label>
                    <input type="text" id="address1" name="address_line1" placeholder="Street and number, P.O. Box, etc." required />
                </div>
                <div class="address-form-row">
                    <label for="address2" class="form-label">Address Line 2</label>
                    <input type="text" id="address2" name="address_line2" placeholder="Apartment, suite, building, floor, etc." />
                </div>
                <div class="address-form-row">
                    <label for="city" class="form-label">City<span class="asterisk">*</span></label>
                    <input type="text" id="city" name="city" required />
                </div>
                <div class="address-form-row">
                    <label for="state" class="form-label">State<span class="asterisk">*</span></label>
                    <select id="state" name="state" required>
                        <option value="">Please Select</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Ladakh">Ladakh</option>
                        <option value="Lakshadweep">Lakshadweep</option>
                        <option value="Puducherry">Puducherry</option>
                    </select>
                </div>
                <div class="address-form-row">
                    <label for="zip" class="form-label">Zip Code <span class="asterisk">*</span></label>
                    <input type="text" id="zip" name="zip_code" pattern="[0-9]{6}" maxlength="6" required />
                </div>
                <div class="address-form-row">
                    <label for="phone" class="form-label">Phone Number<span class="asterisk">*</span></label>
                    <input type="tel" id="phone" name="phone_number" required />
                </div>
                <div class="form-actions">
                    <button type="submit" class="save-btn">Create</button>
                    <button type="button" class="cancel-btn" onclick="window.history.back()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</section>

@include('frontend.layouts.footer')
