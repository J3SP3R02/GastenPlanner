<?php

namespace Database\Factories;

use App\Models\Guest_Info;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'phoneNumber' => $this->faker->phoneNumber(),
            'password' => $this->faker->password(),
            'dietary_wishes' => $this->faker->paragraph(1),
            'allergies' => 'nuts',
            'guestlist_id' => 1,
        ];
    }
}
