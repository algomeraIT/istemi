<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\Users;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    protected $model = History::class;

    public function definition(): array
    {
        return [
            'user_id' => Users::factory(),
            'name_user' => $this->faker->firstName,
            'last_name_user' => $this->faker->lastName,
            'job_position_user' => $this->faker->jobTitle,
            'role_user' => $this->faker->randomElement(['admin', 'manager', 'employee']),
            'status_user' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
            'action' => $this->faker->sentence,
            'id_notes' => Note::factory(),
        ];
    }
}
