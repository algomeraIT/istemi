<?php

namespace App\Livewire\Projects\Modals;

use App\Models\Phase;
use Livewire\Attributes\On;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Flux\Flux;

class CreateTaskProject extends ModalComponent
{
    public ?int $taskId = null;
    public ?int $phase_id = null;
    public ?int $project_id = null;

    public string $title = '';
    public string $assignee = '';
    public string $cc = '';
    public string $note = '';
    public string $status = 'In attesa';
    public ?string $expire = null;
    public array $users = [];

    public function mount(?int $taskId = null, ?int $phase_id = null, ?int $project_id = null)
    {
        $this->taskId = $taskId;
        $this->phase_id = $phase_id;
        $this->project_id = $project_id;

        $this->users = User::select('name', 'last_name')->get()
            ->map(fn($user) => ['id' => $user->name . ' ' . $user->last_name])
            ->pluck('id')
            ->toArray();

            if ($this->taskId) {
                $task = Task::findOrFail($this->taskId);
        
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
                'id_phases' => $this->phase_id,
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