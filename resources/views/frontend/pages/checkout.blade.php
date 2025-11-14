@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')
            
    <!-- Start Checkout -->
    <section class="myshop" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="container">
                <form class="form" method="POST" action="{{route('cart.order')}}">
                    @csrf
                    <div class="row"> 

                        <div class="col-lg-7 col-12" style="border: 1px solid #000; border-radius: 20px; padding: 10px; margin-right: 40px">
                            <div class="checkout-form">
                                <h2>Make Your Checkout Here</h2>
                                <p>Please register in order to checkout more quickly</p>
                                <!-- Form -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>First Name<span>*</span></label>
                                            <input type="text" name="first_name" 
                                                value="{{ old('first_name', $address->first_name ?? '') }}">
                                            @error('first_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Last Name<span>*</span></label>
                                            <input type="text" name="last_name" 
                                                value="{{ old('last_name', $address->last_name ?? '') }}">
                                            @error('last_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email Address<span>*</span></label>
                                            <input type="email" name="email" 
                                                value="{{ old('email', $user->email ?? '') }}">
                                            @error('email')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Phone Number <span>*</span></label>
                                            <input type="number" name="phone" required
                                                value="{{ old('phone', $address->phone_number ?? '') }}">
                                            @error('phone')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <h4 style="color: #000;">Select a Delivery Address</h4>

                                        @if($addresses->count() > 0)
                                            @foreach($addresses as $address)
                                            <label class="address-card d-block">
                                                <input type="radio" name="selected_address" value="{{ $address->id }}" required>
                                                <strong>{{ $address->address_line1 }}</strong><br>
                                                {{ $address->address_line2 ? $address->address_line2 . ',' : '' }}<br>
                                                {{ $address->city }},<br> {{ $address->state }} - {{ $address->zip_code }}
                                            </label>
                                        @endforeach
                                        @else
                                            <p>No saved addresses found.</p>
                                        @endif
                                    </div>
                                    
                                </div>
                                <!--/ End Form -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-12" style="border: 1px solid #000; border-radius: 20px; padding: 10px;">
                            <div class="order-details">
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>CART  TOTALS</h2>
                                    <div class="content">
                                        <ul>
										    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Cart Subtotal<span>${{number_format(Helper::totalCartPrice(),2)}}</span></li>
                                            <li class="shipping">
                                                Shipping Cost
                                                @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                                    <select name="shipping" class="nice-select">
                                                        <option value="">Select your address</option>
                                                        @foreach(Helper::shipping() as $shipping)
                                                        <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: ${{$shipping->price}}</option>
                                                        @endforeach
                                                    </select>
                                                @else 
                                                    <span>Free</span>
                                                @endif
                                            </li>
                                            
                                            @if(session('coupon'))
                                            <li class="coupon_price" data-price="{{session('coupon')['value']}}">You Save<span>${{number_format(session('coupon')['value'],2)}}</span></li>
                                            @endif
                                            @php
                                                $total_amount=Helper::totalCartPrice();
                                                if(session('coupon')){
                                                    $total_amount=$total_amount-session('coupon')['value'];
                                                }
                                            @endphp
                                            @if(session('coupon'))
                                                <li class="last"  id="order_total_price">Total<span>${{number_format($total_amount,2)}}</span></li>
                                            @else
                                                <li class="last"  id="order_total_price">Total<span>${{number_format($total_amount,2)}}</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Payments</h2>
                                    <div class="content">
                                        <div class="payment-option">
                                            <input name="payment_method" id="cod" type="radio" value="cod">
                                            <label for="cod">Cash On Delivery</label>
                                        </div>
                                        <div class="payment-option">
                                            <input name="payment_method" id="razorpay" type="radio" value="paypal">
                                            <label for="razorpay">RazorPay</label>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Payment Method Widget -->
                                <div class="single-widget payement">
                                    <div class="content">
                                        <img src="{{('backend/img/payment-method.png')}}" alt="#">
                                    </div>
                                </div>
                                <!--/ End Payment Method Widget -->
                                <!-- Button Widget -->
                                <div class="single-widget get-button">
                                    <div class="content">
                                        <div class="button">
                                            <button type="submit" class="btn">proceed to checkout</button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Button Widget -->
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </section>
    <!--/ End Checkout -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(!empty($orderSuccess) && $orderSuccess)
        <script>
            Swal.fire({
                title: 'Order Placed!',
                text: 'Your order has been placed successfully.',
                icon: 'success',
                confirmButtonText: 'OK',
                width: '40rem', // Increase width
                customClass: {
                    title: 'swal-title-lg',
                    htmlContainer: 'swal-text-lg',
                    confirmButton: 'swal-btn-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/') }}";
                }
            });
        </script>

        <style>
            .swal-title-lg {
                font-size: 2rem !important; /* bigger title */
            }
            .swal-text-lg {
                font-size: 1.3rem !important; /* bigger text */
            }
            .swal-btn-lg {
                font-size: 1.1rem !important;
                padding: 10px 25px !important;
            }
        </style>
    @endif

