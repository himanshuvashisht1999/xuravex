@extends('layouts.admin.app')

@section('title', 'All Coupons')

@section('content')
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; border: none; padding: 0;">Promotional Coupons</h3>
        <a href="{{ route('admin.coupons.create') }}" class="btn-submit" style="text-decoration: none; padding: 10px 20px;">+ Create Coupon</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Coupon Code</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Expiry Date</th>
                <th>Usage</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coupons as $coupon)
            <tr>
                <td><strong style="color: #3E2703; font-family: monospace; font-size: 16px;">{{ $coupon->code }}</strong></td>
                <td>{{ ucfirst($coupon->type) }}</td>
                <td>
                    <strong style="color: #28a745;">
                        {{ $coupon->type == 'percentage' ? $coupon->value . '%' : '$' . number_format($coupon->value, 2) }}
                    </strong>
                </td>
                <td>{{ $coupon->expiry_date->format('Y-m-d') }}</td>
                <td>{{ $coupon->usage_count }}/{{ $coupon->usage_limit ?? '∞' }}</td>
                <td>
                    @php
                        $isExpired = $coupon->expiry_date->isPast();
                        $statusText = $isExpired ? 'Expired' : ($coupon->status ? 'Active' : 'Inactive');
                        $badgeClass = $isExpired ? 'badge-delete' : ($coupon->status ? 'badge-active' : 'badge-pending');
                    @endphp
                    <span class="badge {{ $badgeClass }}" style="{{ $isExpired ? 'background: #f8d7da; color: #721c24;' : '' }}">
                        {{ $statusText }}
                    </span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn-icon btn-icon-edit" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-icon btn-icon-delete" title="Delete" onclick="if(confirm('Are you sure you want to delete this coupon?')) { document.getElementById('delete-form-{{ $coupon->id }}').submit(); }">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        <form id="delete-form-{{ $coupon->id }}" action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 30px; color: #999;">No coupons found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
