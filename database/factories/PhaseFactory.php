<?php

namespace Database\Factories;

use App\Models\Phase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhaseFactory extends Factory {
    protected $model = Phase::class;

    public function definition() {
        return [
            'name' => $this->faker->word(),
            'status' => $this->faker->boolean(80) ? 1 : 0,
        ];
    }
}
