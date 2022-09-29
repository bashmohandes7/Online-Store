<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;



// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Front Product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
