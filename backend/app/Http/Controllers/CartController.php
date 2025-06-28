<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function preview(): JsonResponse
    {
        if (auth()->check()) {
            $cart = Cart::query()->with('items.product')->where('user_id', auth()->id())->first();
        } else {
            $guest_token = request()->cookie('guest_token');

            $cart = Cart::query()->with('items.product')->where(['guest_token' => $guest_token])->first();
        }

        return response()->json([
            'count' => $cart?->items->sum('quantity') ?? 0,
            'total_price' => $cart?->items->sum(fn($item) => $item->price * $item->quantity),
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
