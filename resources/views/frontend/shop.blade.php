@extends('layouts.frontend.app')

@section('title', 'Shop - Xuravex')

@section('content')
    <!-- Shop Title Section -->
    <div class="shop-page-title"style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important;">
        <div class="container">
            <h1>shop with confidence</h1>
        </div>
    </div>

    <!-- Shop Grid Section -->
    <section class="shop-section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 250px 1fr; gap: 40px;"class="shop-page-row">
                <!-- Sidebar -->
                <aside class="shop-sidebar">
                    <div class="sidebar-block" style="margin-bottom: 40px;">
                        <h3 style="font-size: 1.2rem; margin-bottom: 20px; color: var(--primary-color);">Categories</h3>
                        <ul style="list-style: none; padding: 0;">
                            <li style="margin-bottom: 12px;">
                                <a href="{{ route('shop', ['search' => request('search')]) }}" style="color: {{ !request('category') ? 'var(--secondary-color)' : 'var(--gray-600)' }}; text-decoration: none; font-weight: {{ !request('category') ? '700' : '400' }};">All Products</a>
                            </li>
                            @foreach($categories as $category)
                            <li style="margin-bottom: 12px;">
                                <a href="{{ route('shop', ['category' => $category->slug, 'sort' => request('sort'), 'search' => request('search')]) }}" 
                                   style="color: {{ request('category') == $category->slug ? 'var(--secondary-color)' : 'var(--gray-600)' }}; text-decoration: none; font-weight: {{ request('category') == $category->slug ? '700' : '400' }};">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-block">
                        <h3 style="font-size: 1.2rem; margin-bottom: 20px; color: var(--primary-color);">Sort By</h3>
                        <select onchange="location = this.value;" style="width: 100%; padding: 10px; border: 1px solid var(--gray-200); border-radius: 5px; outline: none; background: white;">
                            <option value="{{ route('shop', ['category' => request('category'), 'sort' => 'newest', 'search' => request('search')]) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Items</option>
                            <option value="{{ route('shop', ['category' => request('category'), 'sort' => 'price_low', 'search' => request('search')]) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="{{ route('shop', ['category' => request('category'), 'sort' => 'price_high', 'search' => request('search')]) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>
                </aside>

                <!-- Product Grid -->
                <div>
                    @if(request('search'))
                        <div style="background: #F3E9D9; border-radius: var(--border-radius-sm); padding: 15px 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: var(--shadow-sm);">
                            <span style="color: var(--primary-color); font-weight: 500;">
                                Showing results for "<strong style="color: var(--secondary-color);">{{ request('search') }}</strong>"
                            </span>
                            <a href="{{ route('shop', ['category' => request('category'), 'sort' => request('sort')]) }}" style="color: var(--primary-color); font-size: 14px; text-decoration: underline; font-weight: 600; transition: var(--transition);" onmouseover="this.style.color='var(--secondary-color)'" onmouseout="this.style.color='var(--primary-color)'">Clear Search</a>
                        </div>
                    @endif
                    <div class="shop-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px;">
                        @forelse($products as $product)
                        <div class="product-card-shop">
                            <a href="{{ route('product.detail', $product->slug) }}">
                                <div class="image-box">
                                    @php $images = $product->images; @endphp
                                    <img src="{{ !empty($images) ? asset('uploads/products/' . $images[0]) : 'https://via.placeholder.com/150x250?text=No+Image' }}" alt="{{ $product->name }}">
                                </div>
                            </a>
                            <div class="info-box">
                                <a href="{{ route('product.detail', $product->slug) }}">
                                    <h3>{{ $product->name }}</h3>
                                </a>
                                <div class="price">
                                    @if($product->has_sizes && $product->sizes->count() > 0)
                                        ${{ number_format($product->sizes->first()->pivot->selling_price ?: $product->sizes->first()->pivot->mrp_price, 2) }}
                                    @else
                                        ${{ number_format($product->selling_price ?: $product->mrp_price, 2) }}
                                    @endif
                                </div>
                                <div style="display: flex; gap: 10px; margin-top: 15px;">
                                    <a href="{{ route('product.detail', $product->slug) }}" class="btn btn-outline" style="flex: 1; padding: 10px; font-size: 12px;">Details</a>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="flex: 1;">
                                        @csrf
                                        @if($product->has_sizes && $product->sizes->count() > 0)
                                            <input type="hidden" name="size_id" value="{{ $product->sizes->first()->id }}">
                                        @endif
                                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; font-size: 12px;">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div style="grid-column: 1/-1; text-align: center; padding: 50px; background: var(--gray-100); border-radius: 20px;">
                            <i class="fa-solid fa-box-open" style="font-size: 3rem; color: var(--gray-400); margin-bottom: 20px;"></i>
                            <h3>No products found</h3>
                            <p>Try adjusting your filters or check back later.</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="pagination" style="margin-top: 50px;">
                        {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
