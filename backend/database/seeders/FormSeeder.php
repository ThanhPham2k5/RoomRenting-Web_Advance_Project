<?php

namespace Database\Seeders;

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
        Form::factory()->count(40)->create();
    }
}
