<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('home');
        }
        return view('frontend.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'intended_use' => 'required',
            'billing_title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'phone' => 'required',
            
            // Shipping validation
            'shipping_title' => 'required',
            'ship_first_name' => 'required',
            'ship_last_name' => 'required',
            'ship_address' => 'required',
            'ship_city' => 'required',
            'ship_state' => 'required',
            'ship_zip' => 'required',
            'ship_country' => 'required',
            'ship_phone' => 'required',
        ]);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'intended_use' => $request->intended_use,
            'billing_title' => $request->billing_title,
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
        ]);

        $user->shippingAddresses()->create([
            'shipping_title' => $request->shipping_title,
            'first_name' => $request->ship_first_name,
            'last_name' => $request->ship_last_name,
            'address' => $request->ship_address,
            'apartment' => $request->ship_apartment,
            'city' => $request->ship_city,
            'state' => $request->ship_state,
            'zip' => $request->ship_zip,
            'country' => $request->ship_country,
            'phone' => $request->ship_phone,
            'company' => $request->ship_company,
            'is_default' => true,
        ]);

        Auth::guard('web')->login($user);

        return redirect()->route('home');
    }
}
