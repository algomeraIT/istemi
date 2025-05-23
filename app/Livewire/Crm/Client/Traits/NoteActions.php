<?php

namespace App\Livewire\Crm\Client\Traits;

use App\Models\Note;
use Flux\Flux;


trait NoteActions
{
    public function createNote()
    {
        $this->noteForm->client_id = $this->client->id;
        $this->noteForm->store();

        Flux::toast(
            text: "Nuova nota inserita.",
            variant: 'success',
        );

        Flux::modals()->close();
    }

    public function updateNote()
    {
        $this->noteForm->update();

        Flux::toast(
            text: "Nota modificata con successo.",
            variant: 'success',
        );

        Flux::modals()->close();
    }


    public function modifyNote($id)
    {
        Flux::modals()->close();

        $this->setNote($id);

        Flux::modal('new-note')->show();
    }

    public function showNote($id)
    {
        $this->setNote($id);

        Flux::modal('show-note')->show();
    }


    public function setNote($id)
    {
        $note = Note::findOrFail($id);

        $this->noteForm->setNote($note);
    }

    public function deleteNote($id)
    {
        Flux::modals()->close();

        Note::findOrFail($id)->delete();

        $this->noteForm->reset();

        Flux::toast(
            text: "Nota eliminata.",
            variant: 'warning',
        );
    }

    public function removeNoteAttachmentByIndex($index)
    {
        if (isset($this->noteForm->attachments[$index])) {
            unset($this->noteForm->attachments[$index]);
            $this->noteForm->attachments = array_values($this->noteForm->attachments);
        }
    }


    public function resetNote()
    {
        $this->noteForm->reset();
    }
}
