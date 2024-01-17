<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => 'Jesper',
            'lastname' => 'de Jong',
            'user_role' => 1,
            'email' => 'jesperdejong2002@outlook.cm',
            'password' => 'password',
            'phoneNumber' => '0619194979'
        ];
    }
}
