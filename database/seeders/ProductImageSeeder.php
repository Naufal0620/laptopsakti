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
        $products = Product::all();

        foreach ($products as $product) {
            // Ensure each product has 1 primary image and 2 additional images
            ProductImage::factory()->create([
                'product_id' => $product->id,
                'is_primary' => true,
            ]);

            ProductImage::factory(2)->create([
                'product_id' => $product->id,
                'is_primary' => false,
            ]);
        }
    }
}
