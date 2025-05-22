<?php

namespace App\Livewire\Projects;

use Livewire\Attributes\On;

use App\Models\DocumentProject;
use App\Models\NoteProject;
use App\Models\Project;
use App\Models\Stackholder;
use App\Models\TaskProject;
use App\Models\Phase;
use App\Models\Task;
use Livewire\Component;
use Flux\Flux;
use Illuminate\Support\Facades\DB;



class ProjectDetail extends Component
{
    public Project $project;
    public $document, $notes, $id, $tasks, $stackholder, $statusPhases, $groupedMicroTasks;
    public string $detailActiveTab = 'detail-kanban';
    public string $tabListKanbaDetail = 'kanban';
    public string $subDetailActiveTab = 'sub-detail-kanban';
    public string $datasheettabs = 'info';
    public string $datasheetHideDiv = 'task';
    public string $query = '';
    public $phaseID;
    public $openMicro = false;
    public string $queryProject = '';
    public $isOpenTaskModal = false;
    public $phasesTable;
    public $openPhaseId;
    public $openTable = false;



    public function mount($id)
    {
        $this->id = $id;
        $this->project = Project::findOrFail($id);
        $this->document = DocumentProject::where("project_id", $id)->get();
        $this->statusPhases = Phase::with(['area', 'microArea'])->where("id_project", $id)->where('status', '!=', 'deleted')->get();
        $this->phaseID = Phase::where('id_project', $id)->pluck('id_micro_area');
        $this->groupedMicroTasks = Task::whereIn(
            'id_phases',
            Phase::where('id_project', $this->project->id)->pluck('id')->toArray()
        )
        ->where('status', '!=', 'deleted')
        ->get()->groupBy('id_phases')->toArray();

        $this->phasesTable = Phase::with(['area', 'microArea', 'user', 'task'])
            ->where('id_project', $this->project->id)
            ->where('status', '!=', 'deleted')
            ->get();

        $this->tasks = Task::whereIn('id_phases', $this->phaseID)->get();

        $ids = json_decode($this->project['stackholder_id'], true);

        if (is_array($ids) && count($ids) > 0) {
            $this->stackholder = Stackholder::whereIn('id', $ids)->get();
        } else {
            $this->stackholder = collect();
        }
    }


    public function togglePhase($phaseId)
    {
        $this->openTable = !$this->openTable;
        $this->openPhaseId = $this->openPhaseId === $phaseId ? null : $phaseId;
    }

    public function updateStatusStart($id, $value)
    {
        try {
            $record = Phase::findOrFail($id);

            $record->status = $value;
            $record->save();

            Flux::toast('Stato aggiornato con successo!');

            $this->dispatch('refresh');
        } catch (\Exception $e) {
            Flux::toast('Errore durante la variazione di stato...');
        }
    }

    public function updateStatusStartMicro($id, $value)
    {
        try {
            $record = Task::findOrFail($id);

            $record->status = $value;
            $record->save();

            Flux::toast('Stato aggiornato con successo!');

            $this->dispatch('refresh');
        } catch (\Exception $e) {
            Flux::toast('Errore durante la variazione di stato...');
        }
    }



    public function microDeleteTask($id)
    {
        try {
            $model = Task::findOrFail($id);

            $model->status = "deleted";
            $model->save();

            $this->dispatch('refresh');

            Flux::toast('MicroTask eliminato con successo!');
        } catch (\Exception $e) {
            logger()->error("Errore nella cancellazione: " . $e->getMessage());
            Flux::toast('Errore durante la cancellazione del MicroTask.');
        }
    }

    public function deleteMacroTask($id)
    {
        try {
            $model = Phase::findOrFail($id);

            $model->status = "deleted";
            $model->save();

            $this->dispatch('refresh');

            Flux::toast('MicroTask eliminato con successo!');
        } catch (\Exception $e) {
            Flux::toast('Errore durante la cancellazione del MacroTask.');
        }
    }
    

    #[On('refresh')]
    public function render()
    {
        $this->notes = NoteProject::where("project_id", $this->id)->orderBy('created_at', 'desc')->get();

        return view('livewire.projects.project-detail');
    }
}
