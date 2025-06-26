<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function preview(): JsonResponse
    {
        $cart = Cart::query()->with('items.product')->where('user_id', auth()->id())->first();
        return response()->json([
            'count' => $cart?->items->sum('quantity') ?? 0,
            'total_price' => $cart->items->sum(fn($item) => $item->price * $item->quantity),
            'items' => $cart?->items->map(function ($item) {
                return [
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
