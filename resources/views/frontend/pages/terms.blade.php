@extends('layouts.frontend.app')

@section('title', 'Terms & Conditions - Xuravex')

@section('content')
<section class="page-header" style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important; padding: 80px 0; color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; font-weight: 800; margin-bottom: 15px;">Terms & Conditions</h1>
        <p style="font-size: 1.1rem; opacity: 0.8;">Please read these terms carefully before using our services.</p>
    </div>
</section>

<section style="padding: 80px 0;">
    <div class="container" style="max-width: 1000px;">
        <div style="background: white; padding: 30px; border-radius: 10px; border: 1px solid #c18b39; line-height: 1.8; color: var(--gray-700);">
            <div style="margin-bottom: 40px;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">1. Acceptance of Terms</h3>
                <p>By accessing and using the Xuravex website, you agree to comply with and be bound by these Terms and Conditions. If you do not agree, please do not use this site.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">2. Research Use Only</h3>
                <p style="font-weight: 700; color: #dc3545;">IMPORTANT: All products sold on this website are intended for LABORATORY RESEARCH USE ONLY. They are not intended for human or animal consumption, diagnostic, therapeutic, or any other use.</p>
                <p>The purchaser warrants that they are associated with a legitimate research institution or laboratory and have the necessary training and facilities to handle research materials safely.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">3. Account Registration</h3>
                <p>When you create an account, you must provide accurate and complete information. You are responsible for maintaining the confidentiality of your account credentials.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">4. Limitation of Liability</h3>
                <p>Xuravex shall not be liable for any damages resulting from the misuse or improper handling of our products. The purchaser assumes all risks associated with the use of the materials provided.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">5. Intellectual Property</h3>
                <p>All content on this website, including text, graphics, logos, and images, is the property of Xuravex and is protected by copyright laws.</p>
            </div>

            <p style="font-style: italic; color: #c18b39; margin-top: 50px;">Last updated: May 15, 2026</p>
        </div>
    </div>
</section>
@endsection
