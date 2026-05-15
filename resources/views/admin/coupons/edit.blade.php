@extends('layouts.admin.app')

@section('title', 'Edit Coupon')

@section('content')
<div class="admin-card">
    <h3>Edit Coupon: {{ $coupon->code }}</h3>
    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
        @csrf
        
        @if ($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 25px; font-size: 13px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Coupon Code <span class="required">*</span></label>
                <input type="text" name="code" class="admin-input" value="{{ old('code', $coupon->code) }}" required style="text-transform: uppercase;">
            </div>
            <div class="admin-form-group">
                <label>Discount Type <span class="required">*</span></label>
                <select name="type" class="admin-select" required>
                    <option value="percentage" {{ $coupon->type == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                    <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                </select>
            </div>
            <div class="admin-form-group">
                <label>Discount Value <span class="required">*</span></label>
                <input type="number" name="value" class="admin-input" value="{{ old('value', $coupon->value) }}" required>
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Minimum Spend ($)</label>
                <input type="number" name="min_spend" class="admin-input" value="{{ old('min_spend', $coupon->min_spend) }}">
            </div>
            <div class="admin-form-group">
                <label>Usage Limit Per Coupon</label>
                <input type="number" name="limit" class="admin-input" value="{{ old('usage_limit', $coupon->usage_limit) }}">
            </div>
            <div class="admin-form-group">
                <label>Expiry Date <span class="required">*</span></label>
                <input type="date" name="expiry_date" class="admin-input" value="{{ old('expiry_date', $coupon->expiry_date->format('Y-m-d')) }}" required>
            </div>
        </div>

        <div class="admin-form-group">
            <label>Description</label>
            <textarea name="description" class="admin-input" rows="3">{{ old('description', $coupon->description) }}</textarea>
        </div>

        <div class="admin-actions">
            <a href="{{ route('admin.coupons.index') }}" class="btn-draft" style="text-decoration: none;">Cancel</a>
            <button type="submit" class="btn-submit">Update Coupon</button>
        </div>
    </form>
</div>
@endsection
