<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        $salesManager = $this->faker->optional()->name;
    
        return [
            'company_name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'pec' => $this->faker->optional()->companyEmail,
            'service' => $this->faker->word,
            'provenance' => $this->faker->city,
            'registered_office_address' => $this->faker->address,
            'first_telephone' => $this->faker->phoneNumber,
            'second_telephone' => $this->faker->optional()->phoneNumber,
            'note' => $this->faker->optional()->sentence,
            'sales_manager' => $salesManager,
            'status' => $salesManager === null
                ? 3
                : $this->faker->randomElement([1, 2]),
            'acquisition_date' => $this->faker->date,
        ];
    }
}
