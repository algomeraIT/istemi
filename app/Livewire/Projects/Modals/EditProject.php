<?php

namespace App\Livewire\Projects\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Project;
use App\Models\Client;
use App\Models\Estimate;
use App\Models\Area;
use App\Models\User;
use App\Models\MicroArea;
use App\Models\Phase;

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
    public $phaseGroups = [];
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
        $this->project = Project::with('phase')->findOrFail($id);

        // Get all area/micro-area groupings
        $this->phaseGroups = Area::with('microAreas')->get()->mapWithKeys(function ($area) {
            return [$area->name => $area->microAreas->pluck('name', 'id')->toArray()];
        })->toArray();

        // Get selected micro_area IDs for this project
        $this->selectedPhases = $this->project->phases->pluck('id_micro_area')->toArray();

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
        try {
            $this->project->update($this->formData);

            Phase::where('id_project', $this->project->id)->delete();

            foreach ($this->selectedPhases as $microAreaId) {
                $microArea = MicroArea::find($microAreaId);
                if ($microArea) {
                    Phase::create([
                        'id_area' => $microArea->area_id, 
                        'id_micro_area' => $microArea->id,
                        'id_project' => $this->project->id,
                        'id_user' => auth()->user()->id, 
                        'status' => 'In attesa',
                    ]);
                }
            }

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
