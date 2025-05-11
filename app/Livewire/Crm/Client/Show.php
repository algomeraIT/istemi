<?php

namespace App\Livewire\Crm\Client;

use App\Models\Client;
use Livewire\Component;
use App\Models\Estimate;
use App\Models\HistoryContact;

class Show extends Component
{
    public $client;
    public $estimates;
    public $histories;
    public $references;

    public function mount($id)
    {
        $this->client = Client::with('referents', 'estimate')->findOrFail($id);

        $this->estimates = Estimate::where('client_id', $id)
            ->latest()
            ->get();

        $this->histories = HistoryContact::where('client_id', $id)
            ->latest()
            ->get();
    }

    public function render()
    {
        if ($this->client->status == 'cliente') {
            return view('livewire.crm.client-detail');
        } elseif ($this->client->status == 'contatto') {
            return view('livewire.crm.contact-detail');
        } elseif ($this->client->status == 'lead') {
            return view('livewire.crm.client.show');
        }
    }
}
