<?php

namespace App\Livewire\Modals\Crm\Client;

use Flux\Flux;
use App\Models\Client;
use Livewire\Attributes\On;
use App\Livewire\Forms\ClientForm;
use LivewireUI\Modal\ModalComponent;

class CreateOrUpdate extends ModalComponent
{
    public ClientForm $clientForm;

    public function mount(Client $client, $clientStatus = null)
    {
        if ($client->id) {
            $this->clientForm->setClient($client);
            $this->dispatch('loadClient');
        } else {
            $this->clientForm->status = $clientStatus;
        }
    }

    public function create()
    {
        $this->clientForm->store();

        $this->closeModal();

        Flux::toast(
            text: "Nuovo {$this->clientForm->status} creato con successo.",
            variant: 'success',
        );

        $this->dispatch('refresh');
    }

    public function update() {
        $this->clientForm->update();

        $this->closeModal();

        Flux::toast(
            text: "{$this->clientForm->client->name} modificato con successo.",
            variant: 'success',
        );

        $this->dispatch('refresh');
    }

    public static function modalMaxWidthClass(): string
    {
        return 'max-w-full-minus-5 !mt-20';
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    #[On('loadClient')]
    public function render()
    {
        return view('livewire.modals.crm.client.create-or-update');
    }
}
