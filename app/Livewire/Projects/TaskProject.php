<?php

namespace App\Livewire\Projects;

use Livewire\Component;

class TaskProject extends Component
{
    public function mount($id)
    {

        $this->projectStart = ProjectStart::where("project_id", $id)->get();
   
    }

    public function updateStatusStart($id, $value)
    {
        try {
            $record = ProjectStart::findOrFail($id);

            $record->status = $value;
            $record->save();

            $this->dispatchBrowserEvent('flux-toast', [
                'message' => 'Stato aggiornato con successo!',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('flux-toast', [
                'message' => 'Errore durante l\'aggiornamento.',
                'type' => 'error',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.projects.task-project');
    }
}
