{{-- resources/views/returns.blade.php --}}
@include('frontend.layouts.header')

<section class="bbts-return-policy">
  <nav class="bbts-breadcrumb">
    <a href="{{ url('help') }}">BBTS Help Center</a> &gt; 
    <span>Return Policy</span>
  </nav>

  <h1>Return Policy</h1>

  <p>
    Not all purchases are going to be perfect. As hard as we try, things may not always arrive as expected; 
    with that in mind we offer a 30-day return policy on most items.
  </p>
  
  <h3>Unopened Items</h3>
  <p>
    Unopened and unused items can be returned within 30 days unless specifically stated on the product details page. 
    The packaging must be in the same condition as when initially received.
  </p>

  <h3>Opened Items</h3>
  <p>Opened items are not eligible for returns. This includes:</p>
  <ul>
    <li>Items that have been opened or removed from the original packaging</li>
    <li>Items that have visible indications the package has been opened</li>
    <li>Opened cases that are no longer factory sealed</li>
  </ul>

  <h3>Other Items Not Eligible for Return</h3>
  <p>
    Certain items on the site are not eligible for return regardless of their status. 
    These may include collectible trading cards, costumes, sealed underwear, jewelry, food/edible items, 
    and any other item noted as ineligible for return on the product details page.
  </p>

  <h3>Clothing and Apparel</h3>
  <p>
    Used or worn clothing, apparel, Halloween costumes, and accessories may not be returned.
  </p>

  <h3>Damaged and Defective Items</h3>
  <p>
    Any defective item or item damaged in transit can be exchanged for a replacement or replacement part 
    within 30 days of receiving your order, if available. If not, we will offer a refund. 
    We may request you to email a picture of your broken or defective item for review.
  </p>
  <p>
    The following issues do not qualify as a defective product:
  </p>
  <ul>
    <li>Minor cosmetic paint issues</li>
    <li>Package condition, unless you have purchased Collector’s Grade 
      (see <a href="#">Package Grading Guide</a>)
    </li>
  </ul>

  <h3>How to Return an Item</h3>
  <p>
    Please contact Customer Service to receive authorization for your return 
    so that the item(s) can be accepted. Any returns without authorization 
    may be delayed and may not be eligible for a refund.<br>
    Email: <a href="mailto:service@bigbadtoystore.com">service@bigbadtoystore.com</a><br>
    Toll Free: 888-980-2287 (9:00 AM to 5:00 PM CST Monday–Friday)
  </p>

  <h3>Return Shipping – Domestic Customers</h3>
  <ul>
    <li>
      If the return is due to our error or a damaged/defective product, 
      we will cover return shipping using a BBTS return option (prepaid label). 
      Self-return shipping choices are not reimbursed.
    </li>
    <li>
      For other reasons, BBTS does not cover shipping fees and you are responsible for all costs. 
      BBTS is not responsible for any lost/damaged return shipments.
    </li>
  </ul>
</section>

@include('frontend.layouts.footer')
