<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use App\Models\Shipping;
use App\User;
use PDF;
use Notification;
use Helper;
use Illuminate\Support\Str;
use App\Notifications\StatusNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::orderBy('id','DESC')->paginate(10);
        return view('backend.order.index')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function placeOrder(Request $request)
    {
        $this->validate($request, [
            'first_name'       => 'required|string|max:50',
            'last_name'        => 'required|string|max:50',
            'phone'            => 'required|string|max:20',
            'selected_address' => 'required|exists:addresses,id',
            'coupon'           => 'nullable|numeric',
            'email'            => 'required|string|email',
            'payment_method'   => 'required|in:paypal,cod'
        ]);

        if (empty(Cart::where('user_id', auth()->user()->id)->whereNull('order_id')->first())) {
            request()->session()->flash('error', 'Cart is Empty !');
            return back();
        }

        // Get the user by email for linking user_id
        $user = User::where('email', $request->email)->firstOrFail();

        // Create the order
        $order_data = [];
        $order_data['order_number'] = 'ORD-' . strtoupper(Str::random(10));
        $order_data['user_id']      = $user->id;

        // Store only the ID for address
        $address = Address::findOrFail($request->selected_address);
        $order_data['address_id']   = $address->id;

        // Customer details
        $order_data['first_name']   = $request->first_name;
        $order_data['last_name']    = $request->last_name;
        $order_data['phone']        = $request->phone;
        $order_data['email']        = $request->email;

        // Shipping and totals
        $order_data['shipping_id']  = $request->shipping;
        $shipping = Shipping::where('id', $order_data['shipping_id'])->pluck('price');

        $order_data['sub_total']    = Helper::totalCartPrice();
        $order_data['quantity']     = Helper::cartCount();

        if (session('coupon')) {
            $order_data['coupon'] = session('coupon')['value'];
        }

        if ($request->shipping) {
            if (session('coupon')) {
                $order_data['total_amount'] = Helper::totalCartPrice() + $shipping[0] - session('coupon')['value'];
            } else {
                $order_data['total_amount'] = Helper::totalCartPrice() + $shipping[0];
            }
        } else {
            if (session('coupon')) {
                $order_data['total_amount'] = Helper::totalCartPrice() - session('coupon')['value'];
            } else {
                $order_data['total_amount'] = Helper::totalCartPrice();
            }
        }

        // Status and payment
        $order_data['status'] = "new";
        if ($request->payment_method == 'paypal') {
            $order_data['payment_method'] = 'paypal';
            $order_data['payment_status'] = 'paid';
        } else {
            $order_data['payment_method'] = 'cod';
            $order_data['payment_status'] = 'Unpaid';
        }

        // Save order
        $order = Order::create($order_data);

        // Store order items
        $cartItems = Cart::where('user_id', auth()->user()->id)->whereNull('order_id')->get();
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $cartItem->product_id,
                'product_name' => $cartItem->product->title ?? 'Unknown Product',
                'quantity'     => $cartItem->quantity,
                'price'        => $cartItem->price
            ]);
        }

        // notify admin
        $admin = User::where('role', 'admin')->first();
        Notification::send($admin, new StatusNotification([
            'title'     => 'New order created',
            'actionURL' => route('order.show', $order->id),
            'fas'       => 'fa-file-alt'
        ]));

        if ($request->payment_method == 'paypal') {
            return redirect()->route('payment')->with(['id' => $order->id]);
        } else {
            session()->forget('cart');
            session()->forget('coupon');
        }

        // Update cart to link with order
        Cart::where('user_id', auth()->user()->id)->whereNull('order_id')
            ->update(['order_id' => $order->id]);

        request()->session()->flash('success', 'Your product successfully placed in order');
        return redirect()->route('checkout')->with('order_success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with([
            'orderItems.product',
            'address' // add this line to also load the address relation
        ])->findOrFail($id);

        return view('backend.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=Order::find($id);
        return view('backend.order.edit')->with('order',$order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $this->validate($request, [
            'status' => 'required|in:new,process,delivered,cancel'
        ]);

        $data = $request->all();

        if ($request->status == 'delivered') {
            // Update product stock
            foreach ($order->cart as $cart) {
                $product = $cart->product;
                $product->stock -= $cart->quantity;
                $product->save();
            }

            // Set payment_status to paid
            $order->payment_status = 'paid';
        }

        $status = $order->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Successfully updated order');
        } else {
            request()->session()->flash('error', 'Error while updating order');
        }

        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=Order::find($id);
        if($order){
            $status=$order->delete();
            if($status){
                request()->session()->flash('success','Order Successfully deleted');
            }
            else{
                request()->session()->flash('error','Order can not deleted');
            }
            return redirect()->route('order.index');
        }
        else{
            request()->session()->flash('error','Order can not found');
            return redirect()->back();
        }
    }

    public function orderTrack(){
        return view('frontend.pages.order-track');
    }

    public function productTrackOrder(Request $request){
        // return $request->all();
        $order=Order::where('user_id',auth()->user()->id)->where('order_number',$request->order_number)->first();
        if($order){
            if($order->status=="new"){
            request()->session()->flash('success','Your order has been placed. please wait.');
            return redirect()->route('home');

            }
            elseif($order->status=="process"){
                request()->session()->flash('success','Your order is under processing please wait.');
                return redirect()->route('home');
    
            }
            elseif($order->status=="delivered"){
                request()->session()->flash('success','Your order is successfully delivered.');
                return redirect()->route('home');
    
            }
            else{
                request()->session()->flash('error','Your order canceled. please try again');
                return redirect()->route('home');
    
            }
        }
        else{
            request()->session()->flash('error','Invalid order numer please try again');
            return back();
        }
    }

    // PDF generate
public function pdf($id)
{
    $order = Order::with(['orderItems.product', 'address'])->findOrFail($id);

    $pdf = \PDF::loadView('backend.order.pdf', compact('order'));

    return $pdf->download('order-'.$order->order_number.'.pdf');
}
    // Income chart
    public function incomeChart(Request $request){
        $year=\Carbon\Carbon::now()->year;
        // dd($year);
        $items=Order::with(['cart_info'])->whereYear('created_at',$year)->where('status','delivered')->get()
            ->groupBy(function($d){
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });
            // dd($items);
        $result=[];
        foreach($items as $month=>$item_collections){
            foreach($item_collections as $item){
                $amount=$item->cart_info->sum('amount');
                // dd($amount);
                $m=intval($month);
                // return $m;
                isset($result[$m]) ? $result[$m] += $amount :$result[$m]=$amount;
            }
        }
        $data=[];
        for($i=1; $i <=12; $i++){
            $monthName=date('F', mktime(0,0,0,$i,1));
            $data[$monthName] = (!empty($result[$i]))? number_format((float)($result[$i]), 2, '.', '') : 0.0;
        }
        return $data;
    }
}
