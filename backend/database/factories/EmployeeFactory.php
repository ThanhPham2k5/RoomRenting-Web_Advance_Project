<?php

namespace Database\Factories;

use App\Models\Account_User\Account;
use App\Models\Account_User\Employee;
use App\Models\Account_User\PersonalInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{

    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id'=>Account::factory()->state([ //automically create an associated account
                'role'=>fake()->randomElement([
                    'admin',
                    'postManager',
                    'billManager',
                    'userManager'
                ])
            ]),

            'personal_info_id'=>PersonalInfo::factory(), //automically create an associated persionalInfo
        ];
    }
}
