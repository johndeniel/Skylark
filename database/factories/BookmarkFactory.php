<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thought;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookmark>
 */
class BookmarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'userid' => User::factory(),
            'thought_id' => Thought::factory(),
        ];
    }

    /**
     * Create a bookmark for a specific user
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'userid' => $user->userid,
        ]);
    }

    /**
     * Create a bookmark for a specific thought
     */
    public function forThought(Thought $thought): static
    {
        return $this->state(fn (array $attributes) => [
            'thought_id' => $thought->_id,
        ]);
    }

    /**
     * Create a bookmark for specific user and thought
     */
    public function forUserAndThought(User $user, Thought $thought): static
    {
        return $this->state(fn (array $attributes) => [
            'userid' => $user->userid,
            'thought_id' => $thought->_id,
        ]);
    }
}