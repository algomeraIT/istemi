<?php

namespace App\Livewire\Crm\Client;

use App\Models\Client;
use Livewire\Component;
use App\Models\Estimate;
use App\Models\HistoryContact;

class Show extends Component
{
    public $client;
    public $references;

    public function mount($id)
    {
        $this->client = Client::with('referents', 'estimate')->findOrFail($id);
    }

    public function copy($text)
    {
        $this->dispatch('copyLink', [
            'text' => $text
        ]);
    }

    public function newQuote() {
        dump('Nuovo preventivo');
    }

    public function render()
    {
        $estimates = Estimate::where('client_id', $this->client->id)->latest()->get();
        $histories = HistoryContact::where('client_id', $this->client->id)->latest()->get();

        return view('livewire.crm.client.show', [
            'estimates' => $estimates,
            'histories' => $histories,
        ]);
    }
}
