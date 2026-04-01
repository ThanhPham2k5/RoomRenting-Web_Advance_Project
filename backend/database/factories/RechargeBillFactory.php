<?php

namespace Database\Factories;

use App\Models\Payments\RechargeBill;
use App\Models\Account_User\Account;
use App\Models\Payments\RechargeRule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments\RechargeBill>
 */
class RechargeBillFactory extends Factory
{
    protected $model = RechargeBill::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rule = RechargeRule::all()->random(); // get random rule
        $money = $this->faker->randomFloat(2, 50000, 500000);
        $vatRate = 0.1;
        $vat = round($money * $vatRate, 2);
        $totalMoney = $money + $vat;
        $points = $totalMoney * $rule->points / $rule->money;

        return [
            'money' => $money,
            'total_money' => $totalMoney,
            'vat' => $vat,
            'points' => $points,
            'status' => $this->faker->randomElement(['completed', 'pending', 'failed']),
            'recharge_rule_id' =>$rule->id
        ];
    }

    /**
     * Indicate that the recharge bill is completed.
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
     * Indicate that the recharge bill is pending.
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
     * Indicate that the recharge bill is failed.
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
     * Set a specific money amount for the recharge bill.
     *
     * @param float $money
     * @return static
     */
    public function withMoney(float $money): static
    {
        $vatRate = $this->faker->randomFloat(2, 0, 0.1);
        $vat = round($money * $vatRate, 2);
        $totalMoney = $money + $vat;

        return $this->state(fn(array $attributes) => [
            'money' => $money,
            'vat' => $vat,
            'total_money' => $totalMoney,
        ]);
    }

    /**
     * Set a specific VAT rate for the recharge bill.
     *
     * @param float $vatRate
     * @return static
     */
    public function withVatRate(float $vatRate): static
    {
        return $this->state(function (array $attributes) use ($vatRate) {
            $money = $attributes['money'] ?? $this->faker->randomFloat(2, 50000, 500000);
            $vat = round($money * $vatRate, 2);
            $totalMoney = $money + $vat;

            return [
                'money' => $money,
                'vat' => $vat,
                'total_money' => $totalMoney,
            ];
        });
    }

    /**
     * Set the recharge bill to use a specific account.
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
     * Set the recharge bill to use a specific recharge rule.
     *
     * @param mixed $rechargeRule
     * @return static
     */
    public function forRechargeRule($rechargeRule): static
    {
        return $this->state(fn(array $attributes) => [
            'recharge_rule_id' => $rechargeRule->id,
        ]);
    }
}
