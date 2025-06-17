<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\OrderItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::middleware('can:edit-user')
    ->prefix('users')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.delete');
    });
Route::middleware('can:edit-product')
    ->group(function () {
        Route::resource('products', ProductController::class);
    });
Route::middleware('can:edit-order')
    ->group(function () {
        Route::resource('orders', OrderController::class)->except(['create', 'destroy']);
        Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

        Route::put('/orders/items/{id}', [OrderItemController::class, 'update'])->name('orders.items.update');
    });
