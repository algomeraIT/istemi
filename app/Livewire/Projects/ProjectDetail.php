<?php

namespace App\Livewire\Projects;

use App\Models\AccountingValidation;
use App\Models\CloseActivity;
use App\Models\ConstructionSitePlane;
use App\Models\Data;
use App\Models\DocumentProject;
use App\Models\ExternalValidation;
use App\Models\InvoicesSal;
use App\Models\NonComplianceManagement;
use App\Models\NoteProject;
use App\Models\Project;
use App\Models\ProjectStart;
use App\Models\Report;
use App\Models\Referent;
use Livewire\Component;

class ProjectDetail extends Component
{
    public Project $project;
    public $projectStart, $document, $notes, $accountingValidation, $closeActivity, $constructionSitePlane, $data, $externalValidation, $invoicesSal, $nonComplianceManagement, $report, $referent;
    public string $detailActiveTab = 'detail-kanban';
    public string $subDetailActiveTab = 'sub-detail-kanban';
    public string $datasheettabs = 'info';
    public $isOpen = true;
    public $selectedProjectStartId = null;
    public $id;
    public string $datasheetHideDiv = 'task';

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
      
        $this->projectStart = ProjectStart::where("project_id", $id)->get();  
        $this->accountingValidation = AccountingValidation::where("project_id", $id)->get();
        $this->closeActivity = CloseActivity::where("project_id", $id)->get();
        $this->constructionSitePlane = ConstructionSitePlane::where("project_id", $id)->get();
        $this->data = Data::where("project_id", $id)->get();
        $this->externalValidation = ExternalValidation::where("project_id", $id)->get();
        $this->invoicesSal = InvoicesSal::where("project_id", $id)->get();
        $this->nonComplianceManagement = NonComplianceManagement::where("project_id", $id)->get();
        $this->report = Report::where("project_id", $id)->get();
        $this->referent = Referent::get();

        $this->document = DocumentProject::where("project_id", $id)->get();
        $this->notes = NoteProject::where("project_id", $id)->orderBy('created_at', 'desc')->get();
    }

    public function show($id)
    {
        $this->selectedProjectStartId = $id;
        $this->isOpen = true;
    }

    public function render()
    {
        $boolColumns = [
            'contract_ver' => 'Verifica contratto',
            'cme_ver' => 'CME Verifica',
            'reserves' => 'Riserve',
            'expiring_date_project' => 'Data scadenza progetto',
            'communication_plan' => 'Piano comunicazione',
            'extension' => 'Proroga',
            'sal' => 'SAL',
            'warranty' => 'Garanzia',
        ];

        return view('livewire.projects.project-detail', compact('boolColumns'))->layout('layout.main');
    }
}
