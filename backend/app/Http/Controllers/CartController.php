<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function preview(CartService $cartService): JsonResponse
    {
        $cart = $cartService->getCartWithItems();

        return response()->json([
            'count' => $cart?->items->sum('quantity') ?? 0,
            'total_price' => $cart?->items->sum(fn ($item) => $item->price * $item->quantity),
            'items' => $cart?->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'product' => [
                        'id' => $item->product->id,
                        'name' => $item->product->name,
                    ]
                ];
            }) ?? [],
        ]);
    }
}
