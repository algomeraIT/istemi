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
use App\Models\HistoryClient;

class Show extends Component
{
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

    public function newHistory()
    {
        dump('nuovo');
    }

    public function updateStatus($status)
    {
        $this->client->step = $status;
        $this->client->save();

        Flux::toast(
            text: "Stato aggiornato per  {$this->client->name}.",
            variant: 'success',
        );
    }

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
