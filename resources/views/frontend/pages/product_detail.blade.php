{{-- Include Header --}}
@include('frontend.layouts.header')

<section class="product-section">
    <div class="product-header">
        <div>
            <span class="product-title">
                {{ $product->title }}
            </span>
            <br>
            <span class="product-brand">
                BY <span class="brand-mattel">{{ $product->brand->title ?? 'N/A' }}</span> - BRANDS 
                <span class="brand-highlight">
                    {{ $product->cat_info->title ?? 'N/A' }}
                    @if($product->series)
                        , {{ $product->series->title }}
                    @endif
                </span>
            </span>
        </div>
    </div>

    <div class="product-main">
        {{-- Product Images --}}
        <div class="product-images">
            <div class="thumbnails">
                @php
                    $photos = explode(',', $product->photo);
                @endphp
                
                {{-- Loop through all images --}}
                @foreach($photos as $index => $image)
                    <img src="{{ $image }}" class="thumb {{ $index === 0 ? 'active' : '' }}" alt="{{ $product->title }}">
                @endforeach
            </div>

            <div class="main-image-container">
                <img src="{{ $photos[0] ?? '' }}" class="main-image" alt="{{ $product->title }}">
            </div>
        </div>

        {{-- Product Info --}}
        <div class="product-info">
            <div class="preorder-section">
                <div class="preorder-label">PRE-ORDER</div>
                <div class="preorder-date">Estimated to arrive soon.</div>

                {{-- Displayed price --}}
                <div class="price">
                    ₹<span id="totalPrice">{{ number_format($product->price, 2) }}</span>
                </div>

                {{-- Cart Form --}}
                <form action="{{ route('single-add-to-cart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="slug" value="{{ $product->slug }}">

                    <div class="qty-section">
                        <label for="quantity">Quantity:</label>
                        
                        @if ($product->stock > 0)
                            <select id="quantity" class="qty-select" name="quant[1]">
                                @for ($i = 1; $i <= $product->stock; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select><br>

                            {{-- Show Add to Cart only if in stock --}}
                            <button class="add-cart" type="submit">ADD TO CART</button>
                        @else
                            <span style="color: red; font-size: 30px; font-weight: bold;">Out of Stock</span>
                        @endif
                    </div>
                </form>

                <div class="shipping-row">
                    <span class="shipping-badge">₹400</span>
                    <span class="shipping-text">FLAT RATE SHIPPING</span>
                </div>

                <div class="returns-row">
                    <span class="returns-icon">&#x21B6;</span>
                    <span class="returns-text">30 Day Easy Returns</span>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const quantitySelect = document.getElementById("quantity");
                const totalPriceElement = document.getElementById("totalPrice");
                const basePrice = {!! json_encode($product->price) !!};

                function formatIndianPrice(amount) {
                    return amount.toLocaleString('en-IN', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }

                quantitySelect.addEventListener("change", function () {
                    const quantity = parseInt(this.value);
                    const total = basePrice * quantity;
                    totalPriceElement.textContent = formatIndianPrice(total);
                });
            });
        </script>
    </div>
</section>

<section class="product-detail-section">
    <div class="product-detail-container">
        {{-- Left Column --}}
        <div class="product-detail-main" style="margin-top: -70px;">
            <h2>Product Description</h2>
            {!! $product->description !!}

            <div class="feature-box">
                <h3 style="color: black; font-size: 1.4rem;">Product Features</h3>
                <ul>
                    {!! $product->summary !!}
                </ul>
            </div>

            <div class="feature-box">
                <h3 style="color: black; font-size: 1.4rem;">Box Contents</h3>
                <ul>
                    {!! $product->boxcontent !!}
                </ul>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="product-detail-sidebar">
            <div class="sidebar-box" style="margin-top: -130px;">
                <h4>PRE-ORDER NOTES</h4>
                <ul>
                    {!! $product->preorder !!}
                </ul>
            </div>

            <div class="sidebar-box">
                <h4>STANDARD GRADE</h4>
                <ul>
                    {!! $product->standardgrade !!}
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Thumbnail Switching Script --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const thumbnails = document.querySelectorAll(".thumb");
        const mainImage = document.querySelector(".main-image");

        thumbnails.forEach((thumb) => {
            thumb.addEventListener("click", function () {
                mainImage.src = this.src;
                thumbnails.forEach((t) => t.classList.remove("active"));
                this.classList.add("active");
            });
        });
    });
</script>

{{-- Include Footer --}}
@include('frontend.layouts.footer')
