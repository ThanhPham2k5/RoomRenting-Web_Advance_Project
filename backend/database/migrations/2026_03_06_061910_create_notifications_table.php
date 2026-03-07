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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('content');
            
            $table->enum('status', ['read', 'unread']);
            $table->enum('notification_type', ['news', 'transaction']);
            
            $table->foreignId('account_id')->constrained()->cascadeOnDelete();
            $table->morphs('notifiable'); //polymorphic, could be from comment, post, recharge, pay
            // creates:
            // notifiable_id
            // notifiable_type

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
