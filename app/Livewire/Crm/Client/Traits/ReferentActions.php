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
    }

    public function updateReferent()
    {
        $this->referentForm->update();

        Flux::modals()->close();

        Flux::toast(
            text: "Referente aggiornato con successo.",
            variant: 'success',
        );
    }

    public function deleteReferent($id)
    {
        Referent::findOrFail($id)->delete();

        $this->referentForm->reset();

        Flux::toast(
            text: "Referente eliminato.",
            variant: 'warning',
        );
    }
}
