@include('frontend.layouts.header')

<section class="custom-featured-section">
  <div class="custom-featured-container">
    <div class="custom-featured-grid top-row">
      @foreach($featuredTop as $item)
          @php
              $photos = explode(',', $item->photo);
              $firstPhoto = $photos[0] ?? 'default.jpg';
          @endphp
          <div class="custom-featured-card large">
              <a href="{{ url('product-detail/' . $item->slug) }}">
                  <img src="{{ asset($firstPhoto) }}" alt="{{ $item->title }}">
              </a>
              <div class="custom-card-caption">
                  {{ $item->title }}
              </div>
          </div>
      @endforeach
    </div>

    <div class="custom-featured-grid bottom-row">
      @foreach($featuredBottom1 as $item)
          @php
              $photos = explode(',', $item->photo);
              $firstPhoto = $photos[0] ?? 'default.jpg';
          @endphp
          <div class="custom-featured-card small">
              <a href="{{ url('product-detail/' . $item->slug) }}">
                  <img src="{{ asset($firstPhoto) }}" alt="{{ $item->title }}">
              </a>
              <div class="custom-card-caption">{{ $item->title }}</div>
          </div>
      @endforeach
    </div>

    <div class="custom-featured-grid bottom-row">
        @foreach($featuredBottom2 as $item)
            @php
                $photos = explode(',', $item->photo);
                $firstPhoto = $photos[0] ?? 'default.jpg';
            @endphp
            <div class="custom-featured-card small">
                <a href="{{ url('product-detail/' . $item->slug) }}">
                    <img src="{{ asset($firstPhoto) }}" alt="{{ $item->title }}">
                </a>
                <div class="custom-card-caption">{{ $item->title }}</div>
            </div>
        @endforeach
    </div>

  </div>
</section>

<section class="custom-featured-section">
  <div class="custom-featured-container">
    <h2 class="custom-section-title">FEATURED PRE-ORDERS</h2>

        <div class="custom-featured-grid top-row">
      @foreach($featuredTop as $item)
          @php
              $photos = explode(',', $item->photo);
              $firstPhoto = $photos[0] ?? 'default.jpg';
          @endphp
          <div class="custom-featured-card large">
              <a href="{{ url('product-detail/' . $item->slug) }}">
                  <img src="{{ asset($firstPhoto) }}" alt="{{ $item->title }}">
              </a>
              <div class="custom-card-caption">
                  {{ $item->title }}
              </div>
          </div>
      @endforeach
    </div>

        <div class="custom-featured-grid bottom-row">
      @foreach($featuredBottom1 as $item)
          @php
              $photos = explode(',', $item->photo);
              $firstPhoto = $photos[0] ?? 'default.jpg';
          @endphp
          <div class="custom-featured-card small">
              <a href="{{ url('product-detail/' . $item->slug) }}">
                  <img src="{{ asset($firstPhoto) }}" alt="{{ $item->title }}">
              </a>
              <div class="custom-card-caption">{{ $item->title }}</div>
          </div>
      @endforeach
    </div>

    <div class="custom-featured-grid bottom-row">
        @foreach($featuredBottom2 as $item)
            @php
                $photos = explode(',', $item->photo);
                $firstPhoto = $photos[0] ?? 'default.jpg';
            @endphp
            <div class="custom-featured-card small">
                <a href="{{ url('product-detail/' . $item->slug) }}">
                    <img src="{{ asset($firstPhoto) }}" alt="{{ $item->title }}">
                </a>
                <div class="custom-card-caption">{{ $item->title }}</div>
            </div>
        @endforeach
    </div>

  </div>
</section>

@include('frontend.layouts.footer')
