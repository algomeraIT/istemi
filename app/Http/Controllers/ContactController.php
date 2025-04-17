<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Estimate;
use App\Models\HistoryContact;

class ContactController extends Controller
{
    public function index()
    {
        return view('crm.contacts');
    }

    public function goToDetail($clientId)
    {
        $client = Clients::with('referents')->findOrFail($clientId);

        $estimates = Estimate::where('client_id', $clientId)
            ->latest()
            ->get();

        $histories = HistoryContact::where('client_id', $clientId)
            ->latest()
            ->get();

        return view('livewire.crm.contact-detail', [
            'client' => $client,
            'estimates' => $estimates,
            'histories' => $histories,
        ]);
    }
}
