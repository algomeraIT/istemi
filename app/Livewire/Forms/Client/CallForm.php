<?php

namespace App\Livewire\Forms\client;

use Livewire\Form;
use App\Models\Call;
use Livewire\WithFileUploads;
use Mews\Purifier\Facades\Purifier;

class CallForm extends Form
{
    use WithFileUploads;

    public $call;

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

    public function setCall($call)
    {
        $this->fill($call->only($call->getFillable()));

        $this->call = $call;
    }

    public function store()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        $validated['content'] = Purifier::clean($validated['content']);

        $call = Call::create($validated);

        if (count($this->attachments)) {
            foreach ($this->attachments as $file) {
                $call->addMedia($file->getRealPath())
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

        $this->call->update($validated);

        $this->reset();
    }
}
