@extends('layouts.frontend.app')

@section('title', 'Order Details - Xuravex')

@section('content')
<div class="shop-page-title">
    <div class="container">
        <h1>Order #{{ $order->order_number }}</h1>
    </div>
</div>

<section class="dashboard-section" style="padding: 60px 0; background: var(--gray-100);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 40px;">
            @include('frontend.user.partials.sidebar')

            <div class="dashboard-content">
                <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow-sm); margin-bottom: 30px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px;">
                        <div>
                            <h3 style="margin-bottom: 10px;">Order Details</h3>
                            <p style="color: var(--gray-500); margin: 0;">Placed on {{ $order->created_at->format('M d, Y') }} at {{ $order->created_at->format('h:i A') }}</p>
                        </div>
                        <span style="padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 700; text-transform: uppercase; 
                            background: {{ $order->order_status == 'completed' ? '#d4edda' : ($order->order_status == 'pending' ? '#fff3cd' : '#f8d7da') }};
                            color: {{ $order->order_status == 'completed' ? '#155724' : ($order->order_status == 'pending' ? '#856404' : '#721c24') }};">
                            {{ $order->order_status }}
                        </span>
                    </div>

                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 2px solid var(--gray-100); text-align: left;">
                                    <th style="padding: 15px;">Product</th>
                                    <th style="padding: 15px;">Price</th>
                                    <th style="padding: 15px;">Quantity</th>
                                    <th style="padding: 15px; text-align: right;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr style="border-bottom: 1px solid var(--gray-100);">
                                    <td style="padding: 15px;">
                                        <div style="display: flex; align-items: center; gap: 15px;">
                                            <div style="width: 50px; height: 60px; background: var(--gray-100); border-radius: 8px; flex-shrink: 0;">
                                                <img src="{{ !empty($item->product->images) ? asset('uploads/products/' . $item->product->images[0]) : 'https://via.placeholder.com/50x60?text=Vial' }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                            </div>
                                            <span style="font-weight: 600;">{{ $item->product_name }}</span>
                                        </div>
                                    </td>
                                    <td style="padding: 15px;">${{ number_format($item->price, 2) }}</td>
                                    <td style="padding: 15px;">{{ $item->quantity }}</td>
                                    <td style="padding: 15px; text-align: right; font-weight: 700;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" style="padding: 15px 15px 5px; text-align: right; color: var(--gray-500);">Subtotal:</td>
                                    <td style="padding: 15px 15px 5px; text-align: right; font-weight: 600;">${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding: 5px 15px; text-align: right; color: var(--gray-500);">Shipping:</td>
                                    <td style="padding: 5px 15px; text-align: right; font-weight: 600;">${{ number_format($order->shipping_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding: 15px; text-align: right; font-weight: 700; font-size: 1.2rem; color: var(--primary-color);">Total:</td>
                                    <td style="padding: 15px; text-align: right; font-weight: 800; font-size: 1.2rem; color: var(--secondary-color);">${{ number_format($order->payable_amount, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: var(--shadow-sm);">
                        <h4 style="margin-bottom: 20px; color: var(--primary-color);">Billing Address</h4>
                        <p style="line-height: 1.8; color: var(--gray-600); margin: 0;">
                            <strong>{{ $order->billing_name }}</strong><br>
                            {{ $order->billing_address }}<br>
                            {{ $order->billing_city }}, {{ $order->billing_state }} {{ $order->billing_pincode }}<br>
                            {{ $order->billing_country }}<br>
                            Phone: {{ $order->billing_phone }}<br>
                            Email: {{ $order->billing_email }}
                        </p>
                    </div>
                    <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: var(--shadow-sm);">
                        <h4 style="margin-bottom: 20px; color: var(--primary-color);">Shipping Address</h4>
                        <p style="line-height: 1.8; color: var(--gray-600); margin: 0;">
                            <strong>{{ $order->shipping_name }}</strong><br>
                            {{ $order->shipping_address }}<br>
                            {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_pincode }}<br>
                            {{ $order->shipping_country }}<br>
                            Phone: {{ $order->shipping_phone }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
