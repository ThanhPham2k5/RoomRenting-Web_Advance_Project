<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Payments\RechargeBill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RechargeBillSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = Account::role('user')->get();

        foreach($accounts as $account){
            if($account->user->points > 0){

                $cycles = rand(1, 3);

            for ($i = 0; $i < $cycles; $i++) {

                $bill = RechargeBill::factory()
                    ->make([
                        'account_id' => $account->id,
                    ]);

                // create record
                $bill = RechargeBill::create([
                    ...$bill->toArray(),
                    'account_id' => $account->id,
                    'created_at' => now()->subDays(rand(0, 30)),
                ]);
            }
            }
        }
    }
}
