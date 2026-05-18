@extends('layouts.frontend.app')

@section('title', 'Privacy Policy - Xuravex')

@section('content')
<section class="page-header" style="background: var(--primary-color); padding: 80px 0; color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; font-weight: 800; margin-bottom: 15px;">Privacy Policy</h1>
        <p style="font-size: 1.1rem; opacity: 0.8;">Your privacy is important to us. Learn how we protect your information.</p>
    </div>
</section>

<section style="padding: 80px 0;">
    <div class="container" style="max-width: 1000px;">
        <div style="background: white; padding: 50px; border-radius: 30px; border: 1px solid var(--gray-200); line-height: 1.8; color: var(--gray-700);">
            <div style="margin-bottom: 40px;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">1. Information We Collect</h3>
                <p>We collect information that you provide directly to us when you create an account, make a purchase, or contact us. This includes your name, email, billing/shipping address, and payment information.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">2. How We Use Your Information</h3>
                <p>We use your information to process your orders, communicate with you about your research needs, and improve our services. We do NOT sell or share your personal data with third parties for marketing purposes.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">3. Data Security</h3>
                <p>We implement a variety of security measures to maintain the safety of your personal information. All transactions are processed through a secure gateway provider and are not stored or processed on our servers.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">4. Cookies</h3>
                <p>We use cookies to help us remember and process the items in your shopping cart and understand your preferences for future visits.</p>
            </div>

            <div style="margin-bottom: 40px;">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">5. Your Rights</h3>
                <p>You have the right to access, correct, or delete your personal information at any time through your account settings or by contacting us.</p>
            </div>

            <p style="font-style: italic; color: var(--gray-500); margin-top: 50px;">Last updated: May 15, 2026</p>
        </div>
    </div>
</section>
@endsection
