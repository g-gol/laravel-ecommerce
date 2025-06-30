<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Services\CartService;
use Illuminate\Http\Resources\Json\JsonResource;

class CartController extends Controller
{
    public function preview(CartService $cartService): JsonResource
    {
        $cart = $cartService->getCartWithItems();

        return new CartResource($cart);
    }
}
