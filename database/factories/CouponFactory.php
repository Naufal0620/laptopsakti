<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['percentage', 'fixed']);
        return [
            'code' => $this->faker->unique()->lexify('PROMO???'),
            'type' => $type,
            'value' => $type === 'percentage' ? $this->faker->numberBetween(5, 50) : $this->faker->numberBetween(5000, 20000),
            'max_discount' => $type === 'percentage' ? 10000 : null,
            'min_order' => $this->faker->numberBetween(10000, 50000),
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'is_active' => true,
        ];
    }
}
