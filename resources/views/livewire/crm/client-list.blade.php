<div class="w-full">
    @if ($clients)
        <flux:table class="border-b">
            <flux:table.columns>
                <flux:table.column>ID</flux:table.column>
                <flux:table.column class="{{ $clientStatus == 'cliente' ? '' : 'hidden' }}">Logo</flux:table.column>
                <flux:table.column>Ragione Sociale</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Telefono</flux:table.column>
                <flux:table.column class="{{ $clientStatus == 'cliente' ? 'hidden' : '' }}">Acquisizione
                </flux:table.column>
                <flux:table.column>Sede</flux:table.column>
                <flux:table.column>{{ $clientStatus == 'cliente' ? 'Etichette' : 'Stato' }}</flux:table.column>
                <flux:table.column align="end">Azioni</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($clients as $client)
                    <flux:table.row key="{{ $client->id }}">
                        <flux:table.cell>{{ $client->id }}</flux:table.cell>
                        <flux:table.cell class="{{ $clientStatus == 'cliente' ? '' : 'hidden' }}">
                            <img src="{{ optional($client)->logo_path ? asset($client->logo_path) : asset('icon/logo.svg') }}"
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
                        <flux:table.cell>{{ $client->city }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" data-step="{{ $client->step }}">{{ ucfirst($client->step) }}
                            </flux:badge>
                        </flux:table.cell>

                        {{-- Actions --}}
                        <flux:table.cell align="end">
                            <flux:button wire:click="goToDetail({{ $client->id }})" variant="ghost"
                                data-variant="ghost" data-color="teal" icon="eye" size="sm" />
                            @if ($clientStatus === 'cliente')
                                <flux:button wire:click="edit({{ $client->id }})" variant="ghost"
                                    data-variant="ghost" data-color="gray" icon="pencil" size="sm" />
                            @endif
                            <flux:button wire:click="delete({{ $client->id }})"
                                wire:confirm="Sei sicuro di voler eliminare questo client?" variant="ghost"
                                data-variant="ghost" data-color="red" icon="trash" size="sm" />
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>

        <div class="-mx-4 mt-4">
            {{ $clients->links('customPagination') }}
        </div>
    @else
        <p class="text-gray-500">Nessun elemento da mostrare</p>
    @endif
</div>
