<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'count' => $this->items->sum('quantity') ?? 0,
            'total_price' => $this->items->sum(fn ($item) => $item->price * $item->quantity),
            'items' => $this->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'product' => [
                        'id' => $item->product->id,
                        'name' => $item->product->name,
                    ]
                ];
            })
        ];
    }
}
