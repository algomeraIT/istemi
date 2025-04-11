<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        return view('crm.clients');
    }

    public function show($clientId)
    {
        $client = Clients::with('referents')->findOrFail($clientId);

        return view('livewire.crm.client-detail', ['id' => $clientId, 'client' => $client]);
    }
}
