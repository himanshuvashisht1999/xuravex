<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newArrivals = \App\Models\Product::where('status', 1)->latest()->take(4)->get();
        $bestSellers = \App\Models\Product::where('status', 1)->inRandomOrder()->take(4)->get();
        return view('frontend.index', compact('newArrivals', 'bestSellers'));
    }

    public function shop(Request $request)
    {
        $query = \App\Models\Product::where('status', 1);

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('short_description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->sort) {
            if ($request->sort == 'price_low') {
                $query->orderBy('selling_price', 'asc');
            } elseif ($request->sort == 'price_high') {
                $query->orderBy('selling_price', 'desc');
            } elseif ($request->sort == 'newest') {
                $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);
        $categories = \App\Models\Category::where('status', 1)->get();

        return view('frontend.shop', compact('products', 'categories'));
    }

    public function productDetail($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)->where('status', 1)->firstOrFail();
        $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->take(4)
            ->get();
            
        return view('frontend.product-detail', compact('product', 'relatedProducts'));
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
