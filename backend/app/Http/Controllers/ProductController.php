<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $products = Product::query()->filter(request(['order']))->latest()->paginate(9)->withQueryString();
        return ProductResource::collection($products);
    }

    public function show(Product $product): JsonResource
    {
        return new ProductResource($product);
    }
}
