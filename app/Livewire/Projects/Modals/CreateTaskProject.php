<?php

namespace App\Livewire\Projects\Modals;
use Livewire\Attributes\On;

use App\Models\TaskProject;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Flux\Flux;

class CreateTaskProject extends ModalComponent
{
    public $project_id;
    public $client_id;
    public $user_id;
    public $user_name;

    public $title;
    public $assignee;
    public $cc;
    public $expire;
    public $note;
    public $media;
    public $status = 'In attesa';

    public $linkedPhaseType; 
    public $linkedPhaseId;

    protected $rules = [
        'title' => 'required|string|max:255',
        'assignee' => 'required|string|max:255',
        'expire' => 'nullable|date',
        'note' => 'nullable|string',
        'status' => 'required|string',
    ];

    public function mount($project_id, $phase, $id)
    {
        $this->project_id = $project_id;
        $this->linkedPhaseType = $phase; 
        $this->linkedPhaseId = $id;       
        $this->user_id = Auth::id();
        $this->user_name = Auth::user()?->name . ' ' . Auth::user()?->last_name  ?? 'Utente';
    }

    public function create()
    {
        $this->validate();

        try {
            $task = new TaskProject();
            $task->project_id = $this->project_id;

            $getProject = Project::where('id', $this->project_id)->get();

            $task->client_id = $getProject[0]->id_client;
            $task->user_id = $this->user_id;
            $task->user_name = $this->user_name;
       
            // This sets the correct phase column dynamically
            if (in_array($this->linkedPhaseType, [
                'project_start_id',
                'project_activity_id',
                'project_accounting_id',
                'project_data_id',
                'project_construction_site_plane_id',
                'project_external_validations_id',
                'project_invoices_sal_id',
                'project_non_compliance_id',
                'project_report_id',
                'project_close_id',
            ])) {
                $task->{$this->linkedPhaseType} = $this->linkedPhaseId;
            }

            $task->title = $this->title;
            $task->assignee = $this->assignee;
            $task->cc = $this->cc;
            $task->expire = $this->expire;
            $task->note = $this->note;
            $task->media = $this->media;
            $task->status = $this->status;

            $task->save();

            Flux::toast('Task aggiunto con successo!');
            $this->dispatch('taskCreated');
            $this->closeModal();

        } catch (\Exception $e) {
            Flux::toast('Errore durante la creazione del task.');
        }
    }

    #[On('taskCreated')]
    public function render()
    {
        return view('livewire.projects.modals.create-task-project');
    }
}