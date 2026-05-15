<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Frontend\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController as UserRegisterController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product/5-amino-1mq', [HomeController::class, 'productDetail'])->name('product.detail');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('/thank-you', [HomeController::class, 'thankYou'])->name('thank.you');

// User Auth
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login'])->name('login.post');
Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');
Route::get('/register', [UserRegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserRegisterController::class, 'register'])->name('register.post');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Auth
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Product Management
        Route::prefix('products')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.index');
            Route::get('/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
            Route::delete('/delete/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');
            Route::post('/store', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
        });

        // Order Management
        Route::prefix('orders')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
            Route::get('/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
        });

        // Customer Management
        Route::prefix('customers')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customers.index');
            Route::get('/create', [App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('admin.customers.create');
            Route::get('/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('admin.customers.show');
            Route::post('/store', [App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('admin.customers.store');
        });

        // Coupon Management
        Route::prefix('coupons')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\CouponController::class, 'index'])->name('admin.coupons.index');
            Route::get('/create', [App\Http\Controllers\Admin\CouponController::class, 'create'])->name('admin.coupons.create');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\CouponController::class, 'edit'])->name('admin.coupons.edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\CouponController::class, 'update'])->name('admin.coupons.update');
            Route::delete('/delete/{id}', [App\Http\Controllers\Admin\CouponController::class, 'destroy'])->name('admin.coupons.destroy');
            Route::post('/store', [App\Http\Controllers\Admin\CouponController::class, 'store'])->name('admin.coupons.store');
        });

        // Category Management
        Route::prefix('categories')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
            Route::delete('/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.destroy');
            Route::post('/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
        });

        // Brand Management
        Route::prefix('brands')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\BrandController::class, 'index'])->name('admin.brands.index');
            Route::get('/create', [App\Http\Controllers\Admin\BrandController::class, 'create'])->name('admin.brands.create');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('admin.brands.edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\BrandController::class, 'update'])->name('admin.brands.update');
            Route::delete('/delete/{id}', [App\Http\Controllers\Admin\BrandController::class, 'destroy'])->name('admin.brands.destroy');
            Route::post('/store', [App\Http\Controllers\Admin\BrandController::class, 'store'])->name('admin.brands.store');
        });

        // Site Settings
        Route::prefix('settings')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index');
            Route::post('/update', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
        });

        // Admin Profile
        Route::prefix('profile')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');
            Route::post('/update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
            Route::post('/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('admin.profile.password');
        });
    });
});
