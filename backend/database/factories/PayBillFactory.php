<?php

namespace Database\Factories;

use App\Models\Payments\PayBill;
use App\Models\Payments\PayRule;
use App\Models\Account_User\Account;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments\PayBill>
 */
class PayBillFactory extends Factory
{
    protected $model = PayBill::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'points' => $this->faker->numberBetween(10, 1000),
            'status' => $this->faker->randomElement(['completed', 'pending', 'failed']),
            'account_id' => Account::inRandomOrder()->first()->id,
            'post_id' => Post::inRandomOrder()->first()->id,
            'pay_rule_id' => PayRule::inRandomOrder()->first()->id,
        ];
    }

    /**
     * Indicate that the pay bill is completed.
     *
     * @return static
     */
    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the pay bill is pending.
     *
     * @return static
     */
    public function pending(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the pay bill is failed.
     *
     * @return static
     */
    public function failed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'failed',
        ]);
    }

    /**
     * Set a specific number of points for the pay bill.
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
     * Set the pay bill to use a specific account.
     *
     * @param mixed $account
     * @return static
     */
    public function forAccount($account): static
    {
        return $this->state(fn(array $attributes) => [
            'account_id' => $account->id,
        ]);
    }

    /**
     * Set the pay bill to use a specific post.
     *
     * @param mixed $post
     * @return static
     */
    public function forPost($post): static
    {
        return $this->state(fn(array $attributes) => [
            'post_id' => $post->id,
        ]);
    }

    /**
     * Set the pay bill to use a specific pay rule.
     *
     * @param mixed $payRule
     * @return static
     */
    public function forPayRule($payRule): static
    {
        return $this->state(fn(array $attributes) => [
            'pay_rule_id' => $payRule->id,
        ]);
    }
}
