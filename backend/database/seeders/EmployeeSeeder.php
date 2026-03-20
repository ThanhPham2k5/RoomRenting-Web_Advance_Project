<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Account_User\Employee;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
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
        
        // $roles = [
        //     'postManager',
        //     'billManager',
        //     'userManager'
        // ];

        // foreach ($roles as $role) {
        //     $account = Account::factory()->create([
        //         'role' => $role
        //     ]);

        //     $personalInfo = PersonalInfo::factory()->create();

        //     Employee::create([
        //         'account_id' => $account->id,
        //         'personal_info_id' => $personalInfo->id
        //     ]);
        // }



        $roles = ['admin', 'postManager', 'billManager', 'userManager'];

        // Get all used personal_info_ids
        $usedIds = collect()
            ->merge(User::pluck('personal_info_id'))
            ->merge(Employee::pluck('personal_info_id'));

        // Get available personal infos
        $availablePersonalInfos = PersonalInfo::whereNotIn('id', $usedIds)->get();

        foreach ($roles as $role) {
            $accounts = Account::role($role)->get();

            foreach ($accounts as $account) {

                if ($availablePersonalInfos->isEmpty()) {
                    throw new \Exception('Not enough PersonalInfo records!');
                }

                $personalInfo = $availablePersonalInfos->shift(); // take 1 and remove

                Employee::create([
                    'account_id' => $account->id,
                    'personal_info_id' => $personalInfo->id,
                ]);
            }
        }
        
    }
}
