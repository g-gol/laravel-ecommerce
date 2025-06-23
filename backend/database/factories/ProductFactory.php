<?php

namespace Database\Factories;

use App\Enums\ProductStatus;
use App\Models\Category;
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
            'category_id' => Category::factory()->create(),
            'slug' => fake()->unique()->slug(),
            'excerpt' => fake()->text(),
            'description' => fake()->text(1000),
            'price' => fake()->randomDigitNotZero() * 10,
            'amount' => fake()->randomDigitNotZero() * 5,
            'status' => fake()->randomElement(ProductStatus::toArray())
        ];
    }
}
