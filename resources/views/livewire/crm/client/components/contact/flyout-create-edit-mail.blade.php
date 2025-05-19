<flux:modal name="new-email" variant="flyout" :dismissible="false" class="w-2xl !px-32">
    <button class="absolute top-4 right-4 text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
        x-on:click="$flux.modals().close()">
        <flux:icon.x-mark class="size-4" />
        <span>Annulla</span>
    </button>

    <div class="flex flex-col justify-start items-start gap-10">
        <h2 class="text-2xl font-bold text-left">
            Invia e-mail
        </h2>

        <div class="w-full grid grid-cols-2 gap-x-5 gap-y-8">
            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.paper-airplane />
                        <flux:label>Mittente</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model.live="clientForm.country" searchable>
                        <x-slot name="search">
                            <flux:select.search placeholder="Cerca..." />
                        </x-slot>

                        @foreach ($users as $user)
                            <flux:select.option value="{{ $user->id }}">
                                {{ $user->full_name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="clientForm.country" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.at-symbol />
                        <flux:label>Destinatari</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model.live="clientForm.country" searchable multiple>
                        <x-slot name="search">
                            <flux:select.search placeholder="Cerca..." />
                        </x-slot>

                        @foreach ($all as $user)
                            <flux:select.option value="{{ $user->id }}">
                                {{ $user->full_name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="clientForm.country" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.document-text />
                        <flux:label>Oggetto</flux:label>
                    </div>
                    <flux:input wire:model.live="referentForm.name" />
                    <flux:error name="referentForm.name" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <div>
                    <div class="flex items-center gap-1 mb-1 ml-1">
                        <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                        <flux:label class="text-xs !font-light !text-[#B0B0B0]">Email</flux:label>
                    </div>
                    <flux:editor wire:model="referentForm.note" class="**:data-[slot=content]:min-h-[200px]!" />
                </div>
            </div>
        </div>

        <flux:button variant="primary" data-variant="primary" wire:click="newHistory" data-color="teal">
            Invia
        </flux:button>
    </div>
</flux:modal>
