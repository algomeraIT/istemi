<?php

namespace App\Livewire\Forms\Client;

use Livewire\Form;
use App\Models\Note;
use Livewire\WithFileUploads;
use Mews\Purifier\Facades\Purifier;

class NoteForm extends Form
{
    use WithFileUploads;

    public $note;

    public $client_id, $content;
    public $attachments = [];

    public function rules()
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'content' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Il campo è obbligatorio.',
        ];
    }

    public function verifyValidation(): void
    {
        if (config('app.env') === 'production') {
            $this->validate();
        } else {
            try {
                $this->validate();
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Gestione dell'eccezione di validazione
                dd($e->errors()); // Mostra i messaggi di errore con dd() per fare debug
            }
        }
    }

    public function setNote($note)
    {
        $this->fill($note->only($note->getFillable()));

        $this->note = $note;
    }

    public function store()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        $validated['content'] = Purifier::clean($validated['content']);

        $note = Note::create($validated);

        if (count($this->attachments)) {
            foreach ($this->attachments as $file) {
                $note->addMedia($file->getRealPath())
                    ->usingFileName($file->getClientOriginalName())
                    ->toMediaCollection('attached');
            }
        }

        $this->reset();
    }

    public function update()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        $validated['content'] = Purifier::clean($validated['content']);

        $this->note->update($validated);

        if (count($this->attachments)) {
            foreach ($this->attachments as $file) {
                $this->note->addMedia($file->getRealPath())
                    ->usingFileName($file->getClientOriginalName())
                    ->toMediaCollection('attached');
            }
        }

        $this->reset();
    }
}
