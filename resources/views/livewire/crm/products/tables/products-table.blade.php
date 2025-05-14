<div class="w-full">
    <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100 ">
        Servizi e prezzi
    </h2>

    <div class="grid grid-cols-2 gap-4 pb-4 ">
        <div class="col-span-1">
            <flux:button variant="primary" size="sm" data-variant="primary" data-color="teal"
                         wire:click="$dispatch('openModal', { component: 'crm.products.modals.upsert-product' })">
                Aggiungi
            </flux:button>
        </div>

        <div class="col-span-1">
            <div class="grid grid-cols-4 gap-3">
                <flux:select size="sm" variant="listbox" clearable searchable wire:model.live="filterCategory" placeholder="Tutte le categorie" data-custom>
                    <flux:select.option value="">Tutte le categorie</flux:select.option>
                    @foreach($categories as $cat)
                        <flux:select.option value="{{ $cat }}">{{ $cat }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select size="sm" variant="listbox" wire:model.live="filterState" placeholder="Tutti gli stati" data-custom>
                    <flux:select.option value="">Tutti gli stati</flux:select.option>
                    <flux:select.option value="attivo">Attivo</flux:select.option>
                    <flux:select.option value="disattivo">Disattivo</flux:select.option>
                </flux:select>

                <flux:select size="sm" searchable variant="listbox" wire:model.live="filterUdm" placeholder="Tutte le UdM" data-custom>
                    <flux:select.option value="">Tutte le UdM</flux:select.option>
                    @foreach($udms as $u)
                        <flux:select.option value="{{ $u }}">{{ $u }}</flux:select.option>
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
            <flux:table.column sortable :sorted="$sortBy==='unique_code'"
                               :direction="$sortDirection" wire:click="sort('unique_code')"
                               class="w-24">
                Codice
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy==='title'"
                               :direction="$sortDirection" wire:click="sort('title')"
                               class="w-1/3">
                Titolo
            </flux:table.column>
            <flux:table.column class="w-20">Stato</flux:table.column>
            <flux:table.column class="w-16">UdM</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy==='price'"
                               :direction="$sortDirection" wire:click="sort('price')"
                               :align="'end'"
                               class="w-32">
                Prezzo base
            </flux:table.column>
            <flux:table.column :align="'end'" class="w-24">Azioni</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($products as $item)
                <flux:table.row wire:key="prod-{{ $item->id }}">
                    <flux:table.cell>
                        <a href="#" class="font-semibold text-teal-500">{{ $item->unique_code }}</a>
                    </flux:table.cell>

                    <flux:table.cell class="whitespace-nowrap max-w-xs overflow-hidden overflow-ellipsis"
                                     title="{{ $item->description }}">
                        <div class="truncate">{{ $item->title }}</div>
                    </flux:table.cell>

                    <flux:table.cell>
                        @php
                            $status = badgeStatus($item->is_active);
                        @endphp

                        <flux:badge size="sm"
                                    style="background-color: {{ $status['bg'] }}; color: {{ $status['text'] }};">
                            {{ $status['label'] }}
                        </flux:badge>
                    </flux:table.cell>

                    <flux:table.cell class="whitespace-nowrap">{{ $item->udm }}</flux:table.cell>

                    <flux:table.cell :align="'end'" class="whitespace-nowrap font-semibold">
                        €{{ number_format($item->price, 2, ',', '.') }}
                    </flux:table.cell>

                    {{-- Actions --}}
                    <flux:table.cell :align="'end'">
                        <flux:modal.trigger :name="'product-show-'.$item->id">
                            <flux:button variant="ghost" data-variant="ghost" data-color="teal" icon="eye" size="sm" />
                        </flux:modal.trigger>
                        <flux:button wire:click.prevent="$dispatch('openModal', { component: 'crm.products.modals.upsert-product', arguments: { product: {{ $item->id }} } })" variant="ghost" data-variant="ghost" data-color="gray" icon="pencil" size="sm" />
                        <flux:button wire:click.prevent="delete({{ $item->id }})" wire:confirm="Sei sicuro di voler eliminare questo prodotto?" variant="ghost" data-variant="ghost" data-color="red" icon="trash" size="sm" />
                    </flux:table.cell>
                </flux:table.row>

                <flux:modal :name="'product-show-'.$item->id" variant="flyout" class="px-28! py-8! max-w-xl space-y-8">
                    {{-- Header --}}
                    <h2 class="text-2xl font-bold mb-16">Servizio</h2>

                    {{-- Codice --}}
                    <div class="space-y-1">
                        <div class="text-xs font-extralight text-[#B0B0B0]">Codice</div>
                        <div class="text-lg font-semibold text-teal-500 ms-3.5">{{ $item->unique_code }}</div>
                    </div>

                    {{-- Titolo --}}
                    <div class="space-y-1">
                        <div class="text-xs font-extralight text-[#B0B0B0]">Titolo</div>
                        <div class="text-base font-semibold text-[#B0B0B0] ms-3.5">{{ $item->title }}</div>
                    </div>

                    {{-- Categoria --}}
                    <div class="space-y-1">
                        <div class="text-xs font-extralight text-[#B0B0B0]">Categoria</div>
                        <div class="text-base font-semibold text-[#B0B0B0] ms-3.5">{{ $item->category }}</div>
                    </div>

                    {{-- UdM --}}
                    <div class="space-y-1">
                        <div class="text-xs font-extralight text-[#B0B0B0]">UdM</div>
                        <div class="text-base font-semibold text-[#B0B0B0] ms-3.5">{{ $item->udm }}</div>
                    </div>

                    {{-- Prezzo --}}
                    <div class="space-y-1">
                        <div class="text-xs font-extralight text-[#B0B0B0]">Prezzo</div>
                        <div class="text-base font-semibold text-[#B0B0B0] ms-3.5">€{{ number_format($item->price, 2, ',', '.') }}</div>
                    </div>

                    {{-- Stato --}}
                    <div class="space-y-1">
                        <div class="text-xs font-extralight text-[#B0B0B0]">Stato</div>
                        <div class="ms-3.5">
                            @if($item->is_active)
                                <flux:badge size="sm" color="green" inset="top bottom">Attivo</flux:badge>
                            @else
                                <flux:badge size="sm" color="slate" inset="top bottom">Disattivo</flux:badge>
                            @endif
                        </div>
                    </div>

                    {{-- Descrizione --}}
                    @if($item->description)
                        <div class="space-y-1">
                            <div class="text-xs font-extralight text-[#B0B0B0]">Descrizione</div>
                            <div class="text-sm font-semibold text-[#B0B0B0] leading-relaxed ms-3.5">
                                {{ $item->description }}
                            </div>
                        </div>
                    @endif

                </flux:modal>

            @endforeach
        </flux:table.rows>
    </flux:table>

    @if (!$products || $products->isEmpty())
        <div class="mt-4">
            <p class="text-gray-500 text-center">Nessun prodotto da mostrare</p>
        </div>
    @endif

    <div class="-mx-4 mt-4">
        {{ $products->links('customPagination') }}
    </div>


</div>