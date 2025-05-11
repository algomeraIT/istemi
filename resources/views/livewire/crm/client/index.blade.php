<flux:tab.group class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-10 pb-8">
    <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100 capitalize">
        {{ $this->clientStatusPlural }}</h2>

    <div class="space-y-3 lg:space-y-0 lg:flex lg:items-center lg:justify-between lg:flex-wrap gap-2 pb-4">
        <!-- Crea Button -->
        <flux:button wire:click="$dispatch('openModal', { component: 'modals.crm.client.create-or-update', arguments: { clientStatus: '{{ $clientStatus }}'} })" size="sm" variant="primary" data-variant="primary" data-color="teal">
            Nuovo {{ $clientStatus }}
        </flux:button>

        <!-- Tabs -->
        <div class="lg:pl-[37%]">
            <flux:tabs wire:model="activeTab" variant="segmented">
                <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
                <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
            </flux:tabs>
        </div>

        <!-- Filters -->
        <div class="flex gap-2">
            @if ($clientStatus === 'cliente')
                {{-- City Filter --}}
                <flux:select wire:model.live="city">
                    <flux:select.option value="">Tutte le sedi</flux:select.option>
                    @foreach ($cities as $city)
                        <flux:select.option value="{{ $city }}">{{ $city }}</flux:select.option>
                    @endforeach
                </flux:select>

                {{-- Badge Filter --}}
                <flux:select wire:model.live="status">
                    <flux:select.option value="">Tutte le etichette</flux:select.option>
                    <flux:select.option value="0">Call center</flux:select.option>
                    <flux:select.option value="1">Censimento</flux:select.option>
                </flux:select>
            @else
                {{-- Status Filter --}}
                <flux:select wire:model.live="status" data-variant="status">
                    <flux:select.option value="">Tutti gli stati</flux:select.option>
                    <flux:select.option value="1">Nuovo</flux:select.option>
                    <flux:select.option value="2">Assegnato</flux:select.option>
                    <flux:select.option value="3">Da riassegnare</flux:select.option>
                </flux:select>

                {{-- Year Filter --}}
                <flux:select wire:model.live="year">
                    <flux:select.option value="">Tutte le date di acquisizione</flux:select.option>
                    @for ($year = \Carbon\Carbon::now()->year; $year >= \Carbon\Carbon::now()->subYears(20)->year; $year--)
                        <flux:select.option :value="$year">{{ $year }}</flux:select.option>
                    @endfor
                </flux:select>
            @endif
        </div>

        <!-- Search Input -->
        <div class="w-full lg:w-auto lg:max-w-xs">
            <flux:input wire:model.live="query" data-variant="search" :loading="false" icon="magnifying-glass"
                placeholder="Cerca..." />
        </div>
    </div>

    <flux:tab.panel name="list" class="!pt-0">
        @include('livewire.crm.client.components.client-list')
    </flux:tab.panel>

    <flux:tab.panel name="kanban" class="!pt-0">
        @include('livewire.crm.client.components.client-kanban')
    </flux:tab.panel>


    <!-- Modals -->
    @if ($clientStatus === 'lead')
        @if ($isOpen)
            @include('livewire.crm.lead_modal')
        @endif

        @if ($isOpenShow)
            @include('livewire.crm.lead-detail')
        @endif
    @endif

    @if ($clientStatus === 'contatto')
        @if ($isOpen)
            @include('livewire.crm.contact-modal')
        @endif
    @endif

    @if ($clientStatus === 'cliente')
        @if ($isOpen)
            @include('livewire.crm.client-modal')
        @endif
    @endif
</flux:tab.group>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('copyLink', (data) => {
                var copyText = data[0]['text'];

                if (!navigator.clipboard) {
                    console.warn("Clipboard API non disponibile, utilizzo metodo alternativo.");
                    fallbackCopyText(copyText);
                    return;
                }

                navigator.clipboard.writeText(copyText)
                    .catch(err => {
                        console.error("Errore nella copia del link", err);
                        fallbackCopyText(copyText); // Usa un metodo alternativo
                    });
            });
        });
    </script>
@endpush

