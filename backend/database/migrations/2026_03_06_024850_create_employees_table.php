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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['admin', 'employee', 'postManager', 'billManager', 'userManager']);
            $table->dateTime('date_of_birth');
            $table->string('gender');
            $table->string('house_number');
            $table->string('ward');
            $table->string('province');
            $table->string('phone_number');
            $table->string('name');
            $table->string('pid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
