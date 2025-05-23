<div class="w-full">
    <flux:table class="border-b">
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column class="{{ $clientStatus == 'cliente' ? '' : 'hidden' }}">Logo</flux:table.column>
            <flux:table.column>Nome/Ragione Sociale</flux:table.column>
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
                                <flux:icon.document-duplicate variant="micro" class="text-[#10BDD4]" />
                            </button>
                        </div>
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        <div class="flex items-center gap-2 mt-1 font-semibold">
                            {{ $client->first_telephone }}

                            <button title="Copia" wire:click="copy('{{ $client->first_telephone }}')"
                                x-on:click="$flux.toast('Contatto telefonico copiato.')" class="cursor-pointer">
                                <flux:icon.document-duplicate variant="micro" class="text-[#10BDD4]" />
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
                            <flux:button variant="ghost" wire:click='setLead({{ $client->id }})'
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
</div>
