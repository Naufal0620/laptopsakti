<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $products = Product::all();

        foreach ($products as $product) {
            // Ensure each product has 1 primary image and 2 additional images
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'products/dummy_' . $faker->numberBetween(1, 10) . '.jpg',
                'is_primary' => true,
            ]);

            for ($i = 0; $i < 2; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'products/dummy_' . $faker->numberBetween(1, 10) . '.jpg',
                    'is_primary' => false,
                ]);
            }
        }
    }
}
