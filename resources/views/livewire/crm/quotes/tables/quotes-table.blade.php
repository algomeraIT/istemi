<div class="w-full">
    <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100 ">
        Preventivi
    </h2>

    <div class="grid grid-cols-2 gap-4 pb-4 ">
        <div class="col-span-1">
            <flux:button href="{{ route('crm.quotes.create') }}" variant="primary" size="sm" data-variant="primary" data-color="teal">
                Crea
            </flux:button>
        </div>

        <div class="col-span-1">
            <div class="grid grid-cols-3 gap-3">
                <flux:select size="sm" variant="listbox" clearable searchable wire:model.live="filterClient" placeholder="Tutti i clienti" data-custom>
                    @foreach($clients as $client)
                        <flux:select.option value="{{ $client->id }}">{{ $client->name }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select size="sm" variant="listbox" clearable wire:model.live="filterStatus" placeholder="Tutti gli stati" data-custom>
                    @foreach($statuses as $key => $label)
                        <flux:select.option value="{{ $key }}">{{ $label }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:field data-input>
                    <flux:input wire:model.live="search" data-variant="search" :loading="false" clearable icon="magnifying-glass" placeholder="Cerca" />
                </flux:field>
            </div>
        </div>
    </div>

    <flux:table class="border-b table-fixed w-full">
        <flux:table.columns>
            <flux:table.column sortable :sorted="$sortBy==='code'"
                               :direction="$sortDirection" wire:click="sort('code')"
                               class="w-32">
                Preventivo
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy==='created_at'"
                               :direction="$sortDirection" wire:click="sort('created_at')"
                               class="w-32">
                Data creazione
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy==='updated_at'"
                               :direction="$sortDirection" wire:click="sort('updated_at')"
                               class="w-32">
                Ultima attività
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy==='client_id'"
                               :direction="$sortDirection" wire:click="sort('client_id')"
                               class="w-1/4">
                Cliente
            </flux:table.column>
            <flux:table.column class="w-32">Stato</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy==='due_date'"
                               :direction="$sortDirection" wire:click="sort('due_date')"
                               class="w-32">
                Data scadenza
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy==='total'"
                               :direction="$sortDirection" wire:click="sort('total')"
                               :align="'end'"
                               class="w-32">
                Totale
            </flux:table.column>
            <flux:table.column :align="'end'" class="w-24">Azioni</flux:table.column>
        </flux:table.columns>
        @if($quotes->count() > 0)
            <flux:table.rows>
                @foreach ($quotes as $quote)
                    <flux:table.row wire:key="quote-{{ $quote->id }}">
                        <flux:table.cell>
                            <a href="{{ route('crm.quotes.show', $quote) }}" class="font-semibold text-teal-500">{{ $quote->code }}</a>
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ dateItFormat($quote->created_at) }}
                        </flux:table.cell>

                        <flux:table.cell>
                            @if($quote->updated_at && $quote->updated_at->ne($quote->created_at))
                                {{ dateItFormat($quote->updated_at) }}
                            @endif
                        </flux:table.cell>

                        <flux:table.cell class="whitespace-nowrap max-w-xs overflow-hidden overflow-ellipsis">
                            <div class="truncate">{{ $quote->client->name ?? 'N/D' }}</div>
                        </flux:table.cell>

                        <flux:table.cell>
                            @php
                                $status = badgeQuoteStatus($quote->status);
                            @endphp

                            <flux:badge size="sm"
                                        style="background-color: {{ $status['bg'] }}; color: {{ $status['text'] }};">
                                {{ $status['label'] }}
                            </flux:badge>
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ dateItFormat($quote->due_date) }}
                        </flux:table.cell>

                        <flux:table.cell :align="'end'" class="whitespace-nowrap font-semibold">
                            {{ money($quote->total, 'EUR')->format() }}
                        </flux:table.cell>

                        {{-- Actions --}}
                        <flux:table.cell :align="'end'">
                            <flux:button href="{{ route('crm.quotes.show', $quote) }}" variant="ghost" data-variant="ghost" data-color="teal" icon="eye" size="sm" />
                            <flux:button href="{{ route('crm.quotes.edit', $quote) }}" variant="ghost" data-variant="ghost" data-color="gray" icon="pencil" size="sm" />
                            <flux:button wire:click.prevent="delete({{ $quote->id }})" wire:confirm="Sei sicuro di voler eliminare questo preventivo?" variant="ghost" data-variant="ghost" data-color="red" icon="trash" size="sm" />
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        @else
            <flux:table.row>
                <flux:table.cell colspan="8" class="text-gray-500 text-center">Nessun preventivo da mostrare</flux:table.cell>
            </flux:table.row>
        @endif
    </flux:table>

    <div class="-mx-4 mt-4">
        {{ $quotes->links('customPagination') }}
    </div>
</div>