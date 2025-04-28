<?php

namespace Database\Factories;

use App\Models\Clients;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientsFactory extends Factory
{
    protected $model = Clients::class;

    public function definition(): array
    {
        return [
            'logo_path' => $this->faker->imageUrl(),
            'tax_code' => $this->faker->bothify('??######??'),
            'company_name' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
            'pec' => $this->faker->optional()->safeEmail,
            'first_telephone' => $this->faker->phoneNumber,
            'second_telephone' => $this->faker->optional()->phoneNumber,
            'registered_office_address' => $this->faker->address,
            'address' => $this->faker->streetAddress,
            'province' => $this->faker->state,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'sdi' => $this->faker->bothify('??######??'),
            'site' => $this->faker->optional()->url,
            'label' => $this->faker->optional()->word,
            'user_id_creation' => User::factory(),
            'name_user_creation' => $this->faker->firstName,
            'last_name_user_creation' => $this->faker->lastName,
            'has_referent' => $this->faker->boolean,
            'has_sales' => $this->faker->boolean,
            'status' => $this->faker->randomElement([1, 2]),
        ];
    }
}
