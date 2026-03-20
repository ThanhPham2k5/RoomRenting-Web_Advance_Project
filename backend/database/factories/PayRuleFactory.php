<?php

namespace Database\Factories;

use App\Models\Payments\PayRule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments\PayRule>
 */
class PayRuleFactory extends Factory
{
    protected $model = PayRule::class;

    public function newModel(array $attributes = [])
    {
        return new \App\Models\Payments\PayRule($attributes);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'points' => $this->faker->numberBetween(10, 50),
        ];
    }

    /**
     * Indicate that the pay rule is a budget option (low points).
     *
     * @return static
     */
    public function budget(): static
    {
        return $this->state(fn(array $attributes) => [
            'points' => $this->faker->numberBetween(10, 50),
        ]);
    }

    /**
     * Indicate that the pay rule is a standard option (medium points).
     *
     * @return static
     */
    public function standard(): static
    {
        return $this->state(fn(array $attributes) => [
            'points' => $this->faker->numberBetween(50, 200),
        ]);
    }

    /**
     * Indicate that the pay rule is a premium option (high points).
     *
     * @return static
     */
    public function premium(): static
    {
        return $this->state(fn(array $attributes) => [
            'points' => $this->faker->numberBetween(200, 1000),
        ]);
    }

    /**
     * Set a specific number of points for the pay rule.
     *
     * @param int $points
     * @return static
     */
    public function withPoints(int $points): static
    {
        return $this->state(fn(array $attributes) => [
            'points' => $points,
        ]);
    }
}
