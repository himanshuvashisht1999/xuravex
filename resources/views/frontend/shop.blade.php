@extends('layouts.frontend.app')

@section('title', 'Shop - Xuravex')

@section('content')
    <!-- Shop Title Section -->
    <div class="shop-page-title">
        <div class="container">
            <h1>shop with confidence</h1>
        </div>
    </div>

    <!-- Shop Grid Section -->
    <section class="shop-section">
        <div class="container">
            <div class="shop-grid">
                @php
                    $products = [
                        ['name' => '5-Amino-1MQ', 'price' => '$55.00'],
                        ['name' => 'Phosphate-Buffered Saline 30mL', 'price' => '$55.00'],
                        ['name' => 'Thymulin 20MG', 'price' => '$55.00'],
                        ['name' => '5-Amino-1MQ', 'price' => '$55.00 - $75.00'],
                        ['name' => 'Phosphate-Buffered Saline 30mL', 'price' => '$55.00'],
                        ['name' => 'Thymulin 20MG', 'price' => '$55.00'],
                        ['name' => 'Mitochondrial B12', 'price' => '$55.00'],
                        ['name' => 'Phosphate-Buffered Saline 30mL', 'price' => '$55.00'],
                        ['name' => 'Thymulin 20MG', 'price' => '$55.00'],
                    ];
                @endphp

                @foreach($products as $index => $product)
                <div class="product-card-shop">
                    <a href="{{ $index === 0 ? route('product.detail') : '#' }}">
                        <div class="image-box">
                            <img src="https://via.placeholder.com/150x250?text=BAC+Water" alt="{{ $product['name'] }}">
                        </div>
                    </a>
                    <div class="info-box">
                        <a href="{{ $index === 0 ? route('product.detail') : '#' }}">
                            <h3>{{ $product['name'] }}</h3>
                        </a>
                        <div class="price">{{ $product['price'] }}</div>
                        <a href="{{ $index === 0 ? route('product.detail') : '#' }}" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <a href="#" class="page-link">&lt;</a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <a href="#" class="page-link">4</a>
                <a href="#" class="page-link">4</a> <!-- Note: Duplicate '4' from design screenshot -->
                <a href="#" class="page-link">&gt;</a>
            </div>
        </div>
    </section>
@endsection
