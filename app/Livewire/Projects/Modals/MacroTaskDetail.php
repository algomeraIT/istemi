<?php

namespace App\Livewire\Projects\Modals;

use App\Models\NoteProject;
use LivewireUI\Modal\ModalComponent;
use Flux\Flux;
use Livewire\Attributes\On;
use App\Models\TaskProject;
use App\Models\Task;
use App\Models\Phase;
use Illuminate\Support\Facades\Auth;


class MacroTaskDetail extends ModalComponent
{
    public $tasks, $groupedTasks, $monthTasks, $notes;

    public string $note = '';

    public function mount($id)
    {
        $this->tasks = Task::where('id', $id)->get();
        $this->notes = NoteProject::where('project_id', $id)->get();
    }

    public function updateStatusStart($id, $value)
    {
        try {
            $record = Phase::findOrFail($id);

            $record->status = $value;
            $record->save();

            Flux::toast('Stato aggiornato con successo!');

            $this->dispatch('refresh');
        } catch (\Exception $e) {
            Flux::toast('Errore durante la variazione di stato...');
        }
    }

    public function saveNote($id, $projectId, $clientId)
    {
        $this->validate([
            'note' => 'required|string|min:2',
        ]);

        TaskProject::create([
            'project_id' => $projectId,
            'client_id' => $clientId,
            'note' => $this->note,
            'user_id' => Auth::user()->id,
            'title' => '',
            'role' => Auth::user()->role,
            'project_id' => $id,
            'user_name' => Auth::user()->name . ' ' . Auth::user()->last_name,
        ]);

        Flux::toast('Nota inserita con successo!');
        $this->dispatch('refresh');
    }

    #[On('refresh')]
    public function render()
    {
        return view('livewire.projects.modals.macro-task-detail');
    }
}
