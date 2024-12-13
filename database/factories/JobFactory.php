<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $now = Carbon::now();
        $startDate = $now->copy()->subYear();
        $endDate = $now;

        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'job_type' => $this->faker->randomElement(['part-time', 'full-time']),
            'work_mode' => $this->faker->randomElement(['hybrid', 'on-site']),
            'location' => $this->faker->city,
            'published_at' => $this->faker->dateTimeBetween($startDate, $endDate),
        ];
    }
}
