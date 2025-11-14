{{-- resources/views/cancellations.blade.php --}}
@include('frontend.layouts.header')

<section class="bbts-cancellation-policy">
  <nav class="bbts-breadcrumb">
    <a href="{{ url('help') }}">BBTS Help Center</a> &gt; 
    <span>Cancellation Policy</span>
  </nav>

  <h1>Cancellation Policy</h1>

  <p>
    BigBadToyStore offers a flexible cancellation policy to give you as much opportunity as possible 
    to cancel items before they ship. All of this can be done by going to the "My Account" section of the BBTS website.
  </p>
  <p>
    If you would like more control over how and when your orders ship we recommend using our 
    <a href="#">Pile of Loot</a>. For more details, please see our 
    <a href="#">Pile of Loot Guide</a>.
  </p>

  <h3>Pre-orders</h3>
  <p>
    Most pre-orders may be canceled at any time before payment has been processed. 
    Payment for pre-orders is processed when the product is received in our warehouse 
    and is available to ship. To cancel a pre-order, sign in to "My Account" and click on Pre-orders.
  </p>
  <p>
    If you wish to cancel pre-orders that require a down payment, you must contact customer service.
  </p>

  <h3>Pile of Loot</h3>
  <p>
    You may cancel items in your Pile of Loot at any time. 
    If the item is canceled within 7 days of first being added to your Pile of Loot, 
    your original payment method will be refunded. If more than 7 days have passed, 
    your refund will be issued in BBTS Store Credit. 
    To cancel an item in the Pile of Loot, sign in to "My Account" and click on Pile of Loot.
  </p>
  <p>
    If an excessive number of items are canceled from your Pile of Loot 
    and you are found to be abusing the system, your account will be changed 
    to no longer allow cancellations from your Pile of Loot.
  </p>

  <h3>Shipments</h3>
  <p>
    When items are added to a shipment we begin the process of fulfilling your order. 
    Once this happens, items can no longer be canceled. Shipments are created when:
  </p>
  <ul>
    <li>You place an order for in-stock items and request that they ship immediately</li>
    <li>Release items from your Pile of Loot</li>
    <li>Pre-orders that have arrived and were requested to ship immediately upon arrival</li>
  </ul>

  <h3>Payments in Process</h3>
  <p>
    All cancellation options may be temporarily unavailable 
    when we are processing a payment for your order. 
    If this occurs, please try again after a few minutes when processing has finished.
  </p>

  <h3>Cancellation due to Non-Payment</h3>
  <p>
    Payment for all items must be received within 4 days of when the items are available to ship. 
    If payment is not received within 4 days it will be automatically canceled. 
    For more information on payments please see our <a href="#">Payment Guide</a>.
  </p>
</section>

@include('frontend.layouts.footer')
