<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Estimate;
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

        $estimates = Estimate::where('status', '!=', 0)
                             ->latest()
                             ->get();

        // return a blade (not a Livewire view) called resources/views/crm/contact-detail.blade.php
        return view('livewire.crm.contact-detail', [
            'client'    => $client,
            'estimates' => $estimates,
        ]);
    }
}