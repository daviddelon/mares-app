<?php

namespace Database\Factories;

use App\Models\Mare;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kv>
 */
class KvFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [

            'identifier' => fake()->text(32),
            'content' => fake()->text(255),
            'user_id' => User::factory(),
            'mare_id' => Mare::factory(),
        ];
    }
}
