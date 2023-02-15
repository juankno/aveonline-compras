<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $products = Product::inRandomOrder()->limit(3)->pluck('id');
            $customer = User::inRandomOrder()->where('role_id', User::ROLES['customer'])->first();

            $order = Order::create([
                'customer_id' => $customer->id,
                'quantity_products' => count($products),
            ]);

            $productsWithQuantity = [];
            foreach ($products as $key => $product) {
                $productsWithQuantity[$product] = ['quantity' => rand(1, 10)];
            }

            $order->products()->sync($productsWithQuantity);
        }
    }
}
