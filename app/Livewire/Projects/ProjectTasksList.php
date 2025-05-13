<?php

namespace App\Livewire\Projects;

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
use Livewire\Component;
use App\Models\TaskProject;

use Flux\Flux;

class ProjectTasksList extends Component
{
    public Project $project;
    public $isOpenTaskModal = false;
    public $selectedProjectStartId;
    public $groupedMicroTasks;

    public $projectStart, $document, $notes, $accountingValidation, $closeActivity, $constructionSitePlane, $data, $externalValidation, $invoicesSal, $nonComplianceManagement, $report, $referent;

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
        $this->projectStart = ProjectStart::where("project_id", $id)->get();
        $this->groupedMicroTasks = TaskProject::where("project_id", $id)->get();

        $this->accountingValidation = AccountingValidation::where("project_id", $id)->get();
        $this->closeActivity = CloseActivity::where("project_id", $id)->get();
        $this->constructionSitePlane = ConstructionSitePlane::where("project_id", $id)->get();
        $this->data = Data::where("project_id", $id)->get();
        $this->externalValidation = ExternalValidation::where("project_id", $id)->get();
        $this->invoicesSal = InvoicesSal::where("project_id", $id)->get();
        $this->nonComplianceManagement = NonComplianceManagement::where("project_id", $id)->get();
        $this->report = Report::where("project_id", $id)->get();
    }

    public function show($id)
    {
        $this->selectedProjectStartId = $id;
        $this->isOpenTaskModal = true;
    }

    public function updateStatusStart($id, $value)
    {
        try {
            $record = ProjectStart::findOrFail($id);

            $record->status = $value;
            $record->save();

            Flux::toast('Stato aggiornato con successo!');

        } catch (\Exception $e) {
            Flux::toast('Errore durante la variazione di stato...');
        }
    }

    public function deleteTask($id)
    {
        try {
            $task = \App\Models\TaskProjectStart::findOrFail($id);

            $task->update([
                'status' => 'archived',
            ]);

            Flux::toast('Task archiviato con successo!');
        } catch (\Exception $e) {
            Flux::toast('Errore durante l\'archiviazione del task...');
        }
    }
    public function render()
    {
        $tasks = ProjectStart::where('project_id', $this->project->id)->get();
        return view('livewire.projects.project-tasks-list', compact('tasks'))->layout('layout.main');
    }
}
