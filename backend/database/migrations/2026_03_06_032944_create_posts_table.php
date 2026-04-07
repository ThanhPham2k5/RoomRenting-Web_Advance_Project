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
            $table->decimal('price', 65, 0);
            $table->decimal('area', 65, 2);
            $table->string('house_number');
            $table->string('ward');
            $table->string('province');
            $table->text('description');
            $table->decimal('deposit', 65, 0);
            $table->enum('status', ['rejected', 'pending', 'expired', 'completed', 'failed']);
            $table->boolean('authorized');
            $table->enum('room_type', ['room', 'apartment', 'dorm']);
            $table->integer('max_occupants');
            $table->string('reason')->nullable();
            $table->date('next_payment_date')->nullable();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained()->nullOnDelete(); //post that haven't got approve doesn't have employee_id 

            $table->softDeletes();
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
