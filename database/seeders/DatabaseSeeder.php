<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder pengguna contoh
        User::query()->updateOrCreate(
            ['email' => 'lecturer@example.com'],
            [
                'name' => 'Default Lecturer',
                'password' => bcrypt('password'),
                'role' => 'lecturer',
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'student1@example.com'],
            [
                'name' => 'Student One',
                'password' => bcrypt('password'),
                'role' => 'student',
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'student2@example.com'],
            [
                'name' => 'Student Two',
                'password' => bcrypt('password'),
                'role' => 'student',
            ]
        );
    }
}
