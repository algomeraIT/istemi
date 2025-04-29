<div class="container mx-auto">
    <flux:tab.group class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">
        <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100">
            Progetti
        </h2>

        <div class="space-y-3 lg:space-y-0 lg:flex lg:items-center flex-wrap gap-2">
            <!-- Create Button -->
            <div>
                <flux:button wire:click="create" variant="primary" data-variant="primary" data-color="teal">
                    Crea
                </flux:button>
            </div>

            <!-- Tabs -->
            <div class="lg:pl-[34%]">
                <flux:tabs wire:model="activeTab" variant="segmented">
                    <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
                    <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
                </flux:tabs>
            </div>

            <!-- Filters and Search -->
            <div class="flex 2xl:flex-nowrap flex-wrap gap-2 lg:w-auto lg:max-w-xs ">
                <!-- Project Type Filter -->
                <flux:select wire:model.live="query_project" data-variant="status">
                    <flux:select.option value="">Tutti i progetti</flux:select.option>
                    <flux:select.option value="Pubblico">Pubblico</flux:select.option>
                    <flux:select.option value="Privato">Privato</flux:select.option>
                </flux:select>

                <!-- Responsible Filter -->
                <div class="w-full lg:w-auto lg:max-w-xs">
                    <flux:input wire:model.live="query" data-variant="list" placeholder="Tutti i responsabili" :loading="false" />
                    <datalist id="responsibles-list">
                        <option value="">Tutti i responsabili</option>
                        @foreach ($responsibles as $resp)
                            <option value="{{ $resp }}"></option>
                        @endforeach
                    </datalist>
                </div>

                <!-- Phase Filter -->
                <flux:select wire:model.live="query_phase" data-variant="status">
                    <flux:select.option value="">Tutte le fasi</flux:select.option>
                    <flux:select.option value="0">Non definito</flux:select.option>
                    <flux:select.option value="1">Avvio</flux:select.option>
                    <flux:select.option value="2">Pianificazione</flux:select.option>
                    <flux:select.option value="3">Esecuzione</flux:select.option>
                    <flux:select.option value="4">Verifica</flux:select.option>
                    <flux:select.option value="5">Chiusura</flux:select.option>
                </flux:select>

                <!-- Search Field -->
                <div class="w-full lg:w-auto lg:max-w-xs relative">
                    <flux:input wire:model.live="search" data-variant="search" placeholder="Cerca..." icon="magnifying-glass" :loading="false" />
                </div>
            </div>
        </div>

        <!-- Tab Panels -->
        <flux:tab.panel name="list">
            @include('livewire.projects.project_list', ['projects' => $listProjects])
        </flux:tab.panel>

        <flux:tab.panel name="kanban">
            @include('livewire.projects.project_kanban', ['projects' => $kanbanProjects])
        </flux:tab.panel>

        <!-- Modal -->
        @if ($isOpen)
            @include('livewire.projects.project_modal')
        @endif
    </flux:tab.group>
</div>