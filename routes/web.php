<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CharacterController as AdminCharacter;
use App\Http\Controllers\Admin\ElementController as AdminElement;
use App\Http\Controllers\Admin\LoreController as AdminLore;
use App\Http\Controllers\Admin\StoryController as AdminStory;
use App\Http\Controllers\Admin\ShopController as AdminShop;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\TimelineController as AdminTimeline;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\CharacterController;
use App\Http\Controllers\Client\LoreController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\Client\StoryController;
use App\Http\Controllers\Client\TimelineController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\AuthController;

/*
|--------------------------------------------------------------------------
| CLIENT ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');
Route::get('/characters/{slug}', [CharacterController::class, 'show'])->name('characters.show');
Route::get('/lore', [LoreController::class, 'index'])->name('lore.index');
Route::get('/lore/{slug}', [LoreController::class, 'show'])->name('lore.show');
Route::get('/story', [StoryController::class, 'index'])->name('story.index');
Route::get('/story/{slug}', [StoryController::class, 'show'])->name('story.show');
Route::get('/timeline', [TimelineController::class, 'index'])->name('timeline.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cart & Checkout (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [CartController::class, 'process'])->name('checkout.process');
    Route::get('/orders', [CartController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{id}', [CartController::class, 'orderShow'])->name('orders.show');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Auth
    Route::get('/login', [AdminAuth::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuth::class, 'login']);
    Route::post('/logout', [AdminAuth::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

        // Characters
        Route::resource('characters', AdminCharacter::class);

        // Elements
        Route::resource('elements', AdminElement::class);

        // Lore
        Route::resource('lore', AdminLore::class);

        // Stories
        Route::resource('stories', AdminStory::class);

        // Timeline
        Route::resource('timeline', AdminTimeline::class);

        // Shop / Items
        Route::resource('shop', AdminShop::class);
        Route::get('shop/{id}/toggle-featured', [AdminShop::class, 'toggleFeatured'])->name('shop.toggle-featured');

        // Orders
        Route::get('orders', [AdminOrder::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [AdminOrder::class, 'show'])->name('orders.show');
        Route::post('orders/{id}/status', [AdminOrder::class, 'updateStatus'])->name('orders.update-status');

        // Users
        Route::resource('users', AdminUser::class)->except(['create', 'store']);
        Route::post('users/{id}/toggle-ban', [AdminUser::class, 'toggleBan'])->name('users.toggle-ban');

        // Settings
        Route::get('settings', [AdminDashboard::class, 'settings'])->name('settings');
        Route::post('settings', [AdminDashboard::class, 'updateSettings'])->name('settings.update');
    });
});
