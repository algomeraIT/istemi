<div class="pt-5 flex flex-col xl:flex-row gap-10 h-full">
    <!-- Right Section: Contact Info -->
    <div class="order-first xl:order-last w-full xl:max-w-[422px] mt-6 lg:mt-0">
        <div class=" rounded border-2 border-dashed border-cyan-300 p-10 space-y-4">
            <h2 class="text-2xl font-bold flex items-center space-x-2">
                <flux:icon.briefcase class="w-6 h-6" />
                <span>{{ $client->name }}</span>
            </h2>

            <div class="space-y-3 text-gray-600 font-inter">
                <x-field-data-client :label="'E-mail'" :data="$client->email" :copy="true" />
                <x-field-data-client :label="'Telefono'" :data="$client->first_telephone" :copy="true" />
                <x-field-data-client :label="'Servizio'" :data="$client->service" />

                <div class="w-full border-b border-dashed border-[#10BDD4] my-2"></div>

                <x-field-data-client :label="'Provenienza'" :data="$client->provenance" />
                <x-field-data-client :label="'Data acquisizione'" :data="dateItFormat($client->created_at)" />

                <div class="w-full border-b border-dashed border-[#10BDD4] my-2"></div>

                <x-field-data-client :label="'Commerciale'" :data="$client->salesManager?->full_name" />

                <div class="flex justify-between mt-2 mb-8">
                    <span class="text-[15px] text-[#B0B0B0]">Stato</span>

                    <flux:dropdown offset="-10" class="border rounded-lg px-2 bg-[#F0F1F2]">
                        <button
                            class="flex items-center justify-between cursor-pointer text-xs font-semibold pt-0.5 capitalize">
                            {{ $client->step }}
                            <flux:icon.chevron-down variant="micro" />
                        </button>

                        <flux:menu>
                            <flux:menu.item wire:click="updateStatus('non idoneo')">
                                Non idoneo
                            </flux:menu.item>
                            <flux:menu.item wire:click="updateStatus('in contatto')">
                                In contatto
                            </flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>

            {{-- TODO da abilitare a seguito di sviluppo aerea preventivo --}}
            {{-- <flux:button variant="primary" size="sm" data-variant="primary" wire:click="newQuote"
                data-color="teal">
                Crea preventivo
            </flux:button> --}}
        </div>
    </div>

    {{-- Section Tab --}}
    <div class="flex-grow xl:w-2/3">
        <flux:tab.group>
            <flux:tabs variant="segmented">
                {{-- <flux:tab data-variant="detail" name="history">Storico</flux:tab> --}}
                <flux:tab data-variant="detail" name="communications">Comunicazioni</flux:tab>
                {{-- <flux:tab data-variant="detail" name="quotes">Preventivi</flux:tab> --}}
            </flux:tabs>

            {{-- <flux:tab.panel name="history">
                @include('livewire.crm.client.components.contact.historyClient')
            </flux:tab.panel> --}}

            <flux:tab.panel name="communications">
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

                    {{-- Flyout Modals --}}
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
                            <flux:select.option>Chiamata</flux:select.option>
                        </flux:select>
                    </flux:field>
                </div>

                <div class="overflow-auto h-[530px]">
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

                    @include('livewire.crm.client.components.contact.flyout-show-activity')
                </div>
            </flux:tab.panel>

            {{-- <flux:tab.panel name="quotes">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-4 mb-4">
                    <div class="flex gap-4 items-center">
                        <select wire:model.live="status_estimate" class=" border rounded p-2">
                            <option value="">Filtro</option>
                            <option value="0">In scadenza</option>
                            <option value="1">Valido</option>
                            <option value="2">Scaduto</option>
                        </select>

                        <input type="text" wire:model.live="query_estimate" placeholder="Cerca…"
                            class="border rounded p-2 flex-1 max-w-sm" />
                    </div>
                </div>

                @include('livewire.crm.utilities.estimate-sub-table', ['estimates' => $estimates])
            </flux:tab.panel> --}}
        </flux:tab.group>
    </div>
</div>
