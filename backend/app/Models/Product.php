<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'user_id',
        'category_id',
        'slug',
        'excerpt',
        'description',
        'price',
        'amount',
        'status',
        'image'
    ];

    #[Scope]
    public function filter(Builder $query, array $filters): void
    {
        $query->when($filters['order'] ?? false, function (Builder $query, string $order) {
            switch ($order) {
                case 'cheap':
                    $query->orderBy('price');
                    break;
                case 'expensive':
                    $query->orderBy('price', 'desc');
                    break;
            }

            return $query;
        });
    }
    protected static function booted(): void
    {
        static::creating(function ($product) {
            $product->slug = self::generateSlug($product->name);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
