<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Phase;
use App\Models\User;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $phase = Phase::first() ?? Phase::factory()->create();
        $user = User::first() ?? User::factory()->create();

        Task::create([
            'name' => 'Esempio attività',
            'id_phases' => $phase->id,
            'id_assignee' => $user->id,
            'status' => 'In attesa',
        ]);
    }
}