@extends('layouts.admin.app')

@section('title', 'All Orders')

@section('content')
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; border: none; padding: 0;">Order Management</h3>
        <div style="display: flex; gap: 15px;">
            <div class="input-group" style="position: relative;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #999;"></i>
                <input type="text" class="admin-input" placeholder="Search order ID or customer..." style="padding-left: 35px; width: 280px;">
            </div>
            <select class="admin-select" style="width: 150px;">
                <option>Filter Status</option>
                <option>Pending</option>
                <option>Processing</option>
                <option>Shipped</option>
            </select>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td><strong>#{{ $order->order_number }}</strong></td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
                <td>{{ $order->billing_name }}</td>
                <td>${{ number_format($order->payable_amount, 2) }}</td>
                <td>
                    <span class="badge {{ $order->payment_status == 'paid' ? 'badge-paid' : 'badge-pending' }}">
                        {{ $order->payment_status }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-{{ strtolower($order->order_status) }}">
                        {{ $order->order_status }}
                    </span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-icon btn-icon-edit" title="View Details">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px;">
        {{ $orders->links() }}
    </div>
</div>
@endsection
