@extends('layouts.frontend.app')

@section('title', 'Your Cart - Xuravex')

@section('content')
    <!-- Page Title -->
    <div class="shop-page-title">
        <div class="container">
            <h1>Your Shopping Cart</h1>
        </div>
    </div>

    <section class="cart-section">
        <div class="container">
            <div class="cart-flex">
                <!-- Left: Cart Items -->
                <div class="cart-items-box">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cartItems = [
                                    ['name' => '5-Amino-1MQ', 'size' => '20mg', 'price' => 55.00, 'qty' => 1],
                                    ['name' => 'BAC Water 30mL', 'size' => '30ml', 'price' => 55.00, 'qty' => 2],
                                ];
                            @endphp

                            @foreach($cartItems as $item)
                            <tr>
                                <td data-label="Product">
                                    <div class="cart-item-info">
                                        <div class="cart-item-img">
                                            <img src="https://via.placeholder.com/60x80?text=Vial" alt="{{ $item['name'] }}">
                                        </div>
                                        <div class="cart-item-name">
                                            <h4>{{ $item['name'] }}</h4>
                                            <p>Size: {{ $item['size'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Price">${{ number_format($item['price'], 2) }}</td>
                                <td data-label="Quantity">
                                    <div class="qty-stepper">
                                        <button>-</button>
                                        <input type="text" value="{{ $item['qty'] }}" readonly>
                                        <button>+</button>
                                    </div>
                                </td>
                                <td data-label="Subtotal">${{ number_format($item['price'] * $item['qty'], 2) }}</td>
                                <td>
                                    <div class="remove-item">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div style="margin-top: 30px;">
                        <a href="{{ route('shop') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Continue Shopping</a>
                    </div>
                </div>

                <!-- Right: Summary -->
                <div class="cart-summary">
                    <h3>Order Summary</h3>
                    <div class="summary-line">
                        <span>Subtotal</span>
                        <span>$165.00</span>
                    </div>
                    <div class="summary-line">
                        <span>Shipping</span>
                        <span style="color: #28a745;">Calculated at next step</span>
                    </div>
                    <div class="summary-line">
                        <span>Tax</span>
                        <span>$0.00</span>
                    </div>
                    
                    <div class="summary-line summary-total">
                        <span>Total</span>
                        <span>$165.00</span>
                    </div>

                    <a href="{{ route('checkout') }}" class="btn btn-primary" style="width: 100%; margin-top: 30px; padding: 15px;">Proceed to Checkout</a>
                    
                    <div style="margin-top: 20px; text-align: center; color: var(--gray-500); font-size: 13px;">
                        <i class="fa-solid fa-lock"></i> Secure Checkout
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Bar (Shared) -->
    @include('frontend.partials.why_choose_bar')
@endsection
