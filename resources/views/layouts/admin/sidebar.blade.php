<aside class="admin-sidebar" x-data="{ openMenu: 'products' }">
    <div class="sidebar-header" style="border: none; padding: 30px 20px;">
        @php
            $siteLogo = \App\Models\Setting::get('site_logo');
        @endphp
        @if($siteLogo)
            <img src="{{ asset('uploads/settings/' . $siteLogo) }}" alt="Xuravex Logo"
                style="width: 100%; max-height: 50px; object-fit: contain;">
        @else
            <img src="https://via.placeholder.com/150x40?text=XURAVEX" alt="Xuravex Logo" style="width: 100%;">
        @endif
    </div>
    <nav class="sidebar-menu">
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="javascript:void(0)" @click="openMenu = (openMenu === 'products' ? '' : 'products')"
                    :class="openMenu === 'products' ? 'active' : ''" style="justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fa-solid fa-box"></i> Products
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>
                </a>
                <ul x-show="openMenu === 'products'" style="background: rgba(0,0,0,0.2); padding-left: 20px;">
                    <li><a href="{{ route('admin.products.index') }}"
                            class="{{ Route::is('admin.products.index') ? 'active' : '' }}" style="font-size: 13px;">All
                            Products</a></li>
                    <li><a href="{{ route('admin.products.create') }}"
                            class="{{ Route::is('admin.products.create') ? 'active' : '' }}"
                            style="font-size: 13px;">Add New Product</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" @click="openMenu = (openMenu === 'categories' ? '' : 'categories')"
                    :class="openMenu === 'categories' ? 'active' : ''" style="justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fa-solid fa-layer-group"></i> Categories
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>
                </a>
                <ul x-show="openMenu === 'categories'" style="background: rgba(0,0,0,0.2); padding-left: 20px;">
                    <li><a href="{{ route('admin.categories.index') }}"
                            class="{{ Route::is('admin.categories.index') ? 'active' : '' }}"
                            style="font-size: 13px;">All Categories</a></li>
                    <li><a href="{{ route('admin.categories.create') }}"
                            class="{{ Route::is('admin.categories.create') ? 'active' : '' }}"
                            style="font-size: 13px;">Add New Category</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" @click="openMenu = (openMenu === 'brands' ? '' : 'brands')"
                    :class="openMenu === 'brands' ? 'active' : ''" style="justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fa-solid fa-tags"></i> Brands
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>
                </a>
                <ul x-show="openMenu === 'brands'" style="background: rgba(0,0,0,0.2); padding-left: 20px;">
                    <li><a href="{{ route('admin.brands.index') }}"
                            class="{{ Route::is('admin.brands.index') ? 'active' : '' }}" style="font-size: 13px;">All
                            Brands</a></li>
                    <li><a href="{{ route('admin.brands.create') }}"
                            class="{{ Route::is('admin.brands.create') ? 'active' : '' }}" style="font-size: 13px;">Add
                            New Brand</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" @click="openMenu = (openMenu === 'sizes' ? '' : 'sizes')"
                    :class="openMenu === 'sizes' ? 'active' : ''" style="justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fa-solid fa-ruler"></i> Sizes
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>
                </a>
                <ul x-show="openMenu === 'sizes'" style="background: rgba(0,0,0,0.2); padding-left: 20px;">
                    <li><a href="{{ route('admin.sizes.index') }}"
                            class="{{ Route::is('admin.sizes.index') ? 'active' : '' }}" style="font-size: 13px;">All
                            Sizes</a></li>
                    <li><a href="{{ route('admin.sizes.create') }}"
                            class="{{ Route::is('admin.sizes.create') ? 'active' : '' }}" style="font-size: 13px;">Add
                            New Size</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" @click="openMenu = (openMenu === 'orders' ? '' : 'orders')"
                    :class="openMenu === 'orders' ? 'active' : ''" style="justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fa-solid fa-cart-shopping"></i> Orders
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>
                </a>
                <ul x-show="openMenu === 'orders'" style="background: rgba(0,0,0,0.2); padding-left: 20px;">
                    <li><a href="{{ route('admin.orders.index') }}"
                            class="{{ Route::is('admin.orders.index') ? 'active' : '' }}" style="font-size: 13px;">All
                            Orders</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" @click="openMenu = (openMenu === 'customers' ? '' : 'customers')"
                    :class="openMenu === 'customers' ? 'active' : ''" style="justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fa-solid fa-users"></i> Customers
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>
                </a>
                <ul x-show="openMenu === 'customers'" style="background: rgba(0,0,0,0.2); padding-left: 20px;">
                    <li><a href="{{ route('admin.customers.index') }}"
                            class="{{ Route::is('admin.customers.index') ? 'active' : '' }}"
                            style="font-size: 13px;">All Customers</a></li>
                    <li><a href="{{ route('admin.customers.create') }}"
                            class="{{ Route::is('admin.customers.create') ? 'active' : '' }}"
                            style="font-size: 13px;">Add New Customer</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" @click="openMenu = (openMenu === 'coupons' ? '' : 'coupons')"
                    :class="openMenu === 'coupons' ? 'active' : ''" style="justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fa-solid fa-ticket"></i> Coupons
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>
                </a>
                <ul x-show="openMenu === 'coupons'" style="background: rgba(0,0,0,0.2); padding-left: 20px;">
                    <li><a href="{{ route('admin.coupons.index') }}"
                            class="{{ Route::is('admin.coupons.index') ? 'active' : '' }}" style="font-size: 13px;">All
                            Coupons</a></li>
                    <li><a href="{{ route('admin.coupons.create') }}"
                            class="{{ Route::is('admin.coupons.create') ? 'active' : '' }}"
                            style="font-size: 13px;">Create Coupon</a></li>
                </ul>
            </li>

            <li style="border-top: 1px solid rgba(255,255,255,0.1);">
                <a href="{{ route('admin.settings.index') }}"
                    class="{{ Route::is('admin.settings.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-gears"></i> Settings
                </a>
            </li>
        </ul>
    </nav>
</aside>