<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'number' => $this->faker->phoneNumber(),
            'country' => $this->faker->country(),
            'message' => $this->faker->text(),
            'email' => $this->faker->email(),
            'read' => 0,
        ];
    }
}
