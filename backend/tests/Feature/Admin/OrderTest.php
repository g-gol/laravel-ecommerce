<?php

namespace Tests\Feature\Admin;

use App\Enums\OrderStatus;
use App\Enums\Role;
use App\Models\Order;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
        $this->actingAs(User::factory()->create()->assignRole(Role::EDITOR->value));
    }

    public function test_editor_can_access_orders(): void
    {
        $response = $this->get(route('admin.orders.index'));

        $response->assertOk();
    }

    public function test_editor_can_cancel_order(): void
    {
        $order = Order::factory()
            ->for(User::factory()->create()->assignRole(Role::CUSTOMER->value))
            ->create([
                'status' => OrderStatus::PENDING->value
            ]);

        $this->assertTrue($order->status === OrderStatus::PENDING->value);

        $this->patch(route('admin.orders.cancel', $order));

        $this->assertTrue($order->fresh()->status === OrderStatus::CANCELLED->value);
    }
}
