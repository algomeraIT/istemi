<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;

class ProjectDatasheet extends Component
{
    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.projects.project-datasheet');
    }
}