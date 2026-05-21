<?php

namespace Database\Factories;

use App\Models\Video;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()?->id ?? 1,
            'video_path' => 'videos/dummy_' . $this->faker->numberBetween(1, 5) . '.mp4',
            'thumbnail_path' => 'videos/thumbnails/dummy_' . $this->faker->numberBetween(1, 5) . '.jpg',
            'status' => 'ready',
        ];
    }
}
