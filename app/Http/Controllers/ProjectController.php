<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.project');
    }

/*     public function goToDetail($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('livewire.projects.project-detail', [
            'project' => $project,
        ]);
    } */
}