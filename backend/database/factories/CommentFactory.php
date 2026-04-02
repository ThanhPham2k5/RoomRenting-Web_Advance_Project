<?php

namespace Database\Factories;

use App\Models\Account_User\Account;
use App\Models\Posts\Comment;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts\Comment>
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
            'content' => fake()->randomElement([
                'Phòng này còn không ạ?',
                'Giá có thương lượng không?',
                'Có cho nuôi thú cưng không?',
                'Điện nước tính như thế nào?',
                'Có thể xem phòng vào cuối tuần không?',
                'Phòng này gần trường nào vậy?',
            ]),
        ];
    }
}
