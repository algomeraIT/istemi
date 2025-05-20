<?php

namespace App\Livewire\Projects\Modals;
use Livewire\Attributes\On;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Flux\Flux;

class CreateTaskProject extends ModalComponent
{
    public ?int $taskId = null;

    public string $title = '';
    public string $assignee = '';
    public string $cc = '';
    public string $note = '';
    public string $status = 'In attesa';
    public ?string $expire = null;

    public function mount(?int $taskId = null)
    {
        $this->taskId = $taskId;

        if ($taskId) {
            $task = Task::findOrFail($taskId);
            $this->title = $task->title ?? '';
            $this->assignee = $task->assignee ?? '';
            $this->cc = $task->cc ?? '';
            $this->note = $task->note ?? '';
            $this->status = $task->status ?? 'In attesa';
            $this->expire = $task->expire ?? null;
        }
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'assignee' => 'nullable|string|max:255',
            'cc' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'status' => 'required|string|in:In attesa,Svolto',
            'expire' => 'nullable|date',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'assignee' => $this->assignee,
            'cc' => $this->cc,
            'note' => $this->note,
            'status' => $this->status,
            'expire' => $this->expire,
        ];

        if ($this->taskId) {
            Task::findOrFail($this->taskId)->update($data);
            Flux::toast('Attività aggiornata con successo!');
        } else {
            Task::create(array_merge($data, [
                'id_phases' => 1, 
                'id_assignee' => Auth::id(),
            ]));
            Flux::toast('Attività creata con successo!');
        }

        $this->closeModal();
        $this->dispatch('refresh');
    }

    #[On('taskCreated')]
    public function render()
    {
        return view('livewire.projects.modals.create-task-project');
    }
}