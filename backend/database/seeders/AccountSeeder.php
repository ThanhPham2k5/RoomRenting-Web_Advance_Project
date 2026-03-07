<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create([ //create a useable admin
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);
    }
}
