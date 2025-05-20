<?php

namespace App\Livewire\Projects\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Task;


class TaskDetail extends ModalComponent
{
    public $id, $tasks, $user_name;
    public $tab = 'profile';
    public string $note = '';

    public function mount($id)
    {
        $this->tasks = Task::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.projects.modals.task-detail');
    }
}
