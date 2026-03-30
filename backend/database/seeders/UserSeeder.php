<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

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
        //get random profile
        // $response = Http::withoutVerifying()->get('https://picsum.photos/300');

        $response = Http::withoutVerifying()
        ->withOptions(['allow_redirects' => true]) 
        ->get("https://picsum.photos/seed/{$personalInfo->user->account_id}/300");
        

        // create dummy file
        Storage::disk('public')->put($path, $response->body());

        return $path;
    }
}
