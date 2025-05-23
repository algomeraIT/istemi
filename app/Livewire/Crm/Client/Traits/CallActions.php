<?php

namespace App\Livewire\Crm\Client\Traits;

use App\Models\Call;
use Flux\Flux;


trait CallActions
{
    public function createCall()
    {
        $this->callForm->client_id = $this->client->id;
        $this->callForm->store();

        Flux::toast(
            text: "Nuova chiamata inserita.",
            variant: 'success',
        );

        Flux::modals()->close();
    }

    public function updateCall()
    {
        $this->callForm->update();

        Flux::toast(
            text: "Chiamata modificata con successo.",
            variant: 'success',
        );

        Flux::modals()->close();
    }


    public function modifyCall($id)
    {
        Flux::modals()->close();

        $this->setCall($id);

        Flux::modal('new-call')->show();
    }

    public function showCall($id)
    {
        $this->setCall($id);

        Flux::modal('show-call')->show();
    }


    public function setCall($id)
    {
        $call = Call::findOrFail($id);

        $this->callForm->setCall($call);
    }

    public function deleteCall($id)
    {
        Flux::modals()->close();

        Call::findOrFail($id)->delete();

        $this->callForm->reset();

        Flux::toast(
            text: "Chiamata eliminata.",
            variant: 'warning',
        );
    }

    public function removeCallAttachmentByIndex($index)
    {
        if (isset($this->callForm->attachments[$index])) {
            unset($this->callForm->attachments[$index]);
            $this->callForm->attachments = array_values($this->callForm->attachments);
        }
    }

    public function resetCall()
    {
        $this->callForm->reset();
    }
}
