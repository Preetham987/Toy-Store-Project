{{-- resources/views/shipping.blade.php --}}
@include('frontend.layouts.header')

<section class="bbts-domestic-shipping">
  <nav class="bbts-breadcrumb">
    <a href="{{ url('help') }}">BBTS Help Center</a> &gt; 
    <span>Domestic Shipping (India)</span>
  </nav>

  <h1>Domestic Shipping (India)</h1>

  <p>
    BigBadToyStore ships to all states and union territories within India, including major cities, rural areas, and remote locations.
  </p>

  <h3>₹299 Flat Rate Shipping</h3>
  <p>
    ₹299 Flat Rate Shipping is now available on all orders shipped to addresses within India. 
    There is no minimum purchase, product restrictions, or upper cap. 
    For more detailed information, please see our ₹299 Flat Rate Shipping Guide.
  </p>

  <h3>Shipping Methods</h3>
  <p>We offer the following services for domestic delivery:</p>
  <ul>
    <li>Blue Dart</li>
    <li>Delhivery</li>
    <li>India Post</li>
    <li>FedEx India</li>
  </ul>
  <p>
    Several shipping methods are available for each courier, including standard and expedited services. 
    Some shipping methods specify which courier will be used, while others may vary depending on package properties. 
    If you choose a method with multiple couriers, we cannot guarantee a specific one.
  </p>
  <p>
    Expedited shipping is generally not available for pre-order products. 
    If you want expedited shipping for a pre-order, we recommend using our "Pile of Loot" feature, 
    which allows you to choose any method when your item is ready to ship. 
    Please see our Pile of Loot guide for more details.
  </p>
  <p>
    All shipping method options, fees, and delivery estimates are detailed at checkout.
  </p>

  <h3>Shipping Fees</h3>
  <p>
    Shipping fees are based on actual product weights or dimensions. 
    Dimensional weight takes into account the space a package occupies in transit.
  </p>
  <p>
    <strong>Shipping fees for in-stock items:</strong> 
    The shipping fee displayed in your cart for in-stock items (or items being released from your Pile of Loot) 
    is the actual fee you will pay.<br>
    Some large or heavy items may require a custom shipping quote at the time of shipment. 
    This will be clearly mentioned in the item description.
  </p>
  <p>
    <strong>Shipping fee estimates for pre-orders:</strong> 
    Shipping fees for pre-ordered items are indicative only. 
    The actual product weight or dimensions may not be available at the time of pre-order listing. 
    If you pre-order a single item, an estimated fee is displayed. 
    For multiple items, you'll see a base fee and a per-kg charge for the shipment. 
    We recommend using the Pile of Loot feature for better combined shipping value.
  </p>

  <h3>Delivery Estimates</h3>
  <p>
    Delivery times vary by courier and delivery address. 
    Each shipping method will show a delivery date or date range during checkout.
  </p>
  <p>
    For pre-orders, the estimated number of business days for delivery 
    after the item arrives at our facility will be displayed.
  </p>
  <p>
    Most orders are delivered within the stated time frame. 
    If your delivery is delayed, please check your tracking information for updates. 
    Deliveries may take longer due to weather, public holidays, or unforeseen circumstances in certain regions.
  </p>
</section>

@include('frontend.layouts.footer')
