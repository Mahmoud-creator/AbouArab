<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\UserSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'home'])->name('page.home');
Route::get('/menu', [PageController::class, 'menu'])->name('page.menu');
Route::get('/contact', [PageController::class, 'contact'])->name('page.contact');
Route::get('/about', [PageController::class, 'about'])->name('page.about');

Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');

Route::get('/user', [UserController::class, 'index'])->name('user.profile');

Route::get('/user/register', [UserRegistrationController::class, 'create'])->name('user.create');
Route::post('/user/register', [UserRegistrationController::class, 'store'])->name('user.store');

Route::get('/user/login', [UserSessionController::class, 'index'])->name('user.login');
Route::post('/user/login', [UserSessionController::class, 'login'])->name('user.login');
Route::get('/user/logout', [UserSessionController::class, 'destroy'])->name('user.logout');

Route::get('/menu/{category}', [CategoryController::class, 'getProductCategory'])->name('products.category');

Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

Route::middleware(['auth'])->group(function(){
    Route::get('/bag', [PageController::class, 'bag'])->name('page.bag');
    Route::post('/cart-quantity', [CartController::class, 'updateQuantity'])->name('cart.quantity');
});

Route::group(['prefix' => '/admin'], function(){
    Route::get('/login', [AdminController::class, 'getLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'postLogin'])->name('admin.login');
    Route::middleware('admin')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});

