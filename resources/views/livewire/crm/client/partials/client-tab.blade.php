<flux:tab.group>
    <flux:tabs variant="segmented">
        <flux:tab data-variant="detail" name="referenti">Referenti</flux:tab>
        {{-- TODO da sviluppare le altre tab --}}
        {{-- <flux:tab data-variant="detail" name="commercio">Vendite e acquisti</flux:tab> --}}
        {{-- <flux:tab data-variant="detail" name="contabilita">Contabilità</flux:tab> --}}
        {{-- <flux:tab data-variant="detail" name="comunicazioni">Comunicazioni</flux:tab> --}}
    </flux:tabs>

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
        @include('livewire.crm.client.components.client.referent-table', ['referents' => $referents])

        {{-- Modals --}}
        @include('livewire.crm.client.components.client.flyout-create-edit')
        @include('livewire.crm.client.components.client.flyout-show')
    </flux:tab.panel>

    {{-- <flux:tab.panel name="commercio">
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
                    <flux:input wire:model.live="search" data-variant="search" :loading="false" clearable
                        icon="magnifying-glass" placeholder="Cerca" />
                </flux:field>
            </div>

            <flux:tab.panel name="sales" class="!pt-0">
                @include('livewire.crm.utilities.sale-table', ['sales' => $sales])
            </flux:tab.panel>

            <flux:tab.panel name="acquisitions" class="!pt-0">
                @include('livewire.crm.utilities.acquisition-table', ['acquisitions' => $acquisitions])
            </flux:tab.panel>
        </flux:tab.group>
    </flux:tab.panel> --}}

    {{-- <flux:tab.panel name="contabilita">
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
    </flux:tab.panel> --}}

    {{-- <flux:tab.panel name="communications">
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
                    <flux:modal.trigger name="new-note">
                        <flux:menu.item icon="pencil"
                            class="!text-[#B0B0B0] hover:!text-[#B0B0B0] hover:!bg-[#F3F3F3]">Nota
                        </flux:menu.item>
                    </flux:modal.trigger>
                    <flux:modal.trigger name="new-call">
                        <flux:menu.item icon="phone"
                            class="!text-[#B0B0B0] hover:!text-[#A259F4] hover:!bg-[#F2EAFA]">Chiamata
                        </flux:menu.item>
                    </flux:modal.trigger>
                </flux:menu>
            </flux:dropdown>

            @include('livewire.crm.client.components.contact.flyout-create-edit-activity')
            @include('livewire.crm.client.components.contact.flyout-create-edit-mail')
            @include('livewire.crm.client.components.contact.flyout-create-edit-note')
            @include('livewire.crm.client.components.contact.flyout-create-edit-call')

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
    </flux:tab.panel> --}}

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
