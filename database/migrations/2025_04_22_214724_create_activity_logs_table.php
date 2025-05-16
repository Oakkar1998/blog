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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Who did it
            $table->string('action');        // e.g., 'created', 'updated', 'deleted', 'commented'
            $table->string('target_type');   // e.g., 'Article', 'Comment', 'User' (polymorphic type)
            $table->unsignedBigInteger('target_id'); // ID of the model being acted on
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
