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
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('house_number')->nullable();
            $table->string('ward')->nullable();
            $table->string('province')->nullable();
            $table->string('email');
            $table->string('phone_number')->unique();
            $table->string('profile_url')->nullable();
            $table->string('name')->nullable();
            $table->string('pid')->unique()->nullable();

            $table->softDeletes();
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
