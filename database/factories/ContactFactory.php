<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Client;
use App\Models\User;
use App\Models\Estimate;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'estimate_id' => Estimate::inRandomOrder()->first()->id,
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'pec' => $this->faker->optional()->domainName,
            'registered_office_address' => $this->faker->address,
            'first_telephone' => $this->faker->phoneNumber,
            'second_telephone' => $this->faker->optional()->phoneNumber,
            'status' => $this->faker->randomElement([1, 2]),
        ];
    }

    public function fixed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'client_id' => 1,
                'user_id' => 1,
                'estimate_id' => Estimate::inRandomOrder()->first()->id,
                'name' => $this->faker->company,
                'email' => $this->faker->unique()->safeEmail,
                'pec' => $this->faker->optional()->domainName,
                'registered_office_address' => $this->faker->address,
                'first_telephone' => $this->faker->phoneNumber,
                'second_telephone' => $this->faker->optional()->phoneNumber,
                'status' => 1,
            ];
        });
    }
}
