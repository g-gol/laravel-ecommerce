<?php

namespace Tests\Feature\Admin;

use App\Enums\Role;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
        $this->actingAs(User::factory()->create()->assignRole(Role::ADMIN->value));
    }


    protected function getGenericUserData(
        array $roles,
        string $username = 'ozon671',
        string $email = 'asdf@afd',
        ?string $password = 'qwerty123',
        ?string $verify = null
    ): array {
        return compact('username', 'email', 'password', 'roles', 'verify');
    }

    public function test_admin_can_access_users(): void
    {
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

    public function test_admin_can_update_user_role(): void
    {
        $user = User::factory()->create()->assignRole(Role::EDITOR->value);

        $this->put(
            route('admin.users.update', $user),
            $this->getGenericUserData(roles: [Role::ADMIN->value])
        );

        $this->assertTrue($user->fresh()->hasRole(Role::ADMIN->value));
    }

    public function test_user_can_be_updated_with_absent_password_form_field(): void
    {
        $user = User::factory()->create()->assignRole(Role::EDITOR->value);

        $response = $this->put(
            route('admin.users.update', $user),
            $this->getGenericUserData(roles: [Role::CUSTOMER->value], password: null)
        );


        $this->assertFalse(Hash::check('', $user->fresh()->password));
        $response->assertRedirect();
        $this->assertEmpty(session('errors'));
    }

    public function test_admin_can_verify_email(): void
    {
        $user = User::factory()
            ->create(['email_verified_at' => null])
            ->assignRole(Role::CUSTOMER->value);

        $this->put(
            route('admin.users.update', $user),
            $this->getGenericUserData([Role::CUSTOMER->value], verify: 'on')
        );

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }

    public function test_admin_can_delete_user(): void
    {
        $user = User::factory()->create();

        $this->delete(route('admin.users.delete', $user));

        $this->assertModelMissing($user);
    }
}
