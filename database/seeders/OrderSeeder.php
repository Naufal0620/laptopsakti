<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = User::where('role', 'customer')->get();
        $couriers = User::where('role', 'courier')->get();
        $products = Product::all();

        if ($customers->isEmpty() || $products->isEmpty()) {
            return;
        }

        foreach ($customers as $customer) {
            // Create 2 orders per customer
            Order::factory(2)->create([
                'user_id' => $customer->id,
                'courier_id' => $couriers->random()->id,
            ])->each(function ($order) use ($products) {
                // Add 1-3 items per order
                $randomProducts = $products->random(rand(1, 3));
                foreach ($randomProducts as $product) {
                    OrderItem::factory()->create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'price_at_time' => $product->price,
                    ]);
                }
            });
        }
    }
}
