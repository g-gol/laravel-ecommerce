<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartItemController extends Controller
{

    public function update(Request $request): Response
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
        ]);

        if (auth()->check()) {
            $cart = Cart::query()->firstOrCreate(['user_id' => auth()->id()]);
        } else {
           $guestId = $request->cookie('guest_id');
           if (!$guestId) {
               $guestId = (string) Str::uuid();
               Cookie::queue('guest_id', $guestId, 60 * 24* 30);
           }

           $cart = Cart::query()->firstOrCreate(['guest_token' => $guestId]);
        }

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

    public function destroy(CartItem $item): Response
    {
        $item->delete();

        return response()->noContent();
    }
}
