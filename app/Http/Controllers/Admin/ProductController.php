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
        $sizes = \App\Models\Size::where('status', 1)->get();
        return view('admin.products.create', compact('categories', 'brands', 'sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'has_sizes' => 'required|boolean',
            'mrp_price' => 'required_if:has_sizes,0|nullable|numeric',
            'stock' => 'required_if:has_sizes,0|nullable|integer',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'coa_report' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'sizes' => 'required_if:has_sizes,1|nullable|array',
            'sizes.*.size_id' => 'required_with:sizes|exists:sizes,id',
            'sizes.*.mrp_price' => 'required_with:sizes|numeric|min:0',
            'sizes.*.selling_price' => 'nullable|numeric|min:0',
            'sizes.*.stock' => 'required_with:sizes|integer|min:0',
            'sizes.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'has_sizes' => $request->has_sizes,
            'mrp_price' => $request->has_sizes ? null : $request->mrp_price,
            'selling_price' => $request->has_sizes ? null : $request->selling_price,
            'quantity' => $request->quantity,
            'quantity_type' => $request->quantity_type,
            'weight' => $request->has_sizes ? null : $request->weight,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'hsn_code' => $request->hsn_code,
            'stock' => $request->has_sizes ? null : $request->stock,
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

        $sizesData = [];
        if ($request->has_sizes && $request->has('sizes') && is_array($request->sizes)) {
            foreach ($request->sizes as $index => $sizeItem) {
                if (!empty($sizeItem['size_id']) && isset($sizeItem['mrp_price'])) {
                    $sizeImageName = null;
                    if ($request->hasFile("sizes.$index.image")) {
                        $sizeImage = $request->file("sizes.$index.image");
                        $sizeImageName = time() . '_size_' . uniqid() . '.' . $sizeImage->extension();
                        $sizeImage->move(public_path('uploads/products'), $sizeImageName);
                    }

                    $sizesData[$sizeItem['size_id']] = [
                        'mrp_price' => $sizeItem['mrp_price'],
                        'selling_price' => $sizeItem['selling_price'] ?? null,
                        'stock' => $sizeItem['stock'] ?? 0,
                        'weight' => $sizeItem['weight'] ?? null,
                        'image' => $sizeImageName
                    ];
                }
            }
        }
        $product->sizes()->sync($sizesData);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::with('sizes')->findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $sizes = \App\Models\Size::where('status', 1)->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'sizes'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'has_sizes' => 'required|boolean',
            'mrp_price' => 'required_if:has_sizes,0|nullable|numeric',
            'stock' => 'required_if:has_sizes,0|nullable|integer',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'coa_report' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'sizes' => 'required_if:has_sizes,1|nullable|array',
            'sizes.*.size_id' => 'required_with:sizes|exists:sizes,id',
            'sizes.*.mrp_price' => 'required_with:sizes|numeric|min:0',
            'sizes.*.selling_price' => 'nullable|numeric|min:0',
            'sizes.*.stock' => 'required_with:sizes|integer|min:0',
            'sizes.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['images', 'coa_report', '_token', 'is_featured', 'sizes']);
        $data['slug'] = Str::slug($request->name);
        $data['is_featured'] = $request->has('is_featured');
        $data['status'] = $request->status ?? true;

        if ($request->has_sizes) {
            $data['mrp_price'] = null;
            $data['selling_price'] = null;
            $data['stock'] = null;
            $data['weight'] = null;
        }

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

        $sizesData = [];
        if ($request->has_sizes && $request->has('sizes') && is_array($request->sizes)) {
            $existingSizes = $product->sizes->keyBy('id');

            foreach ($request->sizes as $index => $sizeItem) {
                if (!empty($sizeItem['size_id']) && isset($sizeItem['mrp_price'])) {
                    $sizeImageName = null;

                    if ($request->hasFile("sizes.$index.image")) {
                        $sizeImage = $request->file("sizes.$index.image");
                        $sizeImageName = time() . '_size_' . uniqid() . '.' . $sizeImage->extension();
                        $sizeImage->move(public_path('uploads/products'), $sizeImageName);
                    } else {
                        $existingSize = $existingSizes->get($sizeItem['size_id']);
                        if ($existingSize && $existingSize->pivot) {
                            $sizeImageName = $existingSize->pivot->image;
                        }
                    }

                    $sizesData[$sizeItem['size_id']] = [
                        'mrp_price' => $sizeItem['mrp_price'],
                        'selling_price' => $sizeItem['selling_price'] ?? null,
                        'stock' => $sizeItem['stock'] ?? 0,
                        'weight' => $sizeItem['weight'] ?? null,
                        'image' => $sizeImageName
                    ];
                }
            }
        }
        $product->sizes()->sync($sizesData);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Product deleted successfully!');
    }
}
