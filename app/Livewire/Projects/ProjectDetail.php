<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectStart;

class ProjectDetail extends Component
{
    public Project $project;
    public  $projectStart;
    public string $detailActiveTab = 'detail-kanban';
    public string $subDetailActiveTab = 'sub-detail-kanban';

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
        $this->projectStart = ProjectStart::where("project_id", $id)->get(); 
    }

    public function addTask(){
        
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