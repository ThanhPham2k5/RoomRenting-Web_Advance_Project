<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Account_User\Employee;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use Database\Factories\AccountFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


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

                //update profile
                $personalInfo->update([
                    'profile_url' => $this->profile($personalInfo),
                ]);
            }
        }
        
    }

    private function profile($personalInfo)
    {   
        // fake image content
        $path = "profiles/{$personalInfo->employee->account_id}/avatar.jpg";

        //get random profile
        $response = Http::withoutVerifying()
        ->withOptions(['allow_redirects' => true]) 
        ->get("https://picsum.photos/seed/{$personalInfo->employee->account_id}/300");
        
        // create dummy file
        Storage::disk('public')->put($path, $response->body());

        return $path;
    }
}
