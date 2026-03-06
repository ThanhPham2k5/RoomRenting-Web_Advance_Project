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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->double('area');
            $table->string('house_number');
            $table->string('ward');
            $table->string('province');
            $table->text('description');
            $table->decimal('deposit', 10, 2);
            $table->enum('status', ['rejected', 'pending', 'expired', 'completed', 'failed']);
            $table->boolean('authorized');
            $table->enum('room_type', ['rental_rooms', 'mini_apartments', 'dormitories']);
            $table->integer('max_occupants');

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained()->nullOnDelete(); //post that haven't got approve doesn't have employee_id 


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
