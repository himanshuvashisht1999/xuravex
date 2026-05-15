@extends('layouts.admin.app')

@section('title', 'Add New Customer')

@section('content')
<div class="admin-card">
    <h3>Customer Personal Information</h3>
    <form action="{{ route('admin.customers.store') }}" method="POST">
        @csrf
        
        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>First Name <span class="required">*</span></label>
                <input type="text" name="first_name" class="admin-input" placeholder="Enter first name" required>
            </div>
            <div class="admin-form-group">
                <label>Last Name <span class="required">*</span></label>
                <input type="text" name="last_name" class="admin-input" placeholder="Enter last name" required>
            </div>
            <div class="admin-form-group">
                <label>Email Address <span class="required">*</span></label>
                <input type="email" name="email" class="admin-input" placeholder="Enter email" required>
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" class="admin-input" placeholder="Enter phone number">
            </div>
            <div class="admin-form-group">
                <label>Status</label>
                <select name="status" class="admin-select">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="admin-form-group">
                <label>Password <span class="required">*</span></label>
                <input type="password" name="password" class="admin-input" placeholder="Set temporary password" required>
            </div>
        </div>

        <h3 style="margin-top: 40px;">Default Shipping Address</h3>
        <div class="admin-form-group">
            <label>Street address</label>
            <input type="text" name="address" class="admin-input" placeholder="Enter address">
        </div>

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>City</label>
                <input type="text" name="city" class="admin-input" placeholder="City">
            </div>
            <div class="admin-form-group">
                <label>State / Province</label>
                <input type="text" name="state" class="admin-input" placeholder="State">
            </div>
            <div class="admin-form-group">
                <label>Country</label>
                <select name="country" class="admin-select">
                    <option>United States</option>
                    <option>United Kingdom</option>
                </select>
            </div>
        </div>

        <div class="admin-actions">
            <button type="button" class="btn-draft">Cancel</button>
            <button type="submit" class="btn-submit">Save Customer</button>
        </div>
    </form>
</div>
@endsection
