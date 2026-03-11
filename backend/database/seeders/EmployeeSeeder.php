<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Account_User\Employee;
use App\Models\Account_User\PersonalInfo;
use Database\Factories\AccountFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Employee::factory()->count(5)->create();
        $roles = [
            'postManager',
            'billManager',
            'userManager'
        ];

        foreach ($roles as $role) {
            $account = Account::factory()->create([
                'role' => $role
            ]);

            $personalInfo = PersonalInfo::factory()->create();

            Employee::create([
                'account_id' => $account->id,
                'personal_info_id' => $personalInfo->id
            ]);
        }
        
    }
}
