<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Estimate;
use App\Models\Referent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstimateFactory extends Factory
{
    protected $model = Estimate::class;

    public function definition(): array
    {
        $clientIds = Client::pluck('id')->toArray();
        $user = User::inRandomOrder()->first() ?: User::factory()->create();
        $referent = Referent::inRandomOrder()->first() ?: Referent::factory()->create();

        return [
            'client_id' => rand(1, 10) <= 7 ? fake()->randomElement($clientIds) : null, 
            'user_id' => $user->id,
            'referent_id' => $referent->id,
            'address_invoice' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'cap' => $this->faker->postcode,
            'country' => $this->faker->country,
            'has_same_address_for_delivery' => $this->faker->boolean(80),
            'price_list' => $this->faker->randomElement(['Standard', 'Premium', 'Custom']),
            'expiration' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'term_pay' => $this->faker->randomElement(['30 giorni', '60 giorni', 'Pagamento anticipato']),
            'method_pay' => $this->faker->randomElement(['Bonifico', 'Carta di credito', 'PayPal']),
            'title_service' => $this->faker->words(3, true),
            'service' => $this->faker->paragraph,
            'note_service' => $this->faker->optional()->sentence,
            'serial_number' => strtoupper($this->faker->bothify('PRT-########')),
            'date_expiration' => $this->faker->date,
            'status_expiration' => $this->faker->randomElement(['Scaduto', 'Valido', 'In scadenza']),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'total' => $this->faker->randomFloat(2, 100, 1000),
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }

    public function fixed(): Factory
    {

        return $this->state(function (array $attributes) {
            return [
                'client_id' => 1,
                'user_id' => 1,
                'referent_id' => 1,
                'address_invoice' => $this->faker->streetAddress,
                'city' => $this->faker->city,
                'cap' => $this->faker->postcode,
                'country' => $this->faker->country,
                'has_same_address_for_delivery' => $this->faker->boolean(80),
                'price_list' => $this->faker->randomElement(['Standard', 'Premium', 'Custom']),
                'expiration' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
                'term_pay' => $this->faker->randomElement(['30 giorni', '60 giorni', 'Pagamento anticipato']),
                'method_pay' => $this->faker->randomElement(['Bonifico', 'Carta di credito', 'PayPal']),
                'title_service' => $this->faker->words(3, true),
                'service' => $this->faker->paragraph,
                'note_service' => $this->faker->optional()->sentence,
                'serial_number' => strtoupper($this->faker->bothify('SN-####')),
                'date_expiration' => $this->faker->date,
                'status_expiration' => $this->faker->randomElement(['Scaduto', 'Valido', 'In scadenza']),
                'price' => $this->faker->randomFloat(2, 50, 500),
                'total' => $this->faker->randomFloat(2, 100, 1000),
                'status' => $this->faker->numberBetween(0, 1),
            ];
        });
    }
}
