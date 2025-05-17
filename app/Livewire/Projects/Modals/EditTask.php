<?php

namespace App\Livewire\Projects\Modals;

use Flux\Flux;
use LivewireUI\Modal\ModalComponent;

class EditTask extends ModalComponent
{
    public $task;
    public $name_phase, $user, $status, $nameSection, $modelClass, $form;

    public function mount($id, $nameSection)
    {
        $collections = [
            'Avvio progetto' => 'ProjectStart',
            'Verifica tecnico contabile' => 'AccountingValidation',
            'Chiusura attività' => 'CloseActivity',
            'Pianificazione cantiere' => 'ConstructionSitePlane',
            'Elaborazione dati' => 'Data',
            'Verifica esterna' => 'ExternalValidation',
            'Fattura e acconto SAL' => 'InvoicesSal',
            'Gestione non conformità' => 'NonComplianceManagement',
            'Report' => 'Report',
        ];

        $modelClass = class_exists($nameSection) ? $collections[$nameSection] : 'App\\Models\\' . $collections[$nameSection] ;

        if (!class_exists($modelClass)) {
            Flux::toast("Model {$modelClass} non esiste...");
        }

        $this->task = $modelClass::findOrFail($id);

        $this->form = $this->task->only([
            'name_phase', 'user', 'status',
        ]);

        $this->name_phase = $this->task->name_phase;
        $this->user = $this->task->user;
        $this->status = $this->task->status;
    }

    public function save()
    {
        $this->task->update([
            'name_phase' => $this->name_phase,
            'user' => $this->user,
            'status' => $this->status,
        ]);

        $this->closeModal();

        Flux::toast('Task aggiornato con successo!');

        $this->dispatch('refresh');

    }

    public function render()
    {
        return view('livewire.projects.modals.edit-task');
    }
}
