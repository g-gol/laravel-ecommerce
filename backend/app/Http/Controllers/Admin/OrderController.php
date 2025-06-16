<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query() ->latest()
            ->with(['user'])->withCount('items')
            ->paginate(20)->withQueryString();

        return view('orders.index', compact('orders'));
    }

    public function cancel(Order $order): RedirectResponse
    {
        $order->status = OrderStatus::CANCELLED->value;
        $order->save();

        return redirect()->back();
    }
}
