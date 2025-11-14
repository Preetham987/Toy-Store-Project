{{-- resources/views/edit-address.blade.php --}}

@include('frontend.layouts.header')

<section class="account-address-form-wrapper">

    @include('frontend.layouts.sidebar-2')

    <div class="address-form-panel">
        <h1 class="main-title">Address Book / Address Book</h1>
        <div class="address-form-card">
            <form method="POST" action="{{ route('address.update', $address->id) }}">
                @csrf
                @method('PUT') <!-- This tells Laravel it's an update request -->
                
                <div class="address-form-row">
                    <label class="form-label">
                        <input type="checkbox" name="preferred" {{ $address->preferred ? 'checked' : '' }} />
                        Make this my Preferred Address
                    </label>
                </div>

                <div class="address-form-row">
                    <label for="first-name" class="form-label">First Name<span class="asterisk">*</span></label>
                    <input type="text" id="first-name" name="first_name" value="{{ $address->first_name }}" required />
                </div>

                <div class="address-form-row">
                    <label for="last-name" class="form-label">Last Name<span class="asterisk">*</span></label>
                    <input type="text" id="last-name" name="last_name" value="{{ $address->last_name }}" required />
                </div>

                <div class="address-form-row">
                    <label for="address1" class="form-label">Address Line 1<span class="asterisk">*</span></label>
                    <input type="text" id="address1" name="address_line1" value="{{ $address->address_line1 }}" required />
                </div>

                <div class="address-form-row">
                    <label for="address2" class="form-label">Address Line 2</label>
                    <input type="text" id="address2" name="address_line2" value="{{ $address->address_line2 }}" />
                </div>

                <div class="address-form-row">
                    <label for="city" class="form-label">City<span class="asterisk">*</span></label>
                    <input type="text" id="city" name="city" value="{{ $address->city }}" required />
                </div>

                <div class="address-form-row">
                    <label for="state" class="form-label">State<span class="asterisk">*</span></label>
                    <select id="state" name="state" required>
                        <option value="">Please Select</option>
                        @foreach([
                            "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh",
                            "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland",
                            "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand",
                            "West Bengal", "Andaman and Nicobar Islands", "Chandigarh", "Dadra and Nagar Haveli and Daman and Diu", "Delhi",
                            "Jammu and Kashmir", "Ladakh", "Lakshadweep", "Puducherry"
                        ] as $state)
                            <option value="{{ $state }}" {{ $address->state == $state ? 'selected' : '' }}>{{ $state }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="address-form-row">
                    <label for="zip" class="form-label">Zip Code<span class="asterisk">*</span></label>
                    <input type="text" id="zip" name="zip_code" value="{{ $address->zip_code }}" maxlength="6" required />
                </div>

                <div class="address-form-row">
                    <label for="phone" class="form-label">Phone Number<span class="asterisk">*</span></label>
                    <input type="tel" id="phone" name="phone_number" value="{{ $address->phone_number }}" required />
                </div>

                <div class="form-actions">
                    <button type="submit" class="save-btn">Update</button>
                    <button type="button" class="cancel-btn" onclick="window.history.back()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</section>

@include('frontend.layouts.footer')
