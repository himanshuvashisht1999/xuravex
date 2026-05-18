@extends('layouts.admin.app')

@section('title', 'Create Coupon')

@section('content')
<div class="admin-card">
    <h3>Coupon Configuration</h3>
    <form action="{{ route('admin.coupons.store') }}" method="POST">
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
                <input type="text" name="code" class="admin-input" placeholder="e.g. WELCOME10" required style="text-transform: uppercase;">
            </div>
            <div class="admin-form-group">
                <label>Discount Type <span class="required">*</span></label>
                <select name="type" class="admin-select" required>
                    <option value="percentage">Percentage (%)</option>
                    <option value="fixed">Fixed Amount ($)</option>
                </select>
            </div>
            <div class="admin-form-group">
                <label>Discount Value <span class="required">*</span></label>
                <input type="number" name="value" class="admin-input" placeholder="0" required>
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Minimum Spend ($)</label>
                <input type="number" name="min_spend" class="admin-input" placeholder="0.00">
            </div>
            <div class="admin-form-group">
                <label>Usage Limit Per Coupon</label>
                <input type="number" name="limit" class="admin-input" placeholder="e.g. 100">
            </div>
            <div class="admin-form-group">
                <label>Expiry Date <span class="required">*</span></label>
                <input type="date" name="expiry_date" class="admin-input" required>
            </div>
        </div>

        <div class="admin-form-group">
            <label>Description</label>
            <textarea name="description" class="admin-input" rows="3" placeholder="Describe the purpose of this coupon..."></textarea>
        </div>

        <div class="admin-actions">
            <button type="button" class="btn-draft">Discard</button>
            <button type="submit" class="btn-submit">Create Coupon</button>
        </div>
    </form>
</div>
@endsection
