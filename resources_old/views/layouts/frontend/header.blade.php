<header class="main-header">
    <div class="container">
        <nav class="navbar">
            <div class="logo">
                <a href="{{ route('home') }}">
                    @if(isset($gs['site_logo']))
                        <img src="{{ asset('uploads/settings/' . $gs['site_logo']) }}" alt="{{ $gs['site_name'] ?? 'Logo' }}" class="img-fluid" style="max-height: 50px;">
                    @else
                        <img src="https://via.placeholder.com/150x50?text=XURAVEX" alt="Xuravex Logo" class="img-fluid">
                    @endif
                </a>
            </div>
            
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">Shop</a></li>
                <li><a href="{{ route('categories') }}" class="{{ request()->routeIs('categories') ? 'active' : '' }}">Categories</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
            
            <div class="nav-icons">
                <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="{{ route('cart') }}" style="position: relative;">
                    <i class="fa-solid fa-cart-shopping"></i>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span style="position: absolute; top: -10px; right: -10px; background: var(--secondary-color); color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 10px; display: flex; align-items: center; justify-content: center; font-weight: 700;">{{ count(session('cart')) }}</span>
                    @endif
                </a>
                @auth('web')
                    <a href="{{ route('user.dashboard') }}" title="My Account"><i class="fa-solid fa-circle-user"></i></a>
                @else
                    <a href="{{ route('login') }}" title="Login"><i class="fa-solid fa-user"></i></a>
                @endauth
            </div>
            
            <div class="mobile-menu-btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </nav>
    </div>
</header>

<style>
.main-header {
    background: var(--white);
    padding: 20px 0;
    box-shadow: var(--shadow-sm);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav-links {
    display: flex;
    gap: 30px;
}

.nav-links a {
    font-weight: 500;
    color: var(--gray-700);
    font-size: 16px;
}

.nav-links a:hover, .nav-links a.active {
    color: var(--secondary-color);
}

.nav-icons {
    display: flex;
    gap: 20px;
    align-items: center;
}

.nav-icons i {
    font-size: 18px;
    color: var(--primary-color);
}

.nav-icons a:hover i {
    color: var(--secondary-color);
}

.mobile-menu-btn {
    display: none;
    cursor: pointer;
    font-size: 24px;
    color: var(--primary-color);
}

@media (max-width: 992px) {
    .nav-links {
        display: none;
    }
    
    .mobile-menu-btn {
        display: block;
    }
}
</style>
