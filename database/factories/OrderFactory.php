<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total_price = \fake()->numberBetween(50000, 200000);
        $shipping_cost = 10000;
        $discount = 0;
        $grand_total = $total_price + $shipping_cost - $discount;

        return [
            'user_id' => User::where('role', 'customer')->inRandomOrder()->first()?->id ?? User::factory(),
            'courier_id' => User::where('role', 'courier')->inRandomOrder()->first()?->id,
            'coupon_id' => Coupon::inRandomOrder()->first()?->id,
            'delivery_address' => \fake()->address(),
            'delivery_lat' => \fake()->latitude(-7.0, -6.0),
            'delivery_lng' => \fake()->longitude(106.0, 108.0),
            'distance_km' => \fake()->randomFloat(2, 1, 15),
            'total_price' => $total_price,
            'shipping_cost' => $shipping_cost,
            'discount_amount' => $discount,
            'grand_total' => $grand_total,
            'status' => \fake()->randomElement(['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled']),
            'expected_ready_date' => now()->addDays(2),
        ];
    }
}
