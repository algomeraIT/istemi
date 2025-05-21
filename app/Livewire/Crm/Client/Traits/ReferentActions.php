<?php

namespace App\Livewire\Crm\Client\Traits;

use Flux\Flux;
use App\Models\Referent;

trait ReferentActions
{
    public function setReferent($id = null, $action = 'create')
    {
        $this->referentForm->setReferent($id);

        if ($action == 'show') {
            Flux::modal('show-referent')->show();
        } else {
            Flux::modal('create-edit-referent')->show();
        }
    }

    public function createReferent()
    {
        $this->referentForm->client_id = $this->client->id;
        $this->referentForm->store();

        Flux::modals()->close();

        Flux::toast(
            text: "Nuovo referente inserito con successo.",
            variant: 'success',
        );

        $this->dispatch('refresh');
    }

    public function updateReferent()
    {
        $this->referentForm->update();

        Flux::modals()->close();

        Flux::toast(
            text: "Referent aggiornato con successo.",
            variant: 'success',
        );

        $this->dispatch('refresh');
    }

    public function deleteReferent($id)
    {
        Referent::find($id)->delete();
        session()->flash('message', 'Referente eliminato con successo!');
    }
}
