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
            @php $images = $product->images; @endphp
            <div class="product-detail-flex"
                 x-data="{ 
                     activeImage: '{{ !empty($images) ? asset('uploads/products/' . $images[0]) : 'https://via.placeholder.com/400x600?text=No+Image' }}',
                     showLightbox: false 
                 }">
                <!-- Left: Gallery -->
                <div class="product-gallery">
                    
                    <!-- Main Image (Interactive Hover Zoom and Click to Zoom) -->
                    <div class="main-img" style="cursor: zoom-in;" @click="showLightbox = true">
                        <img :src="activeImage" alt="{{ $product->name }}">
                    </div>
 
                    <!-- Full-Screen Lightbox Modal -->
                    <div class="lightbox-modal" x-show="showLightbox" x-transition style="display: none;" @click="showLightbox = false" @keydown.escape.window="showLightbox = false">
                        <span style="position: absolute; top: 20px; right: 30px; color: white; font-size: 40px; font-weight: bold; cursor: pointer;">&times;</span>
                        <img :src="activeImage" alt="{{ $product->name }}" style="max-width: 90%; max-height: 90%; object-fit: contain; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);" @click.stop>
                    </div>
 
                    <!-- Thumbnails Slider -->
                    @if(!empty($images) && count($images) > 1)
                        <div class="product-thumbs-wrapper">
                            <div class="swiper product-thumbs-slider">
                                <div class="swiper-wrapper">
                                    @foreach($images as $image)
                                        <div class="swiper-slide" style="width: auto;">
                                            <div class="thumb-box" 
                                                 :class="activeImage === '{{ asset('uploads/products/' . $image) }}' ? 'active-thumb' : ''"
                                                 @click="activeImage = '{{ asset('uploads/products/' . $image) }}'">
                                                <img src="{{ asset('uploads/products/' . $image) }}" alt="Thumb">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Small Navigation Buttons for Thumbnails -->
                            <div class="swiper-nav-btn prev-btn product-thumbs-prev"><i class="fa-solid fa-chevron-left"></i></div>
                            <div class="swiper-nav-btn next-btn product-thumbs-next"><i class="fa-solid fa-chevron-right"></i></div>
                        </div>
                    @endif
                </div>
 
                <!-- Right: Info -->
                <div class="product-info-right">
                    <h1>{{ $product->name }}</h1>
                    <div class="price-range">
                        @if($product->has_sizes && $product->sizes->count() > 0)
                            ${{ number_format($product->sizes->first()->pivot->selling_price ?: $product->sizes->first()->pivot->mrp_price, 2) }}
                        @else
                            ${{ number_format($product->selling_price ?: $product->mrp_price, 2) }}
                        @endif
                    </div>
                    <p class="short-desc">{{ $product->short_description }}</p>
 
                    <div class="vial-info"><strong>Quantity:</strong> {{ $product->quantity }} {{ $product->quantity_type }}
                    </div>
                    <div class="vial-info"><strong>SKU:</strong> {{ $product->sku }}</div>
                    <div class="vial-info"><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</div>
 
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        
                        @if($product->has_sizes && $product->sizes->count() > 0)
                            <div class="size-selector-wrapper" style="margin-top: 20px; margin-bottom: 25px;">
                                <label style="display: block; font-weight: 700; font-size: 13px; text-transform: uppercase; color: var(--primary-color); margin-bottom: 10px;">Select Size:</label>
                                <div class="size-options-grid" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    @foreach($product->sizes as $idx => $size)
                                        <label class="size-option-label" style="cursor: pointer; position: relative; margin: 0;">
                                            <input type="radio" name="size_id" value="{{ $size->id }}" class="size-radio-input" style="display: none;" {{ $idx === 0 ? 'checked' : '' }}
                                                   data-mrp="{{ number_format($size->pivot->mrp_price, 2) }}"
                                                   data-price="{{ number_format($size->pivot->selling_price ?: $size->pivot->mrp_price, 2) }}"
                                                   data-stock="{{ $size->pivot->stock }}"
                                                   data-image="{{ $size->pivot->image ? asset('uploads/products/' . $size->pivot->image) : ( !empty($images) ? asset('uploads/products/' . $images[0]) : '' ) }}"
                                                   @change="activeImage = $el.dataset.image ? $el.dataset.image : '{{ !empty($images) ? asset('uploads/products/' . $images[0]) : '' }}'">
                                            <div class="size-option-box" style="padding: 10px 18px; border: 2px solid #E5D5C0; border-radius: 6px; font-weight: 600; font-size: 13px; text-align: center; transition: all 0.3s ease; min-width: 50px; background: white; color: var(--primary-color);">
                                                {{ $size->name }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif
 
                        @if(($product->has_sizes && $product->sizes->count() > 0) || (!$product->has_sizes && $product->stock > 0))
                            <div class="total-price-box">
                                <span class="total">
                                    @if($product->has_sizes && $product->sizes->count() > 0)
                                        ${{ number_format($product->sizes->first()->pivot->selling_price ?: $product->sizes->first()->pivot->mrp_price, 2) }}
                                    @else
                                        ${{ number_format($product->selling_price ?: $product->mrp_price, 2) }}
                                    @endif
                                </span>
                                <span class="stock-status"><i class="fa-solid fa-circle-check"></i> In Stock</span>
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px;">Add to Cart</button>
                        @else
                            <div class="total-price-box">
                                <span class="stock-status" style="color: #ff4d4d;"><i class="fa-solid fa-circle-xmark"></i> Out of Stock</span>
                            </div>
                            <button class="btn btn-primary" style="width: 100%; padding: 15px; opacity: 0.5; cursor: not-allowed;" disabled>Add to Cart</button>
                        @endif
                    </form>
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
                                <div class="price">
                                    @if($relProduct->has_sizes && $relProduct->sizes->count() > 0)
                                        ${{ number_format($relProduct->sizes->first()->pivot->selling_price ?: $relProduct->sizes->first()->pivot->mrp_price, 2) }}
                                    @else
                                        ${{ number_format($relProduct->selling_price ?: $relProduct->mrp_price, 2) }}
                                    @endif
                                </div>
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

@push('css')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<style>
    /* Size Selector Styles */
    .size-radio-input:checked + .size-option-box {
        border-color: var(--secondary-color) !important;
        background-color: var(--secondary-color) !important;
        color: white !important;
        box-shadow: 0 4px 10px rgba(193, 139, 57, 0.25);
    }
    .size-option-box:hover {
        border-color: var(--secondary-color);
    }

    /* Interactive Hover Zoom on Main Image */
    .product-gallery .main-img {
        overflow: hidden;
        border-radius: var(--border-radius-md);
        background: #F3E9D9;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 500px; /* Standardize main image container height */
    }

    .product-gallery .main-img img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Crop/contain appropriately */
        transition: transform 0.4s ease;
    }

    .product-gallery .main-img:hover img {
        transform: scale(1.05);
    }

    /* Thumbnail slider container */
    .product-thumbs-wrapper {
        position: relative;
        padding: 0 35px;
        margin-top: 15px;
    }

    .product-thumbs-slider {
        overflow: hidden;
    }

    .product-thumbs-slider .swiper-slide {
        width: 75px !important;
        height: 90px !important;
    }

    .product-thumbs-slider .thumb-box {
        background: #F3E9D9;
        border-radius: var(--border-radius-sm);
        padding: 5px;
        cursor: pointer;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid transparent !important;
        transition: var(--transition);
        box-sizing: border-box;
    }

    .product-thumbs-slider .thumb-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .product-thumbs-slider .thumb-box.active-thumb, 
    .product-thumbs-slider .thumb-box:hover {
        border-color: var(--secondary-color) !important;
        box-shadow: 0 4px 10px rgba(193, 139, 57, 0.2);
    }

    /* Thumbnail navigation chevrons */
    .product-thumbs-wrapper .swiper-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 28px;
        height: 28px;
        background: var(--white);
        border: 1px solid rgba(62, 39, 3, 0.2);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 10px;
        cursor: pointer;
        z-index: 10;
        transition: var(--transition);
    }

    .product-thumbs-wrapper .swiper-nav-btn:hover {
        background: var(--primary-color);
        color: var(--white);
        border-color: var(--primary-color);
    }

    .product-thumbs-wrapper .swiper-nav-btn.prev-btn {
        left: 0;
    }

    .product-thumbs-wrapper .swiper-nav-btn.next-btn {
        right: 0;
    }

    /* Full-screen Lightbox Modal */
    .lightbox-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.9);
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: zoom-out;
    }
