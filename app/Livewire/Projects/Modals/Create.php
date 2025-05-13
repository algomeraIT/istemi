<?php

namespace App\Livewire\Projects\Modals;

use App\Models\Client;
use App\Models\Estimate;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectStart;
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
        'is_from_agent' => false,
        'total_budget' => '',
        'id_chief_area' => '',
        'id_chief_project' => '',
        'chief_area' => '',
        'chief_project' => '',
        'start_at' => '',
        'end_at' => '',
        'starting_price' => '',
        'discount_percentage' => '',
        'discounted' => '',
        'n_firms' => '',
        'firms_and_percentage' => '',
        'note' => '',
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
            if ($this->formData['id_chief_area']) {
                $getNameArea = User::select('id', 'name', 'last_name', 'role')->where('role', 'area')->where('id', $this->formData['id_chief_area'])->get()->toArray();
            }
            if ($this->formData['id_chief_project']) {
                $getNameProject = User::select('id', 'name', 'last_name', 'role')->where('role', 'project')->where('id', $this->formData['id_chief_project'])->get()->toArray();
            }

            if ($this->formData['id_client']) {
                $getClient = Client::select('id', 'name', 'address', 'status', 'note')->where('id', $this->formData['id_client'])->get()->toArray();
            }
            if ($this->formData['n_file']) {
                $getEstimate = Estimate::where('id', $this->formData['n_file'])->get()->toArray();
            }

            $this->formData['phase'] = "ok";
            $this->formData['estimate'] = $this->formData['n_file'] = $getEstimate[0]['serial_number'];

            $this->formData['chief_area'] = $getNameArea[0]['name'] . ' ' . $getNameArea[0]['last_name'];
            $this->formData['chief_project'] = $getNameProject[0]['name'] . ' ' . $getNameProject[0]['last_name'];

            $this->formData['address_client'] = $getClient[0]['address'];
            $this->formData['client_status'] = $getClient[0]['status'];
            $this->formData['client_name'] = $getClient[0]['name'];
            $this->formData['note_client'] = $getClient[0]['note'];
            $this->formData['status'] = $this->formData['client_type'];
            $this->formData['stackholder_id'] = json_encode($this->formData['stackholder_id']);

            $this->formData['starting_price'] = $this->formData['starting_price'] !== '' ? (float) $this->formData['starting_price'] : null;
            $this->formData['discount_percentage'] = $this->formData['discount_percentage'] !== '' ? (float) $this->formData['discount_percentage'] : null;
            $this->formData['discounted'] = $this->formData['discounted'] !== '' ? (float) $this->formData['discounted'] : null;
            $this->formData['total_budget'] = $this->formData['total_budget'] !== '' ? (float) $this->formData['total_budget'] : null;

            $project = Project::create($this->formData);
           
            $selected = is_array($this->formData['selectedPhases']) ? $this->formData['selectedPhases'] : [];

             $projectStart = [
                'contract_ver',
                'user',
                'status',
                'cme_ver',
                'reserves',
                'expiring_date_project',
                'communication_plan',
                'extension',
                'sal',
                'warranty',
            ];
            if (count(array_intersect($projectStart, $selected)) > 0) {
                ProjectStart::create([
                    'client_id' => $this->formData['id_client'],
                    'project_id' => $project->id,
                    'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'status' => 'pending',
                    'contract_ver' => in_array('contract_ver', $this->formData['selectedPhases']),
                    'user_contract_ver' => $this->formData['user_contract_ver'] ?? null,
                    'status_contract_ver' => false,

                    'cme_ver' => in_array('cme_ver', $this->formData['selectedPhases']),
                    'user_cme_ver' => $this->formData['user_cme_ver'] ?? null,
                    'status_cme_ver' => false,

                    'reserves' => in_array('reserves', $this->formData['selectedPhases']),
                    'user_reserves' => $this->formData['user_reserves'] ?? null,
                    'status_reserves' => false,

                    'expiring_date_project' => in_array('expiring_date_project', $this->formData['selectedPhases']),
                    'user_expiring_date_project' => $this->formData['user_expiring_date_project'] ?? null,
                    'status_expiring_date_project' => false,

                    'communication_plan' => in_array('communication_plan', $this->formData['selectedPhases']),

                    'extension' => in_array('extension', $this->formData['selectedPhases']),
                    'user_extension' => $this->formData['user_extension'] ?? null,
                    'status_extension' => false,

                    'sal' => in_array('sal', $this->formData['selectedPhases']),
                    'user_sal' => $this->formData['user_sal'] ?? null,
                    'status_sal' => false,

                    'warranty' => in_array('warranty', $this->formData['selectedPhases']),
                    'user_warranty' => $this->formData['user_warranty'] ?? null,
                    'status_warranty' => false,
                ]);
            }

            /*     foreach ($this->formData['stackholder_id'] as $stackholder) {
            $id = DB::table('stackholders')->insertGetId([
            'project_id' => $project->id,
            'name' => $stackholder['name'],
            'email' => $stackholder['email'],
            'role' => $stackholder['role'],
            'is_archived' => 0,
            'created_at' => now(),
            'updated_at' => now(),
            ]);

            $stackholderIds[] = $id;
            } */

            DB::commit();

            Flux::toast('Progetto creato con successo!');

            $this->close();

        } catch (QueryException $e) {
            DB::rollBack();
            dd($e);
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
