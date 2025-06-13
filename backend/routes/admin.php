<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::middleware('can:access-user')
    ->prefix('users')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.delete');
    });
Route::middleware('can:access-product')
    ->prefix('products')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::put('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.delete');
    });
