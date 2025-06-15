<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
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

        $users = User::factory(20)->create();

        $users->map(function ($user) use ($roles) {
            $user->assignRole(Arr::random($roles));
        });

        $products = Product::factory(100)->create(function () use ($users) {
            return [
                'user_id' => $users->random()->id
            ];
        });

        Order::factory(200)->make()->each(function ($order) use ($products, $users) {
            $order->user_id = $users->random()->id;
            $order->save();

            OrderItem::factory(3)->make()->each(function ($item) use ($products, $order) {
                $product = $products->random();
                $item->order_id = $order->id;
                $item->product_id = $product->id;
                $item->quantity = rand(1, 5);
                $item->price = $product->price;

                $item->save();
            });

            $total = $order->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $order->total = $total;
            $order->save();
        });
    }
}
