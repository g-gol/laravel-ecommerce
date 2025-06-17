<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()->latest()
            ->with(['user'])->withCount('items')
            ->paginate(20)->withQueryString();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $items = $order->items()->with('product')->get();
        return view('orders.show', compact('order', 'items'));
    }

    public function edit(Order $order): View
    {
        $statuses = OrderStatus::toArray();
        return view('orders.edit', compact('order', 'statuses'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'shipping_address' => ['required', 'string'],
            'status' => ['required', Rule::enum(OrderStatus::class)],
        ]);

        $order->updateOrFail($validated);

        return redirect()->back();
    }

    public function cancel(Order $order): RedirectResponse
    {
        $order->status = OrderStatus::CANCELLED->value;
        $order->save();

        return redirect()->back();
    }
}
