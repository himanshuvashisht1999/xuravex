@extends('layouts.frontend.app')

@section('title', 'Xuravex - Reliable Peptides, Proven Performance')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 100)" :class="loaded ? 'fade-in-up' : ''">
                <h1>Reliable Peptides.</h1>
                <h2>Proven Performance.</h2>
                <p>From sourcing to quality testing, every product is crafted to ensure precision, safety, and research-grade excellence.</p>
                <a href="#" class="btn btn-primary">Order Now</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-truck-fast fa-2x" style="color: var(--secondary-color)"></i></div>
                    <h3>Same Day Shipping</h3>
                    <p>Fast shipping on orders before 2 PM ET via FedEx 2-Day Air. We're here to help—chat, call, or email us.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-percent fa-2x" style="color: var(--secondary-color)"></i></div>
                    <h3>Volume Discounts</h3>
                    <p>The more you buy, the more you save—get discounts on 5+ items and unlock bigger savings on 10+ units.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-shield-check fa-2x" style="color: var(--secondary-color)"></i></div>
                    <h3>Shop with Confidence</h3>
                    <p>We stand behind every product with a 30-day money-back guarantee on unopened items.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-headset fa-2x" style="color: var(--secondary-color)"></i></div>
                    <h3>Backorder Support</h3>
                    <p>If an item is temporarily out of stock, our support team will reach out with timely updates and next steps.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="new-arrivals">
        <div class="container">
            <h2 class="section-title text-center">New Arrivals</h2>
            <div class="products-slider">
                @for($i = 1; $i <= 3; $i++)
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://via.placeholder.com/150x250?text=BAC+Water" alt="Product">
                    </div>
                    <div class="product-info">
                        <h3>Mitochondrial B12</h3>
                        <div class="product-price">$55.00</div>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-flex">
                <div class="cta-content">
                    <h2>Let's Get in Touch</h2>
                    <p>Discover high-purity research peptides with trusted quality at Xuravex. Connect with us today.</p>
                </div>
                <div class="cta-button">
                    <a href="#" class="btn btn-primary">Place an Order Today</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Seller Section -->
    <section class="best-sellers">
        <div class="container">
            <h2 class="section-title text-center">Best Seller Products</h2>
            <div class="products-slider" style="grid-template-columns: repeat(4, 1fr);">
                @for($i = 1; $i <= 4; $i++)
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://via.placeholder.com/120x200?text=BAC+Water" alt="Product">
                    </div>
                    <div class="product-info">
                        <h3>BAC Water 30mL</h3>
                        <div class="product-price">$55.00</div>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="why-section">
        <div class="container">
            <div class="why-grid">
                <div class="why-image">
                    <img src="https://via.placeholder.com/600x400?text=Research+Excellence" alt="Why Choose Us">
                </div>
                <div class="why-content">
                    <h2 class="section-title">Why Order from Xuravex</h2>
                    <ul class="why-list">
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <div>
                                <h4>Highest-Purity Research Peptides</h4>
                                <p>We ensure the highest standards for our research materials.</p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <div>
                                <h4>Third-Party Trusted Lab Testing</h4>
                                <p>Every batch is tested by independent laboratories for purity.</p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <div>
                                <h4>Same-day and Expedited Shipping</h4>
                                <p>Get your research materials faster with our efficient shipping.</p>
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
