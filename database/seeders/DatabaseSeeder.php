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
        ]);

        // 2. Core Users (Admin)
        User::create([
            'name' => 'Administrator LaptopSakti',
            'email' => 'admin@laptopsakti.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => '628111111111',
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);
    }
}
