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
                'name' => 'Asus ROG Zephyrus G14',
                'description' => 'Laptop gaming ultraportable 14 inci terbaik dengan prosesor AMD Ryzen 9 dan NVIDIA RTX 4060, layar ROG Nebula HDR, dan desain ringkas premium.',
                'price' => 28999000,
                'is_active' => true,
            ],
            [
                'name' => 'Apple MacBook Air M3',
                'description' => 'Laptop tertipis dan teringan dari Apple kini dengan chip M3 yang super cepat, baterai tahan hingga 18 jam, dan layar Liquid Retina yang memukau.',
                'price' => 17499000,
                'is_active' => true,
            ],
            [
                'name' => 'Lenovo ThinkPad X1 Carbon Gen 11',
                'description' => 'Laptop bisnis legendaris kelas enterprise dengan sasis serat karbon yang ringan dan kokoh, keyboard terbaik di industri, serta fitur keamanan tingkat tinggi.',
                'price' => 24500000,
                'is_active' => true,
            ],
            [
                'name' => 'HP Pavilion 14',
                'description' => 'Laptop harian serbaguna yang handal dengan prosesor Intel Core i5, RAM 16GB, penyimpanan SSD cepat, cocok untuk pelajar dan pekerja kantoran.',
                'price' => 9499000,
                'is_active' => true,
            ],
            [
                'name' => 'Dell XPS 13',
                'description' => 'Laptop ultrabook premium dengan layar InfinityEdge 4K bezel-less, performa kencang dengan Intel Evo, dan material aluminium CNC yang mewah.',
                'price' => 21999000,
                'is_active' => true,
            ],
            [
                'name' => 'Acer Swift Go 14',
                'description' => 'Laptop tipis stylish dengan layar OLED 2.8K yang tajam dan akurat, ditenagai prosesor Intel Core Ultra terbaru berkemampuan AI.',
                'price' => 11999000,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
