<?php

use App\Http\Controllers\AddonsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\UserSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('page.home');
Route::get('/menu', [PageController::class, 'menu'])->name('page.menu');
Route::get('/about', [PageController::class, 'about'])->name('page.about');

Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');

Route::get('/user', [UserController::class, 'index'])->name('user.profile');

Route::get('/user/register', [UserRegistrationController::class, 'create'])->name('user.create');
Route::post('/user/register', [UserRegistrationController::class, 'store'])->name('user.store');

Route::get('/user/login', [UserSessionController::class, 'index'])->name('user.login');
Route::post('/user/login', [UserSessionController::class, 'login'])->name('user.login');
Route::get('/user/logout', [UserSessionController::class, 'destroy'])->name('user.logout');

Route::get('/menu/{category}', [CategoryController::class, 'getProductCategory'])->name('products.category');


Route::middleware(['auth'])->group(function(){
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart-total', [CartController::class, 'getTotalPrice'])->name('cart.total');
    Route::post('/cart-addons', [CartController::class, 'storeWithAddons'])->name('cart.store.addons');
    Route::post('/cart/delete/{itemId}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::get('/contact', [PageController::class, 'contact'])->name('page.contact');
    Route::get('/bag', [PageController::class, 'bag'])->name('page.bag');
    Route::post('/cart-quantity', [CartController::class, 'updateQuantity'])->name('cart.quantity');

    Route::post('checkout', [OrderController::class, 'store'])->name('checkout.store');
});

Route::group(['prefix' => '/admin', 'as' => 'admin.'], function(){
    Route::get('/login', [AdminController::class, 'getLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'postLogin'])->name('login');
    Route::middleware('admin')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products/create', [ProductController::class, 'store'])->name('products.store');
        Route::post('/products/delete', [ProductController::class, 'destroy'])->name('products.delete');
        Route::get('/products/edit/{productId}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/update', [ProductController::class, 'update'])->name('products.update');

        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::post('/users/delete', [UserController::class, 'destroy'])->name('users.delete');

        Route::get('/messages', [MessageController::class, 'index'])->name('messages');
        Route::post('/messages/delete', [MessageController::class, 'destroy'])->name('messages.delete');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::post('/orders/status', [OrderController::class, 'changeState'])->name('orders.changeState');
        Route::get('/orders/show', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/delete', [OrderController::class, 'destroy'])->name('orders.delete');

        Route::get('/addons', [AddonsController::class, 'index'])->name('addons');
        Route::post('/addons/delete', [AddonsController::class, 'destroy'])->name('addons.delete');
        Route::post('/addons/store', [AddonsController::class, 'store'])->name('addons.store');

        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

