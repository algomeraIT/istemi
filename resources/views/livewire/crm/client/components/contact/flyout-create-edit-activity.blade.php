<flux:modal name="new-activity" variant="flyout" :dismissible="false" class="w-2xl !px-32">
    <button class="absolute top-4 right-4 text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
        x-on:click="$flux.modals().close()">
        <flux:icon.x-mark class="size-4" />
        <span>Annulla</span>
    </button>

    <div class="flex flex-col justify-start items-start gap-10">
        <h2 class="text-2xl font-bold text-left">
            Programma attività
        </h2>

        <div class="w-full grid grid-cols-2 gap-x-5 gap-y-8">
            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.at-symbol />
                        <flux:label>Attività</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model.live="activityForm.title">
                        <flux:select.option value="chiama">Chiama</flux:select.option>
                        <flux:select.option value="invia e-mail">Invia e-mail</flux:select.option>
                    </flux:select>
                    <flux:error name="clientForm.title" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.at-symbol />
                        <flux:label>Assegnata a</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model.live="activityForm.assigned" searchable>
                        @foreach ($users as $user)
                            <flux:select.option value="{{ $user->id }}">
                                {{ $user->full_name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="clientForm.assigned" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.calendar-days />
                        <flux:label>Scadenza</flux:label>
                    </div>
                    <flux:date-picker wire:model.live="activityForm.expiration">
                        <x-slot name="trigger">
                            <flux:date-picker.input />
                        </x-slot>
                    </flux:date-picker>
                    <flux:error name="activityForm.expiration" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <div>
                    <div class="flex items-center gap-1 mb-1 ml-1">
                        <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                        <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
                    </div>
                    <flux:editor wire:model="activityForm.note" class="**:data-[slot=content]:min-h-[150px]!" />
                </div>
            </div>
        </div>

        <flux:button variant="primary" data-variant="primary" wire:click="createActivity" data-color="teal">
            Programma
        </flux:button>
    </div>
</flux:modal>
