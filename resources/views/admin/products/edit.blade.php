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
            <div class="admin-form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label>Brand</label>
                    <select name="brand_id" class="admin-select">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Has Sizes? <span class="required">*</span></label>
                    <select name="has_sizes" id="has_sizes_select" class="admin-select" required>
                        <option value="0" {{ old('has_sizes', $product->has_sizes) == '0' ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('has_sizes', $product->has_sizes) == '1' ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="admin-form-grid" id="common_pricing_fields">
            <div class="admin-form-group">
                <label>Product MRP Price <span class="required">*</span></label>
                <input type="number" step="0.01" name="mrp_price" id="mrp_price" class="admin-input" value="{{ old('mrp_price', $product->mrp_price) }}" required>
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
            <div class="admin-form-group" id="common_stock_wrapper">
                <label>Initial Stock <span class="required">*</span></label>
                <input type="number" name="stock" id="stock" class="admin-input" value="{{ old('stock', $product->stock) }}" required>
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

        <div id="size_pricing_section" style="display: none;">
            <h3 style="margin-top: 40px;">Size-Based Prices & Stock</h3>
            <p style="color: #666; font-size: 13px; margin-bottom: 20px;">If this product has size variants, define the MRP, Selling Price, Stock, and variant-specific image for each size below.</p>
            
            <div id="size_pricing_wrapper" style="margin-bottom: 30px;">
                <table class="admin-table" style="width: 100%;" id="size_pricing_table">
                    <thead>
                        <tr>
                            <th>Size <span class="required">*</span></th>
                            <th>MRP Price <span class="required">*</span></th>
                            <th>Selling Price</th>
                            <th>Stock <span class="required">*</span></th>
                            <th>Variant Image</th>
                            <th style="width: 80px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="size_pricing_tbody">
                        @foreach($product->sizes as $index => $pivotSize)
                        <tr>
                            <td>
                                <select name="sizes[{{ $index }}][size_id]" class="admin-select" required>
                                    <option value="">Select Size</option>
                                    @foreach($sizes as $size)
                                        <option value="{{ $size->id }}" {{ $pivotSize->id == $size->id ? 'selected' : '' }}>{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" step="0.01" name="sizes[{{ $index }}][mrp_price]" class="admin-input" placeholder="0.00" required min="0" value="{{ $pivotSize->pivot->mrp_price }}">
                            </td>
                            <td>
                                <input type="number" step="0.01" name="sizes[{{ $index }}][selling_price]" class="admin-input" placeholder="0.00" min="0" value="{{ $pivotSize->pivot->selling_price }}">
                            </td>
                            <td>
                                <input type="number" name="sizes[{{ $index }}][stock]" class="admin-input" placeholder="0" required min="0" value="{{ $pivotSize->pivot->stock }}">
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    @if($pivotSize->pivot->image)
                                        <img src="{{ asset('uploads/products/' . $pivotSize->pivot->image) }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;" alt="Variant Image">
                                    @endif
                                    <input type="file" name="sizes[{{ $index }}][image]" class="admin-input" style="padding: 5px; font-size: 12px;" accept="image/*">
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn-icon btn-icon-delete remove-size-row" style="border:none; background:none; cursor:pointer;" title="Remove">
                                    <i class="fa-solid fa-trash-can" style="color: #dc3545;"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn-submit" id="add_size_price_row" style="margin-top: 15px; background-color: #28a745; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-plus"></i> Add Size Price Row
                </button>
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

    // Size-Based Pricing Repeater & Toggle Logic
    document.addEventListener('DOMContentLoaded', function () {
        const hasSizesSelect = document.getElementById('has_sizes_select');
        const commonPricingFields = document.getElementById('common_pricing_fields');
        const commonStockWrapper = document.getElementById('common_stock_wrapper');
        const sizePricingSection = document.getElementById('size_pricing_section');
        
        const mrpPriceInput = document.getElementById('mrp_price');
        const stockInput = document.getElementById('stock');

        function toggleSizeFields() {
            if (hasSizesSelect.value === '1') {
                commonPricingFields.style.display = 'none';
                commonStockWrapper.style.display = 'none';
                sizePricingSection.style.display = 'block';
                
                mrpPriceInput.removeAttribute('required');
                stockInput.removeAttribute('required');
            } else {
                commonPricingFields.style.display = 'grid';
                commonStockWrapper.style.display = 'block';
                sizePricingSection.style.display = 'none';
                
                mrpPriceInput.setAttribute('required', 'required');
                stockInput.setAttribute('required', 'required');
            }
        }

        hasSizesSelect.addEventListener('change', toggleSizeFields);
        toggleSizeFields(); // Run on load

        const sizesJson = @json($sizes);
        const tbody = document.getElementById('size_pricing_tbody');
        const addBtn = document.getElementById('add_size_price_row');
        let rowIndex = {{ $product->sizes->count() }};

        // Attach event listeners to existing remove buttons
        document.querySelectorAll('.remove-size-row').forEach(function (button) {
            button.addEventListener('click', function () {
                button.closest('tr').remove();
            });
        });

        addBtn.addEventListener('click', function () {
            if (sizesJson.length === 0) {
                alert('No active sizes found. Please add sizes in the Size Master first.');
                return;
            }

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <select name="sizes[${rowIndex}][size_id]" class="admin-select" required>
                        <option value="">Select Size</option>
                        ${sizesJson.map(size => `<option value="${size.id}">${size.name}</option>`).join('')}
                    </select>
                </td>
                <td>
                    <input type="number" step="0.01" name="sizes[${rowIndex}][mrp_price]" class="admin-input" placeholder="0.00" required min="0">
                </td>
                <td>
                    <input type="number" step="0.01" name="sizes[${rowIndex}][selling_price]" class="admin-input" placeholder="0.00" min="0">
                </td>
                <td>
                    <input type="number" name="sizes[${rowIndex}][stock]" class="admin-input" placeholder="0" required min="0" value="0">
                </td>
                <td>
                    <input type="file" name="sizes[${rowIndex}][image]" class="admin-input" style="padding: 5px; font-size: 12px;" accept="image/*">
                </td>
                <td>
                    <button type="button" class="btn-icon btn-icon-delete remove-size-row" style="border:none; background:none; cursor:pointer;" title="Remove">
                        <i class="fa-solid fa-trash-can" style="color: #dc3545;"></i>
                    </button>
                </td>
            `;

            tbody.appendChild(tr);

            tr.querySelector('.remove-size-row').addEventListener('click', function () {
                tr.remove();
            });

            rowIndex++;
        });
    });
</script>
@endsection
