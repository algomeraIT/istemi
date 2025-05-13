<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TaskProject extends Component
{
    public function mount($id)
    {
        $this->projectStart = ProjectStart::where("project_id", $id)->get();
    }



    public function render()
    {
        return view('livewire.projects.task-project');
    }
}
