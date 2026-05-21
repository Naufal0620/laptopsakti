<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Initial Data
        $this->call([
            SettingSeeder::class,
            ProductSeeder::class,
            CouponSeeder::class,
        ]);

        // 2. Core Users (Admin & Sample Customer)
        User::factory()->admin()->create([
            'name' => 'Administrator Kulivio',
            'email' => 'admin@kulivio.com',
            'phone' => '628111111111',
        ]);

        $budi = User::factory()->create([
            'name' => 'Budi Pelanggan',
            'email' => 'user@kulivio.com',
            'phone' => '628222222222',
            'role' => 'customer',
        ]);

        // 3. More Random Users
        User::factory(10)->create(['role' => 'customer']);
        
        // 4. Couriers
        $this->call(CourierSeeder::class);

        // 5. Product Related (Videos & Images)
        $this->call([
            VideoSeeder::class,
            ProductImageSeeder::class,
        ]);

        // 6. Transactional Data (Orders)
        $this->call(OrderSeeder::class);
    }
}
