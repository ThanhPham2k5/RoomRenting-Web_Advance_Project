<?php

namespace Database\Factories;

use App\Helpers\VietnamAddress;
use App\Models\Account_User\Employee;
use App\Models\Account_User\User;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $province = VietnamAddress::randomProvince();
        $ward = VietnamAddress::randomWard($province['province_code']);

        $status = fake()->randomElement([
            'pending',
            'expired',
            'completed',
            'completed',
            'completed',
            'completed',
            'completed',
            'completed',
            'completed',
            'completed',
            'completed',
            'completed',
            'completed',
            'completed', // bias for completed posts
            'failed',
            'rejected'
        ]);

        return [
            'title' => fake()->randomElement([
                'Phòng trọ gần Đại học Quốc Gia',
                'Phòng trọ full nội thất Thủ Đức',
                'Cho thuê phòng trọ Quận 9',
                'Phòng trọ giá rẻ gần trung tâm',
                'Cho thuê phòng trọ mới xây',
                'Phòng trọ sạch sẽ, an ninh tốt',
            ]),

            'price' => fake()->numberBetween(1000000, 8000000),
            'area' => fake()->numberBetween(15, 60),

            'house_number' => fake()->buildingNumber(),
            'ward' => $ward['name'],
            'province' => $province['name'],

            'description' => fake()->randomElement([
                'Phòng rộng rãi, sạch sẽ, có wifi và chỗ để xe.',
                'Phòng mới xây, có ban công, gần chợ và siêu thị.',
                'Khu vực an ninh, yên tĩnh, phù hợp sinh viên.',
                'Có máy lạnh, nước nóng, internet tốc độ cao.',
                'Gần trường đại học và bến xe buýt.'
            ]),

            'deposit' => fake()->numberBetween(500000, 3000000),

            'status' => $status,
            'authorized' => $status === 'completed',

            'reason' => $status === 'rejected'
                ? fake()->randomElement([
                    'Thông tin không đầy đủ',
                    'Hình ảnh không rõ ràng',
                    'Nội dung vi phạm chính sách',
                    'Giá cả không hợp lý',
                    'Địa chỉ không chính xác'
                ])
                : null,

            'room_type' => fake()->randomElement(['room', 'apartment', 'dorm']),

            'next_payment_date' => $status === 'completed'
                ? now()->addMonth()
                : null,

            'max_occupants' => fake()->numberBetween(1, 6),
        ];
    }
}
