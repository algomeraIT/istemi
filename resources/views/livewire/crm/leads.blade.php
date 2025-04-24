<div class="container mx-auto">
    <flux:tab.group class=" bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">
        <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100">Lead</h2>

        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <flux:button wire:click="create" variant="primary" data-variant="primary" data-color="teal">Crea</flux:button>

                <flux:tabs wire:model="activeTab" variant="segmented">
                    <flux:tab name="list" icon="list-bullet">List</flux:tab>
                    <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
                </flux:tabs>
            </div>
            <div class="flex flex-col-reverse gap-2 items-center justify-between lg:flex-row">
                <div class="w-full lg:max-w-lg">
                    <flux:input wire:model.live="query" :loading="false" icon="magnifying-glass" placeholder="Cerca..."/>
                </div>
                <div class="w-full flex flex-col gap-2 lg:flex-row lg:w-auto">
                    <div class="flex gap-2">
                        <flux:select wire:model.live="status">
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
                </div>
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