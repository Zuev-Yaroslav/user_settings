<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Persistence\Models\Profile>
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
        $gender = $this->faker->randomElement(['male', 'female']);
        return [
            'first_name' => fake()->firstName($gender),
            'second_name' => fake()->lastName($gender),
            'third_name' => null,
            'gender' => ($gender === 'male') ? 1 : 2,
            'birthed_at' => fake()->dateTimeBetween('-50 years', '-18 years'),
            'about_me' => fake()->text(),
        ];
    }
}
