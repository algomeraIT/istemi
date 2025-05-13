<?php

namespace Database\Factories;

use App\Models\Accounting;
use App\Models\Activity;
use App\Models\Client;
use App\Models\CloseActivity;
use App\Models\ConstructionSitePlane;
use App\Models\Data;
use App\Models\ExternalValidation;
use App\Models\InvoicesSal;
use App\Models\NonComplianceManagement;
use App\Models\Project;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskProjectFactory extends Factory
{
    public function definition(): array
    {
        $clientIds = Client::pluck('id')->toArray();

        return [
            'project_id' => Project::factory(),
            'client_id' => fake()->randomElement($clientIds),
            'project_start_id' => Project::factory(),
            'user_id' => User::factory(),
            'user_name' => $this->faker->name(),
            'title' => $this->faker->sentence(6),
            'assignee' => $this->faker->name(),
            'cc' => $this->faker->name(),
            'expire' => $this->faker->date(),
            'note' => $this->faker->text(),
            'media' => json_encode([$this->faker->randomNumber(), $this->faker->randomNumber()]),
            'status' => $this->faker->randomElement(['In attesa', 'Svolto']),
            'project_activity_id' => Activity::factory(),
            'project_accounting_id' => Accounting::factory(),
            'project_data_id' => Data::factory(),
            'project_construction_site_plane_id' => ConstructionSitePlane::factory(),
            'project_external_validations_id' => ExternalValidation::factory(),
            'project_invoices_sal_id' => InvoicesSal::factory(),
            'project_non_compliance_id' => NonComplianceManagement::factory(),
            'project_report_id' => Report::factory(),
            'project_close_id' => CloseActivity::factory(),
        ];
    }
}
