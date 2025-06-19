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
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'pronoun' => fake()->randomElement(['He', 'She', 'Xe', 'Ze', 'They']),
            'password' => static::$password ??= '$2y$12$GI5DDYLlhb4B7RCfF0wj4OLAvAcROTH86/HHToz.IjwZxjOMIq7uK',
            'bio' => fake()->sentence(),
            'photo' => null,
        ];
    }
}
