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
        
        Schema::table('assessments', function (Blueprint $table) {
            $table->enum('information_status', [
                'sufficient',
                'insufficient',
            ])->default('sufficient');

            $table->enum('match_status', [
                'matched',
                'no_match',
            ])->default('no_match');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            //
        });
    }
};
