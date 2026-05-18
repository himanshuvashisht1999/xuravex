@extends('layouts.frontend.app')

@section('title', 'Your Cart - Xuravex')

@section('content')
    <!-- Page Title -->
    <div class="shop-page-title"style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important;">
        <div class="container">
            <h1>Your Shopping Cart</h1>
        </div>
    </div>

    <section class="cart-section">
        <div class="container">
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    {{ session('success') }}
                </div>
            @endif

            @if(count($cart) > 0)
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
                            @php $total = 0; @endphp
                            @foreach($cart as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <tr data-id="{{ $id }}">
                                <td data-label="Product">
                                    <div class="cart-item-info">
                                        <div class="cart-item-img">
                                            <img src="{{ !empty($details['image']) ? asset('uploads/products/' . $details['image']) : 'https://via.placeholder.com/60x80?text=Vial' }}" alt="{{ $details['name'] }}">
                                        </div>
                                        <div class="cart-item-name">
                                            <h4>{{ $details['name'] }}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Price">${{ number_format($details['price'], 2) }}</td>
                                <td data-label="Quantity">
                                    <div class="qty-stepper">
                                        <button class="update-cart-btn" data-action="decrease">-</button>
                                        <input type="text" class="quantity-input" value="{{ $details['quantity'] }}" readonly>
                                        <button class="update-cart-btn" data-action="increase">+</button>
                                    </div>
                                </td>
                                <td data-label="Subtotal">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                <td>
                                    <div class="remove-item remove-from-cart" style="cursor: pointer;">
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
                        <span>${{ number_format($total, 2) }}</span>
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
                        <span>${{ number_format($total, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout') }}" class="btn btn-primary" style="width: 100%; margin-top: 30px; padding: 15px;">Proceed to Checkout</a>
                    
                    <div style="margin-top: 20px; text-align: center; color: var(--gray-500); font-size: 13px;">
                        <i class="fa-solid fa-lock"></i> Secure Checkout
                    </div>
                </div>
            </div>
            @else
            <div style="text-align: center; padding: 100px 0; background: white; border-radius: 20px; box-shadow: var(--shadow-sm);">
                <i class="fa-solid fa-cart-shopping" style="font-size: 4rem; color: var(--gray-200); margin-bottom: 20px;"></i>
                <h2 style="color: var(--primary-color);">Your cart is empty</h2>
                <p style="color: var(--gray-500); margin-bottom: 30px;">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('shop') }}" class="btn btn-primary">Start Shopping</a>
            </div>
            @endif
        </div>
    </section>

   <div class="product-detail-feature">
        <div class="container-fluid">
            @include('frontend.partials.why_choose_bar')
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.update-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const id = row.getAttribute('data-id');
            const input = row.querySelector('.quantity-input');
            let quantity = parseInt(input.value);
            const action = this.getAttribute('data-action');

            if (action === 'increase') {
                quantity++;
            } else if (action === 'decrease' && quantity > 1) {
                quantity--;
            }

            fetch('{{ route("cart.update") }}', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: id, quantity: quantity })
            }).then(() => window.location.reload());
        });
    });

    document.querySelectorAll('.remove-from-cart').forEach(button => {
        button.addEventListener('click', function() {
            if(confirm("Are you sure you want to remove this product?")) {
                const id = this.closest('tr').getAttribute('data-id');
                fetch('{{ route("cart.remove") }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id })
                }).then(() => window.location.reload());
            }
        });
    });
</script>
@endpush
