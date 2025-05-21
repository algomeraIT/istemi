<flux:modal name="show-lead" variant="flyout" :dismissible="false" class="w-2xl !px-32 relative">
    <button class="absolute top-4 right-4 text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
        x-on:click="$flux.modals().close()">
        <flux:icon.x-mark class="size-4" />
        <span>Annulla</span>
    </button>

    @if ($selectedLead)
        <div class="flex flex-col justify-start items-start gap-10">
            <h2 class="text-2xl font-bold text-left">{{ $selectedLead->name }}</h2>

            <flux:badge size="sm" data-step="{{ $selectedLead->step }}">
                {{ ucfirst($selectedLead->step) }}
            </flux:badge>

            <div class="w-full grid grid-cols-2 gap-x-5 gap-y-10">
                <div class="col-span-1">
                    <x-field-data :label="'Data acquisizione'" :data="dateItFormat($selectedLead->created_at)">
                        <x-slot name="icon">
                            <flux:icon.calendar-days class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>
                <div class="col-span-1">
                    <x-field-data :label="'Provenienza'" :data="$selectedLead->provenance">
                        <x-slot name="icon">
                            <flux:icon.arrow-right class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>
                <div class="col-span-2">
                    <x-field-data :label="'E-mail'" :data="$selectedLead->email" :copy="true">
                        <x-slot name="icon">
                            <flux:icon.at-symbol class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>
                <div class="col-span-2">
                    <x-field-data :label="'Telefono'" :data="$selectedLead->first_telephone" :copy="true">
                        <x-slot name="icon">
                            <flux:icon.phone class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>
                <div class="col-span-2">
                    <x-field-data :label="'Servizio'" :data="$selectedLead->service">
                        <x-slot name="icon">
                            <flux:icon.tag class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>

                <div class="col-span-2">
                    <div>
                        <div class="flex items-center gap-1 mb-1 ml-1">
                            <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                            <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
                        </div>
                        <flux:editor value="{{ $selectedLead->note }}" disabled toolbar="align"
                            class="**:data-[slot=content]:min-h-[100px]!" />
                    </div>
                </div>
            </div>

            @if ($selectedLead->sales_manager_id)
                <div class="col-span-2">
                    <x-field-data :label="'Commerciale'" :data="$selectedLead->salesManager->full_name">
                        <x-slot name="icon">
                            <flux:icon.user class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>
            @else
                <div class="w-full flex flex-col gap-5">
                    <h3 class="text-[22px] font-semibold text-left">Assegna {{ $selectedLead->status }}</h3>

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

                <flux:button variant="primary" data-variant="primary"
                    wire:click="assignManager({{ $selectedLead->id }})" data-color="teal">
                    Assegna
                </flux:button>
            @endif
        </div>
    @endif
</flux:modal>
