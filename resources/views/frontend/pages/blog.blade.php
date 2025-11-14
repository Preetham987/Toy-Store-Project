@include('frontend.layouts.header')

<section class="product-grid-section">
    <section class="sale-section-wrapper">
        <div class="sale-section-container">
            <h2 class="sale-section-title">New Arrivals</h2>
        </div>
    </section>

    <div class="product-grid-container">
        @foreach($products as $product)
            <div class="product-grid-card">
                @php
                    $photos = explode(',', $product->photo);
                    $firstPhoto = $photos[0] ?? 'default.jpg';
                @endphp
                <a href="{{ url('product-detail/' . $product->slug) }}">
                    <img src="{{ asset($firstPhoto) }}" alt="{{ $product->title }}" class="product-grid-image" />
                    <div class="product-grid-title">{{ $product->title }}</div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div style="background:#1e1e1e; padding:24px 0; display:flex; justify-content:center;">
        {{ $products->links('vendor.pagination.bootstrap-4') }}
    </div>
</section>

@include('frontend.layouts.footer')
