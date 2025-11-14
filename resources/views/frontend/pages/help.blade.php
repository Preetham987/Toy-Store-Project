{{-- resources/views/help.blade.php --}}
@include('frontend.layouts.header')

<section class="bbts-help-wrapper">
  <div class="bbts-help-left">
    <h2 class="help-title">NewToyStore Help Center</h2>
<div class="faq-link" onclick="window.location.href='{{ url('faq') }}'">View Our Full FAQ</div>

    <div class="help-grid">
      <a href="{{ url('about') }}">
        <div class="help-item">
          <div class="help-icon" style="font-size:1.3em;">BBTS</div>
          <div class="help-desc">ABOUT US</div>
        </div>
      </a>

      <a href="{{ url('preorders') }}">
        <div class="help-item">
          <div class="help-icon">&#128197;</div>
          <div class="help-desc">PRE-ORDERS</div>
        </div>
      </a>

      <a href="{{ url('shipping') }}">
        <div class="help-item">
          <div class="help-icon">&#127758;</div>
          <div class="help-desc">DOMESTIC<br>SHIPPING</div>
        </div>
      </a>

      <a href="{{ url('cancellations') }}">
        <div class="help-item">
          <div class="help-icon">&#10006;</div>
          <div class="help-desc">CANCELLATIONS</div>
        </div>
      </a>

      <a href="{{ url('returns') }}">
        <div class="help-item">
          <div class="help-icon">&#10550;</div>
          <div class="help-desc">RETURNS</div>
        </div>
      </a>

      <a href="{{ url('payments') }}">
        <div class="help-item">
          <div class="help-icon">$</div>
          <div class="help-desc">PAYMENTS</div>
        </div>
      </a>

      <a href="{{ url('privacy-policy') }}">
        <div class="help-item">
          <div class="help-icon">&#128274;</div>
          <div class="help-desc">PRIVACY<br>POLICY</div>
        </div>
      </a>

      <a href="{{ url('terms-and-conditions') }}">
        <div class="help-item">
          <div class="help-icon">&#128196;</div>
          <div class="help-desc">TERMS &<br>CONDITIONS</div>
        </div>
      </a>
    </div>

<div class="faq-link" onclick="window.location.href='{{ url('faq') }}'">View Our Full FAQ</div>
  </div>

  <aside class="bbts-help-right">
    <div class="customer-panel">
      <div class="customer-header">
        <div class="customer-img"></div>
        <div class="customer-label">Need to reach us?</div>
      </div>
      <div class="customer-body">
        <div class="service-hours-label">Customer Service Hours</div>
        <div class="service-hours">
          Monday - Friday 7:00 AM to 9:00 PM CST<br>
          (current: 08:23 AM CST)
        </div>
        <div class="contact-block">
          <div>Call Customer Service</div>
          <div class="phone">1-888-980-2287</div>
        </div>
        <div class="contact-block">
          <div>Email Customer Service</div>
          <div class="email">service@newtoystore.com</div>
        </div>
      </div>
    </div>
  </aside>
</section>

@include('frontend.layouts.footer')
