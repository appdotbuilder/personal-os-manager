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
        Schema::create('content_ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['idea', 'draft', 'scheduled', 'completed'])->default('idea');
            $table->enum('content_type', ['article', 'video', 'live_stream', 'social_post', 'other'])->default('article');
            $table->datetime('scheduled_at')->nullable();
            $table->json('keywords')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'scheduled_at']);
            $table->index('status');
            $table->index('content_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_ideas');
    }
};