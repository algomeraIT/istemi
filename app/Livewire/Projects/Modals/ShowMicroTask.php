<?php

namespace App\Livewire\Projects\Modals;

use Livewire\Attributes\On;

use App\Models\Task;
use LivewireUI\Modal\ModalComponent;
use Flux\Flux;


class ShowMicroTask extends ModalComponent
{
    public $microTask, $id, $record;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function updateMicroStatus($id, $value)
    {
        try {
            $record = Task::findOrFail($id);

            $record->status = $value;
            $record->save();

            Flux::toast('Stato aggiornato con successo!');

            $this->dispatch('refresh');
        } catch (\Exception $e) {
            Flux::toast('Errore durante la variazione di stato...');
        }
    }

    #[On('refresh')]
    public function render()
    {
        $this->microTask = Task::query()
        ->where('id', $this->id)->get()->toArray();

        return view('livewire.projects.modals.show-micro-task');
    }
}
