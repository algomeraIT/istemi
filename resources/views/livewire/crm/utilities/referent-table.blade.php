<div class="mt-8">
    <flux:table class="border-b">
        <flux:table.columns>
            <flux:table.column>Nome Cognome</flux:table.column>
            <flux:table.column>Titolo</flux:table.column>
            <flux:table.column>Posizione lavorativa</flux:table.column>
            <flux:table.column>E-mail</flux:table.column>
            <flux:table.column>Telefono</flux:table.column>
            <flux:table.column :align="'end'">&nbsp;</flux:table.column>
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
                        <flux:modal.trigger name="show-edit-referent">
                            <flux:button variant="ghost" wire:click='setReferent({{ $referent->id }})'
                                data-variant="ghost" data-color="teal" icon="eye" size="sm" />
                        </flux:modal.trigger>

                        <flux:modal.trigger name="show-edit-referent">
                            <flux:button variant="ghost" wire:click='setReferent({{ $referent->id }})'
                                data-variant="ghost" data-color="gray" icon="pencil" size="sm" />
                        </flux:modal.trigger>

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

    {{-- Modal --}}
    <flux:modal name="show-edit-referent" variant="flyout" class="w-2xl !px-32">
        @if ($selectedReferent)
            <div class="flex flex-col justify-start items-start gap-10">
                <h2 class="text-2xl font-bold text-left">{{ $selectedReferent->name }}</h2>

                <flux:badge size="sm" data-step="{{ $selectedReferent->step }}">
                    {{ ucfirst($selectedReferent->step) }}
                </flux:badge>

                <div class="w-full grid grid-cols-2 gap-x-5 gap-y-10">
                    <div class="col-span-1">
                        <x-field-data :label="'Data acquisizione'" :data="dateItFormat($selectedReferent->created_at)">
                            <x-slot name="icon">
                                <flux:icon.calendar-days class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                    <div class="col-span-1">
                        <x-field-data :label="'Provenienza'" :data="$selectedReferent->provenance">
                            <x-slot name="icon">
                                <flux:icon.arrow-right class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                    <div class="col-span-2">
                        <x-field-data :label="'E-mail'" :data="$selectedReferent->email" :copy="true">
                            <x-slot name="icon">
                                <flux:icon.at-symbol class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                    <div class="col-span-2">
                        <x-field-data :label="'Telefono'" :data="$selectedReferent->first_telephone" :copy="true">
                            <x-slot name="icon">
                                <flux:icon.phone class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                    <div class="col-span-2">
                        <x-field-data :label="'Servizio'" :data="$selectedReferent->service">
                            <x-slot name="icon">
                                <flux:icon.tag class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                    <div class="col-span-2">
                        <x-field-data :label="'Nota'" :data="$selectedReferent->note">
                            <x-slot name="icon">
                                <flux:icon.pencil-square class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>
                </div>

                <flux:button variant="primary" data-variant="primary" wire:click="createReferent" data-color="teal">
                    Aggiungi
                </flux:button>
            </div>
        @endif
    </flux:modal>
</div>
