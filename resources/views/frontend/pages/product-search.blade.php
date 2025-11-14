@include('frontend.layouts.header')

<section class="product-page-layout">
    @include('frontend.layouts.sidebar')

    <div class="main-area">
        <div class="products-header">
            <h1>All Products</h1>
            <div class="products-sorting">
                <label for="sort-by">Sort By</label>
                <select id="sort-by" onchange="window.location.href=`{{ route('product-search') }}?sort_by=${this.value}`">
                    <option value="">Relevance</option>
                    <option value="price_low_high" {{ request('sort_by') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high_low" {{ request('sort_by') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
                <!-- <label for="per-page">Per Page</label>
                <select id="per-page">
                    <option>20</option>
                    <option>40</option>
                    <option>80</option>
                </select> -->
            </div>
        </div>

        <div class="products-list">
            @forelse($products as $product)
                @php
                    $photos = explode(',', $product->photo);
                    $mainPhoto = $photos[0] ?? '';
                @endphp

                <a href="{{ route('product-detail', $product->slug) }}" class="product-card-link">
                    <div class="product-card" style="border-color: #d32f2f">
                        <img src="{{ $mainPhoto }}" alt="{{ $product->title }}" class="product-image">
                        <div class="product-details">
                            <div class="product-title">{{ $product->title }}</div>
                            <div class="product-by">
                                Brand: {{ $product->brand->title ?? 'N/A' }}<br>
                                Company: {{ $product->company->title ?? 'N/A' }}
                            </div>
                            @if($product->is_featured)
                                <span class="badge-preorder">ORDER</span>
                            @endif
                            <div class="product-price">₹{{ number_format($product->price, 2) }}</div>
                        </div>
                    </div>
                </a>
            @empty
                <p>No products found.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="pagination">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</section>
<style>
    .product-card-link {
        text-decoration: none;
        color: inherit; /* Keeps text color as before */
        display: block; /* Makes link cover the full card area */
    }

    .product-card-link:hover .product-title {
        text-decoration: underline;
    }

    .product-card {
        transition: transform 0.2s ease;
    }

    .product-card:hover {
        transform: scale(1.02); /* Optional slight zoom effect */
    }
</style>
@include('frontend.layouts.footer')
