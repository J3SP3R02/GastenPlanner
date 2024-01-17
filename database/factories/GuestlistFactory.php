<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guestlist>
 */
class GuestlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'moment_welcome_1' => 'dag',
            'moment_welcome_2' => 'avond',
            'moment_welcome_3' => 'middag',
            'moment_welcome_4' => 'ceremonie',
        ];
    }
}
