<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Thought;
use App\Models\Bookmark;
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

        // Create thoughts for existing users and collect all thoughts
        $allThoughts = collect();
        $users->each(function ($user) use (&$allThoughts) {
            $userThoughts = Thought::factory()
                ->forUser($user)
                ->count(rand(2, 8))
                ->create();
            $allThoughts = $allThoughts->merge($userThoughts);
        });

        // Create bookmarks - each user bookmarks some random thoughts
        $users->each(function ($user) use ($allThoughts) {
            // Get thoughts from other users (exclude own thoughts)
            $otherUsersThoughts = $allThoughts->where('userid', '!=', $user->userid);
            
            if ($otherUsersThoughts->isNotEmpty()) {
                // Each user bookmarks 1-5 random thoughts from other users
                $bookmarkCount = rand(1, min(5, $otherUsersThoughts->count()));
                $thoughtsToBookmark = $otherUsersThoughts->random($bookmarkCount);
                
                $thoughtsToBookmark->each(function ($thought) use ($user) {
                    Bookmark::factory()->forUserAndThought($user, $thought)->create();
                });
            }
        });
    }
}