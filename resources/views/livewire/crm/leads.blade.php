<div class="container mx-auto">
    <flux:tab.group class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">
        <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100">Lead</h2>

        <div class="space-y-3 lg:space-y-0 lg:flex lg:items-center lg:justify-between lg:flex-wrap gap-2">
            <!-- Crea Button -->
            <div>
                <flux:button wire:click="create" variant="primary" data-variant="primary" data-color="teal">
                    Crea
                </flux:button>
            </div>

            <!-- Tabs -->
            <div class="lg:pl-[37%]">
                <flux:tabs wire:model="activeTab" variant="segmented" >
                    <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
                    <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
                </flux:tabs>
            </div>

            <!-- Selects -->
            <div class="flex gap-2">
                <flux:select wire:model.live="status" data-variant="status">
                    <flux:select.option value="">Tutti gli stati</flux:select.option>
                    <flux:select.option value="1">Nuovo</flux:select.option>
                    <flux:select.option value="2">Assegnato</flux:select.option>
                    <flux:select.option value="3">Da riassegnare</flux:select.option>
                </flux:select>

                <flux:select wire:model.live="year">
                    <flux:select.option value="">Tutte le date di acquisizione</flux:select.option>
                    @for($year = \Carbon\Carbon::now()->year; $year >= \Carbon\Carbon::now()->subYears(20)->year; $year--)
                        <flux:select.option :value="$year">{{ $year }}</flux:select.option>
                    @endfor
                </flux:select>
            </div>

            <!-- Search Input -->
            <div class="w-full lg:w-auto lg:max-w-xs">
                <flux:input wire:model.live="query" data-variant="search" :loading="false" icon="magnifying-glass" placeholder="Cerca..." />
            </div>
        </div>

        <flux:tab.panel name="list">
            @include('livewire.crm.lead_list', ['leads' => $this->leads])
        </flux:tab.panel>
        <flux:tab.panel name="kanban">
            @include('livewire.crm.lead_kanban', ['leads' => $this->leads])
        </flux:tab.panel>

        @if ($isOpen)
            @include('livewire.crm.lead_modal')
        @endif

        @if ($isOpenShow)
            @include('livewire.crm.lead-detail')
        @endif
    </flux:tab.group>
</div>