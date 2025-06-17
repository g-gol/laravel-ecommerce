<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->latest()->with(['user'])->paginate(10)->withQueryString();
        return view('products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validated = Arr::except($request->validated(), 'image');

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store(options: 'public');
        }

         auth()->user()->products()->create([
            ...$validated,
            'image' => $image ?? null,
            'status' => ProductStatus::PENDING->value,
        ]);

        return redirect(route('admin.products.index'));
    }

    public function edit(Product $product): View
    {
        $statuses = ProductStatus::toArray();
        return view('products.edit', compact('product', 'statuses'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $validated = Arr::except($request->validated(), 'image');

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store(options: 'public');
        }

        $product->updateOrFail([...$validated, $image ?? null]);

        return redirect()->back();
    }
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->back();
    }
}
