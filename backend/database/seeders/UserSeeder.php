<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->count(20)->create();

        $accounts = Account::role('user')->get();
        $personalInfo = PersonalInfo::all();

        foreach($accounts as $index => $account){
            User::create([
                'account_id' => $account->id,
                'personal_info_id' => $personalInfo[$index]->id,
                'points' => rand(0, 1000),
            ]);
        }   
    }
}
