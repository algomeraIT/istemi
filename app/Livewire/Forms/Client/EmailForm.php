<?php

namespace App\Livewire\Forms\Client;

use Livewire\Form;
use App\Models\Email;
use App\Models\Client;
use App\Mail\SendClientMail;
use Livewire\WithFileUploads;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Mail;

class EmailForm extends Form
{
    use WithFileUploads;

    public $email;

    public $client_id, $sent_by, $to, $subject, $body;
    public $attachments = [];

    public function rules()
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'sent_by' => ['required', 'exists:users,id'],
            'to' => ['required', 'array', 'min:1'],
            'to.*' => ['required', 'email'],
            'subject' => ['required', 'string'],
            'body' => ['required', 'string'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:10240'],
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

    public function setMail($email)
    {
        $this->fill($email->only($email->getFillable()));

        $this->email = $email;
    }

    public function store()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        $validated['body'] = Purifier::clean($this->body);

        $client = Client::findOrFail($this->client_id);
        $cc = $this->to;

        Mail::to($client->email)->send(
            new SendClientMail($this->subject, $validated['body'], $client, $cc, $this->attachments)
        );

        $validated['to'] = $cc;
        unset($validated['attachments']);

        $email = Email::create($validated);

        if ($this->attachments && is_array($this->attachments)) {
            foreach ($this->attachments as $file) {
                $email->addMedia($file->getRealPath())
                    ->usingFileName($file->getClientOriginalName())
                    ->toMediaCollection('attached');
            }
        }
    }
}
