<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Create specific couriers
        User::create([
            'name' => 'Kurir Ahmad',
            'email' => 'kurir1@kulivio.com',
            'email_verified_at' => now(),
            'phone' => '628333333333',
            'password' => Hash::make('password'),
            'role' => 'courier',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Kurir Siti',
            'email' => 'kurir2@kulivio.com',
            'email_verified_at' => now(),
            'phone' => '628444444444',
            'password' => Hash::make('password'),
            'role' => 'courier',
            'remember_token' => Str::random(10),
        ]);

        // Create random couriers
        for ($i = 0; $i < 3; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'phone' => $faker->phoneNumber(),
                'role' => 'courier',
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
