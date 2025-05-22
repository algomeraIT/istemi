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

    public function removeMailAttachmentByIndex($index)
    {
        if (isset($this->emailForm->attachments[$index])) {
            unset($this->emailForm->attachments[$index]);
            $this->emailForm->attachments = array_values($this->emailForm->attachments);
        }
    }

    public function resetEmail()
    {
        $this->emailForm->reset();
    }
}
