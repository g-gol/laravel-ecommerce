<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $user->assignRole('admin');
    }
}
