@extends('layouts.frontend.app')

@section('title', 'Product Categories - Xuravex')

@section('content')
<section class="page-header" style="background-image:url({{asset('images/innerpage-banner.png')}}) !important; background-size: cover; background-position: center;background-repeat:no-repeat !important;background-size:cover !important; padding: 80px 0; color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; font-weight: 800; margin-bottom: 15px;">Research Categories</h1>
        <p style="font-size: 1.1rem; opacity: 0.8;">Browse our extensive collection of research chemicals and laboratory supplies</p>
    </div>
</section>

<section style="padding: 80px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
            @foreach($categories as $category)
            <a href="{{ route('shop', ['category' => $category->slug]) }}" style="text-decoration: none; color: inherit;">
                <div class="category-card" style="position: relative; height: 400px; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow-md); transition: all 0.4s ease;">
                    <img src="{{ !empty($category->image) ? asset('uploads/categories/' . $category->image) : 'https://via.placeholder.com/600x400?text=' . urlencode($category->name) }}" alt="{{ $category->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); display: flex; flex-direction: column; justify-content: flex-end; padding: 30px;">
                        <h3 style="color: white; font-size: 1.8rem; margin-bottom: 5px;">{{ $category->name }}</h3>
                        <p style="color: var(--secondary-color); margin: 0; font-weight: 600;">{{ $category->products_count }} Products</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<style>
.category-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-lg);
}
.category-card:hover img {
    transform: scale(1.1);
}
</style>
@endsection
