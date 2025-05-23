<?php

namespace App\Livewire\Forms\Client;

use Livewire\Form;
use App\Models\Activity;
use Mews\Purifier\Facades\Purifier;
use Livewire\WithFileUploads;


class ActivityForm extends Form
{
    use WithFileUploads;

    public $activity;

    public $client_id, $title, $note, $expiration, $completed_at;
    public $status = 'nuovo';
    public $assigned;
    public $contacts;

    public $responseMessage;
    public $attachments = [];

    public function rules()
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'title' => ['required', 'string', 'max:255'],
            'assigned' => ['required'],
            'assigned.*' => ['exists:users,id'],
            'expiration' => ['required', 'date', 'after:today'],
            'note' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'Il cliente è obbligatorio.',
            'client_id.exists' => 'Il cliente selezionato non è valido.',
            'title.required' => 'Il titolo è obbligatorio.',
            'assigned.required' => 'Assegnare almeno un utente.',
            'assigned.array' => 'Il campo assegnati deve essere un array di utenti.',
            'assigned.*.exists' => 'Uno degli utenti assegnati non è valido.',
            'expiration.required' => 'La data di scadenza è obbligatoria.',
            'expiration.after' => 'La data di scadenza deve essere futura.',
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

    public function setActivity($activity)
    {
        $this->fill($activity->only($activity->getFillable()));

        $this->activity = $activity->load('messages');
        $this->assigned = $activity->assigned()->where('role', 'assegnato')->pluck('user_id')->toArray();
        $this->contacts = $activity->assigned()->where('role', 'conoscenza')->pluck('user_id')->toArray();
    }

    public function store()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        if (!empty($validated['note'])) {
            $validated['note'] = Purifier::clean($validated['note']);
        }

        unset($validated['assigned']);

        $activity = Activity::create($validated);

        if (count($this->attachments)) {
            foreach ($this->attachments as $file) {
                $activity->addMedia($file->getRealPath())
                    ->usingFileName($file->getClientOriginalName())
                    ->toMediaCollection('attached');
            }
        }

        $activity->assigned()->sync($this->buildUserRoleMap());

        $this->reset();
    }

    public function update()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        if (!empty($validated['note'])) {
            $validated['note'] = Purifier::clean($validated['note']);
        }

        unset($validated['assigned']);

        if (!$this->activity) {
            throw new \Exception('Attività non trovata. Non è possibile aggiornare.');
        }

        $this->activity->update($validated);

        if (count($this->attachments)) {
            foreach ($this->attachments as $file) {
                $this->activity->addMedia($file->getRealPath())
                    ->usingFileName($file->getClientOriginalName())
                    ->toMediaCollection('attached');
            }
        }

        $this->activity->assigned()->sync($this->buildUserRoleMap());

        $this->reset();
    }

    private function buildUserRoleMap(): array
    {
        $assigned = is_array($this->assigned) ? $this->assigned : [$this->assigned];
        $contacts = is_array($this->contacts) ? $this->contacts : [$this->contacts];

        $assignedMap = collect($assigned)
            ->mapWithKeys(fn($userId) => [
                $userId => ['role' => 'assegnato']
            ]);

        $contactMap = collect($contacts)
            ->reject(fn($userId) => isset($assignedMap[$userId])) // evita duplicati
            ->mapWithKeys(fn($userId) => [
                $userId => ['role' => 'conoscenza']
            ]);

        return $contactMap->union($assignedMap)->toArray();
    }
}
