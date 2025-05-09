<?php

namespace Database\Factories;

use App\Models\HistoryContact;
use App\Models\User;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Estimate;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryContactFactory extends Factory
{
    protected $model = HistoryContact::class;

    public function definition()
    {
        $user       = User::inRandomOrder()->first();
        $client     = Client::inRandomOrder()->first();
        $estimateId = $this->faker->boolean(70)
            ? Estimate::inRandomOrder()->first()->id
            : null;

        $types   = ['note', 'status_change', 'comment'];
        $actions = ['created', 'updated', 'deleted'];
        $status  = $this->faker->randomElement([0,1]);

        return [
            'type'                  => $this->faker->randomElement(['attività','e-mail','note']),
            'user_id'               => $user->id,
            'name'                  => $user->name,
            'last_name'             => $user->last_name ?? $this->faker->lastName(),
            'role'                  => $user->role ?? $this->faker->randomElement(['user','admin','manager']),
            'client_id'             => $client->id,
            'action'                => $this->faker->randomElement($actions),
            'estimate_id'           => $estimateId,
            'note'                  => $this->faker->optional()->sentence(),
            'update_status_from_to' => $this->faker->optional()->regexify('[0-2]->[0-2]'),
            'status'                => $status,
        ];
    }
}