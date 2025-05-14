<?php

namespace App\Livewire\Projects\Modals;

use App\Models\Accounting;
use App\Models\AccountingValidation;
use App\Models\Activity;
use App\Models\Client;
use App\Models\CloseActivity;
use App\Models\ConstructionSitePlane;
use App\Models\Data;
use App\Models\Estimate;
use App\Models\ExternalValidation;
use App\Models\InvoicesSal;
use App\Models\NonComplianceManagement;
use App\Models\Project;
use App\Models\ProjectStart;
use App\Models\Report;
use App\Models\User;
use App\Models\Stackholder;
use Flux\Flux;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $currentTab = 1;

    public $clients = [];
    public $estimates = [];
    public $area = [];
    public $project = [];
    public $stackholderIds = [];
    protected array $rules = [];
    public bool $canProceed = true;
    private const DEFAULT_FORM = [
        'estimate' => '',
        'n_file' => '',
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
        'agreement' => false,
        'selectedAreas' => [],
        'selectedPhases' => [],
        'address_client' => 'ok',
        'client_status' => "ok",
        'status' => '',
    ];

    public array $formData = self::DEFAULT_FORM;

    public function mount()
    {
        $this->clients = Client::select('id', 'name')
            ->get()->toArray();

        $this->estimates = Estimate::select('id', 'serial_number')->where('client_id', null)
            ->get()->toArray();

        $this->area = User::select('id', 'name', 'last_name', 'role')->where('role', 'area')->get()->toArray();
        $this->project = User::select('id', 'name', 'last_name', 'role')->where('role', 'project')->get()->toArray();

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
/*     $this->canProceed = $this->getCanProceedProperty();
 */}

    public function getValidationRules()
    {
        switch ($this->currentTab) {
            case 1:
                return [
                    'formData.n_file' => 'required',
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

    public function close()
    {
        $this->isOpen = false;
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
            $project = Project::create($this->formData);

            $selected = is_array($this->formData['selectedPhases']) ? $this->formData['selectedPhases'] : [];

            ProjectStart::createFromPhases($this->formData, $selected, $project->id);

            InvoicesSal::createFromPhases($this->formData, $selected, $project->id);

            ConstructionSitePlane::createFromPhases($this->formData, $selected, $project->id);

            Activity::createFromPhases($this->formData, $selected, $project->id);

            Data::createFromPhases($this->formData, $selected, $project->id);

            Report::createFromPhases($this->formData, $selected, $project->id);

            Accounting::createFromPhases($this->formData, $selected, $project->id);

            ExternalValidation::createFromPhases($this->formData, $selected, $project->id);

            AccountingValidation::createFromPhases($this->formData, $selected, $project->id);

            NonComplianceManagement::createFromPhases($this->formData, $selected, $project->id);

            CloseActivity::createFromPhases($this->formData, $selected, $project->id);

            Stackholder::insertFromForm($this->formData, $project->id);

            DB::commit();

            Flux::toast('Progetto creato con successo!');

        } catch (QueryException $e) {
            DB::rollBack();
            Flux::toast('Errore di database, contatta l’amministratore.');
        } catch (\Exception $e) {
            DB::rollBack();
            Flux::toast('Errore imprevisto: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.projects.modals.create', [
            'canProceed' => $this->canProceed,
        ]);
    }
}
