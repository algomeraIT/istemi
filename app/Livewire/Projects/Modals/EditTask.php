<?php

namespace App\Livewire\Projects\Modals;

use Flux\Flux;
use LivewireUI\Modal\ModalComponent;
use App\Models\Phase;


class EditTask extends ModalComponent
{
    public $task;
    public $name_phase, $user, $status, $form;

    public function mount($id)
    {
        $this->task = Phase::findOrFail($id);

        $this->form = $this->task->only([
            'name_phase', 'user', 'status',
        ]);

        $this->name_phase = $this->task->name_phase;
        $this->user = $this->task->user;
        $this->status = $this->task->status;
    }

    public function save()
    {
        $this->task->update([
            'name_phase' => $this->name_phase,
            'user' => $this->user,
            'status' => $this->status,
        ]);

        $this->closeModal();

        Flux::toast('Task aggiornato con successo!');

        $this->dispatch('refresh');

    }

    public function render()
    {
        return view('livewire.projects.modals.edit-task');
    }
}
