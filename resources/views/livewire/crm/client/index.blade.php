<flux:tab.group class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-10 pb-8">
    <div class="relative">
        <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100 capitalize">
            {{ $this->clientStatusPlural }}
        </h2>

        <!-- Tabs -->
        <div class="absolute left-1/2 -top-2 transform -translate-x-1/2">
            <flux:tabs variant="segmented">
                <flux:tab name="list">
                    <flux:icon.list-bullet class="size-5" /> Lista
                </flux:tab>
                <flux:tab name="kanban">
                    <flux:icon.squares-2x2 class="size-5" /> Kanban
                </flux:tab>
            </flux:tabs>
        </div>
    </div>

    <div class="space-y-3 lg:space-y-0 lg:flex lg:items-center lg:justify-between lg:flex-wrap gap-2 pb-4">
        <!-- Crea Button -->
        @if ($clientStatus === 'lead')
            <flux:modal.trigger name="now-lead">
                <flux:button variant="ghost" size="sm" variant="primary" data-variant="primary" data-color="teal">
                    Nuovo {{ $clientStatus }}
                </flux:button>
            </flux:modal.trigger>
        @elseif ($clientStatus === 'cliente')
            <flux:button variant="primary" size="sm" data-variant="primary" data-color="teal"
                wire:click="$dispatch('openModal', { component: 'modals.crm.client.create-or-update', arguments: { clientStatus: '{{ $clientStatus }}'} })">
                Nuovo {{ $clientStatus }}
            </flux:button>
        @endif

        <!-- Filters -->
        <div class="flex gap-3 ml-auto">
            @if ($clientStatus === 'cliente')
                {{-- City Filter --}}
                <flux:select variant="listbox" wire:model.live="city" placeholder="Tutte le città" data-custom
                    searchable clearable>
                    <x-slot name="search">
                        <flux:select.search placeholder="Cerca..." />
                    </x-slot>

                    @foreach ($cities as $city)
                        <flux:select.option value="{{ $city }}">{{ $city }}</flux:select.option>
                    @endforeach
                </flux:select>

                {{-- Label Filter --}}
                <flux:select variant="listbox" wire:model.live="label" placeholder="Tutte le etichette" data-custom
                    searchable clearable>
                    <x-slot name="search">
                        <flux:select.search placeholder="Cerca..." />
                    </x-slot>

                    @foreach ($labels as $label)
                        <flux:select.option>{{ $label }}</flux:select.option>
                    @endforeach
                </flux:select>
            @else
                {{-- Status Filter --}}
                <flux:select variant="listbox" wire:model.live="step" placeholder="Tutti gli stati"
                    data-variant="status" data-custom clearable>
                    @foreach ($steps as $step)
                        <flux:select.option>{{ $step }}</flux:select.option>
                    @endforeach
                </flux:select>

                {{-- Year Filter --}}
                <flux:select variant="listbox" wire:model.live="year" placeholder="Date di acquisizione" data-custom
                    clearable>
                    @foreach ($years as $year)
                        <flux:select.option>{{ $year }}</flux:select.option>
                    @endforeach
                </flux:select>
            @endif

            <!-- Search Input -->
            <flux:field data-input>
                <flux:input wire:model.live="search" data-variant="search" :loading="false" clearable
                    icon="magnifying-glass" placeholder="Cerca" />
            </flux:field>
        </div>
    </div>

    <flux:tab.panel name="list" class="!pt-0">
        @include('livewire.crm.client.partials.client-list')
    </flux:tab.panel>

    <flux:tab.panel name="kanban" class="!pt-0">
        @include('livewire.crm.client.partials.client-kanban')
    </flux:tab.panel>
    
    {{-- Flyout Lead --}}
    @include('livewire.crm.client.components.contact.flyout-create-lead')
    @include('livewire.crm.client.components.contact.flyout-show-lead')
</flux:tab.group>