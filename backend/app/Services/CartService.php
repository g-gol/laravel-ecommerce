<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;

class CartService
{
    protected ?Cart $cart = null;
    public function addItem(string|int $product_id, int $quantity = 1): void
    {
        $cart = $this->cart ?? $this->handleCart();

        $product = Product::query()->findOrFail($product_id);

        if ($cartItem = $cart->items()->where('product_id', $product->id)->first()) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }
    }

    public function getCartWithItems(): Cart
    {
        $cart = $this->cart ?? $this->handleCart();

        return $cart->load('items.product');
    }

    private function handleCart(): Cart
    {
        if (auth()->check()) {
            $this->cart = Cart::query()->firstOrCreate(['user_id' => auth()->id()]);
        } else {
            $guest_token = request()->cookie('guest_token');

            $this->cart = Cart::query()->firstOrCreate(['guest_token' => $guest_token]);
        }

        return $this->cart;
    }
}
