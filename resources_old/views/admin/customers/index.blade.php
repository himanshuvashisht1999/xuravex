@extends('layouts.admin.app')

@section('title', 'All Customers')

@section('content')
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; border: none; padding: 0;">Customer Database</h3>
        <div style="display: flex; gap: 15px;">
            <div class="input-group" style="position: relative;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #999;"></i>
                <input type="text" class="admin-input" placeholder="Search by name or email..." style="padding-left: 35px; width: 280px;">
            </div>
            <a href="{{ route('admin.customers.create') }}" class="btn-submit" style="text-decoration: none; padding: 10px 20px;">+ Add Customer</a>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Joined</th>
                <th>Orders</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 35px; height: 35px; background: #F3E9D9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #3E2703; font-size: 12px;">
                            {{ strtoupper(substr($customer['name'], 0, 1)) }}{{ strtoupper(substr(explode(' ', $customer['name'])[1] ?? '', 0, 1)) }}
                        </div>
                        <strong>{{ $customer['name'] }}</strong>
                    </div>
                </td>
                <td>{{ $customer['email'] }}</td>
                <td>{{ $customer['phone'] }}</td>
                <td>{{ $customer['joined'] }}</td>
                <td>{{ $customer['orders'] }}</td>
                <td>
                    <span class="badge {{ $customer['status'] == 'Active' ? 'badge-active' : 'badge-pending' }}">
                        {{ $customer['status'] }}
                    </span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.customers.show', $customer['id']) }}" class="btn-icon btn-icon-edit" title="View Profile">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <a href="#" class="btn-icon btn-icon-delete" title="Delete">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
