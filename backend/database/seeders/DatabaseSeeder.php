<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class
        ]);

        $user = User::factory()->create([
            'username' => 'george',
            'email' => 'qwe@qwe.com',
            'password' => 'qwerty123'
        ]);

        $roles = Role::toArray();
        $user->assignRole(Role::ADMIN->value);

        $users = User::factory(50)->create();

        $users->map(function ($user) use ($roles) {
            $user->assignRole(Arr::random($roles));
        });
    }
}
