<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guestlist>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_address' =>  $this->faker->address(),
            'address_longitude' =>  $this->faker->longitude(),
            'address_latitude' =>  $this->faker->latitude(),
            'wedding_id' => 1,
        ];
    }
}