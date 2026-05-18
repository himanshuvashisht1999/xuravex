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
    <section class="new-arrivals"style="background-image:url({{asset('images/new-arrival-bg-img.png')}});background-repeat: no-repeat;background-size: contain;">
        <div class="container">
            <h2 class="section-title text-center">New Arrivals</h2>
            <div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px;">
                @foreach($newArrivals as $product)
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
                        <div class="product-price">${{ number_format($product->selling_price, 2) }}</div>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
                @endforeach
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
            <div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px;">
                @foreach($bestSellers as $product)
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
                        <div class="product-price">${{ number_format($product->selling_price, 2) }}</div>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
                @endforeach
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
    
    @media (max-width: 992px) {
        .best-sellers .products-slider {
            grid-template-columns: repeat(2, 1fr) !!important;
        }
    }
    
    @media (max-width: 576px) {
        .best-sellers .products-slider {
            grid-template-columns: 1fr !!important;
        }
    }
</style>
@endpush
