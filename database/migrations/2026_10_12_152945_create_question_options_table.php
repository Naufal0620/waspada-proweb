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
        
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')
                ->constrained('assessment_questions')
                ->cascadeOnDelete();
            $table->string('value');
            $table->string('label');
            $table->foreignId('next_question_id')
                ->nullable()
                ->constrained('assessment_questions')
                ->nullOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['question_id', 'value']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_options');
    }
};
