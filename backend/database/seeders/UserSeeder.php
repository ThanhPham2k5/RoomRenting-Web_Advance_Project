<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use Exception;
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

        foreach($accounts as $account){
            User::create([
                'account_id' => $account->id,
                'personal_info_id' => $account->id,
                'points' => rand(0, 1000),
            ]);

            $personalInfo = PersonalInfo::where('id', $account->id)->first();

            //update profile
            $personalInfo->update([
                'profile_url' => $this->profile($personalInfo),
            ]);
        }   

    }

    private function profile($personalInfo)
    {   
        // fake image content
        $timeStamp = time();
        $path = "profiles/{$personalInfo->id}/avatar_{$timeStamp}.jpg";

        try{
            //get random profile
            $response = Http::withoutVerifying()
            ->withOptions(['allow_redirects' => true]) 
            ->get("https://picsum.photos/seed/{$personalInfo->id}/300");        

            // create dummy file
            Storage::disk('public')->put($path, $response->body());
        }catch(Exception $e){

        }
        
        return $path;
    }
}
