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
        Schema::create('users', function (Blueprint $table) {
            $table->string('userid')->primary();
            $table->string('name');
            $table->string('username')->unique();
            $table->enum('pronoun', ['He', 'She', 'Xe', 'Ze', 'They']);
            $table->string('password');
            $table->string('bio');
            $table->string('photo_url');
            $table->timestamps();
        
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('thoughts', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->text('content');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('userid')->references('userid')->on('users')->onDelete('cascade');
            
            // Index for better query performance
            $table->index('userid');
        });

        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->unsignedBigInteger('thought_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('userid')->references('userid')->on('users')->onDelete('cascade');
            $table->foreign('thought_id')->references('id')->on('thoughts')->onDelete('cascade');
            
            // Unique constraint to prevent duplicate bookmarks
            $table->unique(['userid', 'thought_id']);
            
            // Indexes for better query performance
            $table->index('userid');
            $table->index('thought_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('thoughts');
        Schema::dropIfExists('bookmarks');
    }
};