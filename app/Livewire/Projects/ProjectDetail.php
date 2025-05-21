<?php

namespace App\Livewire\Projects;

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

use Livewire\Attributes\On;


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
    public string $queryProject = '';
    public $isOpenTaskModal = false;
    public $phasesTable;


    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
        $this->groupedMicroTasks = TaskProject::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->document = DocumentProject::where("project_id", $id)->get();
        $this->notes = NoteProject::where("project_id", $id)->orderBy('created_at', 'desc')->get();
        $this->statusPhases = Phase::with(['area', 'microArea'])->where("id_project", $id)->where('status', '!=', 'deleted')->get();
        $projectId = $id;
        $phaseIds = Phase::where('id_project', $projectId)->pluck('id');
        $this->tasks = Task::whereIn('id_phases', $phaseIds)->get();


        $ids = json_decode($this->project['stackholder_id'], true);

        if (is_array($ids) && count($ids) > 0) {
            $this->stackholder = Stackholder::whereIn('id', $ids)->get();
        } else {
            $this->stackholder = collect();
        }
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

    public function updateMicroStatusStart($id, $value)
    {
        try {
            $columns = [
                'project_start_id',
                'project_activity_id',
                'project_accounting_id',
                'project_data_id',
                'project_construction_site_plane_id',
                'project_external_validations_id',
                'project_invoices_sal_id',
                'project_non_compliance_id',
                'project_report_id',
                'project_close_id',
            ];

            $task = DB::table('task_projects')->where('id', $id)->first();

            if (!$task) {
                Flux::toast('Task non trovato.');
                return;
            }

            $notNullCount = collect($columns)->filter(function ($column) use ($task) {
                return !is_null($task->{$column});
            })->count();

            if ($notNullCount === 1) {
                DB::table('task_projects')
                    ->where('id', $id)
                    ->update(['status' => $value]);

                $this->dispatch('refresh');

                Flux::toast('Stato aggiornato con successo!');
            } else {
                Flux::toast('Errore: Il task ha più di un campo compilato o nessun campo compilato...');
            }
        } catch (\Exception $e) {
            Flux::toast('Errore durante la variazione di stato...');
        }
    }

    public function microDeleteTask($id)
    {
        try {

            $model = TaskProject::findOrFail($id);

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

        $this->groupedMicroTasks = TaskProject::where("project_id", $this->project->id)
            ->where('status', '!=', 'deleted')
            ->when(
                $this->queryProject,
                fn($q) =>
                $q->where('status', $this->queryProject)
            )
            ->when(
                $this->query,
                fn($q) =>
                $q->where('note', 'like', "%{$this->query}%")
            )
            ->get();

        $this->phasesTable = Phase::with(['area', 'microArea', 'user', 'task'])
            ->where('id_project', $this->project->id)
            ->where('status', '!=', 'deleted')
            ->when(
                $this->queryProject,
                fn($q) =>
                $q->whereHas(
                    'task',
                    fn($task) =>
                    $task->where('status', $this->queryProject)
                )
            )
            ->when(
                $this->query,
                fn($q) =>
                $q->whereHas(
                    'microArea',
                    fn($ma) =>
                    $ma->where('name', 'like', "%{$this->query}%")
                )
            )
            ->get();

        return view('livewire.projects.project-detail')->layout('layout.main');
    }
}
