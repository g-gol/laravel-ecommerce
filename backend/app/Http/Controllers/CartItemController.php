<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartItemController extends Controller
{
    public function update(Request $request, CartService $cartService): Response
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
        ]);

        $cartService->addItem($validated['product_id'], $validated['quantity']);

        return response()->noContent();
    }

    public function destroy(CartItem $item): Response
    {
        $item->delete();

        return response()->noContent();
    }
}
