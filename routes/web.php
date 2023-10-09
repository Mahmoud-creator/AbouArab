<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\PageController;
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
Route::get('/bag', [PageController::class, 'bag'])->name('page.bag');
Route::get('/contact', [PageController::class, 'contact'])->name('page.contact');
Route::get('/about', [PageController::class, 'about'])->name('page.about');

Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');
