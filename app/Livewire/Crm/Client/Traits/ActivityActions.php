<?php

namespace App\Livewire\Crm\Client\Traits;

use Flux\Flux;
use App\Models\Activity;
use Livewire\WithFileUploads;

trait ActivityActions
{
    use WithFileUploads;

    public function createActivity()
    {
        $this->activityForm->client_id = $this->client->id;
        $this->activityForm->store();

        Flux::toast(
            text: "Nuova attività inserita.",
            variant: 'success',
        );

        Flux::modals()->close();
    }

    public function modifyActivity($id)
    {
        Flux::modals()->close();

        $this->setActivity($id);

        Flux::modal('new-activity')->show();
    }


    public function updateActivity()
    {
        $this->activityForm->update();

        Flux::toast(
            text: "Attività modificata con successo.",
            variant: 'success',
        );

        Flux::modals()->close();
    }

    public function setActivity($id)
    {
        $activity = Activity::findOrFail($id);

        $this->activityForm->setActivity($activity);
    }

    public function showActivity($id)
    {
        $this->setActivity($id);

        Flux::modal('show-activity')->show();
    }

    public function updateActivityStatus($status, $activityId = null,)
    {
        if ($activityId) {
            $activity = Activity::findOrFail($activityId);
            $activity->status = $status;
            $activity->save();
        } else {
            $this->activityForm->status = $status;
            $this->activityForm->update();
        }

        Flux::toast(
            text: "Stato attività aggiornato.",
            variant: 'success',
        );
    }

    public function deleteActivity($id)
    {
        Flux::modals()->close();

        Activity::findOrFail($id)->delete();

        $this->activityForm->reset();

        Flux::toast(
            text: "Attività eliminata.",
            variant: 'warning',
        );
    }

    public function sendMessage()
    {
        $this->validate([
            'activityForm.responseMessage' => 'required',
            'activityForm.attachments' => 'nullable|array',
            'activityForm.attachments.*' => 'file|max:10240',
        ]);

        $message = $this->activityForm->activity->messages()->create([
            'message' => $this->activityForm->responseMessage,
        ]);

        if ($this->activityForm->attachments && is_array($this->activityForm->attachments)) {
            foreach ($this->activityForm->attachments as $file) {
                $message->addMedia($file->getRealPath())
                    ->usingFileName($file->getClientOriginalName())
                    ->toMediaCollection('attached');
            }
        }

        $this->activityForm->responseMessage = '';
        $this->activityForm->attachments = [];

        $this->dispatch('refresh');
    }

    public function removeActivityAttachmentByIndex($index)
    {
        if (isset($this->activityForm->attachments[$index])) {
            unset($this->activityForm->attachments[$index]);
            $this->activityForm->attachments = array_values($this->activityForm->attachments);
        }
    }

    public function resetActivity()
    {
        $this->activityForm->reset();
    }
}
