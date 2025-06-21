<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'description' => $this
                ->when($request->is('api/products/*'), fn() => $this->description),
            'price' => $this->price,
            'image' => asset('storage/' . ($this->image ?? 'default.jpg')),
        ];
    }
}
