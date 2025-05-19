<?php

namespace App\Livewire\Crm\Client;

use Flux\Flux;
use App\Models\Note;
use App\Models\User;
use App\Models\Email;
use App\Models\Client;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Estimate;
use Livewire\Attributes\On;
use App\Models\HistoryClient;
use App\Livewire\Forms\Client\NoteForm;
use App\Livewire\Forms\Client\EmailForm;
use App\Livewire\Forms\Client\ActivityForm;

class Show extends Component
{
    public ActivityForm $activityForm;
    public EmailForm $emailForm;
    public NoteForm $noteForm;

    public $client;
    public $references;

    public function mount($id)
    {
        $this->client = Client::with('user', 'referents', 'estimate')->findOrFail($id);
    }

    public function copy($text)
    {
        $this->dispatch('copyLink', [
            'text' => $text
        ]);
    }

    public function newQuote()
    {
        dump('Nuovo preventivo');
    }

    // Aggiorna lo stato del cliente
    public function updateStatus($status)
    {
        $this->client->step = $status;
        $this->client->save();

        Flux::toast(
            text: "Stato aggiornato per  {$this->client->name}.",
            variant: 'success',
        );
    }

    // Function Tab Activity
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

    public function showActivity($id)
    {
        $activity = Activity::findOrFail($id);

        $this->activityForm->setActivity($activity);

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

        $this->dispatch('refresh');

        Flux::toast(
            text: "Attività aggiornata.",
            variant: 'success',
        );
    }


    #[On('refresh')]
    public function render()
    {
        $estimates = Estimate::where('client_id', $this->client->id)->latest()->get();
        $histories = HistoryClient::where('client_id', $this->client->id)->latest()->get();
        $activities = Activity::where('client_id', $this->client->id)->latest()->get();
        $emails = Email::where('client_id', $this->client->id)->latest()->get();
        $notes = Note::where('client_id', $this->client->id)->latest()->get();
        $users = User::all();
        $clients = Client::all();

        $all = $users->concat($clients);

        return view('livewire.crm.client.show', [
            'estimates' => $estimates,
            'histories' => $histories,
            'activities' => $activities,
            'emails' => $emails,
            'notes' => $notes,
            'users' => $users,
            'all' => $all,
        ]);
    }
}
