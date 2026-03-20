<?php

namespace Database\Factories;

use App\Helpers\VietnamAddress;
use App\Models\Form;
use App\Models\Account_User\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Form>
 */
class FormFactory extends Factory
{
    protected $model = Form::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $province = VietnamAddress::randomProvince();
        $ward = VietnamAddress::randomWard($province['province_code']);
        return [
            'price_min' => $this->faker->numberBetween(1000000, 5000000),
            'price_max' => $this->faker->numberBetween(5000001, 15000000),
            'area' => $this->faker->randomFloat(2, 20, 200),
            'ward' => $ward['name'],
            'province' => $province['name'],
            'room_type' => $this->faker->randomElement(['room', 'apartment', 'dorm']),
            'max_occupants' => $this->faker->numberBetween(1, 10),
        ];
    }

    /**
     * Indicate that the form is for a room.
     *
     * @return static
     */
    public function room(): static
    {
        return $this->state(fn(array $attributes) => [
            'room_type' => 'room',
        ]);
    }

    /**
     * Indicate that the form is for an apartment.
     *
     * @return static
     */
    public function apartment(): static
    {
        return $this->state(fn(array $attributes) => [
            'room_type' => 'apartment',
        ]);
    }

    /**
     * Indicate that the form is for a dorm.
     *
     * @return static
     */
    public function dorm(): static
    {
        return $this->state(fn(array $attributes) => [
            'room_type' => 'dorm',
        ]);
    }

    /**
     * Indicate that the form has a specific price range.
     *
     * @param int $min
     * @param int $max
     * @return static
     */
    public function priceRange(int $min, int $max): static
    {
        return $this->state(fn(array $attributes) => [
            'price_min' => $min,
            'price_max' => $max,
        ]);
    }

    /**
     * Indicate that the form has a specific area range.
     *
     * @param float $area
     * @return static
     */
    public function area(float $area): static
    {
        return $this->state(fn(array $attributes) => [
            'area' => $area,
        ]);
    }
}
