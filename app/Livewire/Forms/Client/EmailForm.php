<?php

namespace App\Livewire\Forms\Client;

use Livewire\Form;
use App\Models\Email;
use App\Models\Client;
use App\Mail\SendClientMail;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Mail;

class EmailForm extends Form
{
    public $email;

    public $client_id, $sent_by, $to, $subject, $body;

    public function rules()
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'sent_by' => ['required', 'exists:users,id'],
            'to' => ['required', 'array', 'min:1'],
            'to.*' => ['required', 'email'],
            'subject' => ['required', 'string'],
            'body' => ['required', 'string'],
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
        $this->email = $email;

        $this->fill($email->only($email->getFillable()));
    }

    public function store()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        $validated['body'] = Purifier::clean($this->body);

        $client = Client::findOrFail($this->client_id);
        $cc = $this->to;

        Mail::to($client->email)->send(
            new SendClientMail($this->subject, $validated['body'], $client, $cc)
        );

        $validated['to'] = $cc;
        Email::create($validated);
    }
}
