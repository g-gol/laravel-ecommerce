<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
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
}
