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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->decimal('price_max', 12, 0)->nullable();
            $table->decimal('price_min', 12, 0)->nullable();
            $table->decimal('area', 8, 2)->nullable();
            $table->string('ward')->nullable();
            $table->string('province')->nullable();
            $table->enum('room_type', ['room', 'apartment', 'dorm'])->nullable();
            $table->integer('max_occupants')->nullable();

            $table->foreignId('account_id')->unique()->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
