<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductStatus;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'excerpt' => ['required', 'min:20', 'max:2000'],
            'description' => ['required', 'min:20', 'max:10000'],
            'price' => ['required', 'numeric', 'min:1'],
            'image' => ['nullable', 'image']
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store(options: 'public');
        }

         auth()->user()->products()->create([
            ...$validated,
            'status' => ProductStatus::PENDING->value,
        ]);

        return redirect(route('admin.products'));
    }

    public function edit(Product $product): View
    {
        $statuses = ProductStatus::toArray();
        return view('products.edit', compact('product', 'statuses'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated= $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'excerpt' => ['required', 'min:20', 'max:2000'],
            'description' => ['required', 'min:20', 'max:10000'],
            'price' => ['required', 'numeric', 'min:1'],
            'status' => ['required', Rule::enum(ProductStatus::class)],
            'image' => ['nullable']
        ]);

        $product->updateOrFail($validated);

        return redirect()->back();
    }
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->back();
    }
}
