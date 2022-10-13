<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CheckoutController;



// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Front Product
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
// Cart Route
Route::resource('cart', CartController::class);
// Checkout Route
Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store']);
require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
