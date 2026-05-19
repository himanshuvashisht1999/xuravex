@extends('layouts.admin.app')

@section('title', 'All Products')

@section('content')
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; border: none; padding: 0;">Product Inventory</h3>
        <div style="display: flex; gap: 15px;">
            <div class="input-group" style="position: relative;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #999;"></i>
                <input type="text" class="admin-input" placeholder="Search product..." style="padding-left: 35px; width: 250px;">
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn-submit" style="text-decoration: none; padding: 10px 20px;">+ Add Product</a>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    <div class="table-thumb">
                        @if($product->images && count($product->images) > 0)
                            <img src="{{ asset('uploads/products/' . $product->images[0]) }}" alt="Product">
                        @else
                            <img src="https://via.placeholder.com/40x50?text=Vial" alt="Product">
                        @endif
                    </div>
                </td>
                <td><strong>{{ $product->name }}</strong></td>
                <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                <td>
                    @if($product->has_sizes && $product->sizes->count() > 0)
                        @php
                            $minPrice = $product->sizes->min(function($s) { return $s->pivot->selling_price ?: $s->pivot->mrp_price; });
                            $maxPrice = $product->sizes->max(function($s) { return $s->pivot->selling_price ?: $s->pivot->mrp_price; });
                        @endphp
                        @if($minPrice == $maxPrice)
                            ${{ number_format($minPrice, 2) }}
                        @else
                            ${{ number_format($minPrice, 2) }} - ${{ number_format($maxPrice, 2) }}
                        @endif
                    @else
                        ${{ number_format($product->selling_price ?: $product->mrp_price, 2) }}
                    @endif
                </td>
                <td>
                    @if($product->has_sizes && $product->sizes->count() > 0)
                        {{ $product->sizes->sum('pivot.stock') }}
                    @else
                        {{ $product->stock }}
                    @endif
                </td>
                <td>
                    @php
                        $totalStock = $product->has_sizes && $product->sizes->count() > 0 ? $product->sizes->sum('pivot.stock') : $product->stock;
                        $lowStock = $totalStock <= $product->min_stock;
                        $statusClass = $product->status ? ($lowStock ? 'badge-low-stock' : 'badge-active') : 'badge-pending';
                        $statusText = $product->status ? ($lowStock ? 'Low Stock' : 'Active') : 'Inactive';
                    @endphp
                    <span class="badge {{ $statusClass }}">
                        {{ $statusText }}
                    </span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-icon btn-icon-edit" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-icon btn-icon-delete" title="Delete" onclick="if(confirm('Are you sure you want to delete this product?')) { document.getElementById('delete-form-{{ $product->id }}').submit(); }">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 30px; color: #999;">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 30px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #666;">
        <div>Showing 1 to 3 of 3 entries</div>
        <div style="display: flex; gap: 5px;">
            <button class="btn-icon btn-icon-edit" style="width: auto; padding: 0 10px;">Previous</button>
            <button class="btn-icon btn-icon-edit active" style="background: #3E2703; color: white;">1</button>
            <button class="btn-icon btn-icon-edit" style="width: auto; padding: 0 10px;">Next</button>
        </div>
    </div>
</div>
@endsection
