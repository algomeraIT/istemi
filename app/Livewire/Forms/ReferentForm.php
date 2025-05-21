<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Referent;
use Mews\Purifier\Facades\Purifier;

class ReferentForm extends Form
{
    public $referent;
    public $referentId;

    public $client_id, $name, $last_name, $title, $job_position, $email, $telephone, $note;

    public function rules()
    {
        return [
            'client_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'title' => ['nullable', 'string'],
            'job_position' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:referents,email,' . $this->referentId],
            'telephone' => ['required', 'string'],
            'note' => ['nullable', 'string'],
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

    public function setReferent($referentId)
    {
        if ($referentId) {
            $this->referent = Referent::findOrFail($referentId);
            $this->referentId = $referentId;
            $this->fill($this->referent->only($this->referent->getFillable()));
        } else {
            $this->reset();
            $this->referent = null;
            $this->referentId = null;
        }
    }

    public function store()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        if (!empty($validated['note'])) {
            $validated['note'] = Purifier::clean($validated['note']);
        }

        Referent::create($validated);
    }

    public function update()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        if (!$this->referent) {
            throw new \Exception('Referente non trovato. Non è possibile aggiornare.');
        }

        if (!empty($validated['note'])) {
            $validated['note'] = Purifier::clean($validated['note']);
        }

        $this->referent->update($validated);
    }
}
