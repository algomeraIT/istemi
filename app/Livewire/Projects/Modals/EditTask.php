<?php

namespace App\Livewire\Projects\Modals;

use App\Models\TaskProjectStart;
use Flux\Flux;
use LivewireUI\Modal\ModalComponent;

class EditTask extends ModalComponent
{
    public TaskProjectStart $task;
    public $title, $assignee, $expire, $note;

    public function mount($id)
    {
        $this->task = TaskProjectStart::findOrFail($id);

        $this->title = $this->task->title;
        $this->assignee = $this->task->assignee;
        $this->expire = $this->task->expire;
        $this->note = $this->task->note;
    }

    public function save()
    {
        $this->task->update([
            'title' => $this->title,
            'assignee' => $this->assignee,
            'expire' => $this->expire,
            'note' => $this->note,
        ]);

        Flux::toast('Task aggiornato con successo!');
    }

    public function render()
    {
        return view('livewire.projects.modals.edit-task');
    }
}
