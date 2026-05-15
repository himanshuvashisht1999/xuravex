@extends('layouts.frontend.app')

@section('title', 'Checkout - Xuravex')

@section('content')
    <!-- Page Title -->
    <div class="shop-page-title">
        <div class="container">
            <h1>Checkout</h1>
        </div>
    </div>

    <section class="checkout-section">
        <div class="container">
            <div class="checkout-flex" x-data="{ shipToDifferent: false }">
                <!-- Left: Forms -->
                <div class="checkout-forms">
                    <div class="checkout-card">
                        <h3>Billing Details</h3>
                        <div class="form-row">
                            <div class="form-group-checkout">
                                <label>First Name <span class="required">*</span></label>
                                <input type="text" class="form-input-checkout" value="Vivek">
                            </div>
                            <div class="form-group-checkout">
                                <label>Last Name <span class="required">*</span></label>
                                <input type="text" class="form-input-checkout" value="Pandey">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group-checkout">
                                <label>Company Name (optional)</label>
                                <input type="text" class="form-input-checkout" value="Vstechlabs">
                            </div>
                            <div class="form-group-checkout">
                                <label>Country / Region <span class="required">*</span></label>
                                <input type="text" class="form-input-checkout" value="United States (US)">
                            </div>
                        </div>
                        <div class="form-group-checkout">
                            <label>Street address <span class="required">*</span></label>
                            <input type="text" class="form-input-checkout" value="3933 Lincoln Wy" placeholder="House number and street name">
                        </div>
                        <div class="form-row">
                            <div class="form-group-checkout">
                                <label>Apartment, suite, unit, etc. (optional)</label>
                                <input type="text" class="form-input-checkout" value="MG Colony">
                            </div>
                            <div class="form-group-checkout">
                                <label>Town / City <span class="required">*</span></label>
                                <input type="text" class="form-input-checkout" value="San Francisco">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group-checkout">
                                <label>State <span class="required">*</span></label>
                                <input type="text" class="form-input-checkout" value="California">
                            </div>
                            <div class="form-group-checkout">
                                <label>ZIP Code <span class="required">*</span></label>
                                <input type="text" class="form-input-checkout" value="94122">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group-checkout">
                                <label>Phone <span class="required">*</span></label>
                                <input type="text" class="form-input-checkout" value="3028448954">
                            </div>
                            <div class="form-group-checkout">
                                <label>Email Address <span class="required">*</span></label>
                                <input type="email" class="form-input-checkout" value="vivekpandey8777@gmail.com">
                            </div>
                        </div>

                        <div class="checkbox-group" style="margin-bottom: 30px;">
                            <input type="checkbox" x-model="shipToDifferent">
                            <label style="font-weight: 700; font-size: 14px; color: var(--primary-color);">Ship to a different address?</label>
                        </div>

                        <!-- Shipping Address Details (Conditional) -->
                        <div x-show="shipToDifferent" x-transition>
                            <h3 style="margin-top: 40px;">Shipping Address Details</h3>
                            <!-- Same fields as billing -->
                            <div class="form-row">
                                <div class="form-group-checkout">
                                    <label>First Name <span class="required">*</span></label>
                                    <input type="text" class="form-input-checkout">
                                </div>
                                <div class="form-group-checkout">
                                    <label>Last Name <span class="required">*</span></label>
                                    <input type="text" class="form-input-checkout">
                                </div>
                            </div>
                            <!-- ... (shortened for brevity but structure is clear) ... -->
                        </div>

                        <div class="form-group-checkout">
                            <label>Order notes (optional)</label>
                            <textarea class="form-input-checkout" rows="4" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Right: Order Summary & Payment -->
                <div class="checkout-summary">
                    <div class="checkout-sidebar-card">
                        <h3>Your Order</h3>
                        <div class="order-list">
                            <div class="order-item-checkout">
                                <img src="https://via.placeholder.com/60x80?text=Vial" alt="Product">
                                <div class="order-item-detail">
                                    <h4>5-Amino-1MQ</h4>
                                    <p>50MG</p>
                                    <p style="color: var(--secondary-color); font-weight: 600;">Quantity : 1</p>
                                </div>
                                <div class="order-item-price">$75.00</div>
                            </div>
                            <div class="order-item-checkout">
                                <img src="https://via.placeholder.com/60x80?text=Vial" alt="Product">
                                <div class="order-item-detail">
                                    <h4>BPC-157</h4>
                                    <p>500MCG</p>
                                    <p style="color: var(--secondary-color); font-weight: 600;">Quantity : 1</p>
                                </div>
                                <div class="order-item-price">$170.00</div>
                            </div>
                        </div>

                        <div class="summary-line" style="margin-top: 20px;">
                            <span>Subtotal :</span>
                            <span style="font-weight: 700; color: var(--accent-color);">$315.00</span>
                        </div>
                        <div class="summary-line">
                            <span>Credit Card/Debit Card Fee :</span>
                            <span style="font-weight: 700; color: var(--accent-color);">$21.44</span>
                        </div>
                        <div class="summary-line summary-total" style="border-top: 2px solid var(--gray-100); padding-top: 15px; font-size: 24px;">
                            <span>Total :</span>
                            <span style="color: var(--secondary-color);">$336.44</span>
                        </div>
                    </div>

                    <div style="margin-bottom: 30px; font-size: 13px; color: var(--gray-600); text-align: center;">
                        Have a coupon? <a href="#" style="color: var(--secondary-color); text-decoration: underline;">Click here to enter your coupon code</a>
                    </div>

                    <!-- BAC Promo Card -->
                    <div class="promo-banner">BAC is Required For Peptide Reconstitution</div>
                    <div class="promo-card">
                        <div class="promo-card-flex">
                            <img src="https://via.placeholder.com/60x80?text=BAC" alt="BAC Water" style="width: 80px; height: 100px; background: #F3E9D9; border-radius: 8px; padding: 10px;">
                            <div style="flex-grow: 1;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                    <h4 style="font-size: 14px;">Bacteriostatic Water 30ML</h4>
                                    <span style="color: var(--secondary-color); font-weight: 700;">$18.00</span>
                                </div>
                                <div style="display: flex; gap: 10px; align-items: center;">
                                    <div class="qty-stepper" style="height: 35px;">
                                        <button>-</button>
                                        <input type="text" value="1" style="width: 30px;">
                                        <button>+</button>
                                    </div>
                                    <a href="#" class="btn btn-primary" style="padding: 8px 15px; font-size: 12px; border-radius: 4px;">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div class="checkout-sidebar-card">
                        <div class="payment-method">
                            <div style="display: flex; gap: 10px; align-items: center; font-weight: 700; font-size: 14px; color: var(--primary-color);">
                                <input type="radio" checked>
                                Pay with Credit Card - All Major Cards Supported
                            </div>
                            <div class="card-logos">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="Paypal">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/3/30/American_Express_logo.svg" alt="Amex">
                            </div>
                            <div class="form-group-checkout">
                                <label>Card number *</label>
                                <input type="text" class="form-input-checkout" placeholder="**** **** **** ****">
                            </div>
                            <div class="form-row">
                                <div class="form-group-checkout">
                                    <label>Expiry (MM/YY) *</label>
                                    <input type="text" class="form-input-checkout" placeholder="MM / YY">
                                </div>
                                <div class="form-group-checkout">
                                    <label>Card code *</label>
                                    <input type="text" class="form-input-checkout" placeholder="CVC">
                                </div>
                            </div>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" checked>
                            <label>I have read and agree to the website <a href="#" style="color: var(--secondary-color);">terms and conditions</a> *</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" checked>
                            <label>I acknowledge that all products are sold for research use only and are not intended for human use or consumption. *</label>
                        </div>

                        <a href="{{ route('thank.you') }}" class="btn btn-primary" style="display: block; width: 100%; margin-top: 30px; padding: 15px;">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
