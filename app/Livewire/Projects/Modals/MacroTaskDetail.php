<?php

namespace App\Livewire\Projects\Modals;

use LivewireUI\Modal\ModalComponent;
use Flux\Flux;
use Livewire\Attributes\On;


class MacroTaskDetail extends ModalComponent
{
    public $tasks, $groupedTasks, $monthTasks;
    public $nameSection;
    public $collections = [
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

    public function mount($id, $nameSection)
    {
        $this->nameSection = $nameSection;

  

        if (!array_key_exists($nameSection, $this->collections)) {
            abort(404, "Sezione {$nameSection} non trovata.");
        }

        $modelClass = 'App\\Models\\' . $this->collections[$nameSection];

        if (!class_exists($modelClass)) {
            abort(404, "Model {$modelClass} non esiste.");
        }

        $this->tasks = $modelClass::where('id', $id)->get();
    }

    public function updateStatusStart($id, $value, $nameTable)
    {
        try {
            $name = $this->collections[$nameTable];
            $modelClass = class_exists($name) ? $name : 'App\\Models\\' . $name;

           
            if (!class_exists( $modelClass)) {
                throw new \Exception("Model {$modelClass} non esiste...");
            }
            $record = $modelClass::findOrFail($id);

            $record->status = $value;
            $record->save();

            Flux::toast('Stato aggiornato con successo!');
      
            $this->dispatch('refresh');

        } catch (\Exception $e) {
            Flux::toast('Errore durante la variazione di stato...');
        }
    }

    #[On('refresh')]
    public function render()
    {
        return view('livewire.projects.modals.macro-task-detail', ['NameTable' => $this->nameSection]);
    }
}
