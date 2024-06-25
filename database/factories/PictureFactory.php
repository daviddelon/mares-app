<?php

namespace Database\Factories;

use App\Models\Mare;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PictureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'path' => fake()->filePath(),
            'user_id' => User::factory(),
            'mare_id' => Mare::factory(),
            'observed_at' => fake()->dateTime

        ];
    }
}
