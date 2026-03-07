<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('house_number');
            $table->string('ward');
            $table->string('province');
            $table->string('phone_number')->unique();
            $table->string('profile_url');
            $table->string('name');
            $table->string('pid')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
};
