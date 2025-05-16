<?php

namespace App\Livewire\Crm\Client;

use App\Livewire\Forms\HistoryContactForm;
use Flux\Flux;
use App\Models\Client;
use Livewire\Component;
use App\Models\Estimate;
use App\Models\HistoryContact;
use App\Models\User;

class Show extends Component
{
    public HistoryContactForm $historyForm;

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
        $histories = HistoryContact::where('client_id', $this->client->id)->latest()->get();
        $users = User::all();
        $clients = Client::all();

        $all = $users->concat($clients);
        
        return view('livewire.crm.client.show', [
            'estimates' => $estimates,
            'histories' => $histories,
            'users' => $users,
            'all' => $all,
        ]);
    }
}
