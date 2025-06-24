<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $categories = Category::query()
            ->latest()->withCount('products')
            ->having('products_count', '>', 0)->get();

        return response()->json([
            'data' => $categories
        ]);
    }
}
