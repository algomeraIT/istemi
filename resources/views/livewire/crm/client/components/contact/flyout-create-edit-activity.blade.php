<flux:modal name="new-activity" variant="flyout" @close="resetActivity" :dismissible="false" class="w-2xl !px-32">
    <button class="absolute top-4 right-4 text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
        x-on:click="$flux.modals().close()">
        <flux:icon.x-mark class="size-4" />
        <span>Annulla</span>
    </button>

    <div class="flex flex-col justify-start items-start gap-10">
        <h2 class="text-2xl font-bold text-left">
            @if ($activityForm->activity)
                Modifica attivita
            @else
                Programma attività
            @endif
        </h2>

        <div class="w-full grid grid-cols-2 gap-x-5 gap-y-8">
            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.briefcase />
                        <flux:label>Titolo attività</flux:label>
                    </div>

                    <flux:input wire:model="activityForm.title" />
                    <flux:error name="clientForm.title" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.at-symbol />
                        <flux:label>Assegnata a</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model="activityForm.assigned" searchable multiple>
                        <x-slot name="search">
                            <flux:select.search placeholder="Cerca..." />
                        </x-slot>

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
                        <flux:icon.at-symbol />
                        <flux:label>Conoscenza</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model="activityForm.contacts" searchable>
                        <x-slot name="search">
                            <flux:select.search placeholder="Cerca..." />
                        </x-slot>

                        @foreach ($users as $user)
                            <flux:select.option value="{{ $user->id }}">
                                {{ $user->full_name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="clientForm.contacts" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.calendar-days />
                        <flux:label>Scadenza</flux:label>
                    </div>
                    <flux:date-picker wire:model="activityForm.expiration">
                        <x-slot name="trigger">
                            <flux:date-picker.input />
                        </x-slot>
                    </flux:date-picker>
                    <flux:error name="activityForm.expiration" />
                </flux:field>
            </div>

            @if (count($activityForm->attachments))
                <div class="col-span-2 space-y-2">
                    <div class="text-[#B0B0B0] flex items-center gap-1">
                        <flux:icon.paper-clip class="size-4" />
                        <span class="text-xs font-light">Allegati</span>
                    </div>

                    <div class="flex flex-wrap gap-2 pl-4">
                        @foreach ($activityForm->attachments as $file)
                            <div class="border text-[#B0B0B0] px-4 py-1 shadow flex items-center gap-1">
                                <flux:icon.document-plus class="size-4" />
                                {{ $file->getClientOriginalName() }}

                                <flux:icon.x-circle title="rimuovi"
                                    class="size-4 ml-4 cursor-pointer text-[#6C757D] hover:text-red-600"
                                    wire:click="removeActivityAttachmentByIndex({{ $loop->index }})" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="col-span-2">
                <div>
                    <div class="flex items-center gap-1 mb-1 ml-1">
                        <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                        <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
                    </div>

                    <div class="w-full sticky bottom-0">
                        <div class="absolute right-3 top-3">
                            <input type="file" wire:model="activityForm.attachments"
                                id="NewActivity-attachment-upload" multiple class="hidden" />

                            <label for="NewActivity-attachment-upload"
                                class="cursor-pointer flex items-center gap-1 text-[#6C757D] hover:text-[#4E4E4E]">
                                <flux:icon.paper-clip class="size-5" />
                            </label>
                        </div>

                        <flux:editor wire:model="activityForm.note" class="**:data-[slot=content]:min-h-[150px]!" />
                    </div>
                </div>
            </div>
        </div>

        @if ($activityForm->activity)
            <flux:button variant="primary" data-variant="primary" wire:click="updateActivity" data-color="teal">
                Modifica
            </flux:button>
        @else
            <flux:button variant="primary" data-variant="primary" wire:click="createActivity" data-color="teal">
                Assegna
            </flux:button>
        @endif
    </div>
</flux:modal>
