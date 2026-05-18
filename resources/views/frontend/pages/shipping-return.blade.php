@extends('layouts.frontend.app')

@section('title', 'Shipping & Returns - Xuravex')

@section('content')
<section class="page-header" style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important; padding: 80px 0; color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; font-weight: 800; margin-bottom: 15px;">Shipping & Returns</h1>
        <p style="font-size: 1.1rem; opacity: 0.8;">Everything you need to know about delivery and our return policy.</p>
    </div>
</section>

<section style="padding: 80px 0;">
    <div class="container" style="max-width: 900px;">
        <div class="content-block" style="margin-bottom: 60px;">
            <h2 style="color: var(--primary-color); margin-bottom: 25px;"><i class="fa-solid fa-truck" style="margin-right: 15px; color: var(--secondary-color);"></i> Shipping Information</h2>
            <div style="background: white; padding: 30px; border-radius: 10px; border: 1px solid #c18b39; line-height: 1.8; color: var(--gray-700);">
                <p style="margin-bottom: 20px;">We pride ourselves on providing fast, discreet, and reliable shipping for all our research products. All orders are packed with care to ensure the stability of the materials during transit.</p>
                <ul style="padding-left: 20px; margin-bottom: 20px;">
                    <li><strong>Processing Time:</strong> Orders are typically shipped within 24-48 business hours.</li>
                    <li><strong>Shipping Methods:</strong> We use reliable carriers like FedEx, UPS, and DHL.</li>
                    <li><strong>Tracking:</strong> You will receive a tracking number via email as soon as your order is dispatched.</li>
                    <li><strong>International Shipping:</strong> We ship worldwide, but please ensure you are aware of your local regulations regarding research materials.</li>
                </ul>
                <p><strong>Note:</strong> Some products may require temperature-controlled packaging (cold chain shipping) to maintain integrity. This will be automatically calculated at checkout.</p>
            </div>
        </div>

        <div class="content-block">
            <h2 style="color: var(--primary-color); margin-bottom: 25px;"><i class="fa-solid fa-rotate-left" style="margin-right: 15px; color: var(--secondary-color);"></i> Return & Refund Policy</h2>
            <div style="background: white; padding: 30px; border-radius: 10px; border: 1px solid #c18b39; line-height: 1.8; color: var(--gray-700);">
                <p style="margin-bottom: 20px;">Due to the sensitive nature of research chemicals and laboratory supplies, we have a strict return policy to ensure safety and quality control.</p>
                <ul style="padding-left: 20px; margin-bottom: 20px;">
                    <li><strong>Damaged Items:</strong> If your order arrives damaged or if there is a discrepancy, please contact us within 48 hours of delivery with photos of the package and contents.</li>
                    <li><strong>Non-Returnable Items:</strong> For safety and quality reasons, we cannot accept returns of any research chemicals once they have left our facility.</li>
                    <li><strong>Cancellations:</strong> Orders can be cancelled before they have been shipped. Once shipped, cancellations are not possible.</li>
                </ul>
                <p>If you have any issues with your order, please reach out to our support team at <strong>support@xuravex.com</strong>, and we will do our best to resolve it.</p>
            </div>
        </div>
    </div>
</section>
@endsection
