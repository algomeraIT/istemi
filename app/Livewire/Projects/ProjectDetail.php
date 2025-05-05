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

    public function render()
    {
        return view('livewire.projects.project-detail')->layout('layout.main');
    }
}