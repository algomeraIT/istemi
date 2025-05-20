<?php

namespace App\Livewire\Projects;

use App\Models\DocumentProject;
use App\Models\NoteProject;
use App\Models\Project;
use App\Models\Referent;
use App\Models\Stackholder;
use App\Models\TaskProject;
use App\Models\Phase;
use Livewire\Component;

use Livewire\Attributes\On;


class ProjectDetail extends Component
{
    public Project $project;
    public  $projectStart, $document, $notes, $accountingValidation, $closeActivity, $constructionSitePlane, $data, $externalValidation, $invoicesSal, $nonComplianceManagement, $report, $referent;
    public string $detailActiveTab = 'detail-kanban';
    public string $tabListKanbaDetail = 'kanban';
    public string $subDetailActiveTab = 'sub-detail-kanban';
    public string $datasheettabs = 'info';
    public $isOpen = false;
    public $selectedProjectStartId = null;
    public $id;
    public $groupedMicroTasks;
    public $stackholder, $statusPhases;
    public string $datasheetHideDiv = 'task';

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
        $this->groupedMicroTasks = TaskProject::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->referent = Referent::get();
        $this->document = DocumentProject::where("project_id", $id)->get();
        $this->notes = NoteProject::where("project_id", $id)->orderBy('created_at', 'desc')->get();
        $this->statusPhases = Phase::with(['area', 'microArea'])->where("id_project", $id)->get();


        $ids = json_decode($this->project['stackholder_id'], true);

        if (is_array($ids) && count($ids) > 0) {
            $this->stackholder = Stackholder::whereIn('id', $ids)->get();
        } else {
            $this->stackholder = collect();
        }
    }

    public function show($id)
    {
        $this->selectedProjectStartId = $id;
        $this->isOpen = true;
    }

    public function render()
    {

        return view('livewire.projects.project-detail')->layout('layout.main');
    }
}
