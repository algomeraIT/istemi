<?php

namespace App\Livewire\Projects\Modals;

use App\Models\ProjectStart;
use App\Models\TaskProjectStart;
use Flux\Flux;
use LivewireUI\Modal\ModalComponent;

class TaskDetail extends ModalComponent
{
    public $id, $tasks;
    public $tab = 'profile';
    public string $note = '';

    public function mount($id)
    {
        $task = TaskProjectStart::findOrFail($id);
        $this->tasks = TaskProjectStart::where('project_id', $task->project_id)->get();

    }

    public function saveNote($id, $projectID, $projectStartID, $clientID)
    {
        try {
            NoteTaskProjectStart::create([
                'project_id' => $projectID,
                'client_id' => $clientID,
                'note' => $this->note,
                'user_id' => auth()->user()->id,
                'user_name' => auth()->user()->name,
                'created_at' => now(),
            ]);

            $this->reset('note');

            Flux::toast('Nota aggiunta con successo!');

        } catch (\Exception $e) {
            dd($e);
            Flux::toast('Errore durante il salvataggio della nota...');
        }
    }
    public function updateStatusStart($id, $value)
    {
        try {
            $record = ProjectStart::findOrFail($id);

            $record->status = $value;
            $record->save();

            Flux::toast('Stato aggiornato con successo!');

        } catch (\Exception $e) {
            Flux::toast('Errore durante la variazione di stato...');
        }
    }

    public function render()
    {
        return view('livewire.projects.modals.task-detail');
    }
}
