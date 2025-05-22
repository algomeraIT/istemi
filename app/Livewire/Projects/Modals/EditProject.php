<?php

namespace App\Livewire\Projects\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Project;
use App\Models\Client;
use App\Models\Estimate;
use App\Models\User;

use Livewire\Attributes\On;


use Flux\Flux;


class EditProject extends ModalComponent
{
    public $currentTab = 1;
    public $clients = [];
    public $estimates = [];
    public $area = [];
    public $projectUsers = [];
    public $stackholderIds = [];
    public $selectedPhases = [];
    public $id = '';

    protected array $rules = [];
    public bool $canProceed = true;

    public $project;

    private const DEFAULT_FORM = [
        'selectedPhases' => [],
    ];

    public array $formData = self::DEFAULT_FORM;

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);

        $this->formData = [
            'estimate' => (string) $this->project->estimate,
            'name_project' => $this->project->name_project,
            'id_client' => (string) $this->project->id_client,
            'client_type' => $this->project->client_type,
            'is_from_agent' => (bool) $this->project->is_from_agent,
            'total_budget' => $this->project->total_budget,
            'id_chief_area' => (string) $this->project->id_chief_area,
            'id_chief_project' => (string) $this->project->id_chief_project,
            'start_at' => \Carbon\Carbon::parse($this->project->start_at)->format('Y-m-d'),
            'end_at' => \Carbon\Carbon::parse($this->project->end_at)->format('Y-m-d'),
            'starting_price' => $this->project->starting_price,
            'discount_percentage' => $this->project->discount_percentage,
            'discounted' => $this->project->discounted,
            'n_firms' => $this->project->n_firms,
            'firms_and_percentage' => $this->project->firms_and_percentage,
            'note' => $this->project->note,
            'goals' => $this->project->goals,
            'project_scope' => $this->project->project_scope,
            'expected_results' => $this->project->expected_results,

        ];

        $this->clients = Client::select('id', 'name')->with('estimate')->get()->toArray();

        $this->estimates = Estimate::select('id', 'serial_number')
            ->where(function ($query) {
                $query->where('client_id', $this->project->client_id)
                    ->orWhereNull('client_id')
                    ->orWhere('id', $this->project->estimate);
            })
            ->get()
            ->sortByDesc(function ($estimate) {
                // Move the selected to the top
                return $estimate->serial_number === $this->project->estimate ? 1 : 0;
            })
            ->values()
            ->toArray();

        $this->area = User::select('id', 'name', 'last_name')->role('responsabile area')->get()->toArray();
        $this->projectUsers = User::select('id', 'name', 'last_name')->role('project manager')->get()->toArray();
    }

    public function toggleAllPhases()
    {
        $phases = [
            'contract_ver',
            'cme_ver',
            'reserves',
            'expiring_date_project',
            'communication_plan',
            'extension',
            'sal',
            'warranty',
            'emission_invoice',
            'payment_invoice',
            'construction_site_plane',
            'travel',
            'site_pass',
            'ztl',
            'supplier',
            'timetable',
            'security',
            'activities',
            'team',
            'field_activities',
            'daily_check_activities',
            'contruction_site_media',
            'activity_validation',
            'data',
            'foreman_docs',
            'sanding_sample_lab',
            'data_validation',
            'internal_validation',
            'Report',
            'create_note',
            'sending_note',
            'accounting',
            'accounting_dec',
            'create_cre',
            'expense_allocation',
            'external_validation',
            'cre',
            'liquidation',
            'balance_invoice',
            'accounting_validation',
            'balance',
            'cre_archiving',
            'pay_suppliers',
            'pay_allocation_expenses',
            'learned_lesson',
            'non_compliance_management',
            'sa',
            'integrate_doc',
            'close_activity',
            'sale',
            'release'
        ];

        if (count($this->formData['selectedPhases']) === count($phases)) {
            $this->formData['selectedPhases'] = [];
        } else {
            $this->formData['selectedPhases'] = $phases;
        }
    }

    public function getValidationRules()
    {
        switch ($this->currentTab) {
            case 1:
                return [
                    'formData.estimate' => 'required',
                    'formData.name_project' => 'required|string',
                    'formData.id_client' => 'required|integer',
                    'formData.total_budget' => 'required|numeric|min:0',
                    'formData.id_chief_area' => 'required|integer',
                    'formData.id_chief_project' => 'required|integer',
                    'formData.start_at' => 'required|date',
                    'formData.end_at' => 'required|date|after_or_equal:formData.start_at',
                ];
            case 2:
                return [
                    'formData.starting_price' => 'required|numeric|min:0',
                    'formData.discount_percentage' => 'required|numeric|min:0',
                    'formData.discounted' => 'required|numeric|min:0',
                    'formData.n_firms' => 'required|numeric',
                ];
            case 3:
                return [
                    'formData.goals' => 'required|string',
                    'formData.project_scope' => 'required|string',
                    'formData.expected_results' => 'required|string',
                ];
            case 4:
                return [
                    'formData.checked' => 'required',
                ];
            default:
                return [];
        }
    }

    public function nextTab()
    {
        $this->currentTab++;
        $this->recheckCanProceed();
    }

    public function prevTab(): void
    {
        $this->currentTab = max($this->currentTab - 1, 1);
        $this->recheckCanProceed();
    }

    private function recheckCanProceed()
    {
        try {
            $this->validate($this->getValidationRules());
            $this->canProceed = true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->canProceed = false;
        }
    }


    public function save()
    {
        $this->formData = Project::prepareFormData($this->formData);

        try {
            $this->project->update($this->formData);
            $this->closeModal();
            Flux::toast('Progetto aggiornato con successo!');
            $this->dispatch('refresh');
        } catch (\Exception $e) {
            dd($e);
            Flux::toast('Errore durante l\'aggiornamento del progetto.');
        }
    }

    #[On('refresh')]
    public function render()
    {
        return view('livewire.projects.modals.edit-project');
    }
}
