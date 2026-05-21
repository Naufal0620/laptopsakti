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
                'name' => 'Sayur Segar',
                'description' => 'Paket sayuran segar pilihan langsung dari petani lokal, cocok untuk masakan rumahan sehat.',
                'price' => 15000,
                'discount_type' => 'none',
                'discount_value' => 0,
                'pre_order_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Cookie Ice Cream Sandwich',
                'description' => 'Kombinasi sempurna antara soft cookie cokelat dan es krim vanilla premium di tengahnya.',
                'price' => 25000,
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'pre_order_days' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Dorito Chips',
                'description' => 'Keripik jagung renyah dengan bumbu keju nacho yang melimpah dan gurih.',
                'price' => 12000,
                'discount_type' => 'none',
                'discount_value' => 0,
                'pre_order_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Sour Bread',
                'description' => 'Roti sourdough autentik dengan tekstur kenyal dan rasa sedikit asam yang khas, tanpa pengawet.',
                'price' => 30000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'pre_order_days' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Pizza',
                'description' => 'Pizza artisan dengan topping mozzarella lumer, daging pilihan, dan saus tomat rahasia.',
                'price' => 85000,
                'discount_type' => 'none',
                'discount_value' => 0,
                'pre_order_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Sugar Sour Bread',
                'description' => 'Varian sourdough dengan sentuhan gula karamel di bagian kulit luar yang renyah.',
                'price' => 35000,
                'discount_type' => 'none',
                'discount_value' => 0,
                'pre_order_days' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Kebab',
                'description' => 'Kebab isi daging sapi panggang melimpah, sayuran segar, dan saus spesial kulivio.',
                'price' => 22000,
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'pre_order_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Sop Dumpling',
                'description' => 'Sop kaldu ayam bening dengan dumpling isi ayam udang yang lembut dan hangat.',
                'price' => 45000,
                'discount_type' => 'none',
                'discount_value' => 0,
                'pre_order_days' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Cheese Cake',
                'description' => 'New York style cheesecake yang creamy dan lembut dengan crust biskuit yang gurih.',
                'price' => 150000,
                'discount_type' => 'fixed',
                'discount_value' => 20000,
                'pre_order_days' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Ribs and Fries',
                'description' => 'Iga sapi panggang empuk dengan bumbu BBQ meresap, disajikan dengan kentang goreng renyah.',
                'price' => 125000,
                'discount_type' => 'none',
                'discount_value' => 0,
                'pre_order_days' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
