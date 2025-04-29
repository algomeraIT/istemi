<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\Referent;
use Livewire\Component;
use Livewire\WithPagination;

class Projects extends Component
{
    use WithPagination;

    // default values for a new project
    private const DEFAULT_FORM = [
        'general_info' => '',
        'n_file' => '',
        'name_project' => '',
        'client_name' => '',
        'client_type' => '',
        'client_status' => '',
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
        'agreement' => false,
    ];

    // possible phases
    private const PHASES = [
        'Non Definito', 'Avvio', 'Pianificazione', 'Esecuzione', 'Verifica', 'Chiusura',
    ];

    // UI state
    public bool $isOpen = false;
    public int $currentTab = 1;
    public array $formData = self::DEFAULT_FORM;
    public string $activeTab = 'list';
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
    protected $listeners = ['updatePhase'];

    // reset pagination whenever search or tab changes
    public function updatingSearch()
    {$this->resetPage();}
    public function updatingActiveTab()
    {$this->resetPage();}
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
        $this->currentTab = min($this->currentTab + 1, 4);
    }

    public function prevTab(): void
    {
        $this->currentTab = max($this->currentTab - 1, 1);
    }

    public function save()
    {
        $this->validate([
            'formData.general_info' => 'required',
            'formData.name_project' => 'required',
            'formData.client_name' => 'required',
            'formData.total_budget' => 'required|numeric',
            'formData.starting_price' => 'required|numeric',
            'formData.discount_percentage' => 'nullable|numeric',
            'formData.n_firms' => 'nullable|numeric',
            'formData.firms_and_percentage' => 'nullable|string',
            'formData.goals' => 'nullable|string',
            'formData.project_scope' => 'nullable|string',
            'formData.expected_results' => 'nullable|string',
            'formData.stackholder_id' => 'nullable|integer',
            'formData.agreement' => 'accepted',
        ]);

        Project::create($this->formData);

        session()->flash('message', 'Project created successfully!');
        $this->close();
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
        $this->isOpen = false;
    }

    public function updatePhase(int $projectId, string $newPhase): void
    {
        if ($project = Project::find($projectId)) {
            $project->update(['current_phase' => $newPhase]);
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
 */            ->when($this->status, fn($q) => $q->where('status', $this->status));
    }

    public function render()
    {
        $referents = Referent::paginate(10);
    
        // Always prepare both datasets separately
        $listProjects = $this->buildProjectQuery()
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    
        $kanbanProjects = $this->buildProjectQuery()
            ->orderBy($this->sortField, $this->sortDirection)
            ->get()
            ->groupBy('current_phase')
            ->toArray();
    
        foreach (self::PHASES as $phase) {
            if (!isset($kanbanProjects[$phase])) {
                $kanbanProjects[$phase] = [];
            }
        }
    
        return view('livewire.projects.project', [
            'listProjects' => $listProjects,
            'kanbanProjects' => $kanbanProjects,
            'referents' => $referents,
            'phases' => self::PHASES,
            'statuses' => Project::select('status')->distinct()->pluck('status'),
            'responsibles' => Project::select('responsible')->distinct()->pluck('responsible'),
        ]);
    }

}
