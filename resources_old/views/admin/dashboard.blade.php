@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-stats" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
    <div class="card">
        <h4>Total Orders</h4>
        <p style="font-size: 24px; font-weight: 700; color: var(--admin-secondary);">150</p>
    </div>
    <div class="card">
        <h4>New Users</h4>
        <p style="font-size: 24px; font-weight: 700; color: var(--admin-secondary);">45</p>
    </div>
    <div class="card">
        <h4>Total Products</h4>
        <p style="font-size: 24px; font-weight: 700; color: var(--admin-secondary);">82</p>
    </div>
    <div class="card">
        <h4>Revenue</h4>
        <p style="font-size: 24px; font-weight: 700; color: var(--admin-secondary);">$12,450</p>
    </div>
</div>

<div class="card" style="margin-top: 30px;">
    <h3>Recent Orders</h3>
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="border-bottom: 2px solid var(--admin-bg); text-align: left;">
                <th style="padding: 10px;">Order ID</th>
                <th style="padding: 10px;">Customer</th>
                <th style="padding: 10px;">Status</th>
                <th style="padding: 10px;">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid var(--admin-bg);">
                <td style="padding: 10px;">#ORD-7854</td>
                <td style="padding: 10px;">John Doe</td>
                <td style="padding: 10px;"><span style="background: #e1f5fe; color: #0288d1; padding: 3px 10px; border-radius: 20px; font-size: 12px;">Shipped</span></td>
                <td style="padding: 10px;">$110.00</td>
            </tr>
            <tr style="border-bottom: 1px solid var(--admin-bg);">
                <td style="padding: 10px;">#ORD-7855</td>
                <td style="padding: 10px;">Jane Smith</td>
                <td style="padding: 10px;"><span style="background: #fff3e0; color: #ef6c00; padding: 3px 10px; border-radius: 20px; font-size: 12px;">Pending</span></td>
                <td style="padding: 10px;">$55.00</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
