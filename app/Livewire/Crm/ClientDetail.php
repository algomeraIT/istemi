<?php

use Livewire\Component;
use App\Models\Clients;
use App\Models\Sale;

class ClientDetail extends Component
{
    public $clientId;
    public $client;

    public function mount($clientId)
    {
        $this->clientId = $clientId;
        $this->client = Clients::findOrFail($clientId);
    }

    public function render()
    {
        return view('livewire.crm.client-detail');
    }
}