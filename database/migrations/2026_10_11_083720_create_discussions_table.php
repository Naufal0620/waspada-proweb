<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained('forum_categories')
                ->restrictOnDelete();

            $table->string('title', 200);
            $table->string('slug')->unique();
            $table->text('body');

            $table->enum('status', [
                'pending',
                'published',
                'rejected',
                'hidden',
            ])->default('pending');

            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discussions');
    }
};
