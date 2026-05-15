<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function shop()
    {
        return view('frontend.shop');
    }

    public function productDetail()
    {
        return view('frontend.product-detail');
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function thankYou()
    {
        return view('frontend.thank-you');
    }
}
