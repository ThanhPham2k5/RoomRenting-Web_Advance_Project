<?php

namespace Database\Factories;

use App\Helpers\VietnamAddress;
use App\Models\Account_User\Employee;
use App\Models\Account_User\User;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
            'failed'
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

            'authorized' => $status === 'completed', // chưa duyệt thì = 0

            'room_type' => fake()->randomElement([
                'room',
                'apartment',
                'dorm'
            ]),

            'next_payment_date' => $status === 'completed' ? now()->addMonth() : null,

            'max_occupants' => fake()->numberBetween(1,6),

            'user_id' => User::inRandomOrder()->first()->id,

            'employee_id' => $status === 'completed' // chưa duyệt thì NULL
                        ? Employee::inRandomOrder()->first()->id
                        : null,
        ];
    }
}
