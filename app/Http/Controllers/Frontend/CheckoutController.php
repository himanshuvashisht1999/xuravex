<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('shop')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('frontend.checkout', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'billing_name' => 'required',
            'billing_email' => 'required|email',
            'billing_phone' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_state' => 'required',
            'billing_pincode' => 'required',
            'billing_country' => 'required',
        ]);

        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('shop')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'user_id' => auth()->id(),
            'total_amount' => $total,
            'payable_amount' => $total,
            'billing_name' => $request->billing_name,
            'billing_email' => $request->billing_email,
            'billing_phone' => $request->billing_phone,
            'billing_address' => $request->billing_address,
            'billing_city' => $request->billing_city,
            'billing_state' => $request->billing_state,
            'billing_pincode' => $request->billing_pincode,
            'billing_country' => $request->billing_country,
            'shipping_name' => $request->shipping_name ?? $request->billing_name,
            'shipping_email' => $request->shipping_email ?? $request->billing_email,
            'shipping_phone' => $request->shipping_phone ?? $request->billing_phone,
            'shipping_address' => $request->shipping_address ?? $request->billing_address,
            'shipping_city' => $request->shipping_city ?? $request->billing_city,
            'shipping_state' => $request->shipping_state ?? $request->billing_state,
            'shipping_pincode' => $request->shipping_pincode ?? $request->billing_pincode,
            'shipping_country' => $request->shipping_country ?? $request->billing_country,
            'payment_method' => $request->payment_method ?? 'cod',
            'payment_status' => $request->payment_method == 'paypal' ? 'paid' : 'pending',
            'order_status' => 'pending',
            'notes' => $request->notes,
        ]);

        foreach($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('thank.you', ['order' => $order->order_number])
            ]);
        }

        return redirect()->route('thank.you', ['order' => $order->order_number])->with('success', 'Order placed successfully!');
    }

    public function thankYou($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('frontend.thank-you', compact('order'));
    }
}
