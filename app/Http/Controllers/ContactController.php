<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('crm.contacts');
    }

    public function goToDetail($contactId)
    {
        $client = Clients::with('referents')->findOrFail($contactId);

        return view('livewire.crm.contact-detail', ['id' => $contactId, 'client' => $client]);
    }
}
