<?php

namespace Database\Factories;

use App\Helpers\VietnamAddress;
use App\Models\Account_User\PersonalInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalInfo>
 */
class PersonalInfoFactory extends Factory
{

    protected $model = PersonalInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array{

        $province = VietnamAddress::randomProvince();
        $ward = VietnamAddress::randomWard($province['province_code']);

        return [
            'name' => fake()->name(),
            'date_of_birth' => fake()->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
            'gender' => fake()->randomElement(['male', 'female']),
            'house_number' => fake()->buildingNumber(),
            'ward' => $ward['name'],
            'province' => $province['name'],
            'email' => $this->faker()->unque()->email(),
            'phone_number' => fake()->unique()->numerify('0#########'),
            'profile_url' => fake()->imageUrl(200,200,'people'),
            'pid' => fake()->unique()->numerify('###########'),
        ];
    }
}
