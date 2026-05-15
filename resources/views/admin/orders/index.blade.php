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
                <td><strong>{{ $order['id'] }}</strong></td>
                <td>{{ $order['date'] }}</td>
                <td>{{ $order['customer'] }}</td>
                <td>${{ number_format($order['total'], 2) }}</td>
                <td>
                    <span class="badge {{ $order['payment'] == 'Paid' ? 'badge-paid' : 'badge-pending' }}">
                        {{ $order['payment'] }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-{{ strtolower($order['status']) }}">
                        {{ $order['status'] }}
                    </span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.orders.show', 1) }}" class="btn-icon btn-icon-edit" title="View Details">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="#" class="btn-icon btn-icon-delete" title="Archive">
                            <i class="fa-solid fa-box-archive"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #666;">
        <div>Showing 1 to 3 of 3 entries</div>
        <div style="display: flex; gap: 5px;">
            <button class="btn-icon btn-icon-edit" style="width: auto; padding: 0 10px;">Previous</button>
            <button class="btn-icon btn-icon-edit active" style="background: #3E2703; color: white;">1</button>
            <button class="btn-icon btn-icon-edit" style="width: auto; padding: 0 10px;">Next</button>
        </div>
    </div>
</div>
@endsection
