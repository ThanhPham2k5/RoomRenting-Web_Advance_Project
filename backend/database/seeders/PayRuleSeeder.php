<?php

namespace Database\Seeders;

use App\Models\Payments\PayRule;
use Database\Factories\PayRuleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayRuleFactory::new()->count(5)->create();
    }
}
