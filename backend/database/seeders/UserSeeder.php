<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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

            //update profile
            $personalInfo[$index]->update([
                'profile_url' => $this->profile($personalInfo[$index]),
            ]);
        }   

    }

    private function profile($personalInfo)
    {   
        // fake image content
        $path = "profiles/{$personalInfo->user->account_id}/avatar.jpg";
        

        // create dummy file
        Storage::disk('public')->put($path, file_get_contents('https://picsum.photos/300'));

        return $path;
    }
}
