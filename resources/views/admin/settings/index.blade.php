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

        <div class="admin-actions">
            <button type="submit" class="btn-submit" style="width: 200px;">Save All Settings</button>
        </div>
    </form>
</div>
@endsection
