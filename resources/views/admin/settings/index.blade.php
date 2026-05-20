@extends('layouts.admin.app')

@section('title', 'Site Settings')

@section('content')
<div class="admin-card">
    <h3 style="margin-bottom: 25px;">General Settings</h3>
    
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group">
                <label>Site Name</label>
                <input type="text" name="site_name" class="admin-input" value="{{ $settings['site_name'] ?? '' }}" placeholder="e.g. Xuravex">
            </div>
            <div class="admin-form-group">
                <label>Contact Email</label>
                <input type="email" name="site_email" class="admin-input" value="{{ $settings['site_email'] ?? '' }}" placeholder="info@xuravex.com">
            </div>
        </div>

        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group">
                <label>Contact Phone</label>
                <input type="text" name="site_phone" class="admin-input" value="{{ $settings['site_phone'] ?? '' }}" placeholder="+1 (234) 567-890">
            </div>
            <div class="admin-form-group">
                <label>Office Address</label>
                <input type="text" name="site_address" class="admin-input" value="{{ $settings['site_address'] ?? '' }}" placeholder="123 Lab Street, City">
            </div>
        </div>

        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group">
                <label>Site Logo</label>
                <div style="display: flex; align-items: center; gap: 20px;">
                    <input type="file" name="site_logo" class="admin-input" style="padding: 8px;">
                    @if(isset($settings['site_logo']))
                        <img src="{{ asset('uploads/settings/' . $settings['site_logo']) }}" alt="Logo" style="height: 40px; background: #222; padding: 5px; border-radius: 4px;">
                    @endif
                </div>
            </div>
            <div class="admin-form-group">
                <label>Favicon</label>
                <div style="display: flex; align-items: center; gap: 20px;">
                    <input type="file" name="site_favicon" class="admin-input" style="padding: 8px;">
                    @if(isset($settings['site_favicon']))
                        <img src="{{ asset('uploads/settings/' . $settings['site_favicon']) }}" alt="Favicon" style="height: 30px;">
                    @endif
                </div>
            </div>
        </div>

        <h3 style="margin: 40px 0 25px;">Social Media & Links</h3>
        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group">
                <label>Facebook URL</label>
                <input type="text" name="social_facebook" class="admin-input" value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/xuravex">
            </div>
            <div class="admin-form-group">
                <label>Twitter/X URL</label>
                <input type="text" name="social_twitter" class="admin-input" value="{{ $settings['social_twitter'] ?? '' }}" placeholder="https://twitter.com/xuravex">
            </div>
        </div>

        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group">
                <label>Instagram URL</label>
                <input type="text" name="social_instagram" class="admin-input" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="https://instagram.com/xuravex">
            </div>
            <div class="admin-form-group">
                <label>LinkedIn URL</label>
                <input type="text" name="social_linkedin" class="admin-input" value="{{ $settings['social_linkedin'] ?? '' }}" placeholder="https://linkedin.com/company/xuravex">
            </div>
        </div>

        <h3 style="margin: 40px 0 25px;">Payment Gateway Settings (PayPal)</h3>
        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group">
                <label>PayPal Mode</label>
                <select name="paypal_mode" class="admin-select">
                    <option value="sandbox" {{ ($settings['paypal_mode'] ?? '') == 'sandbox' ? 'selected' : '' }}>Sandbox (Testing)</option>
                    <option value="live" {{ ($settings['paypal_mode'] ?? '') == 'live' ? 'selected' : '' }}>Live (Production)</option>
                </select>
            </div>
            <div class="admin-form-group">
                <label>PayPal Client ID</label>
                <input type="text" name="paypal_client_id" class="admin-input" value="{{ $settings['paypal_client_id'] ?? '' }}" placeholder="Enter PayPal Client ID">
            </div>
        </div>

        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group" style="grid-column: span 2;">
                <label>PayPal Secret Key</label>
                <input type="password" name="paypal_secret" class="admin-input" value="{{ $settings['paypal_secret'] ?? '' }}" placeholder="Enter PayPal Secret Key">
            </div>
        </div>

        <h3 style="margin: 40px 0 25px;">Shipping Settings (FedEx)</h3>
        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group">
                <label>FedEx Mode</label>
                <select name="fedex_mode" class="admin-select">
                    <option value="sandbox" {{ ($settings['fedex_mode'] ?? '') == 'sandbox' ? 'selected' : '' }}>Sandbox (Testing)</option>
                    <option value="live" {{ ($settings['fedex_mode'] ?? '') == 'live' ? 'selected' : '' }}>Live (Production)</option>
                </select>
            </div>
            <div class="admin-form-group">
                <label>Origin ZIP Code</label>
                <input type="text" name="fedex_origin_zip" class="admin-input" value="{{ $settings['fedex_origin_zip'] ?? '' }}" placeholder="Enter Origin ZIP Code for shipping">
            </div>
        </div>

        <div class="admin-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="admin-form-group">
                <label>FedEx API Key (Client ID)</label>
                <input type="text" name="fedex_api_key" class="admin-input" value="{{ $settings['fedex_api_key'] ?? '' }}" placeholder="Enter FedEx API Key">
            </div>
            <div class="admin-form-group">
                <label>FedEx Secret Key</label>
                <input type="password" name="fedex_secret_key" class="admin-input" value="{{ $settings['fedex_secret_key'] ?? '' }}" placeholder="Enter FedEx Secret Key">
            </div>
        </div>

        <div class="admin-actions">
            <button type="submit" class="btn-submit" style="width: 200px;">Save All Settings</button>
        </div>
    </form>
</div>
@endsection
