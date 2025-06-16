<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::middleware('can:edit-user')
    ->prefix('users')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.delete');
    });
Route::middleware('can:edit-product')
    ->prefix('products')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::get('/{product:slug}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('/{product}', [ProductController::class, 'store'])->name('products.store');
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.delete');
    });
Route::middleware('can:edit-order')
    ->group(function () {
        Route::resource('orders', OrderController::class)->except(['create']);
        Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    });
