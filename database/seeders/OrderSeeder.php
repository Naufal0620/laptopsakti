<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $customers = User::where('role', 'customer')->get();
        $couriers = User::where('role', 'courier')->get();
        $products = Product::all();
        $coupons = Coupon::all();

        if ($customers->isEmpty() || $products->isEmpty()) {
            return;
        }

        foreach ($customers as $customer) {
            // Create 2 orders per customer
            for ($i = 0; $i < 2; $i++) {
                $total_price = $faker->numberBetween(50000, 200000);
                $shipping_cost = 10000;
                $discount = 0;
                $grand_total = $total_price + $shipping_cost - $discount;

                $order = Order::create([
                    'user_id' => $customer->id,
                    'courier_id' => $couriers->random()->id,
                    'coupon_id' => $coupons->isEmpty() ? null : $coupons->random()->id,
                    'delivery_address' => $faker->address(),
                    'delivery_lat' => $faker->latitude(-7.0, -6.0),
                    'delivery_lng' => $faker->longitude(106.0, 108.0),
                    'distance_km' => $faker->randomFloat(2, 1, 15),
                    'total_price' => $total_price,
                    'shipping_cost' => $shipping_cost,
                    'discount_amount' => $discount,
                    'grand_total' => $grand_total,
                    'status' => $faker->randomElement(['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled']),
                    'expected_ready_date' => now()->addDays(2),
                ]);

                // Add 1-3 items per order
                $randomProducts = $products->random(rand(1, 3));
                foreach ($randomProducts as $product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $faker->numberBetween(1, 5),
                        'price_at_time' => $product->price,
                    ]);
                }
            }
        }
    }
}