@endsection
	<style>
        .address-card {
    border: 2px solid #000; /* Black border */
    border-radius: 8px;     /* Rounded corners */
    padding: 15px;          /* Space inside the box */
    margin-bottom: 15px;    /* Space between boxes */
    background-color: #fff; /* White background */
    transition: all 0.2s ease;
}

.address-card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Hover shadow */
    transform: translateY(-2px);           /* Lift effect */
}

.address-card input[type="radio"] {
    margin-right: 10px;
}

.checkout-container {
    display: flex !important;
    gap: 40px !important;
    flex-wrap: wrap !important;
    align-items: flex-start !important;
    margin-top: 30px !important;
}

.checkout-form, .order-details {
    background: #fff !important;
    padding: 25px !important;
    border-radius: 10px !important;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08) !important;
}

.checkout-form {
    flex: 1 !important;
    min-width: 60% !important;
}

.order-details {
    flex: 0 0 35% !important;
}

.checkout-form h2, .order-details h2 {
    font-size: 24px !important;
    font-weight: 700 !important;
    margin-bottom: 10px !important;
    color: #222 !important;
}

.checkout-form p {
    font-size: 14px !important;
    color: #777 !important;
    margin-bottom: 25px !important;
}

.form-group {
    margin-bottom: 20px !important;
}

.form-group label {
    font-weight: 600 !important;
    font-size: 14px !important;
    color: #555 !important;
    display: block !important;
    margin-bottom: 6px !important;
}

.form-group input, 
.form-group select {
    border: 1px solid #ddd !important;
    border-radius: 6px !important;
    padding: 10px 12px !important;
    font-size: 14px !important;
    width: 100% !important;
    transition: all 0.3s ease !important;
}

.form-group input:focus, 
.form-group select:focus {
    border-color: #ff4d4d !important;
    outline: none !important;
    box-shadow: 0 0 5px rgba(255,77,77,0.3) !important;
}

.single-widget {
    background: #fafafa !important;
    padding: 7px !important;
    border-radius: 6px !important;
    margin-bottom: 20px !important;
}

.single-widget ul li {
    display: flex !important;
    justify-content: space-between !important;
    font-size: 14px !important;
    padding: 6px 0 !important;
    border-bottom: 1px solid #eee !important;
}

.single-widget ul li.last {
    font-weight: 700 !important;
    font-size: 16px !important;
    color: #000 !important;
    border-bottom: none !important;
}

.button .btn {
    background: #ff4d4d !important;
    color: #fff !important;
    padding: 14px 20px !important;
    font-size: 16px !important;
    border-radius: 6px !important;
    width: 100% !important;
    text-transform: uppercase !important;
    font-weight: bold !important;
    transition: background 0.3s ease !important;
    box-shadow: 0 4px 8px rgba(255,77,77,0.2) !important;
}

.button .btn:hover {
    background: #e63b3b !important;
}

/* Payment radio styling */
.payment-option {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-bottom: 10px;
    background: #fff;
    cursor: pointer;
    transition: border-color 0.3s ease, background-color 0.3s ease;
}

.payment-option:hover {
    border-color: #ff4d4d;
    background-color: #fff5f5;
}

.payment-option input[type="radio"] {
    accent-color: #ff4d4d; /* modern browsers */
    width: 18px;
    height: 18px;
    margin-right: 10px;
    cursor: pointer;
}

.payment-option label {
    margin: 0;
    font-size: 15px;
    font-weight: 500;
    color: #333;
    cursor: pointer;
}

	</style>
@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		function showMe(box){
			var checkbox=document.getElementById('shipping').style.display;
			// alert(checkbox);
			var vis= 'none';
			if(checkbox=="none"){
				vis='block';
			}
			if(checkbox=="block"){
				vis="none";
			}
			document.getElementById(box).style.display=vis;
		}
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') ); 
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0; 
				// alert(coupon);
				$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
			});

		});

	</script>

@endpush
