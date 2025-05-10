<?php

namespace Database\Factories;

use App\Models\CloseActivity;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CloseActivityFactory extends Factory
{
    protected $model = CloseActivity::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'project_id' => Project::factory(),
            'close_activity' => $this->faker->sentence,
            'user_close_activity' => User::factory(),
            'status_close_activity' => 'completed',
            'sale' => $this->faker->sentence,
            'user_sale' => User::factory(),
            'status_sale' => 'approved',
            'release' => $this->faker->sentence,
            'user_release' => User::factory(),
            'status_release' => 'released',
        ];
    }
}
