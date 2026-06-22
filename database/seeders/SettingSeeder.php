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
            ['key' => 'admin_whatsapp_number'],
            [
                'display_name' => 'Nomor WhatsApp Penjual',
                'value' => '6285270110305',
                'type' => 'string',
                'group' => 'general',
            ]
        );
    }
}
