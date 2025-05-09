<?php

namespace App\Livewire\Projects;

use App\Models\NoteProject;
use Livewire\Component;

class ProjectNotesList extends Component
{
    public $project;

    public function mount($project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $notes = NoteProject::where('project_id', $this->project->id)
                            ->orderBy('created_at','desc')
                            ->get()
                            ->groupBy(fn($n) => $n->created_at->locale('it')->isoFormat('MMMM YYYY'));
        return view('livewire.projects.project-notes-list', compact('notes'));
    }
}