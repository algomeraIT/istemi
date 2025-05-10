<div class="container mx-auto">
    <flux:tab.group class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">
        <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100">
            Progetti
        </h2>

        <div class="space-y-3 lg:space-y-0 lg:flex lg:items-center flex-wrap gap-2">
            <!-- Create Button -->
            <div>
                <flux:button wire:click="$dispatch('openModal', { component: 'projects.modals.create' })" variant="primary" data-variant="primary" data-color="project">
                    Crea
                </flux:button>

            </div>

            <!-- Tabs -->
            <div class="lg:pl-[33%]">
                <div x-data="{ tab: @entangle('activeTab') }" class="md:flex 2xl:flex-nowrap align-middle items-center justify-center ">
                    <!-- Tabs -->
                    <flux:tabs wire:model="activeTab" variant="segmented">
                        <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
                        <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
                    </flux:tabs>
            
                    <!-- Filters: LIST -->
                    <div x-show="tab === 'list'" x-cloak class="flex 2xl:flex-nowrap flex-wrap gap-2 align-middle">
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
            
                        <!-- Search -->
                        <div class="w-full lg:w-auto lg:max-w-xs relative">
                            <flux:input wire:model.live="search" data-variant="search" placeholder="pippo..." icon="magnifying-glass" :loading="false" />
                        </div>
                    </div>
            
                    <!-- Filters: KANBAN -->
                    <div x-show="tab === 'kanban'" x-cloak class="flex 2xl:flex-nowrap flex-wrap gap-2 align-middle items-center">
                        <div class="flex justify-center items-center ml-5">
                            <p class="text-[#B0B0B0] text-[15px] font-extralight">Raggruppa per </p>
                            <flux:tabs wire:model="kanbanTab" variant="segmented">
                                <flux:tab wire:click="$set('kanbanTab', 'current_phase')" name="current_phase">Fase</flux:tab>
                                <flux:tab wire:click="$set('kanbanTab', 'responsible')" name="responsible">Responsabile</flux:tab>
                            </flux:tabs>
                        </div>
                        <flux:select wire:model.live="query_project" data-variant="status">
                            <flux:select.option value="">Tutti gli stati</flux:select.option>
                            <flux:select.option value="Pubblico">Pubblico</flux:select.option>
                            <flux:select.option value="Privato">Privato</flux:select.option>
                        </flux:select>
                        <div class="w-full lg:w-auto lg:max-w-xs relative">
                            <flux:input wire:model.live="search" data-variant="search" placeholder="Cerca..." icon="magnifying-glass" :loading="false" />
                        </div>
                    </div>
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
