<?php

namespace App\Livewire\Projects;

use App\Models\ProjectStart;
use Livewire\Component;

class ProjectTasksList extends Component
{
    public $project;

    public function mount($project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $tasks = ProjectStart::where('project_id', $this->project->id)->get();
        return view('livewire.projects.project-tasks-list', compact('tasks'));
    }
}