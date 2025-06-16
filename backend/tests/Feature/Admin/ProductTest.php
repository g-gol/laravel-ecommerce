<?php

namespace Tests\Feature\Admin;

use App\Enums\ProductStatus;
use App\Enums\Role;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
        $this->actingAs(User::factory()->create()->assignRole(Role::EDITOR->value));
    }

    public function test_editor_can_create_product(): void
    {
        $this->post(route('admin.products.store'), [
            'name' => fake()->words(3, true),
            'excerpt' => fake()->text(),
            'description' => fake()->text(1000),
            'price' => fake()->randomDigitNotZero() * 10,
        ]);

        $this->assertDatabaseCount('products', 1);
    }

    public function test_editor_can_update_product(): void
    {
        $product = Product::factory()->create([
            'user_id' => auth()->id()
        ]);

        $name = fake()->words(3, true);
        $this->put(route('admin.products.update', $product), [
            'name' => $name,
            'excerpt' => fake()->text(),
            'description' => fake()->text(1000),
            'price' => fake()->randomDigitNotZero() * 10,
            'status' => ProductStatus::PENDING->value,
        ]);

        $this->assertTrue($product->fresh()->name === $name);
    }

    public function test_editor_can_delete_product(): void
    {
        $product = Product::factory()->create([
            'user_id' => auth()->id()
        ]);

        $this->assertDatabaseCount('products', 1);

        $this->delete(route('admin.products.destroy', $product));

        $this->assertDatabaseCount('products', 0);
    }

    public function test_customer_cannot_access_products(): void
    {
        $this->actingAs(User::factory()->create()->assignRole(Role::CUSTOMER->value));

        $response = $this->get(route('admin.products.index'));

        $response->assertForbidden();
    }

    public function test_customer_cannot_create_products(): void
    {
        $this->actingAs(User::factory()->create()->assignRole(Role::CUSTOMER->value));

        $response = $this->post(route('admin.products.store'), [
            'name' => fake()->words(3, true),
            'excerpt' => fake()->text(),
            'description' => fake()->text(1000),
            'price' => fake()->randomDigitNotZero() * 10,
        ]);

        $response->assertForbidden();
    }
}
