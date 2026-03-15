<?php

namespace Database\Factories;

use App\Models\Account_User\Account;
use App\Models\Posts\Comment;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->sentence(),

            'account_id' => Account::inRandomOrder()->first()->id,

            'post_id' => Post::inRandomOrder()->first()->id,
        ];
    }
}
