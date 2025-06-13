<?php

namespace Database\Factories;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'excerpt' => fake()->text(),
            'description' => fake()->text(1000),
            'published' => fake()->boolean(70),
            'price' => fake()->randomDigitNotZero() * 10,
            'status' => fake()->randomElement(ProductStatus::toArray())
        ];
    }
}
