<?php

namespace App\Livewire\Projects;

use App\Models\DocumentProject;
use Livewire\Component;

class ProjectDocumentsList extends Component
{
    public $project;

    public function mount($project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $docs = DocumentProject::where('project_id', $this->project->id)->get();
        return view('livewire.projects.project-documents-list', compact('docs'));
    }
}