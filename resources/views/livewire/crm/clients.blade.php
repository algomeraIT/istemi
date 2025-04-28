<div class="container mx-auto">
    <flux:tab.group class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">
        <h2 class="text-2xl font-bold mb-3 text-[#232323]">Clienti</h2>

        <div class="space-y-3 lg:space-y-0 lg:flex lg:items-center lg:justify-between lg:flex-wrap gap-2">
            <!-- Create Button -->
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

            <!-- Filters -->
            <div class="flex gap-2">
                <flux:select wire:model.live="city">
                    <flux:select.option value="">Tutte le sedi</flux:select.option>
                    @foreach ($cities as $city)
                        <flux:select.option value="{{ $city }}">{{ $city }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select wire:model.live="status">
                    <flux:select.option value="">Tutte le etichette</flux:select.option>
                    <flux:select.option value="0">Call center</flux:select.option>
                    <flux:select.option value="1">Censimento</flux:select.option>
                </flux:select>
            </div>
            <div class="w-full lg:w-auto lg:max-w-xs">
                <flux:input wire:model.live="query" data-variant="search" :loading="false" icon="magnifying-glass"
                    placeholder="Cerca..." />
            </div>

        </div>

        <!-- Content Tabs -->
        <flux:tab.panel name="list">
            @include('livewire.crm.client-list', ['clients' => $clients])
        </flux:tab.panel>

        <flux:tab.panel name="kanban">
            @include('livewire.crm.client-kanban', ['client_kanban' => $client_kanban])
        </flux:tab.panel>

        <!-- Modal -->
        @if ($isOpen)
            @include('livewire.crm.client-modal')
        @endif
    </flux:tab.group>
</div>
