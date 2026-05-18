@extends('layouts.admin.app')

@section('title', 'Order Details')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h2 style="margin: 0;">Order #{{ $order->order_number }}</h2>
        <p style="color: #666; margin: 5px 0 0;">Placed on {{ $order->created_at->format('M d, Y') }} at {{ $order->created_at->format('h:i A') }}</p>
    </div>
    <div style="display: flex; gap: 15px;">
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display: flex; gap: 10px;">
            @csrf
            <select name="order_status" class="admin-select" style="width: 180px;">
                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <select name="payment_status" class="admin-select" style="width: 150px;">
                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
            <button type="submit" class="btn-publish" style="padding: 10px 20px;">Update</button>
        </form>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
    <!-- Left Column: Items & Payment -->
    <div>
        <div class="admin-card">
            <h3 style="border: none; margin-bottom: 20px;">Order Items</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div class="table-thumb">
                                    <img src="{{ !empty($item->product->images) ? asset('uploads/products/' . $item->product->images[0]) : 'https://via.placeholder.com/40x50?text=Vial' }}" alt="">
                                </div>
                                <div>
                                    <div style="font-weight: 700;">{{ $item->product_name }}</div>
                                    <div style="font-size: 12px; color: #888;">SKU: {{ $item->product->sku ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="text-align: right;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right; padding-top: 20px; border: none; font-weight: 600;">Subtotal:</td>
                        <td style="text-align: right; padding-top: 20px; border: none;">${{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; border: none; font-weight: 600;">Shipping:</td>
                        <td style="text-align: right; border: none;">${{ number_format($order->shipping_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; border: none; font-size: 18px; font-weight: 800; color: #3E2703;">Total:</td>
                        <td style="text-align: right; border: none; font-size: 18px; font-weight: 800; color: #3E2703;">${{ number_format($order->payable_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="admin-card" style="margin-top: 30px;">
            <h3 style="border: none; margin-bottom: 20px;">Payment Information</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <p style="font-size: 13px; color: #888; margin-bottom: 5px;">Payment Method</p>
                    <p style="font-weight: 600; text-transform: uppercase;">{{ $order->payment_method }}</p>
                </div>
                <div>
                    <p style="font-size: 13px; color: #888; margin-bottom: 5px;">Payment Status</p>
                    <p style="font-weight: 600; text-transform: uppercase;">{{ $order->payment_status }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Customer Info & Shipping -->
    <div>
        <div class="admin-card">
            <h3 style="border: none; margin-bottom: 20px;">Customer Details</h3>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                <div style="width: 50px; height: 50px; background: #F3E9D9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #3E2703;">
                    {{ substr($order->billing_name, 0, 1) }}
                </div>
                <div>
                    <div style="font-weight: 700;">{{ $order->billing_name }}</div>
                    <div style="font-size: 13px; color: #666;">{{ $order->billing_email }}</div>
                </div>
            </div>
            <hr style="border: none; border-top: 1px solid #eee; margin-bottom: 20px;">
            <p style="font-weight: 700; margin-bottom: 10px; font-size: 14px;">Shipping Address</p>
            <p style="font-size: 14px; line-height: 1.6; color: #555;">
                {{ $order->shipping_name }}<br>
                {{ $order->shipping_address }}<br>
                {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_pincode }}<br>
                {{ $order->shipping_country }}<br>
                Ph: {{ $order->shipping_phone }}
            </p>
        </div>

        <div class="admin-card" style="margin-top: 30px;">
            <h3 style="border: none; margin-bottom: 20px;">Order Notes</h3>
            <p style="font-size: 14px; color: #555; font-style: italic;">{{ $order->notes ?? '"No notes provided for this order."' }}</p>
        </div>
    </div>
</div>
@endsection
