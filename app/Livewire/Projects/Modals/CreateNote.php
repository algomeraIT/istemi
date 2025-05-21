<?php

namespace App\Livewire\Projects\Modals;

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



    public function save()
    {
        DB::beginTransaction();
    
        try {
            $project = Project::where('id', $this->id)->first();
 
            if (!$project) {
                throw new \Exception("Project not found.");
            }
            $user = Auth::user();
            NoteProject::create([
                'note' => $this->note,
                'project_id' => $this->id,
                'id_phase' => null,
                'client_id' => $project->id_client,
                'user_name' => $user->name . ' ' . $user->last_name,
                'role' => $user->role_name,
                'user_id' => $user->id,
            ]);
    
            DB::commit();

            Flux::toast('Nota creata con successo!');
            $this->closeModal();
    
        } catch (\Exception $e) {dd($e);
            DB::rollBack();
            Flux::toast('Errore durante la creazione della nota: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.projects.modals.create-note');
    }
}
