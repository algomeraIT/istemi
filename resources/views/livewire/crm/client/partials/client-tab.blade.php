<flux:tab.group>
    <flux:tabs variant="segmented">
        <flux:tab data-variant="detail" name="referenti">Referenti</flux:tab>
        <flux:tab data-variant="detail" name="commercio">Vendite e acquisti</flux:tab>
        <flux:tab data-variant="detail" name="contabilita">Contabilità</flux:tab>
        <flux:tab data-variant="detail" name="comunicazioni">Comunicazioni</flux:tab>
    </flux:tabs>

    <flux:tab.panel name="referenti">
        <div class="flex items-center place-content-between">
            <flux:button variant="primary" size="sm" data-variant="primary" wire:click="openModalReferent" data-color="teal" class="ml-4">
                Aggiungi
            </flux:button>

            <flux:field data-input>
                <flux:input wire:model.live="search" data-variant="search" :loading="false" clearable
                    icon="magnifying-glass" placeholder="Cerca" />
            </flux:field>    
        </div>

        <!-- Referents Table -->
        @include('livewire.crm.utilities.referent-table', ['referents' => $referents])
    </flux:tab.panel>

    <flux:tab.panel name="commercio">
        <div x-data="{ activeTabSales: 'sales' }">
            <div class="flex  place-content-between">
                <div class="flex  pt-[10px] pl-[40px] pb-[20px] h-[65px]">
                    <button @click="activeTabSales = 'sales'"
                        :class="{ ' text-[#10BDD4]': activeTabSales === 'sales' }"
                        class="flex p-1 border-1 border-[#10BDD4] text-[16px] font-bold text-[#10BDD4] text-left opacity-100 font-inter">
                        <flux:icon.arrow-up-right class="w-3 ml-1.5 mr-2" /> Vendite
                    </button>

                    <button @click="activeTabSales = 'acquisitions';"
                        :class="{ ' text-[#10BDD4]': activeTabSales === 'acquisitions' }"
                        class="flex p-1 border-1 border-[#10BDD4] text-[16px] font-bold text-[#10BDD4] text-left opacity-100 font-inter">
                        <flux:icon.arrow-down-right class="w-3 ml-1.5 mr-2 " /> Acquisti
                    </button>
                </div>


                <div class="" x-show="activeTabSales === 'sales'" x-cloak>

                    <div class="flex h-14 p-2">
                        <select wire:model.live="status_sales" class=" border-1 ">
                            <option value="" selected>Filtro</option>
                            <option value="0">In transito</option>
                            <option value="1">Consegnato</option>
                        </select>
                        <input type="text" wire:model.live="query_sales" placeholder="Cerca" class="border" />
                    </div>
                </div>

                <div class="" x-show="activeTabSales === 'acquisitions'" x-cloak>

                    <div class="">
                        <select wire:model.live="acquisition_sales" class=" border-1 h-[40px] p-[10px] w-[130px]">
                            <option value="" selected>Filtro</option>
                            <option value="0">In arrivo</option>
                            <option value="1">Ricevuta</option>
                        </select>
                        <input type="text" wire:model.live="query_acquisitions" placeholder="Cerca"
                            class="border p-2" />
                    </div>
                </div>
            </div>

            <div class="mt-2 " x-show="activeTabSales === 'sales'" x-cloak>
                @include('livewire.crm.utilities.sale-table', ['sales' => $sales])

            </div>

            <div class="mt-2 " x-show="activeTabSales === 'acquisitions'" x-cloak>
                @include('livewire.crm.utilities.acquisition-table', [
                    'acquisitions' => $acquisitions,
                ])

            </div>
        </div>
    </flux:tab.panel>

    <flux:tab.panel name="contabilita">
        <div class="flex  pt-[10px] pl-[40px] pb-[20px] h-[65px]">
            <button @click="activeTabAccounting = 'orders'"
                :class="{ ' text-[#10BDD4]': activeTabAccounting === 'orders' }"
                class="flex p-[4px] border-1 border-[#10BDD4] text-[16px] leading-[25px] font-bold text-[#10BDD4] text-left opacity-100 font-inter">
                <flux:icon.briefcase class="w-[12px] ml-[6px] mr-[10px] " /> Ordini
            </button>

            <button @click="activeTabAccounting = 'invoices';"
                :class="{ ' text-[#10BDD4]': activeTabAccounting === 'invoices' }"
                class="flex p-[4px] border-1 border-[#10BDD4] text-[16px] leading-[25px] font-bold text-[#10BDD4] text-left opacity-100 font-inter">
                <flux:icon.document class="w-[12px] ml-[6px] mr-[10px] " /> Fatture
            </button>

            <div class="" x-show="activeTabAccounting === 'orders'" x-cloak>

                <div class="">
                    <select wire:model.live="status_orders" class="ml-[300px] border-1 h-[40px] p-[10px]">
                        <option value="" selected>Filtro</option>
                        <option value="0">In corso</option>
                        <option value="1">Evaso</option>
                        <option value="2">Annullato</option>

                    </select>
                    <input type="text" wire:model.debounce.300ms="query_orders" placeholder="Cerca"
                        class="border p-2 rounded w-[280px] mb-4 ml-[40px]" />
                </div>
            </div>
            <div class="" x-show="activeTabAccounting === 'invoices'" x-cloak>

                <div class="">
                    <select wire:model.live="status_invoices" class="ml-[300px] border-1 h-[40px] p-[10px]">
                        <option value="" selected>Filtro</option>
                        <option value="0">Pagata</option>
                        <option value="1">Da pagare</option>
                        <option value="2">Scaduta</option>

                    </select>
                    <input type="text" wire:model.live="query_invoices" placeholder="Cerca"
                        class="border p-2 rounded w-[280px] mb-4 ml-[40px]" />
                </div>
            </div>
        </div>

        <div class="mt-2" x-show="activeTabAccounting === 'orders'" x-cloak>
            @include('livewire.crm.utilities.order-table', [
                'accounting_orders' => $accounting_orders,
            ])

        </div>

        <div class="mt-2" x-show="activeTabAccounting === 'invoices'" x-cloak>
            @include('livewire.crm.utilities.invoice-table', [
                'accounting_invoices' => $accounting_invoices,
            ])

        </div>
    </flux:tab.panel>

    <flux:tab.panel name="comunicazioni">
        <div x-data="{ open: false }" class="relative inline-block text-left mb-8">
            <!-- Trigger Button -->
            <flux:button @click="open = !open"
                class="bg-white  text-sm font-semibold px-4 py-2 rounded shadow-sm border border-gray-200 hover:bg-gray-50 transition duration-200 flex items-center gap-2">

                <flux:icon.plus class="w-4 h-4" />
                Aggiungi
                <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </flux:button>
            <!-- Dropdown Items -->
            <div x-show="open" @click.away="open = false"
                class="absolute mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 z-50"
                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <div class="py-1 space-y-1">
                    <flux:button wire:click="openModalActivity"
                        class="flex w-full border-0  justify-start text-sm text-gray-700 hover:bg-gray-100 hover:text-cyan-600 ">
                        <flux:icon.calendar-days class="w-4 h-4" />
                        Attività
                    </flux:button>

                    <flux:button wire:click="openModalEmail"
                        class="w-full  border-0 justify-start text-sm text-gray-700 hover:bg-gray-100 hover:text-cyan-600 transition flex items-center gap-2 px-4 py-2">
                        <flux:icon.envelope class="w-4 h-4" />
                        E-mail
                    </flux:button>

                    <flux:button wire:click="openModalNote"
                        class="w-full  border-0 justify-start text-sm text-gray-700 hover:bg-gray-100 hover:text-cyan-600 transition flex items-center gap-2 px-4 py-2">
                        <flux:icon.pencil class="w-4 h-4" />
                        Nota
                    </flux:button>

                    <flux:button wire:click="openModalNote"
                        class="w-full border-0  justify-start text-sm text-gray-700 hover:bg-gray-100 hover:text-cyan-600 transition flex items-center gap-2 px-4 py-2">
                        <flux:icon.phone class="w-4 h-4" />
                        Chiamata
                    </flux:button>
                </div>
            </div>
        </div>

        @include('livewire.crm.utilities.activity-com-table', [
            'activity_communications' => $activity_communications,
        ])

        @include('livewire.crm.utilities.note-com-table', [
            'note_communications' => $note_communications,
            'activity_communications' => $activity_communications,
        ])

        @include('livewire.crm.utilities.email-com-table', [
            'email_communications' => $email_communications,
            'activity_communications' => $activity_communications,
        ])


        @include('livewire.crm.utilities.call-com-table', [
            'call_communications' => $note_communications,
            'activity_communications' => $activity_communications,
        ])
    </flux:tab.panel>

    @include('livewire.crm.referent.modal', [
        'showModalActivity' => $showModalActivity,
        'isOpenEmail' => $isOpenEmail,
        'isOpenActivity' => $isOpenActivity,
        'showModalInvoice' => $showModalInvoice,
        'showModalSale' => $showModalSale,
        'showModal' => $showModal,
        'isOpenReferent' => $isOpenReferent,
    ])
</flux:tab.group>
