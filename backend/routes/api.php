<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/categories', CategoryController::class);
Route::put('/cart/items', [CartItemController::class, 'update']);
Route::delete('/cart/items/{item}', [CartItemController::class, 'destroy']);
Route::get('/cart/preview', [CartController::class, 'preview']);
