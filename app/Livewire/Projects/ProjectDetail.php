<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;

class ProjectDetail extends Component
{
    public Project $project;
    public string $detailActiveTab = 'detail-kanban';

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.projects.project-detail')->layout('layout.main');
    }
}