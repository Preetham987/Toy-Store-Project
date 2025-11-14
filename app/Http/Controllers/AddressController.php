<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|digits:6',
            'phone_number' => 'required|string|max:20',
        ]);

        $validated['preferred'] = $request->has('preferred');
        $validated['email'] = Auth::user()->email;

        Address::create($validated);

        // ✅ Redirect to address book instead of going back
        return redirect('/address-book')->with('success', 'Address saved successfully.');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|digits:6',
            'phone_number' => 'required|string|max:20',
        ]);

        $validated['preferred'] = $request->has('preferred');
        $validated['email'] = Auth::user()->email;

        $address = Address::findOrFail($id);
        $address->update($validated);

        return redirect('/address-book')->with('success', 'Address updated successfully.');
    }

    public function edit($id)
    {
        $address = Address::findOrFail($id);

        return view('frontend.pages.edit-address', compact('address'));
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return redirect()->back()->with('success', 'Address deleted successfully.');
    }
}
