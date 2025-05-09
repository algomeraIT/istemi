<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\ProjectStart;
use App\Models\DocumentProject;
use App\Models\NoteProject;
use Livewire\Component;
use Livewire\Attributes\Reactive;


class ProjectDetail extends Component
{
    public Project $project;
    public $projectStart, $document, $notes;
    public string $detailActiveTab = 'detail-kanban';
    public string $subDetailActiveTab = 'sub-detail-kanban';
    public $isOpen = true;
    public $selectedProjectStartId = null;
    public $id;
    public string $datasheetHideDiv = 'task'; 

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
        $this->projectStart = ProjectStart::where("project_id", $id)->get();
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
