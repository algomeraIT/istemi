<?php

namespace App\Livewire\Projects;

use App\Models\Client;
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
        $this->clients = Client::select('id', 'name')
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



    public function goToDetail($projectId)
    {
        return redirect()->route('projects.project-detail', ['project' => $projectId]);
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
