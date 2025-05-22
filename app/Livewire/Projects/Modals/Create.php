<?php

namespace App\Livewire\Projects\Modals;

use Livewire\Attributes\On;

use App\Models\Phase;
use App\Models\MicroArea;
use App\Models\Area;
use App\Models\Client;
use App\Models\Estimate;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Stackholder;
use Flux\Flux;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;


class Create extends ModalComponent
{

    public $currentTab = 1;
    public $phaseGroups;
    public $clients = [];
    public $estimates = [];
    public $area = [];
    public $projectUser = [];
    public $stackholderIds = [];
    protected array $rules = [];
    public $formToken, $formPhase;
    public bool $canProceed = true;
    private const DEFAULT_FORM = [
        'estimate' => '',
        'name_project' => '',
        'id_client' => '',
        'client_type' => '',
        'client_name' => '',
        'current_phase' => 'Non definito',
        'is_from_agent' => false,
        'total_budget' => '',
        'id_chief_area' => '',
        'id_chief_project' => '',
        'chief_area' => '',
        'chief_project' => '',
        'responsible' => '',
        'start_at' => '',
        'end_at' => '',
        'starting_price' => '',
        'discount_percentage' => '',
        'discounted' => '',
        'n_firms' => '',
        'firms_and_percentage' => '',
        'note' => '',
        'general_info' => '',
        'note_client' => '',
        'goals' => '',
        'project_scope' => '',
        'expected_results' => '',
        'stackholder_id' => '',
        'stackholders' => [],
        'selectedPhases' => [],
        'address_client' => 'ok',
        'client_status' => "ok",
        'status' => '',
    ];

    public array $formData = self::DEFAULT_FORM;

    public function mount()
    {
        $this->clients = Client::select('id', 'name')->get()->toArray();
        $this->estimates = Estimate::select('id', 'serial_number')->where('client_id', null)->get()->toArray();
        $this->area = User::select('id', 'name', 'last_name')->role('responsabile area')->get()->toArray();
        $this->projectUser = User::select('id', 'name', 'last_name')->role('project manager')->get()->toArray();

        $this->phaseGroups = Area::with('microAreas')->get()->mapWithKeys(function ($area) {
            return [
                $area->name => $area->microAreas->pluck('name', 'id')->toArray()
            ];
        })->toArray();
    
        $this->formData['selectedPhases'] = []; 
    }


    #[On('checkValid')]
    public function checkValid()
    {
        try {
            $this->validate($this->getValidationRules());
            $this->dispatchBrowserEvent('canProceed-updated', ['detail' => true]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatchBrowserEvent('canProceed-updated', ['detail' => false]);
        }
    }

    public function updated($propertyName)
    {
        $this->rules = $this->getValidationRules();
        $this->validateOnly($propertyName);
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
                    /*    'formData.stackholders' => 'required|array|min:1',
                'formData.stackholders.*.name' => 'required|string',
                'formData.stackholders.*.email' => 'required|email',
                'formData.stackholders.*.role' => 'required',  */
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
        DB::beginTransaction();

        try {
          
            $this->formData = Project::prepareFormData($this->formData);

            $this->formToken = $this->formData;
            $this->formPhase = $this->formData;
            unset($this->formData['stackholders']);
            unset($this->formData['selectedPhases']);
            $project = Project::create($this->formData);

            Stackholder::insertFromForm($this->formToken, $project->id);
         


            $selectedIds = is_array($this->formPhase['selectedPhases']) ? $this->formPhase['selectedPhases'] : [];

            $microAreas = MicroArea::with('area')->whereIn('id', $selectedIds)->get();
            
            foreach ($microAreas as $microArea) {
                $newPhase = Phase::create([
                    'id_micro_area' => $microArea->id,
                    'id_area' => $microArea->area_id,
                    'id_project' => $project->id,
                    'id_user' => auth()->id(),
                    'status' => 'In attesa',
                ]);
            
                Task::create([
                    'id_phases' => $newPhase->id,
                    'id_assignee' => auth()->id(),
                    'status' => 'In attesa',
                    'title' => $microArea->name,
                    'assignee' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'cc' => null,
                    'expire' => now()->addDays(7),
                    'note' => null,
                    'media' => json_encode([]),
                ]);
            }


            DB::commit();

            $this->closeModal();

            Flux::toast('Progetto creato con successo!');
            $this->dispatch('taskAdded');
        } catch (QueryException $e) {
            DB::rollBack();
            Flux::toast('Errore di database, contatta l’amministratore.');
        } catch (\Exception $e) {
            DB::rollBack();
            Flux::toast('Errore imprevisto: ' . $e->getMessage());
        }
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.projects.modals.create', [
            'canProceed' => $this->canProceed,
        ]);
    }
}
