<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    public function store(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id']
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $item = $order->items()->where('product_id', $validated['product_id'])->first();

        if ($item && $item->price === $product->price) {
            $item->increment('quantity');
        } else {
            $order->items()->create([
                'product_id' => $validated['product_id'],
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        $order->updateTotal();

        return redirect()->back();
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'decimal:2', 'min:0']
        ]);

        DB::transaction(function () use ($id, $validated) {
            $item = OrderItem::findOrFail($id);
            $item->updateOrFail($validated);
            $item->order->updateTotal();
        });

        return redirect()->back();
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = OrderItem::findOrFail($id);
        $order = $item->order;
        $item->delete();
        $order->updateTotal();

        return redirect()->back();
    }
}
