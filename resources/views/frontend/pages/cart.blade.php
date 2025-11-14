@include('frontend.layouts.header')

<section class="shopping-cart-container">
  <h3 style="color: black;">{{ $cartItems->count() }} Items in Your Shopping Cart</h3>

  <div class="preorder-bar">
    <span>PRE-ORDER ITEMS</span>
    <span class="preorder-note">(Ships at a later date)</span>
  </div>

  @forelse($cartItems as $item)
    <div class="cart-item">
      <img src="{{ explode(',', $item->product->photo)[0] ?? '' }}" 
           alt="{{ $item->product->title }}" 
           class="cart-item-img">
      <div class="cart-item-details">
        <div class="cart-item-title">{{ $item->product->title }}</div>
        <div class="cart-item-actions">
          <a href="{{ route('cart-delete', $item->id) }}">Delete</a>
        </div>
      </div>
      <div class="cart-item-qty">
			<input type="hidden" class="cart-id" value="{{ $item->id }}">
			<select class="quantity-select">
				@for ($i = 1; $i <= $item->product->stock; $i++)
					<option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>
						{{ $i }}
					</option>
				@endfor
			</select>
	   </div>
		<script>
		document.addEventListener("DOMContentLoaded", function () {
			const selects = document.querySelectorAll(".quantity-select");

			selects.forEach(select => {
				select.addEventListener("change", function () {
					const cartId = this.closest(".cart-item-qty").querySelector(".cart-id").value;
					const quantity = this.value;

					fetch("{{ route('cart.update') }}", {
						method: "POST",
						headers: {
							"Content-Type": "application/json",
							"X-CSRF-TOKEN": "{{ csrf_token() }}"
						},
						body: JSON.stringify({
							qty_id: [cartId],
							quant: [quantity]
						})
					})
					.then(response => response.text())
					.then(() => location.reload()); // Reload to refresh subtotal and total
				});
			});
		});
		</script>
      <div class="cart-item-price">
		{{-- Show original price (no discount) --}}
		<div>
			Price<br>
			₹{{ number_format($item->product->price, 2) }}
		</div>

		{{-- Show subtotal with discount applied --}}
		@php
			$discountedPrice = $item->product->price - ($item->product->price * $item->product->discount / 100);
			$subtotal = $discountedPrice * $item->quantity;
		@endphp
		<div>
			Subtotal<br>
			₹{{ number_format($subtotal, 2) }}
		</div>
	</div>
    </div>
  @empty
    <p>Your cart is empty.</p>
  @endforelse

  @if($cartItems->count() > 0)
	<div class="cart-total-row">
		<span>
			Pre-order Item Total:
			<strong>
				₹{{ number_format($cartItems->sum(function($item) {
					$discountedPrice = $item->product->price - ($item->product->price * $item->product->discount / 100);
					return $discountedPrice * $item->quantity;
				}), 2) }}
			</strong>
		</span>
		<a href="{{ route('checkout') }}" class="checkout-btn">CHECKOUT</a>
	</div>
  @endif
</section>

@include('frontend.layouts.footer')
