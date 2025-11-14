{{-- resources/views/address-book.blade.php --}}

@include('frontend.layouts.header')

<section class="account-address-book-wrapper">
    @include('frontend.layouts.sidebar-2')

    <div class="address-book-panel">
        <div class="address-panel-header">
            <span class="address-panel-title">Account Overview / Address Book</span>
            <a href="{{ url('new-address') }}" class="new-address-btn">Create New Address</a>
        </div>

        <div class="preferred-address-section">
            @if ($addresses->isEmpty())
                <p>You have no address at the moment</p>
            @else
                <div class="address-cards-wrapper" style="display: flex; flex-wrap: wrap; gap: 20px;">
                    @foreach ($addresses as $address)
                        <div class="address-card" style="position: relative; border: 1px solid #ccc; border-radius: 10px; padding: 15px; width: 100%; background: #fff;">
                            {{-- Edit/Delete Buttons --}}
                            <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 8px;">
                                <a href="{{ route('address.edit', $address->id) }}" style="color: blue; text-decoration: underline;">Edit</a>
                                <form method="POST" action="{{ route('address.delete', $address->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this address?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">Delete</button>
                                </form>
                            </div>

                            {{-- Address Info --}}
                            <p><strong>{{ $address->first_name }} {{ $address->last_name }}</strong></p>
                            <p>{{ $address->address_line1 }}</p>
                            @if ($address->address_line2)
                                <p>{{ $address->address_line2 }}</p>
                            @endif
                            <p>{{ $address->city }}, {{ $address->state }} - {{ $address->zip_code }}</p>
                            <p>Phone: {{ $address->phone_number }}</p>
                            @if ($address->preferred)
                                <p><strong>Preferred Address</strong></p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

@include('frontend.layouts.footer')
