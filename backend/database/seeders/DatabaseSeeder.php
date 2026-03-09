<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AccountSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,

            PostSeeder::class,
            PostImageSeeder::class,
            CommentSeeder::class,
            FavoriteSeeder::class,

            FormSeeder::class,
            NotificationSeeder::class,
            PayBillSeeder::class,
            PayRuleSeeder::class,
            RechargeBillSeeder::class,
            RechargeRuleSeeder::class,
        ]);
    }
}
