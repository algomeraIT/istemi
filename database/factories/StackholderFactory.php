<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stackholder>
 */
class StackholderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'role' => $this->faker->jobTitle(),
            'email' => $this->faker->unique()->safeEmail(),
            'project_id' => $this->faker->numberBetween(1,30), 
        ];
    }
}
