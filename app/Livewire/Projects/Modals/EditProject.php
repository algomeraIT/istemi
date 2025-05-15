<?php

namespace App\Livewire\Projects\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\Project;

use Flux\Flux;


class EditProject extends ModalComponent
{
    public Project $project;

    public array $form = [];

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->form = $project->toArray();

        
    }

    public function rules(): array
    {
        return [
            'form.name_project' => 'required|string|max:255',
            'form.client_name' => 'required|string|max:255',
            'form.client_type' => 'nullable|string',
            'form.total_budget' => 'nullable|numeric',
            'form.status' => 'nullable|string',
            'form.start_at' => 'nullable|date',
            'form.end_at' => 'nullable|date|after_or_equal:form.start_at',
            'form.goals' => 'nullable|string',
            'form.project_scope' => 'nullable|string',
            'form.expected_results' => 'nullable|string',
        ];
    }

    public function update()
    {
        $this->validate();

        try {
            $this->project->update($this->form);

            Flux::toast('Progetto modificato con successo!');

        } catch (\Exception $e) {
            Flux::toast('Non è stato possibile modificare il progetto...');

        }
    }

    public function render()
    {
        return view('livewire.projects.modals.edit-project');
    }
}
