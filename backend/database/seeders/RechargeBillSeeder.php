<?php

namespace Database\Seeders;

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
        RechargeBill::factory()->count(40)->create();
    }
}