</style>
@endpush

@push('scripts')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.product-thumbs-slider', {
            slidesPerView: 'auto',
            spaceBetween: 10,
            freeMode: true,
            watchSlidesProgress: true,
            navigation: {
                nextEl: '.product-thumbs-next',
                prevEl: '.product-thumbs-prev',
            }
        });

        // Dynamic Size/Price switching
        const sizeRadios = document.querySelectorAll('.size-radio-input');
        const priceDisplay = document.querySelector('.price-range');
        const totalDisplay = document.querySelector('.total-price-box .total');
        const stockStatus = document.querySelector('.stock-status');
        const addToCartBtn = document.querySelector('.product-info-right button[type="submit"]');

        function updatePriceAndStock(radio) {
            if (!radio) return;
            const price = radio.dataset.price;
            const stock = parseInt(radio.dataset.stock);

            // Update price displays
            if (priceDisplay) priceDisplay.textContent = `$${price}`;
            if (totalDisplay) totalDisplay.textContent = `$${price}`;

            // Update stock display and button availability
            if (stock > 0) {
                if (stockStatus) {
                    stockStatus.innerHTML = `<i class="fa-solid fa-circle-check"></i> In Stock (${stock})`;
                    stockStatus.style.color = ''; // Reset to default style
                }
                if (addToCartBtn) {
                    addToCartBtn.removeAttribute('disabled');
                    addToCartBtn.style.opacity = '1';
                    addToCartBtn.style.cursor = 'pointer';
                    addToCartBtn.textContent = 'Add to Cart';
                }
            } else {
                if (stockStatus) {
                    stockStatus.innerHTML = `<i class="fa-solid fa-circle-xmark"></i> Out of Stock`;
                    stockStatus.style.color = '#ff4d4d';
                }
                if (addToCartBtn) {
                    addToCartBtn.setAttribute('disabled', 'disabled');
                    addToCartBtn.style.opacity = '0.5';
                    addToCartBtn.style.cursor = 'not-allowed';
                    addToCartBtn.textContent = 'Out of Stock';
                }
            }
        }

        sizeRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                updatePriceAndStock(this);
            });
        });

        // Initialize with default checked radio (first size)
        const checkedRadio = document.querySelector('.size-radio-input:checked');
        if (checkedRadio) {
            updatePriceAndStock(checkedRadio);
        }
    });
</script>
@endpush
@endsection