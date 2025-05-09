<?php

namespace App\Livewire\Projects;

use App\Models\Clients;
use App\Models\Estimate;
use App\Models\Project;
use App\Models\Referent;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Projects extends Component
{
    use WithPagination;

    // default values for a new project
    private const DEFAULT_FORM = [
        'n_file' => '',
        'name_project' => '',
        'id_client' => '',
        'client_type' => '',
        'is_from_agent' => false,
        'total_budget' => '',
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
        'goals' => '',
        'project_scope' => '',
        'expected_results' => '',
        'stackholder_id' => '',
        'stackholders' => [],
        'agreement' => false,
        'selectedAreas' => [],
    ];

    // possible phases
    private const PHASES = [
        'Non Definito', 'Avvio', 'Pianificazione', 'Esecuzione', 'Verifica', 'Chiusura',
    ];

    public array $areas = [];
    public bool $selectAll = false;
    public bool $isOpen = false;
    public bool $showListFilters = true;
    public bool $showKanbanFilters = false;
    public int $currentTab = 1;
    public array $formData = self::DEFAULT_FORM;
    public string $activeTab = 'list';
    #[Url( as :'currentTab', except: 'list')]
    public string $kanbanTab = 'current_phase';
    public string $detailTab = 'task';
    public string $detailActiveTab = 'detail-list';
    public string $query = '';
    public string $query_project = '';
    public string $query_phase = '';
    public string $query_search = '';
    public string $search = '';
    public string $sortField = 'n_file';
    public string $sortDirection = 'asc';
    public string $activePhase = '';
    public string $selectedReferent = '';
    public string $filterResponsible = '';
    public string $status = '';
    public string $responsibleQuery = '';
    protected $queryString = [
        'filterResponsible' => ['except' => ''],
    ];
    protected $paginationTheme = 'tailwind';
    protected $listeners = ['updatePhase', 'updatePhaseResponsible'];
    public $clients = [];
    public $estimates = [];

    public function mount()
    {
        $this->clients = Clients::select('id', 'company_name')
            ->get()->toArray();

        $this->estimates = Estimate::select('id', 'serial_number')
            ->get()->toArray();
    }

    // reset pagination whenever search or tab changes
    public function updatingSearch()
    {$this->resetPage();}

    public function updatingActiveTab($value)
    {
        $this->resetPage();
    }
    public function updatingKanbanTab()
    {
        $this->resetPage();
    }
    public function updatingDetailTab($value)
    {
        $this->resetPage();
    }
    public function updatingSortField()
    {$this->resetPage();}
    public function updatingSortDirection()
    {$this->resetPage();}

    public function search()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();

        $this->isOpen = true;

    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function close()
    {
        $this->resetForm();
        $this->isOpen = false;
    }

    private function resetForm(): void
    {
        $this->formData = self::DEFAULT_FORM;
        $this->currentTab = 1;
    }

    public function nextTab(): void
    {
        $this->currentTab = min($this->currentTab + 1, 5);
    }

    public function prevTab(): void
    {
        $this->currentTab = max($this->currentTab - 1, 1);
    }

    public function goToDetail($projectId)
    {
        return redirect()->route('projects.project-detail', ['project' => $projectId]);
    }

    public function save()
    {

        $this->validate([
            'formData.n_file' => 'required|exists:estimates,id',
            'formData.name_project' => 'required|string',
            'formData.id_client' => 'required|exists:clients,id',
            'formData.client_type' => 'required|in:0,1',
            'formData.is_from_agent' => 'boolean',
            'formData.total_budget' => 'required|numeric',
            'formData.chief_area' => 'nullable|string',
            'formData.chief_project' => 'nullable|string',
            'formData.start_at' => 'nullable|date',
            'formData.end_at' => 'nullable|date|after_or_equal:formData.start_at',
            'formData.starting_price' => 'nullable|numeric',
            'formData.discount_percentage' => 'nullable|numeric',
            'formData.discounted' => 'nullable|numeric',
            'formData.n_firms' => 'nullable|integer',
            'formData.firms_and_percentage' => 'nullable|string',
            'formData.note' => 'nullable|string',
            'formData.goals' => 'nullable|string',
            'formData.project_scope' => 'nullable|string',
            'formData.expected_results' => 'nullable|string',
            'formData.stackholder_id' => 'nullable|integer',
            'formData.stackholders' => 'array',
            'formData.stackholders.*.name' => 'required|string',
            'formData.stackholders.*.role' => 'required|in:Admin,User',
            'formData.stackholders.*.email' => 'required|email',
            'formData.agreement' => 'accepted',
        ]);

        DB::beginTransaction();

        try {
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

    public function edit()
    {
        $this->isOpen = true;
    }

    public function sortBy(string $field, string $phase): void
    {
        $this->activePhase = $phase;
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->detailTab = $tab;
        $this->isOpen = false;
    }

    public function updatePhase(int $projectId, string $newPhase): void
    {
        if ($project = Project::find($projectId)) {
            $project->update(['current_phase' => $newPhase]);
            $this->dispatch('projects-updated');
        }
    }

    public function updatePhaseResponsible(int $projectId, string $newResponsible): void
    {
        if ($project = Project::find($projectId)) {
            $project->update(['responsible' => $newResponsible]);
            $this->dispatch('projects-updated');
        }
    }

    public function updatingResponsibleQuery()
    {
        $this->resetPage();
    }

    protected function buildProjectQuery()
    {

        return Project::query()
            ->when($this->search, fn($q) => $q->where('n_file', 'like', "%{$this->search}%"))
            ->when($this->query, fn($q) => $q->where('responsible', 'like', '%' . $this->query . '%'))
            ->when($this->query_project, fn($q) => $q->where('client_type', 'like', '%' . $this->query_project . '%'))
            ->when($this->query_phase, fn($q) => $q->where('current_phase', 'like', '%' . $this->query_phase . '%'))
            ->when($this->query_search, fn($q) => $q->where('client_name', 'like', '%' . $this->query_search . '%'))
/*             ->when($this->query_search, fn($q) => $q->where('n_file', 'like', '%' . $this->query_search . '%'))
 */    ->when($this->status, fn($q) => $q->where('status', $this->status));
    }

    public function render()
    {
        $referents = Referent::paginate(10);

        // Always prepare both datasets separately
        $listProjects = $this->buildProjectQuery()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $validGroupFields = ['current_phase', 'responsible'];
        $groupField = in_array($this->kanbanTab, $validGroupFields) ? $this->kanbanTab : 'current_phase';

        $kanbanProjects = $this->buildProjectQuery()
            ->orderBy($this->sortField, $this->sortDirection)
            ->get()
            ->groupBy($groupField)
            ->toArray();

        return view('livewire.projects.project', [
            'listProjects' => $listProjects,
            'kanbanProjects' => $kanbanProjects,
            'referents' => $referents,
            'phases' => self::PHASES,
            'statuses' => Project::select('status')->distinct()->pluck('status'),
            'responsibles' => Project::select('responsible')->distinct()->pluck('responsible'),
            'clients' => $this->clients,
            'estimates' => $this->estimates,
        ]);
    }

}
