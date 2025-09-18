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
        Schema::create('content_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('content_type', ['article', 'video', 'live_stream']);
            $table->string('url')->nullable();
            $table->json('keywords')->nullable();
            $table->json('categories')->nullable();
            $table->integer('views')->default(0);
            $table->integer('engagement')->default(0);
            $table->date('published_at');
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['user_id', 'content_type']);
            $table->index(['user_id', 'published_at']);
            $table->index('content_type');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_logs');
    }
};