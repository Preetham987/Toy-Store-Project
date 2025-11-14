{{-- resources/views/sale.blade.php --}}
@include('frontend.layouts.header')

<!-- SALE SECTION -->
<section class="sale-section-wrapper">
  <div class="sale-section-container">
    <h2 class="sale-section-title">SALE ITEMS</h2>
    <p class="sale-section-description">
      Looking for great deals on your favorite collectibles? You’ve come to the right place. 
      Shop discounted figures, statues, games, and more from your favorite fandoms — with new markdowns added regularly!
    </p>
    <hr class="sale-section-divider" />

    <div class="sale-banner-wrapper">
      <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/8b0c2dc7-efcb-42c7-9052-5bcbe12988a0.jpg" alt="Daily Deals Banner" class="sale-banner-image" />
      <a href="#" class="sale-banner-link">
        Daily Deals! Check Back Monday – Friday for New Items and Discounts!
      </a>
    </div>
  </div>
</section>

<section class="promo-section">
  <!-- Top Row: 2 Large Promos -->
  <div class="promo-row promo-row-top">
    <div class="promo-box wide">
      <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/147663eb-5f00-4507-9f77-b8d4f9a9b71d.jpg" alt="Promo 1">
      <p class="promo-caption">
        Super7 ULTIMATES! Action Figures Up to 60% Off! TMNT, G.I. Joe, Silverhawks & More!
      </p>
    </div>
    <div class="promo-box wide">
      <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/7e79008f-c1f7-4442-bbc4-f3cc13483839.jpg" alt="Promo 2">
      <p class="promo-caption">
        Batman: The Animated Series (Noir Ver.) 1/6 Scale BBTS Exclusive Limited Edition Figures
      </p>
    </div>
  </div>

  <!-- Bottom Row: 4 Categories -->
  <div class="promo-row promo-row-bottom">
      <a href="{{ url('product-search?product_types[]=2') }}" class="promo-box square">
          <h3>Action Figures</h3>
          <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/345797ec-54d5-4bec-80d3-a6653363dea2.jpg" alt="Action Figures">
          <p class="promo-caption small">Action Figures!</p>
      </a>

      <a href="{{ url('product-search?product_types[]=1') }}" class="promo-box square">
          <h3>Static Figures</h3>
          <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/625a130c-285b-4ae5-bfb1-f9fe28fc2756.jpg" alt="Static Figures">
          <p class="promo-caption small">Static Figures!</p>
      </a>

      <a href="{{ url('product-search?product_types[]=3') }}" class="promo-box square">
          <h3>Model Kits</h3>
          <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/cc2ceeab-0808-4a1f-8350-4f208b642290.jpg" alt="Model Kits">
          <p class="promo-caption small">Model Kits!</p>
      </a>

      <a href="{{ url('product-search?product_types[]=4') }}" class="promo-box square">
          <h3>Statues</h3>
          <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/7a48db8c-1d20-4495-932c-18f8e8aa6f50.jpg" alt="Statues">
          <p class="promo-caption small">Statues!</p>
      </a>
  </div>
</section>

<section class="sale-promos">
  <!-- Top Row: Two Promos -->
  <div class="promo-row">
    <a href="{{ url('product-search?brands[]=5') }}" class="promo-box promo-grey">
        <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/a3b307e2-595c-4bae-90d0-cef1cd1a9441.jpg" alt="DC Multiverse">
        <p class="promo-caption">DC Multiverse Action Figures & Vehicles</p>
    </a>
    <a href="{{ url('product-search?scales[]=2') }}" class="promo-box promo-grey">
        <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/037f2468-6031-4792-a839-7803a0011689.jpg" alt="1/12 Scale Figures">
        <p class="promo-caption">1/12 Scale Action Figures on Sale!</p>
    </a>
  </div>

  <!-- Bottom Row: Wide Promo -->
  <div class="promo-row">
    <div class="promo-banner">
      <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/5b529a5d-4872-44da-bead-84418e9c5192.jpg" alt="Anime & Manga Sale">
    </div>
  </div>
</section>

<section class="promo-section">
  <!-- Top Row: 2 Large Promos -->
  <div class="promo-row promo-row-top">
    <a href="{{ url('product-search?companies[]=1') }}" class="promo-box wide">
        <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/26a8c82d-7593-4e4a-9d26-e47d956b7924.jpg" alt="Promo 1">
        <p class="promo-caption">
            Funko Pop! Sale Items
        </p>
    </a>
    <a href="{{ url('product-search?companies[]=23') }}" class="promo-box wide">
        <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/15a888c1-b41a-4077-91db-812f684065f7.jpg" alt="Promo 2">
        <p class="promo-caption">
            Banpresto Sale Items!
        </p>
    </a>
  </div>

  <!-- Bottom Row: 4 Categories -->
  <div class="promo-row promo-row-bottom">
    <div class="promo-box square">
      <h3>Action Figures</h3>
      <img src="https://images.bigbadtoystore.com/site-images/p/2025/04/8bff0d4f-0d0e-4e75-98ff-361cb8934492.jpg" alt="Action Figures">
      <p class="promo-caption small"> ReAction Series Figures</p>
    </div>
    <div class="promo-box square">
      <h3>Static Figures</h3>
      <img src="https://images.bigbadtoystore.com/site-images/p/2025/04/4d9a5d52-1abb-4ffa-8020-917f1fb4f635.jpg" alt="Static Figures">
      <p class="promo-caption small">Nendoroid Action Figures & Accessories!</p>
    </div>
    <div class="promo-box square">
      <h3>Model Kits</h3>
      <img src="https://images.bigbadtoystore.com/site-images/p/2025/04/953cb770-945a-4526-93cc-8d6e0c23ebbe.jpg" alt="Model Kits">
      <p class="promo-caption small">Nendoroid Action Figures & Accessories!</p>
    </div>
    <div class="promo-box square">
      <h3>Statues</h3>
      <img src="https://images.bigbadtoystore.com/site-images/p/2025/04/1cf17ffe-d9af-44b9-82ee-5bc6b8458a34.jpg" alt="Statues">
      <p class="promo-caption small">FiGPiNs!</p>
    </div>
  </div>
</section>

<section class="promo-section">
    <div class="unique-banner-row">
    <div class="unique-banner-top">All Sale Items</div>
  </div>
<div class="promo-row promo-row-top">
    <div class="promo-box wide">
      <img src="https://images.bigbadtoystore.com/site-images/p/2025/07/956b6d6a-020d-4da0-8a7a-0cdf4d421f3d.jpg" alt="Promo 1">
      <p class="promo-caption">
        G.I. Joe Sale Items!
      </p>
    </div>
    <div class="promo-box wide">
      <img src="https://images.bigbadtoystore.com/site-images/p/2025/04/654b800b-01c7-46a4-9642-0fc6eb77681d.jpg" alt="Promo 2">
      <p class="promo-caption">
        Dragon Ball Sale Items!
      </p>
    </div>
  </div>
    <div class="unique-banner-row">
    <div class="unique-banner-bottom">Highest Discount Sale Items</div>
  </div>
</section>

@include('frontend.layouts.footer')
