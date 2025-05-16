<?php

namespace App\Livewire\Projects\Modals;

use App\Models\TaskProject;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Flux\Flux;


class ShowMicroTask extends ModalComponent
{
    public $microTask, $id, $record;

    public function mount($id)
    {
        $this->microTask = TaskProject::query()
            ->where('id', $id)->get()->toArray();
    }

    public function updateMicroStatusStart($id, $value)
    {
        try {
            $columns = [
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
            ];
    
            $task = DB::table('task_projects')->where('id', $id)->first();
    
            if (!$task) {
                Flux::toast('Task non trovato.');
                return;
            }
    
            $notNullCount = collect($columns)->filter(function ($column) use ($task) {
                return !is_null($task->{$column});
            })->count();
    
            if ($notNullCount === 1) {
                DB::table('task_projects')
                    ->where('id', $id)
                    ->update(['status' => $value]);
    
                Flux::toast('Stato aggiornato con successo!');
            } else {
                Flux::toast('Errore: Il task ha più di un campo compilato o nessuno.');
            }
    
        } catch (\Exception $e) {
            Flux::toast('Errore durante la variazione di stato...');
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.projects.modals.show-micro-task');
    }
}
