<?php

namespace App\Livewire\Crm\Client\Traits;

use Flux\Flux;
use App\Models\Activity;

trait ActivityActions
{
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
        Flux::modals()->close();
        
        $activity = Activity::findOrFail($id);

        $this->activityForm->setActivity($activity);

        Flux::modal('new-activity')->show();
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

        $this->dispatchEvent('refresh');

        Flux::toast(
            text: "Stato attività aggiornato.",
            variant: 'success',
        );
    }

    public function deleteActivity($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        $this->dispatchEvent('refresh');

        Flux::toast(
            text: "Attività eliminata.",
            variant: 'warning',
        );
    }
    
    protected function dispatchEvent(string $event, array $params = [])
    {
        if (method_exists($this, 'dispatch')) {
            $this->dispatch($event, ...$params);
        }
    }
}
