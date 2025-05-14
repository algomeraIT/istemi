<?php

namespace App\Livewire\Projects\Modals;

use App\Models\TaskProject;
use LivewireUI\Modal\ModalComponent;

class ShowMicroTask extends ModalComponent
{
    public $microTask, $id;

    public function mount($id)
    {
        $this->microTask = TaskProject::query()
        ->where('id', $id)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.projects.modals.show-micro-task');
    }
}
