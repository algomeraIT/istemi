<?php

namespace App\Livewire\Projects;

use Livewire\Attributes\On;

use App\Models\AccountingValidation;
use App\Models\CloseActivity;
use App\Models\ConstructionSitePlane;
use App\Models\Data;
use App\Models\ExternalValidation;
use App\Models\InvoicesSal;
use App\Models\NonComplianceManagement;
use App\Models\Project;
use App\Models\ProjectStart;
use App\Models\Report;
use App\Models\TaskProject;
use Flux\Flux;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class ProjectTasksList extends Component
{
    public Project $project;
    public $isOpenTaskModal = false;
    public $selectedProjectStartId;
    public $groupedMicroTasks, $nameSection;

    public $projectStart, $document, $notes, $accountingValidation, $closeActivity, $constructionSitePlane, $data, $externalValidation, $invoicesSal, $nonComplianceManagement, $report, $referent;

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
        $this->projectStart = ProjectStart::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->groupedMicroTasks = TaskProject::where("project_id", $id)->where('status', '!=', 'deleted')->get();

        $this->accountingValidation = AccountingValidation::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->closeActivity = CloseActivity::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->constructionSitePlane = ConstructionSitePlane::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->data = Data::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->externalValidation = ExternalValidation::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->invoicesSal = InvoicesSal::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->nonComplianceManagement = NonComplianceManagement::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->report = Report::where("project_id", $id)->where('status', '!=', 'deleted')->get();
    }

    public function show($id)
    {
        $this->selectedProjectStartId = $id;
        $this->isOpenTaskModal = true;
    }

    public function updateStatusStart($id, $value, $nameTable)
    {
        try {
            $modelClass = class_exists($nameTable) ? $nameTable : 'App\\Models\\' . $nameTable;

            if (!class_exists($modelClass)) {
                throw new \Exception("Model {$modelClass} non esiste...");
            }
            $record = $modelClass::findOrFail($id);

            $record->status = $value;
            $record->save();

            Flux::toast('Stato aggiornato con successo!');

            $this->dispatch('refresh');

        } catch (\Exception $e) {
            dd($e);
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

            Flux::toast('MicroTask eliminato con successo!');
        } catch (\Exception $e) {
            logger()->error("Errore nella cancellazione: " . $e->getMessage());
            Flux::toast('Errore durante la cancellazione del MicroTask.');
        }
    }

    public function deleteMacroTask($id, $nameTable)
    {
        try {
            $collections = [
                'Avvio progetto' => 'ProjectStart',
                'Verifica tecnico contabile' => 'AccountingValidation',
                'Chiusura attività' => 'CloseActivity',
                'Pianificazione cantiere' => 'ConstructionSitePlane',
                'Elaborazione dati' => 'Data',
                'Verifica esterna' => 'ExternalValidation',
                'Fattura e acconto SAL' => 'InvoicesSal',
                'Gestione non conformità' => 'NonComplianceManagement',
                'Report' => 'Report',
            ];

            $class = $collections[$nameTable];

            if (!class_exists('App\\Models\\' .  $class)) {
                throw new \Exception("Model {$class} non esiste...");
            }

            $className = 'App\\Models\\' . $class;
            $model = $className::findOrFail($id);

            $model->status = "deleted";
            $model->save();

            Flux::toast('MicroTask eliminato con successo!');
        } catch (\Exception $e) {
            dd($e);
            Flux::toast('Errore durante la cancellazione del MacroTask.');
        }
    }
    public function render()
    {
        $tasks = ProjectStart::where('project_id', $this->project->id)->get();
        return view('livewire.projects.project-tasks-list', compact('tasks'))->layout('layout.main');
    }
}
