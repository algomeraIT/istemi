<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::with('assigned')->get()->each(function ($activity) {
            $assignedUsers = $activity->assigned;

            if ($assignedUsers->isEmpty()) {
                return;
            }

            $assignedUsers->take(3)->each(function ($user) use ($activity) {
                $message = Message::factory()->make([
                    'created_by' => $user->id,
                ]);
                $message->messageable()->associate($activity);
                $message->saveQuietly();
            });
        });
    }
}
