@extends('layouts.admin.app')

@section('title', 'Add New Product')

@section('content')
<div class="admin-card">
    <h3>General Information</h3>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
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
                <input type="text" name="name" class="admin-input" placeholder="e.g. 5-Amino-1MQ" required value="{{ old('name') }}">
            </div>
            <div class="admin-form-group">
                <label>Category <span class="required">*</span></label>
                <select name="category_id" class="admin-select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="admin-form-group">
                <label>Brand</label>
                <select name="brand_id" class="admin-select">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Product MRP Price <span class="required">*</span></label>
                <input type="number" step="0.01" name="mrp_price" class="admin-input" placeholder="0.00" required value="{{ old('mrp_price') }}">
            </div>
            <div class="admin-form-group">
                <label>Selling/Discounted Price</label>
                <input type="number" step="0.01" name="selling_price" class="admin-input" placeholder="0.00" value="{{ old('selling_price') }}">
            </div>
            <div class="admin-form-group">
                <label>Quantity Type</label>
                <div class="dimensions-grid">
                    <input type="text" name="quantity" class="admin-input" placeholder="Value" value="{{ old('quantity') }}">
                    <select name="quantity_type" class="admin-select" style="grid-column: span 2;">
                        <option value="Vial">Vial</option>
                        <option value="Bottle">Bottle</option>
                        <option value="Pack">Pack</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>SKU</label>
                <input type="text" name="sku" class="admin-input" placeholder="e.g. XUR-P-001" value="{{ old('sku') }}">
            </div>
            <div class="admin-form-group">
                <label>Barcode</label>
                <input type="text" name="barcode" class="admin-input" placeholder="UPC/EAN" value="{{ old('barcode') }}">
            </div>
            <div class="admin-form-group">
                <label>HSN Code</label>
                <input type="text" name="hsn_code" class="admin-input" placeholder="8-digit code" value="{{ old('hsn_code') }}">
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Initial Stock <span class="required">*</span></label>
                <input type="number" name="stock" class="admin-input" placeholder="0" required value="{{ old('stock', 0) }}">
            </div>
            <div class="admin-form-group">
                <label>Minimum Stock Alert</label>
                <input type="number" name="min_stock" class="admin-input" placeholder="5" value="{{ old('min_stock', 5) }}">
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="status" class="admin-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label>Product Description <span class="required">*</span></label>
            <textarea name="description" class="admin-input" rows="8" placeholder="Detailed product description..." required>{{ old('description') }}</textarea>
        </div>

        <h3 style="margin-top: 40px;">Lab & Technical Data</h3>
        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Batch Number</label>
                <input type="text" name="batch_number" class="admin-input" placeholder="e.g. BN-2024-001" value="{{ old('batch_number') }}">
            </div>
            <div class="admin-form-group">
                <label>Purity (%)</label>
                <input type="text" name="purity" class="admin-input" placeholder="e.g. 99.8%" value="{{ old('purity') }}">
            </div>
            <div class="admin-form-group">
                <label>Verification Status</label>
                <input type="text" name="verification_status" class="admin-input" placeholder="e.g. Third-Party Verified" value="{{ old('verification_status') }}">
            </div>
        </div>

        <div class="admin-form-group">
            <label>COA Report (PDF/Image)</label>
            <input type="file" name="coa_report" class="admin-input" style="padding: 8px;" accept=".pdf,image/*">
        </div>

        <h3 style="margin-top: 40px;">Upload Product Images</h3>
        <div class="upload-box">
            <input type="file" name="images[]" id="product_images" multiple class="admin-input" style="padding: 8px;" accept="image/jpeg,image/png,image/jpg">
        </div>
        
        <div class="image-preview-grid" id="image_preview_container">
            <!-- Dynamic Previews -->
        </div>

        <div class="admin-actions">
            <a href="{{ route('admin.products.index') }}" class="btn-draft" style="text-decoration: none;">Cancel</a>
            <button type="submit" class="btn-submit">Save Product</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('product_images').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('image_preview_container');
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
