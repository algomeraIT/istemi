<flux:tab.group class="p-2" wire:model="tabListKanbaDetail">

    <flux:tabs variant="segmented" class="lg:ml-[40%]">
        <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
        <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
    </flux:tabs>      

    <flux:tab.panel name="list">
        @if (count($this->phasesTable) > 0)
            @include('livewire.projects.project-detail-list-component', [
                'elements' => $this->phasesTable,
                'groupedMicroTasks' => $this->groupedMicroTasks
            ])
        @endif

    </flux:tab.panel>

    <flux:tab.panel name="kanban" class="flex overflow-auto max-w-[1000px]">

        @if (count($this->phasesTable) > 0)
            @include('livewire.projects.project-detail-kanban-component', [
                'elements' => $this->phasesTable,
                'groupedMicroTasks' => $this->groupedMicroTasks
            ])
        @endif

    </flux:tab.panel>


</flux:tab.group>
@if ($isOpenTaskModal)
@include('livewire.projects.project_detail_task_modal')
@endif