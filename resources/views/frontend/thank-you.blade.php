@extends('layouts.frontend.app')

@section('title', 'Thank You - Xuravex')

@section('content')
    <div class="container">
        <div class="thank-you-box">
            <i class="fa-solid fa-circle-check fa-5x"></i>
            <h2>Thank You for Your Order!</h2>
            <div class="order-id">Order Number: #XUR-{{ rand(10000, 99999) }}</div>
            <p>Your order has been successfully placed. We've sent a confirmation email to your registered address with all the details and tracking information.</p>
            
            <div class="thank-you-actions">
                <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
                <a href="#" class="btn btn-outline">View Order History</a>
            </div>
        </div>
    </div>
@endsection
