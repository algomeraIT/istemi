<?php

namespace App\Livewire\Projects;

use Livewire\Attributes\On;

use App\Models\DocumentProject;
use App\Models\NoteProject;
use App\Models\Project;
use App\Models\Stackholder;
use App\Models\Phase;
use App\Models\Task;
use Livewire\Component;
use Flux\Flux;



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
    public $phasesTable, $phases;
    public $openPhaseId;
    public $openTable = false;
    public $firms;



    public function mount($id)
    {
        $project = Project::findOrFail($id);

        $this->phases = Phase::with(['area', 'microArea', 'user'])
            ->where("id_project", $id)
            ->where('status', '!=', 'deleted')
            ->get();

        $stackholderIds = json_decode($project->stackholder_id, true);
        $stackholder = is_array($stackholderIds) && count($stackholderIds) > 0
            ? Stackholder::whereIn('id', $stackholderIds)->get()
            : collect();

        $this->fill([
            'id' => $id,
            'project' => $project,
            'firms' => json_decode($project->firms_and_percentage, true),
            'stackholder' => $stackholder,
            'document' => DocumentProject::where("project_id", $id)->get(),
            'statusPhases' => $this->phases,
            'phasesTable' => $this->phases,
            'phaseID' => $this->phases->pluck('id_micro_area'),
        ]);
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

            Flux::toast('Fase eliminata con successo!');
        } catch (\Exception $e) {
            Flux::toast('Errore durante la cancellazione del MacroTask.');
        }
    }


    #[On('refresh')]
    public function render()
    {
        $phaseIds = $this->phases->pluck('id');

        $this->groupedMicroTasks = Task::whereIn('id_phases', $phaseIds)
            ->where('status', '!=', 'deleted')
            ->get();
        $this->notes = NoteProject::where("project_id", $this->id)->orderBy('created_at', 'desc')->get();

        return view('livewire.projects.project-detail');
    }
}
