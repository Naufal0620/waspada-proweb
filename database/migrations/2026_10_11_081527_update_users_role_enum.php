<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'admin',
                'moderator',
                'user',
            ])->default('user')->change();
        });
    }

    public function down(): void
    {
        // Pastikan tidak ada akun dengan role "user"
        // sebelum melakukan rollback.
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'admin',
                'moderator',
            ])->default('moderator')->change();
        });
    }
};
