<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>public
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'second_name' => fake()->lastName(),
            'third_name' => null,
            'gender' => random_int(1, 2),
            'birthed_at' => fake()->dateTimeBetween('-50 years', '-18 years'),
            'about_me' => fake()->text(),
        ];
    }
}
