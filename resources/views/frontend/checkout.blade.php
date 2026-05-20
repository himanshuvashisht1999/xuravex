@extends('layouts.frontend.app')

@section('title', 'Checkout - Xuravex')

@section('content')
    <!-- Page Title -->
    <div class="shop-page-title"style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important;">
        <div class="container">
            <h1>Checkout</h1>
        </div>
    </div>

    <section class="checkout-section">
        <div class="container">
            <form action="{{ route('place.order') }}" method="POST">
                @csrf
                <input type="hidden" name="shipping_amount" id="shipping_amount_input" value="0">
                <input type="hidden" name="shipping_method" id="shipping_method_input" value="">
                <div class="checkout-flex" x-data="{ shipToDifferent: false }">
                    <!-- Left: Forms -->
                    <div class="checkout-forms">
                        <div class="checkout-card">
                            <h3>Billing Details</h3>
                            <div class="form-row">
                                <div class="form-group-checkout">
                                    <label>Full Name <span class="required">*</span></label>
                                    <input type="text" name="billing_name" class="form-input-checkout" value="{{ old('billing_name', auth()->user()->name ?? '') }}" required>
                                    @error('billing_name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group-checkout">
                                    <label>Country / Region <span class="required">*</span></label>
                                    <input type="text" name="billing_country" class="form-input-checkout" value="{{ old('billing_country', auth()->user()->country ?? '') }}" required>
                                    @error('billing_country') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group-checkout">
                                    <label>State <span class="required">*</span></label>
                                    <input type="text" name="billing_state" class="form-input-checkout" value="{{ old('billing_state', auth()->user()->state ?? '') }}" required>
                                    @error('billing_state') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group-checkout">
                                <label>Street address <span class="required">*</span></label>
                                <input type="text" name="billing_address" class="form-input-checkout" value="{{ old('billing_address', auth()->user()->address ?? '') }}" placeholder="House number and street name" required>
                                @error('billing_address') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group-checkout">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input type="text" name="billing_city" class="form-input-checkout" value="{{ old('billing_city', auth()->user()->city ?? '') }}" required>
                                    @error('billing_city') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group-checkout">
                                    <label>ZIP Code <span class="required">*</span></label>
                                    <input type="text" name="billing_pincode" class="form-input-checkout" value="{{ old('billing_pincode', auth()->user()->pincode ?? '') }}" required>
                                    @error('billing_pincode') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group-checkout">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" name="billing_phone" class="form-input-checkout" value="{{ old('billing_phone', auth()->user()->phone ?? '') }}" required>
                                    @error('billing_phone') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group-checkout">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="email" name="billing_email" class="form-input-checkout" value="{{ old('billing_email', auth()->user()->email ?? '') }}" required>
                                    @error('billing_email') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="checkbox-group" style="margin-bottom: 30px;">
                                <input type="checkbox" name="ship_to_different" x-model="shipToDifferent">
                                <label style="font-weight: 700; font-size: 14px; color: var(--primary-color);">Ship to a different address?</label>
                            </div>

                            <!-- Shipping Address Details (Conditional) -->
                            <div x-show="shipToDifferent" x-transition>
                                <h3 style="margin-top: 40px;">Shipping Address Details</h3>
                                <div class="form-row">
                                    <div class="form-group-checkout">
                                        <label>Full Name <span class="required">*</span></label>
                                        <input type="text" name="shipping_name" class="form-input-checkout" value="{{ old('shipping_name') }}" :required="shipToDifferent">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group-checkout">
                                        <label>Country / Region <span class="required">*</span></label>
                                        <input type="text" name="shipping_country" class="form-input-checkout" value="{{ old('shipping_country') }}" :required="shipToDifferent">
                                    </div>
                                    <div class="form-group-checkout">
                                        <label>State <span class="required">*</span></label>
                                        <input type="text" name="shipping_state" class="form-input-checkout" value="{{ old('shipping_state') }}" :required="shipToDifferent">
                                    </div>
                                </div>
                                <div class="form-group-checkout">
                                    <label>Street address <span class="required">*</span></label>
                                    <input type="text" name="shipping_address" class="form-input-checkout" value="{{ old('shipping_address') }}" placeholder="House number and street name" :required="shipToDifferent">
                                </div>
                                <div class="form-row">
                                    <div class="form-group-checkout">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" name="shipping_city" class="form-input-checkout" value="{{ old('shipping_city') }}" :required="shipToDifferent">
                                    </div>
                                    <div class="form-group-checkout">
                                        <label>ZIP Code <span class="required">*</span></label>
                                        <input type="text" name="shipping_pincode" class="form-input-checkout" value="{{ old('shipping_pincode') }}" :required="shipToDifferent">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group-checkout">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" name="shipping_phone" class="form-input-checkout" value="{{ old('shipping_phone') }}" :required="shipToDifferent">
                                    </div>
                                    <div class="form-group-checkout">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input type="email" name="shipping_email" class="form-input-checkout" value="{{ old('shipping_email') }}" :required="shipToDifferent">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-checkout">
                                <label>Order notes (optional)</label>
                                <textarea name="notes" class="form-input-checkout" rows="4" placeholder="Notes about your order, e.g. special notes for delivery.">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Order Summary & Payment -->
                    <div class="checkout-summary">
                        <div class="checkout-sidebar-card">
                            <h3>Your Order</h3>
                            <div class="order-list">
                                @foreach($cart as $id => $item)
                                <div class="order-item-checkout">
                                    <img src="{{ !empty($item['image']) ? asset('uploads/products/' . $item['image']) : 'https://via.placeholder.com/60x80?text=Vial' }}" alt="{{ $item['name'] }}">
                                    <div class="order-item-detail">
                                        <h4>{{ $item['name'] }}</h4>
                                        @if(!empty($item['size_name']))
                                            <span style="display: block; font-size: 11px; color: var(--secondary-color); font-weight: 600; margin-bottom: 2px;">Size: {{ $item['size_name'] }}</span>
                                        @endif
                                        <p style="color: var(--secondary-color); font-weight: 600; margin: 0;">Quantity : {{ $item['quantity'] }}</p>
                                    </div>
                                    <div class="order-item-price">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                </div>
                                @endforeach
                            </div>

                            <div id="shipping-rates-container" style="margin-top: 20px; border-top: 1px solid var(--gray-100); padding-top: 15px;">
                                <h4 style="font-size: 16px; margin-bottom: 10px;">Shipping Options</h4>
                                <p style="font-size: 13px; color: var(--gray-500); margin-bottom: 10px;">Enter your ZIP code to see shipping rates.</p>
                                <div id="shipping-options"></div>
                            </div>

                            <div class="summary-line" style="margin-top: 20px;">
                                <span>Subtotal :</span>
                                <span style="font-weight: 700; color: var(--accent-color);">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="summary-line summary-total" style="border-top: 2px solid var(--gray-100); padding-top: 15px; font-size: 24px;">
                                <span>Total :</span>
                                <span style="color: var(--secondary-color);" id="total-display">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <!-- Payment Section -->
                        <div class="checkout-sidebar-card" x-data="{ paymentMethod: 'cod' }">
                            <div class="payment-methods">
                                <div class="payment-method-item" style="margin-bottom: 20px;">
                                    <div style="display: flex; gap: 10px; align-items: center; font-weight: 700; font-size: 14px; color: var(--primary-color);">
                                        <input type="radio" name="payment_method" value="cod" x-model="paymentMethod">
                                        Cash on Delivery (COD)
                                    </div>
                                    <p style="font-size: 13px; color: var(--gray-500); margin-top: 10px; padding-left: 25px;">Pay with cash upon delivery. All products are for research use only.</p>
                                </div>

                                @if(!empty($gs['paypal_client_id']))
                                <div class="payment-method-item" style="margin-bottom: 20px;">
                                    <div style="display: flex; gap: 10px; align-items: center; font-weight: 700; font-size: 14px; color: var(--primary-color);">
                                        <input type="radio" name="payment_method" value="paypal" x-model="paymentMethod">
                                        PayPal / Credit Card
                                    </div>
                                    <div x-show="paymentMethod == 'paypal'" style="margin-top: 20px; min-height: 150px;">
                                        <div id="paypal-button-container"></div>
                                        <p id="paypal-loading" style="font-size: 13px; color: var(--gray-500);">Loading PayPal...</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="checkbox-group">
                                <input type="checkbox" required checked>
                                <label>I have read and agree to the website <a href="{{ route('terms') }}" target="_blank" style="color: var(--secondary-color);">terms and conditions</a> *</label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" required checked>
                                <label>I acknowledge that all products are sold for research use only and are not intended for human use or consumption. *</label>
                            </div>

                            <button type="submit" x-show="paymentMethod == 'cod'" class="btn btn-primary" style="display: block; width: 100%; margin-top: 30px; padding: 15px;">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const billingZip = document.querySelector('input[name="billing_pincode"]');
        const shippingZip = document.querySelector('input[name="shipping_pincode"]');
        const shipToDifferent = document.querySelector('input[name="ship_to_different"]');
        
        function fetchRates() {
            let zip = shipToDifferent && shipToDifferent.checked ? shippingZip.value : billingZip.value;
            if (!zip || zip.length < 5) return;
            
            document.getElementById('shipping-options').innerHTML = '<p style="font-size: 13px; color: var(--secondary-color);">Loading rates...</p>';
            
            fetch('{{ route("checkout.shipping-rates") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ zip: zip })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    let html = '';
                    data.rates.forEach((rate, index) => {
                        let checked = index === 0 ? 'checked' : '';
                        html += `
                            <div class="shipping-option" style="display:flex; justify-content:space-between; margin-bottom:10px;">
                                <label style="font-size: 14px; display: flex; align-items: center; gap: 8px;">
                                    <input type="radio" name="shipping_method_radio" value="${rate.service_name}|${rate.amount}" ${checked} onchange="updateTotal()">
                                    ${rate.service_name}
                                </label>
                                <span style="font-weight: 600;">$${parseFloat(rate.amount).toFixed(2)}</span>
                            </div>
                        `;
                    });
                    document.getElementById('shipping-options').innerHTML = html;
                    updateTotal();
                } else {
                    document.getElementById('shipping-options').innerHTML = '<p style="color:red; font-size:13px;">' + data.error + '</p>';
                }
            })
            .catch(e => {
                document.getElementById('shipping-options').innerHTML = '<p style="color:red; font-size:13px;">Error fetching rates.</p>';
            });
        }

        if (billingZip) billingZip.addEventListener('blur', fetchRates);
        if (shippingZip) shippingZip.addEventListener('blur', fetchRates);
        if (shipToDifferent) shipToDifferent.addEventListener('change', fetchRates);
    });

    function updateTotal() {
        let subtotal = {{ $total }};
        let shippingAmount = 0;
        let shippingMethodName = '';
        
        let selectedRate = document.querySelector('input[name="shipping_method_radio"]:checked');
        if (selectedRate) {
            let parts = selectedRate.value.split('|');
            shippingMethodName = parts[0];
            shippingAmount = parseFloat(parts[1]);
        }
        
        document.getElementById('shipping_amount_input').value = shippingAmount;
        document.getElementById('shipping_method_input').value = shippingMethodName;
        
        let total = subtotal + shippingAmount;
        document.getElementById('total-display').innerText = '$' + total.toFixed(2);
        
        window.checkoutTotal = total;
    }
