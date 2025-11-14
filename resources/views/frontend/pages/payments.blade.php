{{-- resources/views/payments.blade.php --}}
@include('frontend.layouts.header')

<section class="bbts-payments">
  <nav class="bbts-breadcrumb">
    <a href="{{ url('help') }}">BBTS Help Center</a> &gt; 
    <span>Payments</span>
  </nav>

  <h1>Payments</h1>

  <p>We accept these payment methods:</p>
  <ul>
    <li>Visa</li>
    <li>MasterCard</li>
    <li>American Express</li>
    <li>RuPay</li>
    <li>Discover</li>
    <li>JCB</li>
    <li>UPI</li>
  </ul>
  <p>
    Most pre-paid credit and debit cards from Visa, MasterCard, American Express, Discover, 
    JCB, RuPay, and UPI are also accepted.
  </p>

  <h3>Payment Terms</h3>
  <p>
    Payment is due within four days of product availability. 
    For in-stock products, payment is due at the time of purchase. 
    For pre-orders, payment is due when the product has arrived at our warehouse and is ready to ship. 
    After four days any unpaid item(s) and amount will automatically be canceled.
  </p>

  <h3>Wallet</h3>
  <p>
    Every customer has a wallet associated with their account which allows 
    multiple payment methods to be stored and used for purchases.
  </p>

  <h3>International Payments</h3>
  <p>
    We accept cards from most countries in the world. 
    All payments must be made in Indian Rupees (INR). 
    Your card issuer may convert from your currency to INR at the time of purchase, 
    using the current exchange rate. 
    We do not control the exchange rate, nor any foreign transaction fees your issuing bank may charge.
  </p>

  <h3>PayPal Billing Agreements</h3>
  <p>
    We accept PayPal for payments. 
    By using a PayPal Billing Agreement, you are pre-authorizing us to charge your PayPal account 
    for purchases. This has several advantages:
  </p>
  <ul>
    <li>No need to log in to PayPal every time you want to place an order with BBTS</li>
    <li>We can process your payments more quickly, getting your orders to you that much faster</li>
    <li>You can use PayPal to pay for all your pre-orders</li>
    <li>A billing agreement can be canceled at any time</li>
  </ul>

  <h3>BBTS Store Credit</h3>
  <p>
    We also offer BBTS Store Credit as a payment method. 
    When money is due to you from cancellations or returns, 
    you typically can choose to have your original payment method refunded 
    or receive the refund in BBTS store credit.
  </p>
  <p>
    You can check your store credit balance by signing in to "My Account." 
    Any available store credit will be automatically applied to your next purchase or pre-order arrival.
  </p>
  <p>
    <strong>Expiration Policy:</strong> In most situations BBTS store credit automatically 
    expires one year from the date of issue. 
    Store credit issued in certain situations is not allowed to expire. 
    The oldest store credit is always used first.
  </p>

  <h3>Payment Verification</h3>
  <p>
    Every payment goes through a rigorous verification process to detect potential fraud. 
    As one of our verification steps, we may authorize your card for a small amount 
    and ask you to verify the amount before we accept payment. 
    This authorization is not a charge, but the bank may hold the authorized funds 
    as unavailable until the authorization expires.
  </p>
</section>

@include('frontend.layouts.footer')
