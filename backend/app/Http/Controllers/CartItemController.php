<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CartItemController extends Controller
{

    public function update(Request $request): Response
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
        ]);

        $cart = Cart::query()->firstOrCreate(['user_id' => auth()->id()]);
        $product = Product::query()->findOrFail($validated['product_id']);

        if ($cartItem = $cart->items()->where('product_id', $product->id)->first()) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            $cart->items()->create([
                ...$validated,
                'price' => $product->price
            ]);
        }

        return response()->noContent();
    }
}
