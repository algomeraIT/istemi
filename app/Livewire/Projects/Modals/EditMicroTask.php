<?php

namespace App\Livewire\Projects\Modals;

use Livewire\Component;
use App\Models\TaskProject;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;
use Flux\Flux;


class EditMicroTask extends ModalComponent
{
    use WithFileUploads;

    public $microTaskId;
    public $title;
    public $assignee;
    public $cc;
    public $expire;
    public $note;
    public $media = [];
    public $status;

    public function mount($id)
    {
        $task = TaskProject::findOrFail($id);

        $this->microTaskId = $task->id;
        $this->title = $task->title;
        $this->assignee = $task->assignee;
        $this->cc = $task->cc;
        $this->expire = $task->expire;
        $this->note = $task->note;
        $this->status = $task->status;
        $this->media = $task->media ?? [];
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'assignee' => 'nullable|string|max:255',
            'cc' => 'nullable|string|max:255',
            'expire' => 'nullable|date',
            'note' => 'nullable|string',
            'status' => 'required|string|in:In attesa,Svolto',
        ];
    }

    public function save()
    {
        try {
            $this->validate();
    
            $task = TaskProject::findOrFail($this->microTaskId);
    
            $task->update([
                'title' => $this->title,
                'assignee' => $this->assignee,
                'cc' => $this->cc,
                'expire' => $this->expire,
                'note' => $this->note,
                'status' => $this->status,
                'media' => $this->media,
            ]);
    
            Flux::toast('MicroTask aggiornato con successo!');
        } catch (\Exception $e) {
            logger()->error('Errore durante il salvataggio del MicroTask: ' . $e->getMessage());
            Flux::toast('Errore durante l\'aggiornamento del MicroTask.');
        }
    }

    public function render()
    {
        return view('livewire.projects.modals.edit-micro-task');
    }
}
