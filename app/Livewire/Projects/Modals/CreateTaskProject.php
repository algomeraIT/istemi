<?php

namespace App\Livewire\Projects\Modals;
use Livewire\Attributes\On;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Flux\Flux;

class CreateTaskProject extends ModalComponent
{
    public $project_id;
    public $client_id;
    public $user_id;
    public $user_name;

    public $title;
    public $assignee;
    public $cc;
    public $expire;
    public $note;
    public $media;
    public $status = 'In attesa';

    public $linkedPhaseType; 
    public $linkedPhaseId;

    protected $rules = [
        'title' => 'required|string|max:255',
        'assignee' => 'required|string|max:255',
        'expire' => 'nullable|date',
        'note' => 'nullable|string',
        'status' => 'required|string',
    ];

    public function mount($project_id, $phase, $id)
    {
        $this->project_id = $project_id;
        $this->linkedPhaseType = $phase; 
        $this->linkedPhaseId = $id;       
        $this->user_id = Auth::id();
        $this->user_name = Auth::user()?->name . ' ' . Auth::user()?->last_name  ?? 'Utente';
    }

    public function create()
    {
        $this->validate();

        try {

            $task = new Task();
            $task->id_phases = $this->linkedPhaseId;
            $task->id_assignee = $this->user_id;
            $task->title = $this->title;
            $task->assignee = $this->assignee;
            $task->cc = $this->cc;
            $task->expire = $this->expire;
            $task->note = $this->note;
            $task->media = $this->media;
            $task->status = $this->status;

            $task->save();

            Flux::toast('Task aggiunto con successo!');
            $this->dispatch('taskCreated');
            $this->closeModal();

        } catch (\Exception $e) {
            dd($e);
            Flux::toast('Errore durante la creazione del task.');
        }
    }

    #[On('taskCreated')]
    public function render()
    {
        return view('livewire.projects.modals.create-task-project');
    }
}