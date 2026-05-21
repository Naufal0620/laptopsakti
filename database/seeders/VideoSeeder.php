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
        $faker = \Faker\Factory::create();
        $products = Product::all();

        foreach ($products as $product) {
            Video::create([
                'product_id' => $product->id,
                'video_path' => 'videos/dummy_' . $faker->numberBetween(1, 5) . '.mp4',
                'thumbnail_path' => 'videos/thumbnails/dummy_' . $faker->numberBetween(1, 5) . '.jpg',
                'status' => 'ready',
            ]);
        }
    }
}
