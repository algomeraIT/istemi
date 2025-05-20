<?php

namespace App\Livewire\Projects;

use Livewire\Attributes\On;

use App\Models\Project;
use App\Models\TaskProject;
use App\Models\Phase;
use Flux\Flux;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class ProjectTasksList extends Component
{
    public Project $project;
    public $isOpenTaskModal = false;
    public $selectedProjectStartId;
    public $groupedMicroTasks;

    public $phasesTable, $tasks, $projectStart, $document, $notes, $accountingValidation, $closeActivity, $constructionSitePlane, $data, $externalValidation, $invoicesSal, $nonComplianceManagement, $report, $referent;

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
        $this->groupedMicroTasks = TaskProject::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->phasesTable = Phase::with(['area', 'microArea', 'user', 'task'])
            ->where('id_project', $id)->where('status', '!=', 'deleted')
            ->get();
    }

    public function show($id)
    {
        $this->selectedProjectStartId = $id;
        $this->isOpenTaskModal = true;
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
/*         $tasks = ProjectStart::where('project_id', $this->project->id)->get();
 */        return view('livewire.projects.project-tasks-list')->layout('layout.main');
    }
}
