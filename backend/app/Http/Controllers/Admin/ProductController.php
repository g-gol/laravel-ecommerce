<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
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
}
