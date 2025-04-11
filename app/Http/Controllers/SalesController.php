<?php

namespace App\Http\Controllers;

use App\Models\Referent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class SalesController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'client_id' => 'required|exists:clients,id',
                'invoice' => 'required|string',
                'price' => 'required|numeric',
                'status' => 'required|string',
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
                'client_id' => 'required|exists:clients,id',
                'invoice' => 'required|string',
                'price' => 'required|numeric',
                'status' => 'required|string',
            ]);

            $referent->update($request->only([
                'client_id',
                'invoice',
                'price',
                'status',
            ]));

            return redirect()->back()->with('success', 'Vendita modificata con successo!');
        } catch (Exception $e) {
            Log::error('Error updating sale ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Errore durante la modifica della vendita.');
        }
    }
}