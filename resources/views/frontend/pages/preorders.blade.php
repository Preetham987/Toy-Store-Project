{{-- resources/views/preorders.blade.php --}}
@include('frontend.layouts.header')

<section class="bbts-preorders">
  <div class="bbts-breadcrumb">
    <a href="{{ url('help') }}">BBTS Help Center</a> &gt; <span>Pre-orders</span>
  </div>
  
  <h1>Pre-orders</h1>
  
  <p class="bbts-intro">
    Tired of missing releases of highly sought after collectibles that have sold out? Pre-ordering products helps you avoid these frustrations and makes the process a hassle-free and enjoyable experience!
  </p>
  
  <p class="bbts-intro">
    As soon as a manufacturer announces a new item and gives us the go ahead, we will list it for presale with an expected arrival date. Presale means we are taking advanced orders for the item. It has either not been released or has not yet arrived at our warehouse. No payment is generally necessary until the item arrives at our warehouse and is ready to ship.
  </p>

  <h2>Pre-order Management</h2>
  <ul>
    <li>View all items you currently have on pre-order</li>
    <li>View updated arrival information</li>
    <li>Cancel pre-orders</li>
    <li>Change Pile of Loot shipping options</li>
    <li>Change shipping address</li>
    <li>Change shipping method</li>
    <li>Change payment method</li>
  </ul>
  
  <p class="bbts-note">
    We work hard to make pre-orders convenient and flexible. For unparalleled flexibility, use our Pile of Loot which is specifically designed to work with pre-orders.
  </p>

  <h2>Pre-order Arrival Dates</h2>
  <p>
    Every product on pre-order lists an expected arrival date. Our product department is in constant contact with our vendors to try to obtain the most up to date information possible.
  </p>
  <p>
    We would all like pre-orders to show up within the expected time frame, but unfortunately the toy industry can have delays. The expected arrival date is an estimate; there are no guarantees for exactly when pre-ordered products will arrive.
  </p>

  <h2>Pre-order Cancelation</h2>
  <p>
    You can cancel most pre-orders at any time prior to their arrival at our warehouse. All of this can be done directly from "My Account." Please keep in mind that if you cancel a pre-order that required a non-refundable down payment, your down payment will not be refunded.
  </p>

  <h2>Pre-order Payment</h2>
  <p>
    No payment is generally necessary until the item arrives at our warehouse and is ready to ship. When you purchase a pre-order we will ask you to indicate how you would like to pay for the item. All accepted payment methods may be used to pay for pre-orders, including PayPal.
  </p>

  <h2 class="bbts-subhead">Non-Refundable Down Payments</h2>
  <p>
    Some pre-orders may require a non-refundable down payment. If applicable, this will be indicated at checkout and in your order summary.
  </p>
</section>

@include('frontend.layouts.footer')
