<flux:modal name="show-referent" variant="flyout" :dismissible="false" class="w-2xl !px-32">
    <button class="absolute top-4 right-4 text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
        x-on:click="$flux.modals().close()">
        <flux:icon.x-mark class="size-4" />
        <span>Chiudi</span>
    </button>

    @if ($referentForm->referent)
        <div class="flex flex-col justify-start items-start gap-10">
            <div class="flex items-center gap-2">
                <flux:icon.user variant="solid" class="size-6" />
                <h2 class="text-2xl font-bold text-left">{{ $referentForm->referent->full_name }}</h2>
            </div>

            <div class="w-full grid grid-cols-2 gap-x-5 gap-y-10">
                <div class="col-span-2">
                    <x-field-data :label="'Titolo'" :data="$referentForm->referent->title">
                        <x-slot name="icon">
                            <flux:icon.tag class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>

                <div class="col-span-2">
                    <x-field-data :label="'Posizione lavorativa'" :data="$referentForm->referent->job_position">
                        <x-slot name="icon">
                            <flux:icon.briefcase class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>

                <div class="col-span-2">
                    <x-field-data :label="'E-mail'" :data="$referentForm->referent->email" :copy="true">
                        <x-slot name="icon">
                            <flux:icon.at-symbol class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>

                <div class="col-span-2">
                    <x-field-data :label="'Telefono'" :data="$referentForm->referent->telephone" :copy="true">
                        <x-slot name="icon">
                            <flux:icon.phone class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>

                <div class="col-span-2">
                    <div>
                        <div class="flex items-center gap-1 mb-1 ml-1">
                            <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                            <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
                        </div>
                        <flux:editor wire:model="referentForm.note" disabled toolbar="align" class="**:data-[slot=content]:min-h-[100px]!" />
                    </div>
                </div>
            </div>
        </div>
    @endif
</flux:modal>
