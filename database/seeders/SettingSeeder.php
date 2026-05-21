<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'shipping_cost_per_km'],
            [
                'display_name' => 'Tarif Ongkir per KM',
                'value' => '2000',
                'type' => 'integer',
                'group' => 'shipping',
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'admin_whatsapp_number'],
            [
                'display_name' => 'Nomor WhatsApp Admin',
                'value' => '6285270110305',
                'type' => 'string',
                'group' => 'general',
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'store_latitude'],
            [
                'display_name' => 'Latitude Toko',
                'value' => '-6.2088',
                'type' => 'string',
                'group' => 'shipping',
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'store_longitude'],
            [
                'display_name' => 'Longitude Toko',
                'value' => '106.8456',
                'type' => 'string',
                'group' => 'shipping',
            ]
        );
    }
}
