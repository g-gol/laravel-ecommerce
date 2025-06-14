<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'user_id',
        'slug',
        'excerpt',
        'description',
        'price',
        'status',
        'image'
    ];
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
}
