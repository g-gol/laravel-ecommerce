<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
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

        Route::resource('categories', CategoryController::class)->except('show');
    });

Route::middleware('can:edit-order')
    ->group(function () {
        Route::resource('orders', OrderController::class)->except(['create', 'destroy']);

        Route::prefix('orders')
            ->as('orders.')
            ->group(function () {
                Route::patch('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');

                Route::post('/{order}/items', [OrderItemController::class, 'store'])->name('items.store');
                Route::put('/items/{id}', [OrderItemController::class, 'update'])->name('items.update');
                Route::delete('/items/{id}', [OrderItemController::class, 'destroy'])->name('items.destroy');
            });
    });
