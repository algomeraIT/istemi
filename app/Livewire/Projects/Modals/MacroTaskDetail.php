<?php

namespace App\Livewire\Projects\Modals;

use Flux\Flux;
use LivewireUI\Modal\ModalComponent;

class MacroTaskDetail extends ModalComponent
{
    public $tasks, $groupedTasks, $monthTasks;

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

        if (!array_key_exists($nameSection, $collections)) {
            abort(404, "Sezione {$nameSection} non trovata.");
        }

        $modelClass = 'App\\Models\\' . $collections[$nameSection];

        if (!class_exists($modelClass)) {
            abort(404, "Model {$modelClass} non esiste.");
        }

        $this->tasks = $modelClass::where('id', $id)->get();
    }

    public function updateStatusStart($id, $value)
    {
        try {
            $modelClass = class_exists($nameTable) ? $nameTable : 'App\\Models\\' . $nameTable;

            if (!class_exists($modelClass)) {
                throw new \Exception("Model {$modelClass} non esiste...");
            }
            $record = $modelClass::findOrFail($id);

            $record->status = $value;
            $record->save();

            Flux::toast('Stato aggiornato con successo!');

        } catch (\Exception $e) {
            dd($e);
            Flux::toast('Errore durante la variazione di stato...');
        }
    }

    

    public function render()
    {
        return view('livewire.projects.modals.macro-task-detail');
    }
}
