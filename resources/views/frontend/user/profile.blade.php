@extends('layouts.frontend.app')

@section('title', 'Edit Profile - Xuravex')

@section('content')
<div class="shop-page-title"style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important;">
    <div class="container">
        <h1>Edit Profile</h1>
    </div>
</div>

<section class="dashboard-section" style="padding: 60px 0; background: var(--gray-100);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 40px;"class="profile-page-div">
            @include('frontend.user.partials.sidebar')

            <div class="dashboard-content">
                @if(session('success'))
                    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow-sm);">
                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        <h3 style="margin-bottom: 30px;">Personal Information</h3>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                            <div class="form-group-checkout">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-input-checkout" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-group-checkout">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-input-checkout" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="form-group-checkout">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-input-checkout" value="{{ old('phone', $user->phone) }}">
                            </div>
                            <div class="form-group-checkout">
                                <label>Company</label>
                                <input type="text" name="company" class="form-input-checkout" value="{{ old('company', $user->company) }}">
                            </div>
                        </div>

                        <h3 style="margin-bottom: 30px; border-top: 1px solid #ddd; padding-top: 30px;">Billing Address</h3>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                            <div class="form-group-checkout">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-input-checkout" value="{{ old('first_name', $user->first_name) }}">
                            </div>
                            <div class="form-group-checkout">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-input-checkout" value="{{ old('last_name', $user->last_name) }}">
                            </div>
                            <div class="form-group-checkout" style="grid-column: span 2;">
                                <label>Street Address</label>
                                <input type="text" name="address" class="form-input-checkout" value="{{ old('address', $user->address) }}">
                            </div>
                            <div class="form-group-checkout">
                                <label>City</label>
                                <input type="text" name="city" class="form-input-checkout" value="{{ old('city', $user->city) }}">
                            </div>
                            <div class="form-group-checkout">
                                <label>State</label>
                                <input type="text" name="state" class="form-input-checkout" value="{{ old('state', $user->state) }}">
                            </div>
                            <div class="form-group-checkout">
                                <label>ZIP Code</label>
                                <input type="text" name="zip" class="form-input-checkout" value="{{ old('zip', $user->zip) }}">
                            </div>
                            <div class="form-group-checkout">
                                <label>Country</label>
                                <input type="text" name="country" class="form-input-checkout" value="{{ old('country', $user->country) }}">
                            </div>
                        </div>

                        <h3 style="margin-bottom: 30px; border-top: 1px solid #ddd; padding-top: 30px;">Change Password</h3>
                        <p style="color: var(--gray-500); font-size: 0.9rem; margin-bottom: 20px;">Leave blank if you don't want to change it.</p>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
                            <div class="form-group-checkout">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-input-checkout">
                            </div>
                            <div class="form-group-checkout">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-input-checkout">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="padding: 15px 40px;">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
