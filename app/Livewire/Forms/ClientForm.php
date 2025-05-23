<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Client;
use Illuminate\Http\File;
use Livewire\WithFileUploads;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Auth;

class ClientForm extends Form
{
    use WithFileUploads;

    public $client;
    public $clientId;

    public $logo = [];
    public $parent_id, $sales_manager_id, $is_company, $name, $email, $pec, $first_telephone, $second_telephone, $country, $city, $province, $address, $cap, $tax_code, $p_iva, $sdi, $site, $label, $note, $service, $provenance, $registered_office_address, $has_referent, $status, $step;

    public function rules()
    {
        return [
            'parent_id' => ['nullable', 'integer'],
            'sales_manager_id' => ['nullable'],
            'is_company' => ['nullable', 'boolean'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:clients,email,' . $this->clientId],
            'pec' => ['nullable', 'email'],
            'first_telephone' => ['required', 'string', 'max:20'],
            'second_telephone' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'province' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'cap' => ['nullable', 'string'],
            'tax_code' => ['nullable', 'string', 'max:50'],
            'p_iva' => ['nullable', 'string', 'max:50'],
            'sdi' => ['nullable', 'string', 'max:50'],
            'site' => ['nullable', 'string'],
            'label' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
            'service' => ['nullable', 'string'],
            'provenance' => ['nullable', 'string'],
            'registered_office_address' => ['nullable', 'string'],
            'has_referent' => ['nullable', 'boolean'],
            'status' => ['required', 'string', 'max:50'],
            'step' => ['nullable', 'string', 'max:50'],
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


    public function setClient($client)
    {
        $this->fill($client->only($client->getFillable()));
        $this->client = $client;
        $this->clientId = $client->id;
        $logo = $client->getFirstMedia('logos');

        if ($logo) {
            $this->logo = [
                [
                    'id' => $logo->id,
                    'extension' => pathinfo($logo->file_name, PATHINFO_EXTENSION),
                    'name' => $logo->name,
                    'path' => $logo->getFullUrl(),
                    'size' => $logo->size,
                    'temporaryUrl' => $logo->getFullUrl('preview'),
                    'tmpFilename' => $logo->file_name,
                ]
            ];
        }
    }

    public function store()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        if (!empty($validated['note'])) {
            $validated['note'] = Purifier::clean($validated['note']);
        }

        $client = Client::create($validated);

        if (!empty($this->logo) && isset($this->logo[0]['path'])) {
            $file = new File($this->logo[0]['path']);

            $client->addMedia($file)
                ->usingName(pathinfo($this->logo[0]['name'], PATHINFO_FILENAME))
                ->usingFileName($this->logo[0]['tmpFilename'])
                ->toMediaCollection('logos');
        }
    }

    public function update()
    {
        $this->verifyValidation();
        $validated = $this->validate();

        if (!empty($validated['note'])) {
            $validated['note'] = Purifier::clean($validated['note']);
        }

        $currentLogo = $this->client->getFirstMedia('logos');

        // Controlla se il logo è stato rimosso
        if (empty($this->logo) && $currentLogo) {
            $currentLogo->delete();
        }

        // Controlla se è stato caricato un nuovo logo
        if (!empty($this->logo) && isset($this->logo[0]['path'])) {
            if (!$currentLogo || ($currentLogo && $currentLogo->file_name !== $this->logo[0]['tmpFilename'])) {
                // Cancella il logo precedente
                if ($currentLogo) {
                    $currentLogo->delete();
                }

                // Aggiungi il nuovo logo
                $file = new File($this->logo[0]['path']);
                $this->client
                    ->addMedia($file)
                    ->usingName(pathinfo($this->logo[0]['name'], PATHINFO_FILENAME))
                    ->usingFileName($this->logo[0]['tmpFilename'])
                    ->toMediaCollection('logos');
            }
        }

        $this->client->update($validated);
    }
}
