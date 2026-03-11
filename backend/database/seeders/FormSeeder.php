<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Form;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create forms for rooms
        $accounts = Account::all();

        foreach ($accounts as $account) {
            Form::factory()->create([
                'account_id' => $account->id
            ]);
        }
    }
}
