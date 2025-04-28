<div class="container mx-auto relative top-14 overflow-auto">
    <flux:tab.group class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">
        <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100">
            Contatti
        </h2>

        <div class="space-y-3 lg:space-y-0 lg:flex lg:items-center lg:justify-between lg:flex-wrap gap-2">
            <!-- Crea Button -->
            <div>
                <flux:button wire:click="create" variant="primary" data-variant="primary" data-color="teal">
                    Crea
                </flux:button>
            </div>

            <!-- Tabs -->
            <div class="lg:pl-[37%]">
                <flux:tabs wire:model="activeTab" variant="segmented">
                    <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
                    <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
                </flux:tabs>
            </div>

            <!-- Filters and Search -->
            <div class="flex gap-2">
                <!-- Status Filter -->
                <flux:select wire:model.live="status" data-variant="status">
                    <flux:select.option value="">Tutti gli stati</flux:select.option>
                    <flux:select.option value="0">In contatto</flux:select.option>
                    <flux:select.option value="1">Non idoneo</flux:select.option>
                </flux:select>

                <!-- Year Filter -->
                <flux:select wire:model.live="year">
                    <flux:select.option value="">Tutte le date di acquisizione</flux:select.option>
                    @for ($year = \Carbon\Carbon::now()->year; $year >= \Carbon\Carbon::now()->subYears(20)->year; $year--)
                        <flux:select.option :value="$year">{{ $year }}</flux:select.option>
                    @endfor
                </flux:select>

                <!-- Search -->
                <div class="w-full lg:w-auto lg:max-w-xs">
                    <flux:input wire:model.live="query" data-variant="search" :loading="false" icon="magnifying-glass" placeholder="Cerca..." />
                </div>
            </div>
        </div>

        <!-- Tab Panels -->
        <flux:tab.panel name="list">
            @include('livewire.crm.contact-list')
        </flux:tab.panel>

        <flux:tab.panel name="kanban">
            @include('livewire.crm.contact-kanban')
        </flux:tab.panel>

        <!-- Modals -->
        @if ($isOpen)
            @include('livewire.crm.contact-modal')
        @endif
    </flux:tab.group>
</div>