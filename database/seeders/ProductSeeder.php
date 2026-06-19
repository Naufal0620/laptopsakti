<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Lapis Legit Premium',
                'description' => 'Kue lapis tradisional dengan aroma bumbu spekuk yang harum dan tekstur lembut berminyak yang mewah.',
                'price' => 250000,
                'discount_type' => 'fixed',
                'discount_value' => 25000,
                'pre_order_days' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Bika Ambon Medan',
                'description' => 'Kue khas Medan dengan tekstur bersarang yang kenyal dan rasa nira yang autentik.',
                'price' => 65000,
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'pre_order_days' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Lumpia Semarang Rebung',
                'description' => 'Lumpia goreng renyah dengan isian rebung manis gurih, telur, dan udang, disajikan dengan saus kental spesial.',
                'price' => 12000,
                'discount_type' => 'none',
                'discount_value' => 0,
                'pre_order_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Dadar Gulung Pandan',
                'description' => 'Dadar tipis aroma pandan suji berisi unti kelapa manis yang legit.',
                'price' => 5000,
                'discount_type' => 'none',
                'discount_value' => 0,
                'pre_order_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Serabi Notosuman Solo',
                'description' => 'Serabi tipis lembut dengan santan kental yang gurih, tersedia varian original dan cokelat.',
                'price' => 28000,
                'discount_type' => 'fixed',
                'discount_value' => 3000,
                'pre_order_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Lemper Ayam Spesial',
                'description' => 'Ketan kukus gurih berisi suwiran ayam berbumbu melimpah, dibungkus rapi dengan daun pisang.',
                'price' => 6000,
                'discount_type' => 'percentage',
                'discount_value' => 5,
                'pre_order_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Kue Ku (Angku Kue)',
                'description' => 'Kue ketan kenyal berwarna merah berbentuk kura-kura dengan isian kacang hijau kupas yang manis halus.',
                'price' => 5500,
                'discount_type' => 'none',
                'discount_value' => 0,
                'pre_order_days' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
