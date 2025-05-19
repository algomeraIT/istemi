<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Activity;
use App\Models\Client;
use App\Models\HistoryClient;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        $clients = Client::whereIn('status', ['contatto', 'cliente'])->get();

        foreach ($clients as $client) {
            Activity::factory()->count(10)->make()->each(function ($activity) use ($userIds, $client) {
                $activity->client_id  = $client->id;
                $activity->created_by = fake()->randomElement($userIds);
                $activity->updated_by = fake()->randomElement($userIds);
                $activity->saveQuietly();

                $activity->assigned()->attach(
                    fake()->randomElements($userIds, $client->status === 'cliente' ? 2 : 1)
                );

                HistoryClient::create([
                    'client_id' => $client->id,
                    'type'      => 'activity',
                    'action'    => 'create',
                    'model_id'  => $activity->id,
                    'status_client' => $client->step,
                ]);
            });
        }
    }
}
