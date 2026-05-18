<div class="features-grid" style="margin-top: 80px; margin-bottom: 80px; background: var(--primary-color); padding: 0px !important; border-radius: 12px;">
    <div class="container" style="padding: 0;">
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
</div>

<style>
@media (max-width: 992px) {
    .features-grid .container > div {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
@media (max-width: 576px) {
    .features-grid .container > div {
        grid-template-columns: 1fr !important;
    }
}
</style>
