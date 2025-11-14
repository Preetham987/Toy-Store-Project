<footer id="footer" style="background-color: #b30303; color: #fff;">
  <!-- Top Footer -->
  <div class="section" style="padding: 40px 0;">
    <div class="container">
      <div class="row">

        <!-- Column 1 -->
        <div class="col-md-3 col-sm-6">
          <h4><strong style="color: #fff;">MY ACCOUNT</strong></h4>
          <ul class="footer-links">
            @auth
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        Sign Out
                    </button>
                </form>
            </li>
            @endauth
            <li><a href="{{ url('sign-in') }}">Sign In</a></li>
            <li><a href="{{ url('register') }}">Register</a></li>
            <li><a href="{{ url('cart') }}">Shopping Cart</a></li>
          </ul>
        </div>

        <!-- Column 2 -->
        <div class="col-md-3 col-sm-6">
          <h4><strong style="color: #fff;">PRODUCTS</strong></h4>
          <ul class="footer-links">
            <li><a href="{{ url('featuredpreorders') }}">Featured Pre-orders</a></li>
            <li><a href="{{ url('newarrivals') }}">Newest Arrivals</a></li>
            <li><a href="{{ url('sale') }}">On Sale</a></li>
            <li><a href="{{ url('product-search') }}">All Products</a></li>
          </ul>
        </div>

        <!-- Column 3 -->
        <div class="col-md-3 col-sm-6">
          <h4><strong style="color: #fff;">HELP</strong></h4>
          <ul class="footer-links">
            <li><a href="{{ url('help') }}">Help Center</a></li>
          </ul>
        </div>

        <!-- Column 4 - Newsletter -->
        <div class="col-md-3 col-sm-6">
          <h4><strong style="color: #fff;">PAYMENT METHODS</strong></h4>
          <img src="https://images.bigbadtoystore.com/site-images/payment-methods-logo.png" alt="Payment Methods" style="max-width: 100%;margin-left: -20px;">

          <!-- Social Icons -->
          <div style="margin-top: 20px;">
            <a href="#"><img src="https://images.bigbadtoystore.com/site-images/facebook-logo.png" alt="Facebook" style="width: 30px;"></a>
            <a href="#"><img src="https://images.bigbadtoystore.com/site-images/twitter-logo.png" alt="Twitter" style="width: 30px;"></a>
            <a href="#"><img src="https://images.bigbadtoystore.com/site-images/instagramlogo.png" alt="Instagram" style="width: 30px;"></a>
            <a href="#"><img src="https://images.bigbadtoystore.com/site-images/youtube1.png" alt="YouTube" style="width: 30px;"></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    @media (max-width: 768px) {
      .col-md-3.col-sm-6 {
        margin-top: 20px;
      }
    }
  </style>

  <!-- Bottom Footer -->
  <div style="background-color: #8d130e; padding: 30px 0;">
    <div class="container text-center">
      <div class="footer-bottom-links" style="font-size: 12px;">
        <a href="{{ url('privacy-policy') }}">Privacy Policy</a> |
        <a href="{{ url('terms-and-conditions') }}">Terms & Conditions</a>
      </div>
    </div>
  </div>
</footer>

<!-- jQuery Plugins -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
