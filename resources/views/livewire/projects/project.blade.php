<flux:tab.group class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">
    <div class="relative">
        <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100">
            Progetti
        </h2>

        <!-- Tabs -->
        <div class="absolute left-1/2 -top-2 transform -translate-x-1/2">
            <flux:tabs wire:model.live="activeTab" variant="segmented">
                <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
                <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
            </flux:tabs>
        </div>
    </div>

    <div class="min-h-10 space-y-3 lg:space-y-0 lg:flex lg:items-center lg:justify-between flex-wrap gap-2">
        <!-- Create Button -->
        <flux:button wire:click="$dispatch('openModal', { component: 'projects.modals.create' })" variant="primary"
            data-variant="primary" data-color="project">Crea
        </flux:button>

        <!-- Filters: LIST -->
        @if ($activeTab == 'list')
            <div class="flex 2xl:flex-nowrap flex-wrap gap-2 align-middle">
                <!-- Project Type Filter -->
                <flux:select wire:model.live="query_project" data-variant="status" variant="listbox"
                    placeholder="Filtra tipologia" clearable data-custom>
                    <flux:select.option value="Pubblico">Pubblico</flux:select.option>
                    <flux:select.option value="Privato">Privato</flux:select.option>
                </flux:select>

                <!-- Responsible Filter -->
                <div class="w-full lg:w-auto lg:max-w-xs">
                    <flux:select wire:model.live="responsible" data-variant="status" variant="listbox"
                        placeholder="Responsabile" clearable searchable data-custom>
                        <x-slot name="search">
                            <flux:select.search class="px-4" placeholder="Cerca..." />
                        </x-slot>
                        @foreach ($managers as $resp)
                            <flux:select.option value="{{ $resp->id }}">
                                {{ $resp->full_name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                </div>

                <!-- Phase Filter -->
                <flux:select wire:model.live="query_phase" data-variant="status" variant="listbox"
                    placeholder="Filtra fase" clearable data-custom>
                    <flux:select.option value="Non definito">Non definito</flux:select.option>
                    <flux:select.option value="Avvio">Avvio</flux:select.option>
                    <flux:select.option value="Pianificazione">Pianificazione</flux:select.option>
                    <flux:select.option value="Esecuzione">Esecuzione</flux:select.option>
                    <flux:select.option value="Verifica">Verifica</flux:select.option>
                    <flux:select.option value="Chiusura">Chiusura</flux:select.option>
                </flux:select>

                <!-- Search -->
                <flux:field data-input>
                    <flux:input wire:model.live="search" data-variant="search" :loading="false" clearable
                        icon="magnifying-glass" placeholder="Cerca" />
                </flux:field>

            </div>
        @endif

        <!-- Filters: KANBAN -->
        @if ($activeTab == 'kanban')
            <div class="flex 2xl:flex-nowrap flex-wrap gap-2 align-middle  items-center">
                <div class="flex justify-center items-center ml-5">
                    <p class="text-[#B0B0B0] text-[15px] font-extralight">Raggruppa per </p>

                    <flux:tabs wire:model="kanbanTab" variant="segmented">
                        <flux:tab wire:click="$set('kanbanTab', 'current_phase')" name="current_phase">Fase
                        </flux:tab>
                        <flux:tab wire:click="$set('kanbanTab', 'responsible')" name="responsible">Responsabile
                        </flux:tab>
                    </flux:tabs>
                </div>

                <flux:select wire:model.live="query_project" data-variant="status" variant="listbox"
                    placeholder="Filtra tipologia" clearable data-custom>
                    <flux:select.option value="Pubblico">Pubblico</flux:select.option>
                    <flux:select.option value="Privato">Privato</flux:select.option>
                </flux:select>

                <!-- Search -->
                <flux:field data-input>
                    <flux:input wire:model.live="search" data-variant="search" :loading="false" clearable
                        icon="magnifying-glass" placeholder="Cerca" />
                </flux:field>
            </div>
        @endif

    </div>
    <!-- Tab Panels -->
    <flux:tab.panel name="list">
        @include('livewire.projects.project_list')
    </flux:tab.panel>

    <flux:tab.panel name="kanban">
        @include('livewire.projects.project_kanban')
    </flux:tab.panel>

    <!-- Modal -->
    @if ($isOpen)
        @include('livewire.projects.project_modal')
    @endif
</flux:tab.group>
