<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'mrp_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'coa_report' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('uploads/products'), $name);
                $imageNames[] = $name;
            }
        }

        $coaName = null;
        if ($request->hasFile('coa_report')) {
            $coaName = 'COA_' . time() . '.' . $request->coa_report->extension();
            $request->coa_report->move(public_path('uploads/coa'), $coaName);
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'mrp_price' => $request->mrp_price,
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity,
            'quantity_type' => $request->quantity_type,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'hsn_code' => $request->hsn_code,
            'stock' => $request->stock,
            'min_stock' => $request->min_stock,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'batch_number' => $request->batch_number,
            'purity' => $request->purity,
            'verification_status' => $request->verification_status,
            'coa_report' => $coaName,
            'images' => $imageNames,
            'status' => $request->status ?? true,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'mrp_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'coa_report' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        $data = $request->except(['images', 'coa_report', '_token', 'is_featured']);
        $data['slug'] = Str::slug($request->name);
        $data['is_featured'] = $request->has('is_featured');
        $data['status'] = $request->status ?? true;

        // Handle Images
        $currentImages = $product->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('uploads/products'), $name);
                $currentImages[] = $name;
            }
        }
        $data['images'] = $currentImages;

        // Handle COA Report
        if ($request->hasFile('coa_report')) {
            $coaName = 'COA_' . time() . '.' . $request->coa_report->extension();
            $request->coa_report->move(public_path('uploads/coa'), $coaName);
            $data['coa_report'] = $coaName;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Product deleted successfully!');
    }
}
