<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartPreviewResource;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Resources\Json\JsonResource;

class CartController extends Controller
{
    public function show(): JsonResource
    {
        if (!auth()->check()) {
            abort(401, 'Unauthorized');
        }

        $cart = Cart::query()
            ->with('items.product.category')
            ->where('user_id', auth()?->id())
            ->first();

        return new CartResource($cart);
    }

    public function preview(CartService $cartService): JsonResource
    {
        $cart = $cartService->getCartWithItems();

        return new CartPreviewResource($cart);
    }
}
