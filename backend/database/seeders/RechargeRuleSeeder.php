<?php

namespace Database\Seeders;

use App\Models\Payments\RechargeRule;
use Database\Factories\RechargeRuleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RechargeRuleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RechargeRuleFactory::new()->count(5)->create();
    }
}
