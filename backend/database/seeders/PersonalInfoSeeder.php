<?php

namespace Database\Seeders;

use App\Models\Account_User\PersonalInfo;
use Illuminate\Database\Seeder;

class PersonalInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalInfo::factory()->count(50)->create(); //might be unecessary
    }
}
