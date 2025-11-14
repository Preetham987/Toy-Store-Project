{{-- Include Header --}}
@include('frontend.layouts.header')

<section class="product-grid-section">
    <section class="sale-section-wrapper">
        <div class="sale-section-container">
            <h2 class="sale-section-title">Featured Pre-Orders List</h2>
        </div>
    </section>

    {{-- Product Grid --}}
    <div class="product-grid-container">
        @forelse($featuredProducts as $product)
            @php
                $photos = explode(',', $product->photo);
                $firstPhoto = $photos[0] ?? 'default.jpg';
            @endphp
            <div class="product-grid-card">
                <a href="{{ url('product-detail/' . $product->slug) }}">
                    <img src="{{ asset($firstPhoto) }}" 
                        alt="{{ $product->title }}" 
                        class="product-grid-image" />
                    <div class="product-grid-title">{{ $product->title }}</div>
                </a>
            </div>
        @empty
            <p style="color:white; text-align:center;">No featured products available right now.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div style="background:#1e1e1e; padding:24px 0; display:flex; justify-content:center;">
        {{ $featuredProducts->links('vendor.pagination.bootstrap-4') }}
    </div>
</section>

{{-- Include Footer --}}
@include('frontend.layouts.footer')
