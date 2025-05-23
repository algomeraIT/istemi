<flux:modal name="now-lead" variant="flyout" :dismissible="false" class="w-2xl !px-26 relative">
    <button class="absolute top-4 right-4 text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
        x-on:click="$flux.modals().close()">
        <flux:icon.x-mark class="size-4" />
        <span>Annulla</span>
    </button>

    <div class="flex flex-col justify-start items-start gap-10">
        <h2 class="text-2xl font-bold text-left">Crea lead</h2>

        <div class="w-full grid grid-cols-1 gap-x-5 gap-y-10">
            <flux:field data-input>
                <div>
                    <flux:icon.clipboard />
                    <flux:label>Nome/Ragione sociale</flux:label>
                </div>
                <flux:input wire:model="clientForm.name" />
                <flux:error name="clientForm.name" />
            </flux:field>

            <flux:field data-input>
                <div>
                    <flux:icon.phone />
                    <flux:label>Telefono</flux:label>
                </div>
                <flux:input.group>
                    <flux:select class="max-w-fit">
                        <flux:select.option selected>+39</flux:select.option>
                    </flux:select>
                    <flux:input wire:model="clientForm.first_telephone" mask="999 99 99 999" />
                </flux:input.group>

                <flux:error name="clientForm.first_telephone" />
            </flux:field>

            <flux:field data-input>
                <div>
                    <flux:icon.at-symbol />
                    <flux:label>E-mail</flux:label>
                </div>
                <flux:input type="email" wire:model="clientForm.email" />
                <flux:error name="clientForm.email" />
            </flux:field>

            <div>
                <div class="flex items-center gap-1 mb-1 ml-1">
                    <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                    <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
                </div>
                <flux:editor wire:model="clientForm.note" class="**:data-[slot=content]:min-h-[100px]!"
                    placeholder="Scrivi qualcosa..." />
                <flux:error name="clientForm.note" />
            </div>

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

        <flux:button variant="primary" data-variant="primary" wire:click="create" data-color="teal">
            Crea
        </flux:button>
    </div>
</flux:modal>
