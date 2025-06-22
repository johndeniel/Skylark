<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Thought;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users first
        $users = User::factory(10)->create();

        // Create thoughts for existing users
        $users->each(function ($user) {
            Thought::factory()
                ->forUser($user)
                ->count(rand(2, 8))
                ->create();
        });
    }
}