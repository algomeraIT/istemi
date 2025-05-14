<div class="w-full">
    <flux:table class="border-b">
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column class="{{ $clientStatus == 'cliente' ? '' : 'hidden' }}">Logo</flux:table.column>
            <flux:table.column>Nome</flux:table.column>
            <flux:table.column>Email</flux:table.column>
            <flux:table.column>Telefono</flux:table.column>
            <flux:table.column class="{{ $clientStatus == 'cliente' ? 'hidden' : '' }}">Acquisizione
            </flux:table.column>
            <flux:table.column class="{{ $clientStatus == 'cliente' ? '' : 'hidden' }}">Sede</flux:table.column>
            <flux:table.column>{{ $clientStatus == 'cliente' ? 'Etichette' : 'Stato' }}</flux:table.column>
            <flux:table.column :align="'end'">Azioni</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($clients as $client)
                <flux:table.row wire:key="{{ $client->id }}">
                    <flux:table.cell>{{ $client->id }}</flux:table.cell>
                    <flux:table.cell class="{{ $clientStatus == 'cliente' ? '' : 'hidden' }}">
                        <img src="{{ $client->getFirstMediaUrl('logos') ? $client->getFirstMediaUrl('logos') : asset('icon/logo.svg') }}"
                            class="w-10 rounded" alt="Logo" />
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $client->name }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        <div class="flex items-center gap-2 mt-1 font-semibold">
                            {{ $client->email }}

                            <button title="Copia" wire:click="copy('{{ $client->email }}')"
                                x-on:click="$flux.toast('Mail copiata.')" class="cursor-pointer">
                                <flux:icon.document-duplicate class="size-4 text-[#10BDD4]" />
                            </button>
                        </div>
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        <div class="flex items-center gap-2 mt-1 font-semibold">
                            {{ $client->first_telephone }}

                            <button title="Copia" wire:click="copy('{{ $client->first_telephone }}')"
                                x-on:click="$flux.toast('Contatto telefonico copiato.')" class="cursor-pointer">
                                <flux:icon.document-duplicate class="size-4 text-[#10BDD4]" />
                            </button>
                        </div>
                    </flux:table.cell>
                    <flux:table.cell class="{{ $clientStatus == 'cliente' ? 'hidden' : '' }}">
                        {{ dateItFormat($client->created_at) }}</flux:table.cell>
                    <flux:table.cell class="{{ $clientStatus == 'cliente' ? '' : 'hidden' }}">
                        {{ $client->city }}
                    </flux:table.cell>
                    <flux:table.cell>
                        @php
                            $badge = $clientStatus == 'cliente' ? $client->label : $client->step;
                        @endphp
                        <flux:badge size="sm" data-step="{{ $badge }}">{{ ucfirst($badge) }}
                        </flux:badge>
                    </flux:table.cell>

                    {{-- Actions --}}
                    <flux:table.cell :align="'end'">
                        @if ($clientStatus === 'lead')
                            <flux:button variant="ghost" wire:click='setClient({{ $client->id }})'
                                data-variant="ghost" data-color="teal" icon="eye" size="sm" />
                        @else
                            <flux:button href="{{ route('crm.client.show', [$clientStatus, $client->id]) }}"
                                variant="ghost" data-variant="ghost" data-color="teal" icon="eye" size="sm" />
                        @endif

                        @if ($clientStatus === 'cliente')
                            <flux:button
                                wire:click="$dispatch('openModal', { component: 'modals.crm.client.create-or-update', arguments: { client: {{ $client->id }} } })"
                                variant="ghost" data-variant="ghost" data-color="gray" icon="pencil" size="sm" />
                        @endif

                        <flux:button wire:click="delete({{ $client->id }})"
                            wire:confirm="Sei sicuro di voler eliminare questo {{ $clientStatus }}?" variant="ghost"
                            data-variant="ghost" data-color="red" icon="trash" size="sm" />
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    @if (!$clients)
        <div class="mt-4">
            <p class="text-gray-500 text-center">Nessun {{ $clientStatus }} da mostrare</p>
        </div>
    @endif

    <div class="-mx-4 mt-4">
        {{ $clients->links('customPagination') }}
    </div>

    {{-- Modal --}}
    <flux:modal name="show-client" variant="flyout" :dismissible="false" class="w-2xl !px-32 relative">
        <button class="absolute top-4 right-4 text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
            x-on:click="$flux.modals().close()">
            <flux:icon.x-mark class="size-4" />
            <span>Annulla</span>
        </button>

        @if ($selectedClient)
            <div class="flex flex-col justify-start items-start gap-10">
                <h2 class="text-2xl font-bold text-left">{{ $selectedClient->name }}</h2>

                <flux:badge size="sm" data-step="{{ $selectedClient->step }}">
                    {{ ucfirst($selectedClient->step) }}
                </flux:badge>

                <div class="w-full grid grid-cols-2 gap-x-5 gap-y-10">
                    <div class="col-span-1">
                        <x-field-data :label="'Data acquisizione'" :data="dateItFormat($selectedClient->created_at)">
                            <x-slot name="icon">
                                <flux:icon.calendar-days class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                    <div class="col-span-1">
                        <x-field-data :label="'Provenienza'" :data="$selectedClient->provenance">
                            <x-slot name="icon">
                                <flux:icon.arrow-right class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                    <div class="col-span-2">
                        <x-field-data :label="'E-mail'" :data="$selectedClient->email" :copy="true">
                            <x-slot name="icon">
                                <flux:icon.at-symbol class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                    <div class="col-span-2">
                        <x-field-data :label="'Telefono'" :data="$selectedClient->first_telephone" :copy="true">
                            <x-slot name="icon">
                                <flux:icon.phone class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                    <div class="col-span-2">
                        <x-field-data :label="'Servizio'" :data="$selectedClient->service">
                            <x-slot name="icon">
                                <flux:icon.tag class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>

                    <div class="col-span-2">
                        <div>
                            <div class="flex items-center gap-1 mb-1 ml-1">
                                <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                                <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
                            </div>
                            <flux:editor value="{{ $selectedClient->note }}" disabled toolbar="align"
                                class="**:data-[slot=content]:max-h-[50px]!" />
                        </div>
                    </div>
                </div>

                @if ($selectedClient->sales_manager_id)
                    <div class="col-span-2">
                        <x-field-data :label="'Commerciale'" :data="$selectedClient->salesManager->full_name">
                            <x-slot name="icon">
                                <flux:icon.user class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                @else
                    <div class="w-full flex flex-col gap-5">
                        <h3 class="text-[22px] font-semibold text-left">Assegna {{ $selectedClient->status }}</h3>

                        <flux:field data-input>
                            <div>
                                <flux:icon.user />
                                <flux:label>Commerciale</flux:label>
                            </div>
                            <flux:select variant="listbox" wire:model="selected_sales_manager">
                                @foreach ($sale_managers as $sale_manager)
                                    <flux:select.option value="{{ $sale_manager->id }}">
                                        {{ ucfirst($sale_manager->full_name) }}
                                    </flux:select.option>
                                @endforeach
                            </flux:select>
                            <flux:error name="selected_sales_manager" />
                        </flux:field>
                    </div>

                    <flux:button variant="primary" data-variant="primary"
                        wire:click="assignManager({{ $selectedClient->id }})" data-color="teal">
                        Assegna
                    </flux:button>
                @endif
            </div>
        @endif
    </flux:modal>
</div>
