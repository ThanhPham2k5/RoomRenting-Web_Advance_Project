<?php

namespace Database\Factories;

use App\Models\Posts\Post;
use App\Models\Posts\PostImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts\PostImage>
 */
class PostImageFactory extends Factory
{
    protected $model = PostImage::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'image_post_url' => fake()->imageUrl(800, 600, 'house'),
        ];
    }
}
