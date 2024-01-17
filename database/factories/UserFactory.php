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
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'firstname' => fake()->firstname(),
            'lastname' => fake()->lastname(),
            'phoneNumber'=> fake()->phoneNumber(),
            'password' => $this->faker->password(),
            'user_role' => 2,
        ];
    }

    public function alternate() {

        return $this->state(function (array $attributes) {
            return [
                'firstname' => 'Jesper',
                'lastname' => 'de Jong',
                'user_role' => 1,
                'email' => 'jesperdejong2002@outlook.cm',
                'password' => 'password',
                'phoneNumber' => '0619194979'
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    /**public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    */
}
