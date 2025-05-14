<div class="mt-8">
    <flux:table class="border-b">
        <flux:table.columns>
            <flux:table.column>Nome Cognome</flux:table.column>
            <flux:table.column>Titolo</flux:table.column>
            <flux:table.column>Posizione lavorativa</flux:table.column>
            <flux:table.column>E-mail</flux:table.column>
            <flux:table.column>Telefono</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($referents as $referent)
                <flux:table.row wire:key="{{ $referent->id }}">
                    <flux:table.cell>{{ $referent->full_name }}</flux:table.cell>
                    <flux:table.cell>{{ $referent->title }}</flux:table.cell>
                    <flux:table.cell>{{ $referent->job_position }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        <div class="flex items-center gap-2 mt-1 font-semibold">{{ $referent->email }}
                            <button title="Copia" wire:click="copy('{{ $referent->email }}')"
                                x-on:click="$flux.toast('Mail copiata.')" class="cursor-pointer">
                                <flux:icon.document-duplicate class="size-4 text-[#10BDD4]" />
                            </button>
                        </div>
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        <div class="flex items-center gap-2 mt-1 font-semibold">{{ $referent->telephone }}
                            <button title="Copia" wire:click="copy('{{ $referent->telephone }}')"
                                x-on:click="$flux.toast('Contatto telefonico copiato.')" class="cursor-pointer">
                                <flux:icon.document-duplicate class="size-4 text-[#10BDD4]" />
                            </button>
                        </div>
                    </flux:table.cell>

                    {{-- Actions --}}
                    <flux:table.cell :align="'end'">
                        <flux:button variant="ghost" wire:click="setReferent({{ $referent->id }}, 'show')"
                            data-variant="ghost" data-color="teal" icon="eye" size="sm" />

                        <flux:button variant="ghost" wire:click="setReferent({{ $referent->id }}, 'edit')"
                            data-variant="ghost" data-color="gray" icon="pencil" size="sm" />

                        <flux:button wire:click="delete({{ $referent->id }})"
                            wire:confirm="Sei sicuro di voler eliminare questo referente?" variant="ghost"
                            data-variant="ghost" data-color="red" icon="trash" size="sm" />
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    @if (!$referents)
        <div class="mt-4">
            <p class="text-gray-500 text-center">Nessun referente da mostrare</p>
        </div>
    @endif

    <div class="-mx-4 mt-4">
        {{ $referents->links('customPagination') }}
    </div>
</div>
