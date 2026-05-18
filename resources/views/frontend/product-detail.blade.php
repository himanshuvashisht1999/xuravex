@extends('layouts.frontend.app')

@section('title', ($product->name ?? 'Product Detail') . ' - Xuravex')

@section('content')
    <!-- Page Title -->
    <div class="shop-page-title"style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important;">
        <div class="container">
            <h1>{{ $product->name }}</h1>
        </div>
    </div>

    <!-- Product Detail Section -->
    <section class="product-detail-section">
        <div class="container">
            <div class="product-detail-flex">
                <!-- Left: Gallery -->
                <div class="product-gallery">
                    <div class="main-img">
                        @php $images = $product->images; @endphp
                        <img src="{{ !empty($images) ? asset('uploads/products/' . $images[0]) : 'https://via.placeholder.com/400x600?text=No+Image' }}"
                            alt="{{ $product->name }}">
                    </div>
                    @if(!empty($images) && count($images) > 1)
                        <div class="thumb-grid">
                            @foreach($images as $image)
                                <div class="thumb-box">
                                    <img src="{{ asset('uploads/products/' . $image) }}" alt="Thumb">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right: Info -->
                <div class="product-info-right">
                    <h1>{{ $product->name }}</h1>
                    <div class="price-range">${{ number_format($product->selling_price, 2) }}</div>
                    <p class="short-desc">{{ $product->short_description }}</p>

                    <div class="vial-info"><strong>Quantity:</strong> {{ $product->quantity }} {{ $product->quantity_type }}
                    </div>
                    <div class="vial-info"><strong>SKU:</strong> {{ $product->sku }}</div>
                    <div class="vial-info"><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</div>

                    @if($product->stock > 0)
                        <div class="total-price-box">
                            <span class="total">${{ number_format($product->selling_price, 2) }}</span>
                            <span class="stock-status"><i class="fa-solid fa-circle-check"></i> In Stock</span>
                        </div>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px;">Add to
                                Cart</button>
                        </form>
                    @else
                        <div class="total-price-box">
                            <span class="stock-status" style="color: #ff4d4d;"><i class="fa-solid fa-circle-xmark"></i> Out of
                                Stock</span>
                        </div>
                        <button class="btn btn-primary" style="width: 100%; padding: 15px; opacity: 0.5; cursor: not-allowed;"
                            disabled>Add to Cart</button>
                    @endif
                </div>
            </div>


        </div>
    </section>

    <!-- Features Bar (Dark) -->
    <div class="product-detail-feature">
        <div class="container-fluid">
            @include('frontend.partials.why_choose_bar')
        </div>
    </div>

    <div>
        <div class="container">
            <!-- Tabs -->
            <div class="product-tabs" style="margin-top:0 !important;padding-bottom:80px !important"
                x-data="{ tab: 'description' }">
                <div class="tabs-nav" style="margin-top:0 !important;">
                    <button class="tab-btn" :class="tab === 'description' ? 'active' : ''"
                        @click="tab = 'description'">Description</button>
                    @if($product->coa_report)
                        <button class="tab-btn" :class="tab === 'coa' ? 'active' : ''" @click="tab = 'coa'">COA Report</button>
                    @endif
                    <button class="tab-btn" :class="tab === 'reviews' ? 'active' : ''"
                        @click="tab = 'reviews'">Reviews</button>
                </div>
                <div class="tabs-content">
                    <div class="tab-pane" :class="tab === 'description' ? 'active' : ''">
                        <h3>Overview of {{ $product->name }}</h3>
                        <div class="full-desc">
                            {!! $product->description !!}
                        </div>
                    </div>
                    @if($product->coa_report)
                        <div class="tab-pane" :class="tab === 'coa' ? 'active' : ''">
                            <h3>Certificate of Analysis</h3>
                            <p>You can view or download the third-party purity report for this batch below:</p>
                            <a href="{{ asset('uploads/coa/' . $product->coa_report) }}" class="btn btn-secondary"
                                target="_blank">View COA Report (PDF)</a>
                        </div>
                    @endif
                    <div class="tab-pane" :class="tab === 'reviews' ? 'active' : ''">
                        <p>No reviews yet. Be the first to review this product!</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <section class="related-products" style="padding: 80px 0; background: var(--gray-100);">
            <div class="container">
                <h2 style="text-align: center; margin-bottom: 40px; color: var(--primary-color);">Related Research Products</h2>
                <div class="shop-grid"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px;">
                    @foreach($relatedProducts as $relProduct)
                        <div class="product-card-shop" style="background: white;">
                            <a href="{{ route('product.detail', $relProduct->slug) }}">
                                <div class="image-box">
                                    @php $relImages = $relProduct->images; @endphp
                                    <img src="{{ !empty($relImages) ? asset('uploads/products/' . $relImages[0]) : 'https://via.placeholder.com/150x250?text=No+Image' }}"
                                        alt="{{ $relProduct->name }}">
                                </div>
                            </a>
                            <div class="info-box">
                                <a href="{{ route('product.detail', $relProduct->slug) }}">
                                    <h3>{{ $relProduct->name }}</h3>
                                </a>
                                <div class="price">${{ number_format($relProduct->selling_price, 2) }}</div>
                                <a href="{{ route('product.detail', $relProduct->slug) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <div class="product-faq-section">
        <div class="container">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            
            <div class="faq-accordion" x-data="{ active: 1 }">
                <!-- FAQ Item 1 -->
                <div class="faq-item" :class="active === 1 ? 'active' : ''">
                    <button class="faq-button" @click="active = active === 1 ? null : 1">
                        What is 5-Amino-1MQ and how does it work?
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div x-show="active === 1" x-collapse>
                        <div class="faq-content">
                            <p>5-Amino-1MQ is a synthetic small-molecule compound studied for its ability to inhibit the enzyme nicotinamide N-methyltransferase, commonly referred to as NNMT. This enzyme plays a regulatory role in metabolic signaling and energy balance within cells. By limiting NNMT activity, 5-Amino-1MQ helps preserve nicotinamide, a key precursor involved in NAD+ production, allowing researchers to examine how cellular energy utilization and metabolic efficiency may be influenced.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item" :class="active === 2 ? 'active' : ''">
                    <button class="faq-button" @click="active = active === 2 ? null : 2">
                        What is 5-Amino-1MQ used for in research settings?
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div x-show="active === 2" x-collapse style="display: none;">
                        <div class="faq-content">
                            <p>5-Amino-1MQ is utilized in research settings to study metabolic processes, specifically targeting NNMT inhibition to understand its role in energy metabolism and obesity-related research.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item" :class="active === 3 ? 'active' : ''">
                    <button class="faq-button" @click="active = active === 3 ? null : 3">
                        How does 5-Amino-1MQ affect NAD+ levels?
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div x-show="active === 3" x-collapse style="display: none;">
                        <div class="faq-content">
                            <p>By inhibiting NNMT, 5-Amino-1MQ prevents the methylation of nicotinamide, leading to increased levels of NAD+ and enhanced cellular metabolism in preclinical studies.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Disclaimer Section -->
    <section class="disclaimer-section">
        <div class="container">
            <h3>Research Use Only – Legal Disclaimer</h3>
            <p>The research products sold on this website are strictly for in vitro laboratory research only. They are not
                intended for human consumption, or diagnostic use, and must be used solely for laboratory experimentation by
                qualified experts. Xuravex research products are not medications, food items, or cosmetic products, and
                users must follow all relevant laws and regulations in their respective jurisdictions.</p>
        </div>
    </section>
@endsection