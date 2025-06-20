<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The hashed password used by the factory.
     * Original password: Password123
     */
    protected static ?string $password = '$2y$12$GI5DDYLlhb4B7RCfF0wj4OLAvAcROTH86/HHToz.IjwZxjOMIq7uK';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'userid' => Str::uuid()->toString(),
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'pronoun' => fake()->randomElement(['He', 'She', 'Xe', 'Ze', 'They']),
            'password' => static::$password,
            'bio' => fake()->sentence(),
            'photo_url' => 'https://ui-avatars.com/api/?name=' . urlencode(fake()->name()),
        ];
    }
}
