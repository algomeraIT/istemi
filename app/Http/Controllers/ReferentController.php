<?php

namespace App\Http\Controllers;

use App\Models\Referent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ReferentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'client_id' => 'required|exists:clients,id',
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'title' => 'nullable|string|max:255',
                'job_position' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'telephone' => 'nullable|string|max:20',
                'note' => 'nullable|string',
                //'status' => 'required|in:active,inactive', cambaire su db
                'role' => 'nullable|string|max:255',
            ]);

            $referent = Referent::create($request->all());

            Log::info('Referent created successfully', ['referent' => $referent]);

            return redirect()->back()->with('success', 'Referente aggiunto con successo!');
        } catch (Exception $e) {
            Log::error('Error creating referent', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Errore durante l\'aggiunta del referente.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $referent = Referent::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'title' => 'nullable|string|max:255',
                'job_position' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'telephone' => 'nullable|string|max:20',
                'note' => 'nullable|string',
                //'status' => 'required|in:active,inactive', da modificare su db
                'role' => 'nullable|string|max:255',
            ]);

            $referent->update($request->only([
                'name',
                'last_name',
                'title',
                'job_position',
                'email',
                'telephone',
                'note',
                'status',
                'role'
            ]));

            Log::info('Referent updated successfully', ['referent' => $referent]);

            return redirect()->back()->with('success', 'Referente modificato con successo!');
        } catch (Exception $e) {
            Log::error('Error updating referent', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Errore durante la modifica del referente.');
        }
    }
}