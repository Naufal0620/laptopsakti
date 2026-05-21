<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\Product;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            Video::factory()->create([
                'product_id' => $product->id,
            ]);
        }
    }
}
