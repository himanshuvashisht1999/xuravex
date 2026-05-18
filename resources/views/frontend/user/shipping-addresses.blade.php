@extends('layouts.frontend.app')

@section('title', 'Shipping Addresses - Xuravex')

@section('content')
<div class="shop-page-title"style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important;">
    <div class="container">
        <h1>Shipping Addresses</h1>
    </div>
</div>

<section class="dashboard-section" style="padding: 60px 0; background: var(--gray-100);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 40px;"class="shipping-page-div">
            @include('frontend.user.partials.sidebar')

            <div class="dashboard-content">
                @if(session('success'))
                    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;"class="shipping-card-div">
                    @foreach($addresses as $address)
                    <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: var(--shadow-sm); position: relative;border: 1px solid #ddd;">
                        @if($address->is_default)
                        <span style="position: absolute; top: 20px; right: 20px; background: var(--secondary-color); color: white; padding: 2px 10px; border-radius: 10px; font-size: 10px; font-weight: 700; text-transform: uppercase;">Default</span>
                        @endif
                        <h4 style="margin-bottom: 15px; color: var(--primary-color);">{{ $address->shipping_title }}</h4>
                        <p style="line-height: 1.6; color: var(--gray-600); margin-bottom: 20px; font-size: 0.95rem;">
                            <strong>{{ $address->first_name }} {{ $address->last_name }}</strong><br>
                            {{ $address->address }}<br>
                            {{ $address->city }}, {{ $address->state }} {{ $address->zip }}<br>
                            {{ $address->country }}<br>
                            Phone: {{ $address->phone }}
                        </p>
                        <form action="{{ route('user.shipping.delete', $address->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #ff4d4d; font-weight: 600; cursor: pointer; padding: 0; font-size: 0.9rem;">
                                <i class="fa-solid fa-trash-can"></i> Remove
                            </button>
                        </form>
                    </div>
                    @endforeach

                    <!-- Add New Address Card -->
                    <div style="background: white; border: 2px dashed #ddd; padding: 30px; border-radius: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 200px;">
                        <i class="fa-solid fa-plus-circle" style="font-size: 2.5rem; color: var(--gray-200); margin-bottom: 15px;"></i>
                        <h4 style="color: var(--gray-400);">Add New Address</h4>
                        <button onclick="document.getElementById('addAddressModal').style.display='block'" class="btn btn-outline" style="margin-top: 20px; padding: 8px 20px; font-size: 13px;">Add Address</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Address Modal (Simple Simulation) -->
<div id="addAddressModal" style="display:none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); padding-top: 60px;">
    <div style="background-color: white; margin: 5% auto; padding: 40px; border-radius: 20px; width: 600px; box-shadow: var(--shadow-lg);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h3 style="margin: 0;">Add Shipping Address</h3>
            <span onclick="document.getElementById('addAddressModal').style.display='none'" style="cursor: pointer; font-size: 1.5rem;">&times;</span>
        </div>
        <form action="{{ route('user.shipping.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group-checkout" style="grid-column: span 2;">
                    <label>Address Title (e.g. Home, Office)</label>
                    <input type="text" name="shipping_title" class="form-input-checkout" required placeholder="e.g. Home">
                </div>
                <div class="form-group-checkout">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-input-checkout" required>
                </div>
                <div class="form-group-checkout">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-input-checkout" required>
                </div>
                <div class="form-group-checkout" style="grid-column: span 2;">
                    <label>Street Address</label>
                    <input type="text" name="address" class="form-input-checkout" required>
                </div>
                <div class="form-group-checkout">
                    <label>City</label>
                    <input type="text" name="city" class="form-input-checkout" required>
                </div>
                <div class="form-group-checkout">
                    <label>State</label>
                    <input type="text" name="state" class="form-input-checkout" required>
                </div>
                <div class="form-group-checkout">
                    <label>ZIP Code</label>
                    <input type="text" name="zip" class="form-input-checkout" required>
                </div>
                <div class="form-group-checkout">
                    <label>Country</label>
                    <input type="text" name="country" class="form-input-checkout" required>
                </div>
                <div class="form-group-checkout">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-input-checkout" required>
                </div>
                <div class="form-group-checkout">
                    <label>Company (Optional)</label>
                    <input type="text" name="company" class="form-input-checkout">
                </div>
                <div class="checkbox-group" style="grid-column: span 2;">
                    <input type="checkbox" name="is_default" value="1">
                    <label>Set as default shipping address</label>
                </div>
            </div>
            <div style="margin-top: 30px; display: flex; gap: 15px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Save Address</button>
                <button type="button" onclick="document.getElementById('addAddressModal').style.display='none'" class="btn btn-outline" style="padding: 12px 30px;">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection
