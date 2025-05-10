<?php

namespace App\Livewire\Projects\Modals;

use App\Models\Client;
use App\Models\Estimate;
use App\Models\Project;
use App\Models\User;
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
    protected array $rules = [];
    public bool $canProceed = true;
    private const DEFAULT_FORM = [
        'estimate' => '',
        'n_file' => '',
        'name_project' => '',
        'id_client' => '',
        'client_type' => '',
        'is_from_agent' => false,
        'total_budget' => '',
        'id_chief_area' => '',
        'id_chief_project' => '',
        'start_at' => '',
        'end_at' => '',
        'starting_price' => '',
        'discount_percentage' => '',
        'discounted' => '',
        'n_firms' => '',
        'firms_and_percentage' => '',
        'note' => '',
        'goals' => '',
        'project_scope' => '',
        'expected_results' => '',
        'stackholder_id' => '',
        'stackholders' => [],
        'agreement' => false,
        'selectedAreas' => [],
        'address_client' => 'ok',
        'client_status' => "ok",
        'status' => ''
    ];
    public array $formData = self::DEFAULT_FORM;

    public function mount()
    {
        $this->clients = Client::select('id', 'name')
            ->get()->toArray();

        $this->estimates = Estimate::select('id', 'serial_number')
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
        $this->validate($this->getValidationRules());
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
            if($this->formData['id_chief_area']){
                $getNameArea = User::select('id', 'name', 'last_name', 'role')->where('role', 'area')->where('id', $this->formData['id_chief_area'])->get()->toArray();
            }
            if($this->formData['id_chief_project']){
                $getNameArea = User::select('id', 'name', 'last_name', 'role')->where('role', 'project')->where('id', $this->formData['id_chief_project'])->get()->toArray();
            }
            
            if($this->formData['id_client']){
                $getClient = Client::select('id', 'name', 'address', 'status')->where('id', $this->formData['id_client'])->get()->toArray();
            }
            
            $this->formData['stackholder_id'] = 1;
            $this->formData['phase'] = "ok";
            $this->formData['estimate'] = $this->formData['n_file'];
            $this->formData['address_client'] = $getClient['address'];
            $this->formData['client_status'] = $getClient['status'];
            $this->formData['status'] = $this->formData['client_type'];
            $project = Project::create($this->formData);

            DB::commit();

            session()->flash('success', 'Progetto creato con successo!');

            $this->close();

        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            $this->addError('save_error', 'Errore di database, contatta l’amministratore.');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            $this->addError('save_error', 'Errore imprevisto: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.projects.modals.create', [
            'canProceed' => $this->canProceed
        ]);
    }
}
