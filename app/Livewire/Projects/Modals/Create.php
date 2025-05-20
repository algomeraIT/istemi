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
    public $clients = [];
    public $estimates = [];
    public $area = [];
    public $projectUser = [];
    public $stackholderIds = [];
    protected array $rules = [];
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
        $this->clients = Client::select('id', 'name')->get()->toArray();
        $this->estimates = Estimate::select('id', 'serial_number')->where('client_id', null)->get()->toArray();
        $this->area = User::select('id', 'name', 'last_name', 'role')->where('role', 'area')->get()->toArray();
        $this->projectUser = User::select('id', 'name', 'last_name', 'role')->where('role', 'project')->get()->toArray();
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
            $project = Project::create($this->formData);
            $selected = is_array($this->formData['selectedPhases']) ? $this->formData['selectedPhases'] : [];

            $phaseGroups = [
                'Avvio progetto' => [
                    'contract_ver' => 'Verifica contratto',
                    'cme_ver' => "Verifica CME - Piano d'indagine e capitolato",
                    'reserves' => 'Riserve',
                    'expiring_date_project' => 'Impostare la data di scadenza del progetto',
                    'communication_plan' => 'Definizione del piano di comunicazione',
                    'extension' => 'Proroga',
                    'sal' => 'Possibilità di produrre dei SAL',
                    'warranty' => 'Garanzia definitiva',
                ],
                'Fatture acconto e SAL' => [
                    'emission_invoice' => 'Emissione fattura',
                    'payment_invoice' => 'Pagamento fattura',
                ],
                'Pianificazione cantiere' => [
                    'construction_site_plane' => 'Verifica accesibilità e sopralluogo',
                    'travel' => 'Organizzazione trasferte',
                    'site_pass' => 'Permessi/pass accesso al sito',
                    'ztl' => 'Permessi/pass ZTL',
                    'supplier' => 'Selezione fornitori',
                    'timetable' => 'Cronoprogramma',
                    'security' => 'Sicurezza',
                ],
                'Esecuzione attività' => [
                    'team' => 'Selezione della squadra (caposquadra + altre risorse)',
                    'field_activities' => 'Indicazioni per lo svolgimento delle attività in campo',
                    'daily_check_activities' => 'Riepilogo giornaliero delle attività',
                    'contruction_site_media' => 'Caricamento dati di cantiere',
                    'activity_validation' => 'Controllo avanzamento attività/budget (PM)',
                ],
                'Elaborazione dati' => [
                    'foreman_docs' => 'Controllo documentazione Caposquadra',
                    'sanding_sample_lab' => 'Spedizione campione ai laboratori',
                    'data_validation' => 'Avvio analisi dati',
                    'internal_validation' => 'Validazione interna elaborati',
                ],
                'Trasmissione report' => [
                    'create_note' => 'Predisposizione nota di trasmissione',
                    'sending_note' => 'Invio nota di trasmissione',
                ],
                'Contabilità' => [
                    'accounting_dec' => 'Contabilità attività eseguite (DEC)',
                    'create_cre' => 'Produrre richiesta CRE',
                    'expense_allocation' => 'Riparto spese',
                ],
                'Conferma esterna' => [
                    'cre' => 'CRE',
                    'liquidation' => 'Liquidazione',
                    'balance_invoice' => 'Fattura di saldo',
                ],
                'Verifica tecnico contabile' => [
                    'balance' => 'Saldo',
                    'cre_archiving' => 'Archiviazione CRE',
                    'pay_suppliers' => 'Pagamento fornitori',
                    'pay_allocation_expenses' => 'Pagamento riparto spese',
                    'learned_lesson' => 'Lezioni apprese',
                ],
                'Gestione non conformità' => [
                    'sa' => 'Accogliere richieste della S.A.',
                    'integrate_doc' => 'Inviare documentazione integrativa',
                ],
                'Chiusura attività' => [
                    'sale' => 'Fatturato specifico',
                    'release' => 'Svincolo della polizza',
                ],
            ];
                        
            $phaseData = collect($selected)->map(function ($key) use ($phaseGroups) {
                foreach ($phaseGroups as $groupName => $groupItems) {
                    if (array_key_exists($key, $groupItems)) {
                        return [
                            'key' => $key,
                            'label' => $groupItems[$key],
                            'area' => $groupName,
                        ];
                    }
                }
                return null;
            })->filter();
            
            $microAreas = MicroArea::whereIn('name', $phaseData->pluck('label'))->get()->keyBy('name');
            $areas = Area::whereIn('name', $phaseData->pluck('area'))->get()->keyBy('name');

            foreach ($phaseData as $phase) {
                $micro = $microAreas[$phase['label']] ?? null;
                $area = $areas[$phase['area']] ?? null;
            
                if ($micro && $area) {
                    $newPhase = Phase::create([
                        'id_micro_area' => $micro->id,
                        'id_area' => $area->id,
                        'id_project' => $project->id,
                        'id_user' => auth()->id(),
                        'status' => 'In attesa',
                    ]);
            
                    Task::create([
                        'id_phases' => $newPhase->id,
                        'id_assignee' => auth()->id(), 
                        'status' => 'In attesa',
                        'title' => $phase['label'],
                        'assignee' => auth()->user()->name . ' ' . auth()->user()->last_name,
                        'cc' => null,
                        'expire' => now()->addDays(7), 
                        'note' => null,
                        'media' => json_encode([]),
                    ]);
                }
            }

            Stackholder::insertFromForm($this->formData, $project->id);

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
