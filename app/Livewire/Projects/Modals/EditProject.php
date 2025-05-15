<?php

namespace App\Livewire\Projects\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\Project;

use Flux\Flux;


class EditProject extends ModalComponent
{
    public array $form = [];
    public Project $project;

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);

        // Fill form with existing values
        $this->form = $this->project->only([
            'name_project',
            'client_name',
            'client_type',
            'total_budget',
            'status',
            'goals',
        ]);
    }

    public function update()
    {
        $this->validate([
            'form.name_project' => 'required|string|max:255',
            'form.client_name' => 'required|string|max:255',
            'form.client_type' => 'nullable|string',
            'form.total_budget' => 'nullable|numeric',
            'form.status' => 'nullable|string|max:255',
            'form.goals' => 'nullable|string',
        ]);

        try {
            $this->project->update($this->form);
            Flux::toast('Progetto aggiornato con successo!');
            $this->dispatch('project-updated');
            $this->closeModal();
        } catch (\Exception $e) {
            Flux::toast('Errore durante l\'aggiornamento del progetto.');
        }
    }

    public function render()
    {
        return view('livewire.projects.modals.edit-project');
    }
}
