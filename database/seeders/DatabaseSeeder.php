<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // 1. Initial Data
        $this->call([
            SettingSeeder::class,
            ProductSeeder::class,
            CouponSeeder::class,
        ]);

        // 2. Core Users (Admin & Sample Customer)
        User::create([
            'name' => 'Administrator Kulivio',
            'email' => 'admin@kulivio.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => '628111111111',
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        $budi = User::create([
            'name' => 'Budi Pelanggan',
            'email' => 'user@kulivio.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => '628222222222',
            'role' => 'customer',
            'remember_token' => Str::random(10),
        ]);

        // 3. More Random Users
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'phone' => $faker->phoneNumber(),
                'role' => 'customer',
                'remember_token' => Str::random(10),
            ]);
        }
        
        // 4. Couriers
        $this->call(CourierSeeder::class);

        // 5. Transactional Data (Orders)
        $this->call(OrderSeeder::class);
    }
}
