<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        $users = User::all();

        $status = $this->faker->randomElement(['lead', 'contatto', 'cliente']);

        $stepOptions = match ($status) {
            'lead' => ['nuovo', 'assegnato', 'da riassegnare'],
            'contatto' => ['in contatto', 'non idoneo'],
            'cliente' => ['call center', 'censimento'],
            default => ['nessuno'],
        };

        $step = $this->faker->randomElement($stepOptions);

        return [
            'user_id' => $users->random()->id,
            'is_company' => $this->faker->boolean(),
            'email' => $this->faker->unique()->companyEmail,
            'pec' => $this->faker->optional()->safeEmail,
            'first_telephone' => $this->faker->phoneNumber,
            'second_telephone' => $this->faker->optional()->phoneNumber,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'province' => $this->faker->state,
            'address' => $this->faker->streetAddress,
            'logo_path' => 'icon/logo.svg',
            'name' => $this->faker->company,
            'tax_code' => $this->faker->bothify('??######??'),
            'sdi' => $this->faker->bothify('??######??'),
            'site' => $this->faker->optional()->url,
            'label' => $this->faker->optional()->word,
            'note' => $this->faker->paragraph(),
            'registered_office_address' => $this->faker->address,
            'has_referent' => $this->faker->boolean,
            'sales_manager' => $this->faker->boolean,
            'status' => $status,
            'step' => $step,
        ];
    }
}