</script>
@endpush

@if(!empty($gs['paypal_client_id']))
@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id={{ $gs['paypal_client_id'] }}&currency=USD"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof paypal !== 'undefined') {
            paypal.Buttons({
                createOrder: function(data, actions) {
                    // Check form validity before proceeding
                    const form = document.querySelector('form[action="{{ route('place.order') }}"]');
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return false;
                    }

                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: window.checkoutTotal ? window.checkoutTotal.toFixed(2) : '{{ $total }}'
                            }
                        }]
                    });
                },
                onRender: function() {
                    document.getElementById('paypal-loading').style.display = 'none';
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // Submit order via AJAX
                        const form = document.querySelector('form[action="{{ route('place.order') }}"]');
                        const formData = new FormData(form);
                        formData.set('payment_method', 'paypal');
                        formData.set('paypal_order_id', data.orderID);

                        fetch('{{ route('place.order') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.href = data.redirect_url;
                            } else {
                                alert('Order processing failed. Please contact support.');
                            }
                        })
                        .catch(err => {
                            console.error('Final order submission error:', err);
                            alert('An error occurred while placing your order. Please try again.');
                        });
                    });
                },
                onError: function(err) {
                    console.error('PayPal Error:', err);
                    document.getElementById('paypal-loading').innerHTML = '<span style="color:red">Failed to load PayPal. Please check your credentials in settings.</span>';
                }
            }).render('#paypal-button-container').then(() => {
                document.getElementById('paypal-loading').style.display = 'none';
            });
        } else {
            document.getElementById('paypal-loading').innerHTML = '<span style="color:red">PayPal SDK failed to load. Check your Client ID.</span>';
        }
    });
</script>
@endpush
@endif
