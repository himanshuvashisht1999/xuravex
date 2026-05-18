<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('frontend.user.dashboard', compact('orders'));
    }

    public function orderDetails($orderNumber)
    {
        $order = Order::where('user_id', auth()->id())->where('order_number', $orderNumber)->with('orderItems')->firstOrFail();
        return view('frontend.user.order-details', compact('order'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('frontend.user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'billing_title' => $request->billing_title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'apartment' => $request->apartment,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'company' => $request->company,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function shippingAddresses()
    {
        $addresses = ShippingAddress::where('user_id', auth()->id())->get();
        return view('frontend.user.shipping-addresses', compact('addresses'));
    }

    public function addShippingAddress(Request $request)
    {
        $request->validate([
            'shipping_title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'phone' => 'required',
        ]);

        ShippingAddress::create([
            'user_id' => auth()->id(),
            'shipping_title' => $request->shipping_title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'apartment' => $request->apartment,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'phone' => $request->phone,
            'company' => $request->company,
            'is_default' => $request->has('is_default'),
        ]);

        return back()->with('success', 'Shipping address added successfully!');
    }

    public function deleteShippingAddress($id)
    {
        $address = ShippingAddress::where('user_id', auth()->id())->findOrFail($id);
        $address->delete();
        return back()->with('success', 'Shipping address deleted successfully!');
    }
}
