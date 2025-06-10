<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_admin_can_access_users(): void  {
        $this->actingAs(User::factory()->create()->assignRole(Role::ADMIN->value));

        $response = $this->get(route('admin.users'));

        $response->assertStatus(200);
    }

    public function test_editor_cannot_access_users(): void
    {
        $this->actingAs(User::factory()->create()->assignRole(Role::EDITOR->value));

        $response = $this->get(route('admin.users'));

        $response->assertForbidden();
    }

    public function test_customer_cannot_access_users(): void
    {
        $this->actingAs(User::factory()->create()->assignRole(Role::CUSTOMER->value));

        $response = $this->get(route('admin.users'));

        $response->assertForbidden();
    }
}
