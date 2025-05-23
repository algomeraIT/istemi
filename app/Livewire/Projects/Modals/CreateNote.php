<?php

namespace App\Livewire\Projects\Modals;

use Livewire\Attributes\On;

use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use App\Models\Project;
use App\Models\NoteProject;
use Illuminate\Support\Facades\DB;
use Flux\Flux;


class CreateNote extends ModalComponent
{
    public $note, $id, $microTask;

    protected $rules = [
        'note' => 'required|string',
    ];



    public function saveNote()
    {
        DB::beginTransaction();
    
        try {    
            $user = Auth::user();
            NoteProject::create([
                'note' => $this->note,
                'project_id' => $this->id,
                'user_name' => $user->name . ' ' . $user->last_name,
                'user_id' => $user->id,
            ]);
    
            DB::commit();
    
            Flux::toast('Nota creata con successo!');
            $this->dispatch('refresh'); 
            $this->closeModal();
    
        } catch (\Exception $e) {
            DB::rollBack();
            Flux::toast('Errore: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.projects.modals.create-note');
    }
}
