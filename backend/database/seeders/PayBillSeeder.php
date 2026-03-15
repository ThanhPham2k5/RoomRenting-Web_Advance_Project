<?php

namespace Database\Seeders;

use App\Models\Payments\PayBill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayBillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayBill::factory()->count(40)->create();
    }
}
