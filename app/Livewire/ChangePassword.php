<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ChangePassword extends Component
{
    public $current_password;
    public $new_password;
    public $new_password_confirmation;


    protected $rules = [
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ];
    public function updatePassword()
    {
       
        DB::beginTransaction();

        $validatedData = $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|min:8|confirmed'
        ]);

    
        $user = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($this->current_password, $user->password)) {
            session()->flash('message', "La password corrente non è corretta...");
            session()->flash('type', 'yellow');
            return;
        }

        if($validatedData['new_password'] != $validatedData['new_password_confirmation'])
        {
            session()->flash('message', "La password di conferma non è uguale alla nuova password...");
            session()->flash('type', 'yellow');
            return;
        }

        // Update the password
        try {
            $user->has_to_change_password = false;
            $user->email_verified_at = now();
            $user->password = Hash::make($this->new_password);

            if ($user->save()) {
                DB::commit();
                session()->flash('message', "La password è stata modificata correttamente");
                session()->flash('type', 'green');
                return;
            }
        } catch (Exception $e) {
            Log::error("Errore password modificata utente:  {$user->email}. Errore: " . $e->getMessage());
            DB::rollBack();
            return redirect()->route('home')->with('error', 'Errore nel cambiare la password, per favore prova di nuovo...');

        }
    }

    public function render()
    {
        return view('livewire.change-password');
    }
}
