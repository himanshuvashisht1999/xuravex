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
            
           <div style="display: flex;gap: 20px;">
             <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">Shop</a></li>
                <li><a href="{{ route('categories') }}" class="{{ request()->routeIs('categories') ? 'active' : '' }}">Categories</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
            
            <div class="nav-icons">
                <!-- Sliding Search Bar Form -->
                <form action="{{ route('shop') }}" method="GET" class="search-form" x-data="{ open: false }" @click.outside="open = false">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    
                    <div class="search-input-wrapper" :class="open ? 'open' : ''">
                        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" class="search-input" x-ref="searchInput">
                    </div>
                    <button type="button" class="search-btn" @click="if (open) { if ($refs.searchInput.value.trim() !== '') { $el.closest('form').submit(); } else { open = false; } } else { open = true; $nextTick(() => $refs.searchInput.focus()); }">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
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

/* Sliding Search Bar Styling */
.search-form {
    display: flex;
    align-items: center;
    position: relative;
}

.search-input-wrapper {
    width: 0;
    opacity: 0;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.search-input-wrapper.open {
    width: 200px;
    opacity: 1;
    margin-right: 10px;
}

.search-input {
    width: 100%;
    padding: 6px 15px;
    border: 1px solid rgba(62, 39, 3, 0.2);
    border-radius: 20px;
    background: #F3E9D9;
    color: var(--primary-color);
    outline: none;
    font-size: 14px;
    font-weight: 500;
}

.search-input::placeholder {
    color: rgba(62, 39, 3, 0.5);
}

.search-btn {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    outline: none;
}

.search-btn i {
    font-size: 18px;
    color: var(--primary-color);
    transition: var(--transition);
}

.search-btn:hover i {
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
