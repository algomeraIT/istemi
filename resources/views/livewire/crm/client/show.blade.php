<div class="h-full bg-white p-10 pb-4 shadow">
    @include('livewire.general.goback')

    <div class="mt-5 flex flex-col xl:flex-row gap-10">
        <!-- Right Section: Detail -->
        <div class="order-first xl:order-last w-full xl:max-w-[419px] mt-6 lg:mt-0">
            @if ($this->client->status == 'cliente')
                @include('livewire.crm.client.partials.client-detail')
            @endif

            @if ($this->client->status == 'contatto')
                @include('livewire.crm.client.partials.contact-detail')
            @endif
        </div>

        {{-- Section Tab --}}
        <div class="flex-grow xl:w-2/3">
            <flux:tab.group>
                <flux:tabs variant="segmented">
                    @foreach ($tabs as $tab)
                        <flux:tab data-variant="detail" name="{{ $tab }}">{{ $tab }}</flux:tab>
                    @endforeach
                </flux:tabs>

                <flux:tab.panel name="storico">
                    @include('livewire.crm.client.components.contact.historyClient')
                </flux:tab.panel>

                <flux:tab.panel name="preventivi">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-4 mb-4">
                        <div class="flex gap-4 items-center">
                            <select class=" border rounded p-2">
                                <option value="">Filtro</option>
                                <option value="0">In scadenza</option>
                                <option value="1">Valido</option>
                                <option value="2">Scaduto</option>
                            </select>

                            <input type="text" placeholder="Cerca…" class="border rounded p-2 flex-1 max-w-sm" />
                        </div>
                    </div>

                    {{-- @include('livewire.crm.utilities.estimate-sub-table') --}}
                </flux:tab.panel>

                <flux:tab.panel name="referenti">
                    <div class="flex items-center place-content-between">
                        <flux:button wire:click='setReferent' variant="primary" size="sm" data-variant="primary"
                            data-color="teal" class="ml-4">
                            Aggiungi
                        </flux:button>

                        <flux:field data-input>
                            <flux:input wire:model.live="search" data-variant="search" :loading="false" clearable
                                icon="magnifying-glass" placeholder="Cerca" />
                        </flux:field>
                    </div>

                    <!-- Table -->
                    @include('livewire.crm.client.components.client.referent-table')

                    {{-- Modals --}}
                    @include('livewire.crm.client.components.client.flyout-create-edit')
                    @include('livewire.crm.client.components.client.flyout-show')
                </flux:tab.panel>

                <flux:tab.panel name="commercio">
                    <flux:tab.group>
                        <div class="flex items-center place-content-between">
                            <flux:tabs variant="segmented">
                                <flux:tab name="sales">
                                    <flux:icon.arrow-up-right class="size-5" /> Vendite
                                </flux:tab>
                                <flux:tab name="acquisitions">
                                    <flux:icon.arrow-down-right class="size-5" /> Acquisti
                                </flux:tab>
                            </flux:tabs>

                            <flux:field data-input>
                                <flux:input wire:model.live="search" data-variant="search" :loading="false"
                                    clearable icon="magnifying-glass" placeholder="Cerca" />
                            </flux:field>
                        </div>

                        <flux:tab.panel name="sales" class="!pt-0">
                        </flux:tab.panel>

                        <flux:tab.panel name="acquisitions" class="!pt-0">
                        </flux:tab.panel>
                    </flux:tab.group>
                </flux:tab.panel>

                <flux:tab.panel name="contabilità">
                </flux:tab.panel>

                <flux:tab.panel name="comunicazioni">
                    <div class="flex items-center justify-between">
                        <flux:dropdown>
                            <flux:button icon="plus" size="sm" data-color="teal">Aggiungi</flux:button>

                            <flux:menu class="text-[#B0B0B0]">
                                <flux:modal.trigger name="new-activity">
                                    <flux:menu.item icon="calendar"
                                        class="!text-[#B0B0B0] hover:!text-[#E873A0] hover:!bg-[#F9EDF1]">Attività
                                    </flux:menu.item>
                                </flux:modal.trigger>
                                <flux:modal.trigger name="new-email">
                                    <flux:menu.item icon="paper-airplane"
                                        class="!text-[#B0B0B0] hover:!text-[#10BDD4] hover:!bg-[#E2EDF7]">E-mail
                                    </flux:menu.item>
                                </flux:modal.trigger>
                                {{-- <flux:modal.trigger name="new-note">
                                        <flux:menu.item icon="pencil"
                                            class="!text-[#B0B0B0] hover:!text-[#B0B0B0] hover:!bg-[#F3F3F3]">Nota
                                        </flux:menu.item>
                                    </flux:modal.trigger>
                                    <flux:modal.trigger name="new-call">
                                        <flux:menu.item icon="phone"
                                            class="!text-[#B0B0B0] hover:!text-[#A259F4] hover:!bg-[#F2EAFA]">Chiamata
                                        </flux:menu.item>
                                    </flux:modal.trigger> --}}
                            </flux:menu>
                        </flux:dropdown>

                        {{-- Flyout Modals Create/Edit --}}
                        @include('livewire.crm.client.components.contact.flyout-create-edit-activity')
                        @include('livewire.crm.client.components.contact.flyout-create-edit-mail')
                        @include('livewire.crm.client.components.contact.flyout-create-edit-note')
                        @include('livewire.crm.client.components.contact.flyout-create-edit-call')

                        {{-- Filter --}}
                        <flux:field data-input>
                            <flux:select wire:model.live="communicationType" variant="listbox" clearable
                                placeholder="Seleziona tipologia" class="min-w-44">
                                <flux:select.option>Attivita</flux:select.option>
                                <flux:select.option>E-mail</flux:select.option>
                                <flux:select.option>Nota</flux:select.option>
                                {{-- <flux:select.option>Chiamata</flux:select.option> --}}
                            </flux:select>
                        </flux:field>
                    </div>

                    <div class="overflow-auto h-[530px]">
                        @if (count($communications))
                            @foreach ($communications as $record)
                                @if ($record instanceof \App\Models\Activity)
                                    @include('livewire.crm.client.components.contact.item-activity', [
                                        'activity' => $record,
                                    ])
                                @elseif ($record instanceof \App\Models\Email)
                                    @include('livewire.crm.client.components.contact.item-email', [
                                        'email' => $record,
                                    ])
                                @elseif ($record instanceof \App\Models\Note)
                                    @include('livewire.crm.client.components.contact.item-note', [
                                        'note' => $record,
                                    ])
                                @endif
                            @endforeach
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <p class="text-[#B0B0B0] text-2xl font-medium">Nessuna
                                    comunicazione al momento</p>
                            </div>
                        @endif

                        {{-- Flyout Modals Show --}}
                        @include('livewire.crm.client.components.contact.flyout-show-activity')
                        @include('livewire.crm.client.components.contact.flyout-show-mail')
                    </div>
                </flux:tab.panel>
            </flux:tab.group>
        </div>
    </div>
</div>
