<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'code' => 'HEMAT10',
            'type' => 'percentage',
            'value' => 10,
            'max_discount' => 10000,
            'min_order' => 50000,
            'start_date' => now(),
            'end_date' => now()->addMonths(1),
            'usage_limit' => 100,
            'is_active' => true,
        ]);

        Coupon::create([
            'code' => 'DISKON5RB',
            'type' => 'fixed',
            'value' => 5000,
            'min_order' => 20000,
            'is_active' => true,
        ]);
    }
}
