<?php

namespace Database\Factories;

use App\Models\Account_User\Account;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account_User\Account>
 */
class UserFactory extends Factory
{

    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'points'=>fake()->numberBetween(0, 1000),

            'account_id'=>Account::factory()->state([ //automically create an associated account
                'role'=>'user'
            ]),
            'personal_info_id'=>PersonalInfo::factory(), //automically create an associated persionalInfo
        ];
    }
}
