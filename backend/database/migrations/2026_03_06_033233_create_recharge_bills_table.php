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
        Schema::create('recharge_bills', function (Blueprint $table) {
            $table->id();

            $table->decimal('money', 30, 0);
            $table->decimal('total_money', 30, 0);
            $table->integer('points');
            $table->decimal('vat', 8, 2);
            $table->enum('status', ['completed', 'pending', 'failed']);

            $table->foreignId('account_id')->constrained()->cascadeOnDelete();
            $table->foreignId('recharge_rule_id')->constrained()->cascadeOnDelete();
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recharge_bills');
    }
};
