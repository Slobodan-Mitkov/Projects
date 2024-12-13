<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Position;
use App\Models\Member;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $positions = Position::pluck('id')->all();
        $specialPositions = [1, 2, 3];
        $otherPositions = array_diff($positions, $specialPositions);

        static $assignedSpecialPositions = [];

        if (count($assignedSpecialPositions) < count($specialPositions)) {
            $remainingSpecialPositions = array_diff($specialPositions, $assignedSpecialPositions);
            $positionId = array_shift($remainingSpecialPositions);
            $assignedSpecialPositions[] = $positionId;
        } else {
            $positionId = $otherPositions[array_rand($otherPositions)];
        }

        return [
            'picture' => $this->faker->imageUrl,
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'position_id' => $positionId,
            'short_profile' => $this->faker->paragraph,
        ];
    }
}
