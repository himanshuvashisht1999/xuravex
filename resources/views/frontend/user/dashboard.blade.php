@extends('layouts.frontend.app')

@section('title', 'User Dashboard - Xuravex')

@section('content')
<div class="shop-page-title"style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important;">
    <div class="container">
        <h1>My Account</h1>
    </div>
</div>

<section class="dashboard-section" style="padding: 60px 0; background: var(--gray-100);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 40px;"class="dashboard-div">
            <!-- Dashboard Sidebar -->
            @include('frontend.user.partials.sidebar')

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow-sm);">
                    <h3 style="margin-bottom: 30px;">Recent Orders</h3>
                    
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 2px solid #ddd; text-align: left;vertical-align: sub;">
                                    <th style="padding: 15px;">Order #</th>
                                    <th style="padding: 15px;">Date</th>
                                    <th style="padding: 15px;">Status</th>
                                    <th style="padding: 15px;">Total</th>
                                    <th style="padding: 15px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr style="border-bottom: 1px solid var(--gray-100);">
                                    <td style="padding: 15px; font-weight: 600;">{{ $order->order_number }}</td>
                                    <td style="padding: 15px;">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td style="padding: 15px;">
                                        <span style="padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase; 
                                            background: {{ $order->order_status == 'completed' ? '#d4edda' : ($order->order_status == 'pending' ? '#fff3cd' : '#f8d7da') }};
                                            color: {{ $order->order_status == 'completed' ? '#155724' : ($order->order_status == 'pending' ? '#856404' : '#721c24') }};">
                                            {{ $order->order_status }}
                                        </span>
                                    </td>
                                    <td style="padding: 15px; font-weight: 700;">${{ number_format($order->payable_amount, 2) }}</td>
                                    <td style="padding: 15px;">
                                        <a href="{{ route('user.order.details', $order->order_number) }}" class="btn btn-primary" style="padding: 8px 15px; font-size: 13px;">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="padding: 40px; text-align: center; color: var(--gray-500);">
                                        <i class="fa-solid fa-box-open" style="font-size: 3rem; display: block; margin-bottom: 15px;"></i>
                                        You haven't placed any orders yet.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
