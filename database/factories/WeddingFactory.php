<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Null_;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wedding>
 */
class WeddingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'unique_code' => 'aaa',
            'title' => $this->faker->title(),
            'date' => $this->faker->date(),
            'user_id' => 1,
            'guestlist_id' => 1,
        ];
    }
}
