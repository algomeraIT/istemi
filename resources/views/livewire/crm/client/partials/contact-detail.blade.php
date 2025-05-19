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
                <flux:tab data-variant="detail" name="history">Storico</flux:tab>
                <flux:tab data-variant="detail" name="communications">Comunicazioni</flux:tab>
                <flux:tab data-variant="detail" name="quotes">Preventivi</flux:tab>
            </flux:tabs>

            <flux:tab.panel name="history">
                @include('livewire.crm.client.components.contact.historyClient')
            </flux:tab.panel>

            <flux:tab.panel name="communications">
                <flux:tab.group>
                    <flux:tabs variant="segmented">
                        <flux:tab name="activity">
                            <flux:icon.calendar class="size-5" /> Attività
                        </flux:tab>
                        <flux:tab name="email">
                            <flux:icon.paper-airplane class="size-5" /> E-mail
                        </flux:tab>
                        <flux:tab name="note">
                            <flux:icon.pencil class="size-5" /> Note
                        </flux:tab>
                    </flux:tabs>

                    <flux:tab.panel name="activity">
                        <div class="flex items-center justify-between">
                            <flux:modal.trigger name="new-activity">
                                <flux:button variant="primary" size="sm" data-variant="primary" data-color="teal">
                                    Programma attività
                                </flux:button>
                            </flux:modal.trigger>

                            @include('livewire.crm.client.components.contact.flyout-create-edit-activity')

                            <flux:field data-input>
                                <flux:input wire:model.live="search" data-variant="search" :loading="false"
                                    clearable icon="magnifying-glass" placeholder="Cerca" />
                            </flux:field>
                        </div>

                        <div class="mt-5 overflow-auto h-[500px]">
                            @foreach ($activities->groupBy(fn($record) => $record->created_at->locale('it')->isoFormat('MMMM YYYY')) as $month => $records)
                                <div class="mt-8 mb-4 flex items-center relative">
                                    <div class="absolute h-px bg-gray-300 w-full"></div>
                                    <span
                                        class="bg-[#F5FCFD] text-[#10BDD4] z-10 px-3 py-1 border-[#E8E8E8] border-1 text-[13px] font-semibold ml-12">
                                        {{ $month }}
                                    </span>
                                </div>

                                @foreach ($records as $activity)
                                    <div class="border w-full p-4 mt-6">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                                                <flux:icon.user class="size-4" />
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2 text-sm">
                                                    <span
                                                        class="text-sm font-medium">{{ $activity->user?->full_name }}</span>
                                                    <span class="text-[#B0B0B0] text-xs capitalize"> -
                                                        {{ $activity->user?->role_name }}</span>
                                                </div>
                                                <div class="flex items-center text-xs text-gray-600 mt-1">
                                                    <span class="italic">ha programmato un'attività</span>
                                                    <div class="w-1 h-1 bg-black rounded-full mx-2"></div>
                                                    <span>{{ $activity->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-8 my-5 ml-8">
                                            <div class="text-[#B0B0B0]">
                                                <div class="flex items-center gap-1">
                                                    <flux:icon.briefcase class="size-4" />
                                                    <span class="text-xs font-light ">Attività</span>
                                                </div>
                                                <span class="font-semibold ml-4">{{ $activity->title }}</span>
                                            </div>
                                            <div class="text-[#B0B0B0]">
                                                <div class="flex items-center gap-1">
                                                    <flux:icon.at-symbol class="size-4" />
                                                    <span class="text-xs font-light ">Assegnato a</span>
                                                </div>
                                                @foreach ($activity->assigned as $user)
                                                    <span class="font-semibold ml-4">{{ $user->full_name }}</span>
                                                @endforeach
                                            </div>
                                            <div class="text-[#B0B0B0]">
                                                <div class="flex items-center gap-1">
                                                    <flux:icon.calendar-days class="size-4" />
                                                    <span class="text-xs font-light ">Scadenza</span>
                                                </div>
                                                <span class="font-semibold ml-4">{{ dateItFormat(now()) }}</span>
                                            </div>

                                            <flux:badge size="sm" data-step="{{ $activity->status }}" class="capitalize">
                                                {{ $activity->status }}

                                                <flux:dropdown offset="-15" gap="2">
                                                    <button class="flex items-center cursor-pointer">
                                                        <flux:icon.chevron-down class="text-white" variant="micro" />
                                                    </button>

                                                    <flux:menu>
                                                        <flux:menu.item wire:click="updateActivityStatus('presa in carico', {{ $activity->id }})"
                                                            class="!text-custom-9C1216">Presa in carico 
                                                        </flux:menu.item>
                                                        <flux:menu.item wire:click="updateActivityStatus('completato', {{ $activity->id }})"
                                                            class="!text-custom-126C9C">Completato
                                                        </flux:menu.item>
                                                        <flux:menu.item wire:click="updateActivityStatus('in ritardo', {{ $activity->id }})"
                                                            class="!text-custom-126C9C">In ritardo
                                                        </flux:menu.item>
                                                    </flux:menu>
                                                </flux:dropdown>
                                            </flux:badge>
                                        </div>

                                        <flux:button wire:click='showActivity({{ $activity->id }})' variant="ghost"
                                            icon:trailing="arrow-right" data-color="teal">
                                            Mostra di più
                                        </flux:button>
                                    </div>
                                @endforeach
                            @endforeach

                            @include('livewire.crm.client.components.contact.flyout-show-activity')

                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="email">
                        <div class="flex items-center justify-between">
                            <flux:modal.trigger name="new-email">
                                <flux:button variant="primary" size="sm" data-variant="primary" data-color="teal">
                                    Invia e-mail
                                </flux:button>
                            </flux:modal.trigger>

                            @include('livewire.crm.client.components.contact.flyout-create-edit-mail')

                            <flux:field data-input>
                                <flux:input wire:model.live="search" data-variant="search" :loading="false"
                                    clearable icon="magnifying-glass" placeholder="Cerca" />
                            </flux:field>
                        </div>

                        <div class="mt-5 overflow-auto h-[500px]">
                            @foreach ($emails->groupBy(fn($email) => $email->created_at->locale('it')->isoFormat('MMMM YYYY')) as $month => $records)
                                <div class="mt-8 mb-4 flex items-center relative">
                                    <div class="absolute h-px bg-gray-300 w-full"></div>
                                    <span
                                        class="bg-[#F5FCFD] text-[#10BDD4] z-10 px-3 py-1 border-[#E8E8E8] border-1 text-[13px] font-semibold ml-12">
                                        {{ $month }}
                                    </span>
                                </div>

                                @foreach ($records as $record)
                                    <div class="border w-full p-4 mt-6">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                                                <flux:icon.user class="size-4" />
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2 text-sm">
                                                    <span
                                                        class="text-sm font-medium">{{ $record->user?->full_name }}</span>
                                                    <span class="text-[#B0B0B0] text-xs capitalize"> -
                                                        {{ $record->user?->role_name }}</span>
                                                </div>
                                                <div class="flex items-center text-xs text-gray-600 mt-1">
                                                    <span class="italic">ha inviato un'email</span>
                                                    <div class="w-1 h-1 bg-black rounded-full mx-2"></div>
                                                    <span>{{ $record->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-8 my-5 ml-8">
                                            <div class="text-[#B0B0B0]">
                                                <div class="flex items-center gap-1">
                                                    <flux:icon.paper-airplane class="size-4" />
                                                    <span class="text-xs font-light">Mittente</span>
                                                </div>
                                                <span
                                                    class="font-semibold ml-4">{{ $record->sendBy->full_name }}</span>
                                            </div>
                                            <div class="text-[#B0B0B0]">
                                                <div class="flex items-center gap-1">
                                                    <flux:icon.at-symbol class="size-4" />
                                                    <span class="text-xs font-light ">Assegnato a</span>
                                                </div>
                                                <span class="font-semibold ml-4">{{ $record->user->email }}</span>
                                            </div>
                                            <div class="text-[#B0B0B0]">
                                                <div class="flex items-center gap-1">
                                                    <flux:icon.paper-clip class="size-4" />
                                                    <span class="text-xs font-light ">Allegati</span>
                                                </div>
                                                <span class="font-semibold ml-4">sample.pdf</span>
                                            </div>
                                        </div>

                                        <flux:button variant="ghost" icon:trailing="arrow-right" data-color="teal">
                                            Mostra di più
                                        </flux:button>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="note">
                        <div class="flex items-center justify-between">
                            <flux:modal.trigger name="new-note">
                                <flux:button variant="primary" size="sm" data-variant="primary"
                                    data-color="teal">
                                    Scrivi nota
                                </flux:button>
                            </flux:modal.trigger>

                            @include('livewire.crm.client.components.contact.flyout-create-edit-note')

                            <flux:field data-input>
                                <flux:input wire:model.live="search" data-variant="search" :loading="false"
                                    clearable icon="magnifying-glass" placeholder="Cerca" />
                            </flux:field>
                        </div>


                        <div class="mt-5 overflow-auto h-[500px]">
                            @foreach ($notes->groupBy(fn($note) => $note->created_at->locale('it')->isoFormat('MMMM YYYY')) as $month => $records)
                                <div class="mt-8 mb-4 flex items-center relative">
                                    <div class="absolute h-px bg-gray-300 w-full"></div>
                                    <span
                                        class="bg-[#F5FCFD] text-[#10BDD4] z-10 px-3 py-1 border-[#E8E8E8] border-1 text-[13px] font-semibold ml-12">
                                        {{ $month }}
                                    </span>
                                </div>

                                @foreach ($records as $record)
                                    <div class="border w-full p-4 mt-6">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                                                <flux:icon.user class="size-4" />
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2 text-sm">
                                                    <span
                                                        class="text-sm font-medium">{{ $record->user?->full_name }}</span>
                                                    <span class="text-[#B0B0B0] text-xs capitalize"> -
                                                        {{ $record->user?->role_name }}</span>
                                                </div>
                                                <div class="flex items-center text-xs text-gray-600 mt-1">
                                                    <span class="italic">ha scritto una nota</span>
                                                    <div class="w-1 h-1 bg-black rounded-full mx-2"></div>
                                                    <span>{{ $record->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-[#B0B0B0] mt-5 ml-8">
                                            <div class="flex items-center gap-1">
                                                <flux:icon.paper-clip class="size-4" />
                                                <span class="text-xs font-light ">Allegati</span>
                                            </div>
                                            <span class="font-semibold ml-4">sample.pdf</span>
                                        </div>

                                        <p class="mt-4 ml-12 text-lg font-light text-[#B0B0B0]">
                                            {{ $record->content }}
                                        </p>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </flux:tab.panel>
                </flux:tab.group>
            </flux:tab.panel>

            <flux:tab.panel name="quotes">
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
            </flux:tab.panel>
        </flux:tab.group>
    </div>
</div>
