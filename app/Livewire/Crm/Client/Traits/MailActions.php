<?php

namespace App\Livewire\Crm\Client\Traits;

use Flux\Flux;
use App\Models\Email;

trait MailActions
{
    public function sendEmails()
    {
        $this->emailForm->client_id = $this->client->id;
        $this->emailForm->store();

        $this->dispatch('refresh');

        Flux::toast(
            text: "Invio E-mail in corso.",
            variant: 'success',
        );

        Flux::modals()->close();
    }

    public function setEmail($id)
    {
        Flux::modals()->close();

        $email = Email::findOrFail($id);

        $this->emailForm->setMail($email);

        Flux::modal('show-email')->show();
    }
}
