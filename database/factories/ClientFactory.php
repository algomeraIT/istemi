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
        $userIds = User::pluck('id')->toArray();

        return [
            'sales_manager_id' => null,
            'is_company' => $this->faker->boolean(),
            'email' => $this->faker->unique()->companyEmail,
            'pec' => $this->faker->optional()->safeEmail,
            'first_telephone' => $this->faker->phoneNumber,
            'second_telephone' => $this->faker->optional()->phoneNumber,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'province' => $this->faker->state,
            'address' => $this->faker->streetAddress,
            'name' => $this->faker->company,
            'tax_code' => $this->faker->bothify('??######??'),
            'sdi' => $this->faker->bothify('??######??'),
            'site' => $this->faker->optional()->url,
            'label' => null,
            'note' => $this->faker->paragraph(),
            'registered_office_address' => $this->faker->address,
            'has_referent' => $this->faker->boolean,
            'status' => null,
            'step' => null,
            'created_by' => null,
            'updated_by' => null,
            'deleted_by' => fake()->optional(0.1)->randomElement($userIds),
        ];
    }

    public function withStatus(string $status): self
    {
        $stepOptions = match ($status) {
            'lead' => ['nuovo', 'da riassegnare'],
            'contatto' => ['in contatto', 'non idoneo'],
            'cliente' => ['call center', 'censimento'],
            default => ['nessuno'],
        };

        return $this->state(function () use ($status, $stepOptions) {
            $step = fake()->randomElement($stepOptions);
            $userIds = User::pluck('id')->toArray();

            return [
                'status' => $status,
                'step' => $step,
                'label' => fake()->randomElement($stepOptions),
                'sales_manager_id' => in_array($step, ['nuovo', 'da riassegnare']) ? null : fake()->randomElement($userIds),
            ];
        });
    }
}
