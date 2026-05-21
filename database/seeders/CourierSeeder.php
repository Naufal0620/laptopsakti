<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create specific couriers
        User::factory()->create([
            'name' => 'Kurir Ahmad',
            'email' => 'kurir1@kulivio.com',
            'phone' => '628333333333',
            'password' => Hash::make('password'),
            'role' => 'courier',
        ]);

        User::factory()->create([
            'name' => 'Kurir Siti',
            'email' => 'kurir2@kulivio.com',
            'phone' => '628444444444',
            'password' => Hash::make('password'),
            'role' => 'courier',
        ]);

        // Create random couriers
        User::factory(3)->create(['role' => 'courier']);
    }
}
