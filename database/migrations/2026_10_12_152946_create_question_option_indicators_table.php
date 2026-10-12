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
        
        Schema::create('question_option_indicators', function (Blueprint $table) {
            $table->foreignId('question_option_id')
                ->constrained('question_options')
                ->cascadeOnDelete();
            $table->foreignId('indicator_id')
                ->constrained('indicators')
                ->cascadeOnDelete();

            $table->primary(['question_option_id', 'indicator_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_option_indicators');
    }
};
