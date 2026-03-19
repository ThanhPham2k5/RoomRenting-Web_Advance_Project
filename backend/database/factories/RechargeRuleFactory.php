<?php

namespace Database\Factories;

use App\Models\Payments\RechargeRule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments\RechargeRule>
 */
class RechargeRuleFactory extends Factory
{
    protected $model = RechargeRule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'points' => $this->faker->numberBetween(100, 5000),
            'money' => $this->faker->numberBetween(50000, 500000),
        ];
    }

    /**
     * Indicate that the recharge rule is a budget option (low points and money).
     *
     * @return static
     */
    public function budget(): static
    {
        return $this->state(fn(array $attributes) => [
            'points' => $this->faker->numberBetween(100, 500),
            'money' => $this->faker->randomFloat(2, 50000, 100000),
        ]);
    }

    /**
     * Indicate that the recharge rule is a standard option (medium points and money).
     *
     * @return static
     */
    // public function standard(): static
    // {
    //     return $this->state(fn(array $attributes) => [
    //         'points' => $this->faker->numberBetween(500, 2000),
    //         'money' => $this->faker->randomFloat(2, 100000, 300000),
    //     ]);
    // }

    // /**
    //  * Indicate that the recharge rule is a premium option (high points and money).
    //  *
    //  * @return static
    //  */
    // public function premium(): static
    // {
    //     return $this->state(fn(array $attributes) => [
    //         'points' => $this->faker->numberBetween(2000, 5000),
    //         'money' => $this->faker->randomFloat(2, 300000, 500000),
    //     ]);
    // }

    /**
     * Set a specific number of points for the recharge rule.
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

    /**
     * Set a specific money amount for the recharge rule.
     *
     * @param float $money
     * @return static
     */
    public function withMoney(float $money): static
    {
        return $this->state(fn(array $attributes) => [
            'money' => $money,
        ]);
    }
}
