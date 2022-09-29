<?php

use Illuminate\Support\Facades\Route;

// Dashboard route
Route::group(['middleware' => ['auth', 'auth-type:admin,super-admin'], 'prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.dashboard');
    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});