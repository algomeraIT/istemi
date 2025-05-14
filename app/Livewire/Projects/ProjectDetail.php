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
use App\Models\Referent;
use App\Models\Report;
use App\Models\Stackholder;
use App\Models\TaskProject;
use Livewire\Component;

class ProjectDetail extends Component
{
    public Project $project;
    public $projectStart, $document, $notes, $accountingValidation, $closeActivity, $constructionSitePlane, $data, $externalValidation, $invoicesSal, $nonComplianceManagement, $report, $referent;
    public string $detailActiveTab = 'detail-kanban';
    public string $tabListKanbaDetail = 'kanban';
    public string $subDetailActiveTab = 'sub-detail-kanban';
    public string $datasheettabs = 'info';
    public $isOpen = false;
    public $selectedProjectStartId = null;
    public $id;
    public $groupedMicroTasks;
    public $stackholder;
    public string $datasheetHideDiv = 'task';

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
        $this->groupedMicroTasks = TaskProject::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->projectStart = ProjectStart::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->accountingValidation = AccountingValidation::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->closeActivity = CloseActivity::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->constructionSitePlane = ConstructionSitePlane::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->data = Data::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->externalValidation = ExternalValidation::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->invoicesSal = InvoicesSal::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->nonComplianceManagement = NonComplianceManagement::where("project_id", $id)->where('status', '!=', 'deleted')->get();
        $this->report = Report::where("project_id", $id)->where('status', '!=', 'deleted')->get();

        $this->referent = Referent::get();
        $this->document = DocumentProject::where("project_id", $id)->get();
        $this->notes = NoteProject::where("project_id", $id)->orderBy('created_at', 'desc')->get();

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

    public function getStatusPhasesList()
    {
        $collections = [
            'Avvio progetto' => $this->projectStart,
            'Verifica tecnico contabile' => $this->accountingValidation,
            'Chiusura attività' => $this->closeActivity,
            'Pianificazione cantiere' => $this->constructionSitePlane,
            'Elaborazione dati' => $this->data,
            'Verifica esterna' => $this->externalValidation,
            'Fattura e acconto SAL' => $this->invoicesSal,
            'Gestione non conformità' => $this->nonComplianceManagement,
            'Report' => $this->report,
        ];

        $result = [];

        foreach ($collections as $label => $items) {
            $phases = [];

            foreach ($items as $item) {
                foreach ($item->getAttributes() as $key => $value) {
                    if (str_starts_with($key, 'status_')) {
                        $phase = str_replace('status_', '', $key);
                        $phases[$phase] = $value ? 'Svolto' : 'In attesa';
                    }
                }
            }

            if (!empty($phases)) {
                $result[$label] = $phases;
            }
        }

        return $result;
    }

    public function deleteTask($id)
    {
        try {
            $task = \App\Models\TaskProjectStart::findOrFail($id);

            $task->update([
                'status' => 'archived',
            ]);

            \Flux\Flux::toast('Task archiviato con successo!');
        } catch (\Exception $e) {
            \Flux\Flux::toast('Errore durante l\'archiviazione del task...');
        }
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
