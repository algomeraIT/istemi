<?php

namespace App\Livewire\Projects\Modals;

use App\Models\Phase;
use App\Models\User;
use Flux\Flux;
use LivewireUI\Modal\ModalComponent;

class EditTask extends ModalComponent
{
    public $name_phase;
    public $id_user;
    public $status;
    public Phase $phase;

    public function mount($taskId)
    {
        $this->phase = Phase::with(['area', 'microArea', 'user'])->findOrFail($taskId);

        $this->id_user = $this->phase->user->id;
        $this->status = $this->phase->status;
    }

    public function save()
    {
        $this->phase->update([
            'id_user' => $this->id_user,
            'status' => $this->status,
        ]);

        $this->closeModal();

        Flux::toast('Task aggiornato con successo!');
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.projects.modals.edit-task', [
            'users' => User::select('id', 'name', 'last_name')->get(),
        ]);
    }
}