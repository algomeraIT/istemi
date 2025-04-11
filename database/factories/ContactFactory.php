<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'pec' => $this->faker->optional()->domainName,
            'registered_office_address' => $this->faker->address,
            'first_telephone' => $this->faker->phoneNumber,
            'second_telephone' => $this->faker->optional()->phoneNumber,
            'status' => $this->faker->boolean(80)
        ];
    }
}
