@extends('layouts.admin.app')

@section('title', 'Edit Product')

@section('content')
<div class="admin-card">
    <h3>Edit Product: {{ $product->name }}</h3>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        @if ($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 25px; font-size: 13px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Product Name <span class="required">*</span></label>
                <input type="text" name="name" class="admin-input" value="{{ old('name', $product->name) }}" required>
            </div>
            <div class="admin-form-group">
                <label>Category <span class="required">*</span></label>
                <select name="category_id" class="admin-select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="admin-form-group">
                <label>Brand</label>
                <select name="brand_id" class="admin-select">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Product MRP Price <span class="required">*</span></label>
                <input type="number" step="0.01" name="mrp_price" class="admin-input" value="{{ old('mrp_price', $product->mrp_price) }}" required>
            </div>
            <div class="admin-form-group">
                <label>Selling/Discounted Price</label>
                <input type="number" step="0.01" name="selling_price" class="admin-input" value="{{ old('selling_price', $product->selling_price) }}">
            </div>
            <div class="admin-form-group">
                <label>Quantity Type</label>
                <div class="dimensions-grid">
                    <input type="text" name="quantity" class="admin-input" value="{{ old('quantity', $product->quantity) }}">
                    <select name="quantity_type" class="admin-select" style="grid-column: span 2;">
                        <option value="Vial" {{ $product->quantity_type == 'Vial' ? 'selected' : '' }}>Vial</option>
                        <option value="Bottle" {{ $product->quantity_type == 'Bottle' ? 'selected' : '' }}>Bottle</option>
                        <option value="Pack" {{ $product->quantity_type == 'Pack' ? 'selected' : '' }}>Pack</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>SKU</label>
                <input type="text" name="sku" class="admin-input" value="{{ old('sku', $product->sku) }}">
            </div>
            <div class="admin-form-group">
                <label>Barcode</label>
                <input type="text" name="barcode" class="admin-input" value="{{ old('barcode', $product->barcode) }}">
            </div>
            <div class="admin-form-group">
                <label>HSN Code</label>
                <input type="text" name="hsn_code" class="admin-input" value="{{ old('hsn_code', $product->hsn_code) }}">
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Initial Stock <span class="required">*</span></label>
                <input type="number" name="stock" class="admin-input" value="{{ old('stock', $product->stock) }}" required>
            </div>
            <div class="admin-form-group">
                <label>Minimum Stock Alert</label>
                <input type="number" name="min_stock" class="admin-input" value="{{ old('min_stock', $product->min_stock) }}">
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="status" class="admin-select">
                    <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label>Product Description <span class="required">*</span></label>
            <textarea name="description" class="admin-input" rows="8" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <h3 style="margin-top: 40px;">Lab & Technical Data</h3>
        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Batch Number</label>
                <input type="text" name="batch_number" class="admin-input" value="{{ old('batch_number', $product->batch_number) }}">
            </div>
            <div class="admin-form-group">
                <label>Purity (%)</label>
                <input type="text" name="purity" class="admin-input" value="{{ old('purity', $product->purity) }}">
            </div>
            <div class="admin-form-group">
                <label>Verification Status</label>
                <input type="text" name="verification_status" class="admin-input" value="{{ old('verification_status', $product->verification_status) }}">
            </div>
        </div>

        <div class="admin-form-group">
            <label>COA Report (PDF/Image)</label>
            @if($product->coa_report)
                <div style="margin-bottom: 10px;">
                    <a href="{{ asset('uploads/coa/' . $product->coa_report) }}" target="_blank" style="color: #C18B39; font-size: 13px; font-weight: 600;">
                        <i class="fa-solid fa-file-pdf"></i> View Current COA
                    </a>
                </div>
            @endif
            <input type="file" name="coa_report" class="admin-input" style="padding: 8px;" accept=".pdf,image/*">
        </div>

        <h3 style="margin-top: 40px;">Product Images</h3>
        <div class="image-preview-grid" style="margin-bottom: 20px;">
            @if($product->images)
                @foreach($product->images as $image)
                    <div class="preview-thumb">
                        <img src="{{ asset('uploads/products/' . $image) }}" alt="Product Image">
                        <div class="remove-thumb" title="This will be handled in a full implementation"><i class="fa-solid fa-xmark"></i></div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="upload-box">
            <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">Add More Images</label>
            <input type="file" name="images[]" id="product_images" multiple class="admin-input" style="padding: 8px;" accept="image/jpeg,image/png,image/jpg">
        </div>
        
        <div class="image-preview-grid" id="new_image_preview_container">
            <!-- New Previews -->
        </div>

        <div class="admin-actions">
            <a href="{{ route('admin.products.index') }}" class="btn-draft" style="text-decoration: none;">Cancel</a>
            <button type="submit" class="btn-submit">Update Product</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('product_images').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('new_image_preview_container');
        previewContainer.innerHTML = '';
        
        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const div = document.createElement('div');
                div.className = 'preview-thumb';
                div.innerHTML = `<img src="${event.target.result}" alt="Preview">`;
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
