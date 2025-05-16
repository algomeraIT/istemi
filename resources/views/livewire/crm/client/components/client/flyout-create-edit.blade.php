<flux:modal name="create-edit-referent" variant="flyout" :dismissible="false" class="w-2xl !px-32 relative">
    <button class="absolute top-4 right-4 text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
        x-on:click="$flux.modals().close()">
        <flux:icon.x-mark class="size-4" />
        <span>Annulla</span>
    </button>

    <div class="flex flex-col justify-start items-start gap-10">
        <div class="flex items-center gap-2">
            <flux:icon.user variant="solid" class="size-6" />
            <h2 class="text-2xl font-bold text-left">
                @if ($referentForm->referent)
                    Modifica referente
                @else
                    Aggiungi referente
                @endif
            </h2>
        </div>

        <div class="w-full grid grid-cols-2 gap-x-5 gap-y-5">
            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.user />
                        <flux:label>Nome</flux:label>
                    </div>
                    <flux:input wire:model.live="referentForm.name" />
                    <flux:error name="referentForm.name" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.user />
                        <flux:label>Cognome</flux:label>
                    </div>
                    <flux:input wire:model.live="referentForm.last_name" />
                    <flux:error name="referentForm.last_name" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.tag />
                        <flux:label>Titolo</flux:label>
                    </div>
                    <flux:input wire:model.live="referentForm.title" />
                    <flux:error name="referentForm.title" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.briefcase />
                        <flux:label>Posizione lavorativa</flux:label>
                    </div>
                    <flux:input wire:model.live="referentForm.job_position" />
                    <flux:error name="referentForm.job_position" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.at-symbol />
                        <flux:label>e-mail</flux:label>
                    </div>
                    <flux:input type="email" wire:model.live="referentForm.email" />
                    <flux:error name="referentForm.email" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.phone />
                        <flux:label>Telefono</flux:label>
                    </div>
                    <flux:input.group>
                        <flux:select class="max-w-fit">
                            <flux:select.option selected>+39</flux:select.option>
                        </flux:select>
                        <flux:input wire:model.live="referentForm.telephone" mask="999 99 99 999" />
                    </flux:input.group>

                    <flux:error name="referentForm.telephone" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <div>
                    <div class="flex items-center gap-1 mb-1 ml-1">
                        <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                        <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
                    </div>
                    <flux:editor wire:model="referentForm.note" class="**:data-[slot=content]:min-h-[100px]!" />
                </div>
            </div>
        </div>

        @if ($referentForm->referent)
            <flux:button variant="primary" data-variant="primary" wire:click="updateReferent" data-color="teal">
                Modifica
            </flux:button>
        @else
            <flux:button variant="primary" data-variant="primary" wire:click="createReferent" data-color="teal">
                Aggiungi
            </flux:button>
        @endif
    </div>
</flux:modal>
