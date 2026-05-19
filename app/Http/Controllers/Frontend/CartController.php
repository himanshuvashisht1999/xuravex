<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('frontend.cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $sizeId = $request->input('size_id');
        $sizeName = null;
        $price = $product->selling_price ?: $product->mrp_price;
        $cartKey = $id;
        $image = !empty($product->images) ? $product->images[0] : '';

        if ($product->has_sizes && !$sizeId) {
            $firstSize = $product->sizes()->first();
            if ($firstSize) {
                $sizeId = $firstSize->id;
            }
        }

        if ($product->has_sizes && $sizeId) {
            $size = $product->sizes()->where('sizes.id', $sizeId)->first();
            if ($size) {
                $price = $size->pivot->selling_price ?: $size->pivot->mrp_price;
                $sizeName = $size->name;
                $cartKey = $id . '_' . $sizeId;
                if ($size->pivot->image) {
                    $image = $size->pivot->image;
                }
            }
        }

        $cart = session()->get('cart', []);

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                "product_id" => $id,
                "size_id" => $sizeId,
                "size_name" => $sizeName,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $price,
                "image" => $image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
