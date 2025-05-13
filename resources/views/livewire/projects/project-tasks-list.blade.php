<flux:tab.group class="p-2" wire:model="tabListKanbaDetail">

    <flux:tabs variant="segmented" class="lg:ml-[40%]">
        <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
        <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
    </flux:tabs>      

    <flux:tab.panel name="list">
        @if (count($this->projectStart) > 0)
            @include('livewire.projects.project-detail-list-component', [
                'elements' => $this->projectStart,
                'nameSection' => 'Avvio progetto',
                'groupedMicroTasks' => $this->groupedMicroTasks
            ])
        @endif

        @if (count($this->invoicesSal) > 0)
            @include('livewire.projects.project-detail-list-component', [
                'elements' => $this->invoicesSal,
                'nameSection' => 'Fattura e acconto SAL',
            ])
        @endif

        @if (count($this->constructionSitePlane) > 0)
            @include('livewire.projects.project-detail-list-component', [
                'elements' => $this->constructionSitePlane,
                'nameSection' => 'Pianificazione cantiere',
            ])
        @endif

        @if (count($this->data) > 0)
            @include('livewire.projects.project-detail-list-component', [
                'elements' => $this->data,
                'nameSection' => 'Elaborazione dati',
            ])
        @endif

        @if (count($this->externalValidation) > 0)
            @include('livewire.projects.project-detail-list-component', [
                'elements' => $this->externalValidation,
                'nameSection' => 'Verifica esterna',
            ])
        @endif

        @if (count($this->accountingValidation) > 0)
            @include('livewire.projects.project-detail-list-component', [
                'elements' => $this->accountingValidation,
                'nameSection' => 'Verifica tecnico contabile',
            ])
        @endif

        @if (count($this->nonComplianceManagement) > 0)
            @include('livewire.projects.project-detail-list-component', [
                'elements' => $this->nonComplianceManagement,
                'nameSection' => 'Gestione non conformità',
            ])
        @endif

        @if (count($this->closeActivity) > 0)
            @include('livewire.projects.project-detail-list-component', [
                'elements' => $this->closeActivity,
                'nameSection' => 'Chiusura attività',
            ])
        @endif

    </flux:tab.panel>

    <flux:tab.panel name="kanban" class="flex overflow-auto max-w-[1000px]">

        @if (count($this->projectStart) > 0)
            @include('livewire.projects.project-detail-kanban-component', [
                'elements' => $this->projectStart,
                'nameSection' => 'Avvio progetto',
            ])
        @endif

        @if (count($this->invoicesSal) > 0)
            @include('livewire.projects.project-detail-kanban-component', [
                'elements' => $this->invoicesSal,
                'nameSection' => 'Fattura e acconto SAL',
            ])
        @endif

        @if (count($this->constructionSitePlane) > 0)
            @include('livewire.projects.project-detail-kanban-component', [
                'elements' => $this->constructionSitePlane,
                'nameSection' => 'Pianificazione cantiere',
            ])
        @endif

        @if (count($this->data) > 0)
            @include('livewire.projects.project-detail-kanban-component', [
                'elements' => $this->data,
                'nameSection' => 'Elaborazione dati',
            ])
        @endif

        @if (count($this->externalValidation) > 0)
            @include('livewire.projects.project-detail-kanban-component', [
                'elements' => $this->externalValidation,
                'nameSection' => 'Verifica esterna',
            ])
        @endif

        @if (count($this->accountingValidation) > 0)
            @include('livewire.projects.project-detail-kanban-component', [
                'elements' => $this->accountingValidation,
                'nameSection' => 'Verifica tecnico contabile',
            ])
        @endif

        @if (count($this->nonComplianceManagement) > 0)
            @include('livewire.projects.project-detail-kanban-component', [
                'elements' => $this->nonComplianceManagement,
                'nameSection' => 'Gestione non conformità',
            ])
        @endif

        @if (count($this->closeActivity) > 0)
            @include('livewire.projects.project-detail-kanban-component', [
                'elements' => $this->closeActivity,
                'nameSection' => 'Chiusura attività',
            ])
        @endif

    </flux:tab.panel>


</flux:tab.group>
@if ($isOpenTaskModal)
@include('livewire.projects.project_detail_task_modal')
@endif