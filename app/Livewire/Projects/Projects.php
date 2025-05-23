<?php

namespace App\Livewire\Projects;

use Flux\Flux;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Livewire\Component;
use App\Models\Estimate;
use App\Models\Referent;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;


class Projects extends Component
{
    use WithPagination;

    private const PHASES = [
        'Non Definito',
        'Avvio',
        'Pianificazione',
        'Esecuzione',
        'Verifica',
        'Chiusura',
    ];

    public array $areas = [];
    public bool $selectAll = false;
    public bool $isOpen = false;
    public bool $showListFilters = true;
    public bool $showKanbanFilters = false;
    public int $currentTab = 1;

    public string $activeTab = 'list';
    #[Url(as: 'currentTab', except: 'list')]
    public string $kanbanTab = 'current_phase';
    public string $detailTab = 'task';
    public string $detailActiveTab = 'detail-list';
    public string $responsible = '';
    public string $query_project = '';
    public string $query_phase = '';
    public string $query_search = '';
    public string $search = '';
    public string $sortField = 'estimate';
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
    public $formData;
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

    public $selectedView;

    public function mount()
    {
        $this->clients = Client::select('id', 'name')
            ->get()->toArray();

        $this->estimates = Estimate::select('id', 'serial_number')
            ->get()->toArray();
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
        return redirect()->route('projects.project-detail', ['id' => $projectId]);
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

    protected function buildProjectQuery()
    {

        return Project::query()
            ->when($this->search, fn($q) => $q->where('estimate', 'like', "%{$this->search}%"))
            ->when($this->responsible, fn($q) => $q->where('responsible_id', $this->responsible))
            ->when($this->query_project, fn($q) => $q->where('client_type', 'like', '%' . $this->query_project . '%'))
            ->when($this->query_phase, fn($q) => $q->where('current_phase', 'like', '%' . $this->query_phase . '%'))
            ->when($this->query_search, fn($q) => $q->where('client_name', 'like', '%' . $this->query_search . '%'))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->where('status', '!=', 'deleted');
    }

    public function delete($id)
    {
        try {
            $project = Project::findOrFail($id);

            $project->status = "deleted";
            $project->save();

            Flux::toast('Progetto eliminato...');
        } catch (\Exception $e) {
            Flux::toast('Non è stato possibile eliminare il progetto.');
        }
    }
    #[On('taskAdded')]
    public function render()
    {
        $referents = Referent::paginate(10);

        $listProjects = $this->buildProjectQuery()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

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
            'managers' => User::role('project manager')->get(),
            'clients' => $this->clients,
            'estimates' => $this->estimates,
        ]);
    }
}
