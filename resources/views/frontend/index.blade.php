@extends('layouts.frontend.app')

@section('title', 'Xuravex - Reliable Peptides, Proven Performance')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section"style="background-image:url({{asset('images/banner-bg-img.png')}})">
        <div class="container">
            <div class="hero-content" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 100)" :class="loaded ? 'fade-in-up' : ''">
                <h1>Reliable Peptides.</h1>
                <h2>Proven Performance.</h2>
                <p>From sourcing to quality testing, every product is <br> crafted to ensure precision, safety, and research- <br> grade excellence.</p>
                <a href="#" class="btn btn-primary">Order Now</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><img src="{{asset('images/banner-bottom-icon-1.png')}}" alt=""></div>
                    <h3>Same Day Shipping</h3>
                    <p>Fast shipping on orders before 2 PM ET via FedEx 2-Day Air. We're here to help—chat, call, or email us.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><img src="{{asset('images/banner-bottom-icon-2.png')}}" alt=""></div>
                    <h3>Volume Discounts</h3>
                    <p>The more you buy, the more you save—get discounts on 5+ items and unlock bigger savings on 10+ units.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><img src="{{asset('images/banner-bottom-icon-3.png')}}" alt=""></div>
                    <h3>Shop with Confidence</h3>
                    <p>We stand behind every product with a 30-day money-back guarantee on unopened items.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><img src="{{asset('images/banner-bottom-icon-4.png')}}" alt=""></div>
                    <h3>Backorder Support</h3>
                    <p>If an item is temporarily out of stock, our support team will reach out with timely updates and next steps.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="new-arrivals" style="background-image:url({{asset('images/new-arrival-bg-img.png')}});background-repeat: no-repeat;background-size: contain;">
        <div class="container">
            <h2 class="section-title text-center">New Arrivals</h2>
            <div class="slider-container-wrapper">
                <div class="swiper new-arrivals-slider">
                    <div class="swiper-wrapper">
                        @foreach($newArrivals as $product)
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-image">
                                    <a href="{{ route('product.detail', $product->slug) }}">
                                        <img src="{{ !empty($product->images) ? asset('uploads/products/' . $product->images[0]) : 'https://via.placeholder.com/150x250?text=Product' }}" alt="{{ $product->name }}">
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('product.detail', $product->slug) }}">
                                        <h3>{{ $product->name }}</h3>
                                    </a>
                                    <div class="product-price">
                                        @if($product->has_sizes && $product->sizes->count() > 0)
                                            ${{ number_format($product->sizes->first()->pivot->selling_price ?: $product->sizes->first()->pivot->mrp_price, 2) }}
                                        @else
                                            ${{ number_format($product->selling_price ?: $product->mrp_price, 2) }}
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        @if($product->has_sizes && $product->sizes->count() > 0)
                                            <input type="hidden" name="size_id" value="{{ $product->sizes->first()->id }}">
                                        @endif
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Custom Navigation Buttons -->
                <div class="swiper-nav-btn prev-btn new-arrivals-prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="swiper-nav-btn next-btn new-arrivals-next"><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-flex">
                <div class="cta-content">
                    <h2>Let's Get in Touch</h2>
                    <p>Discover high-purity research peptides with trusted quality at Xuravex. Connect with us <br> today to support your research with reliable products and expert assistance.</p>
                </div>
                <div class="cta-button">
                    <a href="{{ route('shop') }}" class="btn btn-primary">Place an Order Today</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Seller Section -->
    <section class="best-sellers">
        <div class="container">
            <h2 class="section-title text-center">Best Seller Products</h2>
            <div class="slider-container-wrapper">
                <div class="swiper best-sellers-slider">
                    <div class="swiper-wrapper">
                        @foreach($bestSellers as $product)
                        <div class="swiper-slide">
                            <div class="product-card">
                                <div class="product-image">
                                    <a href="{{ route('product.detail', $product->slug) }}">
                                        <img src="{{ !empty($product->images) ? asset('uploads/products/' . $product->images[0]) : 'https://via.placeholder.com/150x250?text=Product' }}" alt="{{ $product->name }}">
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('product.detail', $product->slug) }}">
                                        <h3>{{ $product->name }}</h3>
                                    </a>
                                    <div class="product-price">
                                        @if($product->has_sizes && $product->sizes->count() > 0)
                                            ${{ number_format($product->sizes->first()->pivot->selling_price ?: $product->sizes->first()->pivot->mrp_price, 2) }}
                                        @else
                                            ${{ number_format($product->selling_price ?: $product->mrp_price, 2) }}
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        @if($product->has_sizes && $product->sizes->count() > 0)
                                            <input type="hidden" name="size_id" value="{{ $product->sizes->first()->id }}">
                                        @endif
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Custom Navigation Buttons -->
                <div class="swiper-nav-btn prev-btn best-sellers-prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="swiper-nav-btn next-btn best-sellers-next"><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="why-section pt-0">
        <div class="container">
            <div class="why-grid">
                <div class="why-image">
                    <img src="{{asset('images/why-choose-img.png')}}" alt="Why Choose Us">
                </div>
                <div class="why-content">
                    <h2 class="section-title">Why Order from Xuravex</h2>
                    <ul class="why-list">
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <div>
                                <h4>Highest-Purity Research Peptides</h4>
                                
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <div>
                                <h4>Third-Party Trusted Lab Testing</h4>
                                
                            </div>
                        </li>
                        <li style="margin-bottom: 0;">
                            <i class="fa-solid fa-check"></i>
                            <div>
                                <h4>Same-day and Expedited Shipping</h4>
                               
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<style>
    .fade-in-up {
        animation: fadeInUp 0.8s ease forwards;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Swiper Slider Wrapper & Navigation Styling */
    .slider-container-wrapper {
        position: relative;
        padding: 0 45px;
        margin-top: 30px;
    }

    .swiper-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background: var(--white);
        border: 1px solid rgba(62, 39, 3, 0.2);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 14px;
        cursor: pointer;
        z-index: 10;
        transition: var(--transition);
    }

    .swiper-nav-btn:hover {
        background: var(--primary-color);
        color: var(--white);
        border-color: var(--primary-color);
        box-shadow: 0 4px 10px rgba(62, 39, 3, 0.15);
    }

    .swiper-nav-btn.prev-btn {
        left: 0;
    }

    .swiper-nav-btn.next-btn {
        right: 0;
    }

    .swiper-button-disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    /* Ensure slides have equal height and cards fill the slide */
    .swiper-slide {
        height: auto;
    }

    .swiper-slide .product-card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .swiper-slide .product-card .product-info {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>
@endpush

@push('scripts')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize New Arrivals Slider
        new Swiper('.new-arrivals-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            navigation: {
                nextEl: '.new-arrivals-next',
                prevEl: '.new-arrivals-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            }
        });

        // Initialize Best Sellers Slider
        new Swiper('.best-sellers-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            navigation: {
                nextEl: '.best-sellers-next',
                prevEl: '.best-sellers-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            }
        });
    });
</script>
@endpush
