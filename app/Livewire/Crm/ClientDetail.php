<?php

use Livewire\Component;
use App\Models\Client;
use App\Models\Sale;

class ClientDetail extends Component
{
    public $clientId;
    public $client;

    public function mount($clientId)
    {
        $this->clientId = $clientId;
        $this->client = Client::findOrFail($clientId);
    }

    public function render()
    {
        return view('livewire.crm.client-detail');
    }
}