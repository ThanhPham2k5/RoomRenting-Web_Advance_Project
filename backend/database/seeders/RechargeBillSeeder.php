<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Payments\RechargeBill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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
            $cycles = rand(5, 10); // each account has 5–10 recharge bills

            for ($i = 0; $i < $cycles; $i++) {
                $billData = RechargeBill::factory()->make()->toArray();

                // create random created_at within the last 3 years
                $randomDate = Carbon::now()
                    ->subMonths(rand(0, 36)) // 36 months = 3 years
                    ->subDays(rand(0, 28));

                RechargeBill::create([
                    ...$billData,
                    'account_id' => $account->id,
                    'status' => $billData['status'],
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);
            }
        }
    }
}
