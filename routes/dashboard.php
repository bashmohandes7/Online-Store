<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\RoleController;

// Dashboard route
Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'dashboard.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');
    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Route::resource('roles', RoleController::class);
    Route::resources([
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'roles' => RoleController::class
    ]);
});
