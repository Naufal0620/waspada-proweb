<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@waspada.test'],
            [
                'name' => 'Administrator WASPADA',
                'password' => Hash::make('GantiAdmin123!'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'moderator@waspada.test'],
            [
                'name' => 'Moderator WASPADA',
                'password' => Hash::make('GantiModerator123!'),
                'role' => 'moderator',
                'email_verified_at' => now(),
            ]
        );
    }
}
