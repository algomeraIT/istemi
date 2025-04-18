<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;
use Livewire\WithPagination;
use App\Models\Phase;
use App\Models\Users;
use App\Models\Referent;

class Projects extends Component
{
    use WithPagination;
    public $isOpen = false;
    public $currentTab = 1;

    public $formData = [
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

    protected $paginationTheme = 'tailwind';
    public $search = '';
    public $activeTab = 'list';
    public $status = '';
    public $date = '';
    protected $listeners = ['updatePhase'];
    public $sortField = 'n_file';
    public $sortDirection = 'asc';
    public $activePhase = '';

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
    public function resetForm()
    {
        $this->formData = [
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
        $this->currentTab = 1;
    }

    public function nextTab()
    {
        if ($this->currentTab < 4) {
            $this->currentTab++;
        }
    }

    public function prevTab()
    {
        if ($this->currentTab > 1) {
            $this->currentTab--;
        }
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
        session()->flash('message', 'Project Created Successfully!');
        $this->close();
    }
    public function sortBy($field, $phase)
    {
        // Set the active phase for sorting
        $this->activePhase = $phase;

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function search()
    {
        $this->resetPage();
    }
    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->isOpen = false;
        $this->resetPage();
    }
    public function updatePhase($projectId, $newPhase)
    {
        $projectId = intval($projectId);

        $project = Project::find($projectId);
        if ($project) {
            $project->update(['current_phase' => $newPhase]);
            $this->dispatch('projects-updated');
        }
    }
    public function render()
    {
      /*   $admins = Users::whereHas('role', function ($query) {
            $query->where('name', 'admin');
        })->get(); */

        $phases = ["Non Definito", "Avvio", "Pianificazione", "Esecuzione", "Verifica", "Chiusura"];

        if ($this->activeTab == 'list') {
            $projects = Project::when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where('n_file', 'like', '%' . $this->search . '%')
                        ->orWhere('name_client', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy('created_at')
                ->paginate();
        } else {
            $projects = Project::when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where('n_file', 'like', '%' . $this->search . '%')
                        ->orWhere('name_client', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sortField, $this->sortDirection)
                ->get()
                ->groupBy('current_phase')
                ->toArray();

            // controllo che tutte le fasi esistano
            foreach ($phases as $phase) {
                if (!isset($projects[$phase])) {
                    $projects[$phase] = [];
                }
            }
        }

        $referents = Referent::paginate(10);

    return view('livewire.projects.project', compact('projects', 'referents'));
    }
}