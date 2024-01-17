<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guestlist>
 */
class ScriptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'activity' => $this->faker->sentence(),
           'starttime' => $this->faker->time(),
           'endtime' => $this->faker->time(),
           'timespan'=> $this->faker->numberBetween(10,120),
           'location'=> $this->faker->address(),
           'attendees'=> $this->faker->randomNumber(2)
        ];
    }
}