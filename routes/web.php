<?php

use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthentcationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

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

Route::get('/auth/redirect', [SocialLoginController::class, 'redirect'])
->name('auth.socialite.redirect');
Route::get('/auth/callback', [SocialLoginController::class, 'callback'])
->name('auth.socialite.callback');
// 2FA Authentication
Route::get('auth/user/2fa', [TwoFactorAuthentcationController::class, 'index'])
    ->name('front.2fa');

});
//require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
