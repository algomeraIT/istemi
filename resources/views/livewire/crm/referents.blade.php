<div>

    <div x-data="{ activeTab: 'referent' }">
        <!-- Tab Buttons -->
        <div class="flex space-x-4 ml-[10px]">
            <button @click="activeTab = 'referent'"
                :class="{ 'border-b-2 border-cyan-500 text-cyan-600': activeTab === 'referent' }"
                class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                Referenti
            </button>

            <button @click="activeTab = 'sale';"
                :class="{ 'border-b-2 border-cyan-500 text-cyan-600': activeTab === 'sale' }"
                class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                Vendite e acquisti
            </button>

            <button @click="activeTab = 'accounting';"
                :class="{ 'border-b-2 border-cyan-500 text-cyan-600': activeTab === 'accounting' }"
                class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                Contabilità
            </button>

            <button @click="activeTab = 'communication';"
                :class="{ 'border-b-2 border-cyan-500 text-cyan-600': activeTab === 'communication' }"
                class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                Comunicazioni
            </button>
        </div>

        <div class="mt-4">
            <!-- Referents Tab -->
            <div x-show="activeTab === 'referent'" x-cloak>
                <div>
                    <div class="flex place-content-between">
                        <!-- Buttons -->
                        <button wire:click="openModalReferent"
                            class="bg-[#10BDD4] w-[88px] h-[32px] text-white text-sm hover:bg-cyan-700  ml-[22px] text-[16px] leading-[20px] font-medium  text-center opacity-100 font-inter">Aggiungi</button>

                        <input type="text" wire:model.live="query_referent" placeholder="Cerca"
                            class="border p-2 rounded " />


                    </div>

                    <!-- Referents Table -->
                    <div class="bg-white p-6 ">
                        <table class="w-full border-b ">
                            <thead>
                                <tr class="h-[50px]">
                                    <th
                                        class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                        Nome e Cognome</th>
                                    <th
                                        class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                        Titolo</th>
                                    <th
                                        class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                        Posizione</th>
                                    <th
                                        class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                        E-mail</th>
                                    <th
                                        class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                        Telefono</th>
                                    <th
                                        class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-center opacity-100 font-inter">
                                        Azioni</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($referents as $referent)
                                <tr class="bg-gray-100  text-gray-800 h-[50px] border-b ">
                                    <td
                                        class=" text-[16px] leading-[20px] font-semibold text-[#232323] text-left opacity-100 font-inter">
                                        {{ $referent->name }}
                                        {{ $referent->last_name }}
                                    </td>
                                    <td
                                        class=" b text-[16px] leading-[20px] font-semibold text-[#232323] text-left opacity-100 font-inter">
                                        {{ $referent->title }}</td>
                                    <td
                                        class="  text-[16px] leading-[20px] font-semibold text-[#232323] text-left opacity-100 font-inter">
                                        {{ $referent->job_position }}</td>
                                    <td class=" ">{{ $referent->email }}</td>
                                    <td class="">{{ $referent->telephone }}</td>
                                    <td class="flex ">
                                        <button wire:click="show({{ $referent->id }})" title="Dettaglio"
                                            class="px-3 py-1  text-[#10BDD4] rounded  hover:cursor-pointer">
                                            <flux:icon.eye />
                                        </button>

                                        <button wire:click="edit({{ $referent->id }})"
                                            class="px-3 py-1 text-[#6C757D] hover:cursor-pointer">
                                            <flux:icon.pencil-square />
                                        </button>

                                        <button wire:click="delete({{ $referent->id }})"
                                            class="px-3 py-1 text-[#E63946] hover:cursor-pointer">
                                            <flux:icon.trash />
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sales Tab (Lazy Loaded) -->
            <div x-show="activeTab === 'sale'" x-cloak>
                <div x-data="{ activeTabSales: 'sales' }">
                    <div class="flex  place-content-between">
                        <div class="flex  place-content-between">
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
                                <select wire:model.live="acquisition_sales"
                                    class=" border-1 h-[40px] p-[10px] w-[130px]">
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


                        @if(empty($sales) || count($sales) === 0)
                        <p class="text-gray-500">Nessuna vendita per questo cliente</p>
                        @else
                        <table class="w-full border-collapse  p-2 mt-4 ml-[45px]">
                            <thead>
                                <tr class="text-gray-600">
                                    <th class=" text-left ">Data</th>
                                    <th class=" text-left">Fattura</th>
                                    <th class=" text-left ">Importo</th>
                                    <th class=" text-left ">Stato</th>
                                    <th class="text-left">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                <tr class="bg-gray-100  ">
                                    <td class="">{{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y') }}</td>
                                    <td class=" ">{{ $sale->invoice }}</td>
                                    <td class=" ">{{ $sale->price }}</td>
                                    <td class=" "> <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                                        @if($sale->status == 0)
                                            bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
                                        @else
                                            bg-[#E9F6EC] text-[#28A745] border-[#28A745]
                                        @endif">
                                            @if($sale->status == 0)
                                            In transito
                                            @else
                                            Consegnato
                                            @endif
                                        </span></td>
                                    <td>
                                        <button wire:click="showSale({{ $sale->id }})" title="Dettaglio"
                                            class="px-3 py-1  text-gray-600 rounded  hover:cursor-pointer">
                                            <flux:icon.eye />
                                        </button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>

                    <div class="mt-2 " x-show="activeTabSales === 'acquisitions'" x-cloak>

                        @if(empty($acquisitions) || count($acquisitions) === 0)
                        <p class="text-gray-500">Nessun acquisto per questo cliente</p>
                        @else
                        <table class="w-full border-collapse  p-2 mt-4 ml-[45px]">
                            <thead>
                                <tr class="text-gray-600">
                                    <th class=" text-left ">Data</th>
                                    <th class=" text-left">Fattura</th>
                                    <th class=" text-left ">Importo</th>
                                    <th class=" text-left ">Stato</th>
                                    <th class="text-left">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($acquisitions as $acquisition)
                                <tr class="bg-gray-100 ">
                                    <td class="">{{ \Carbon\Carbon::parse($acquisition->created_at)->format('d/m/Y') }}
                                    </td>
                                    <td class=" ">{{ $acquisition->invoice }}</td>
                                    <td class=" ">{{ $acquisition->price }}</td>
                                    <td class=" "> <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                                    @if($acquisition->status == 0)
                                        bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
                                    @else
                                        bg-[#E9F6EC] text-[#28A745] border-[#28A745]
                                    @endif">
                                            @if($acquisition->status == 0)
                                            In arrivo
                                            @else
                                            Ricevuta
                                            @endif
                                        </span></td>
                                    <td>
                                        <button wire:click="showSale({{ $acquisition->id }})" title="Dettaglio"
                                            class="px-3 py-1  text-gray-600 rounded  hover:cursor-pointer">
                                            <flux:icon.eye />
                                        </button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
            <div x-show="activeTab === 'accounting'" x-data="{ activeTabAccounting: 'orders' }" x-cloak>

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

                    @if(empty($accounting_orders) || count($accounting_orders) === 0)
                    <p class="text-gray-500">Nessun ordine per questo cliente</p>
                    @else
                    <table class="w-full border-collapse  p-2 mt-4 ml-[45px]">
                        <thead>
                            <tr class="text-gray-600">
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Numero d'ordine</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Data ordine</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Nazione</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Corriere</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Totale</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Stato</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accounting_orders as $accounting)
                            <tr class="bg-gray-100 border-b h-[50px]">
                                <td class="text-left">{{ $accounting->order_number }}</td>
                                <td class="text-left">{{ $accounting->date }}</td>
                                <td class="text-left">{{ $accounting->country }}</td>
                                <td class="text-left">{{ $accounting->shipper }}</td>
                                <td class="text-left">{{ $accounting->total_price }}</td>
                                <td class="text-left"> <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                                        @if($accounting->status == 0)
                                            bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
                                        @elseif($accounting->status == 1)
                                            bg-[#E9F6EC] text-[#28A745] border-[#28A745]
                                            @else
                                              bg-[#F0F1F2] text-[#6C757D] border-[#6C757D]
                                        @endif">
                                        @if($accounting->status == 0)
                                        In corso
                                        @elseif($accounting->status == 1)
                                        Evaso
                                        @else
                                        Annullato
                                        @endif
                                    </span></td>
                                <td>
                                    <button wire:click="showInvoice({{ $accounting->id }})" title="Dettaglio"
                                        class="px-3 py-1  text-[#10BDD4] rounded  hover:cursor-pointer">
                                        <flux:icon.eye />
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="mt-2" x-show="activeTabAccounting === 'invoices'" x-cloak>

                    @if(empty($accounting_invoices) || count($accounting_invoices) === 0)
                    <p class="text-gray-500">Nessuna fattura per questo cliente</p>
                    @else
                    <table class="w-full p-2 mt-4 ml-[45px]">
                        <thead>
                            <tr class="text-gray-600">
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Numero Fattura</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Data Fattura</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Data Scadenza</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Imponibile</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Totale</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Stato</th>
                                <th
                                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                                    Azioni</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accounting_invoices as $accounting_i)
                            <tr class="bg-gray-100 border-b h-[50px]">
                                <td class="text-left">{{ $accounting_i->number_invoice }}</td>
                                <td class="text-left">{{ $accounting_i->date_invoice }}</td>
                                <td class="text-left">{{ $accounting_i->expire_invoice }}</td>
                                <td class="text-left">{{ $accounting_i->taxable }}</td>
                                <td class="text-left">{{ $accounting_i->total }}</td>
                                <td class="text-left"><span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                                        @if($accounting_i->status == 0)
                                        bg-[#E9F6EC] text-[#28A745] border-[#28A745]
                                           
                                        @elseif($accounting_i->status == 1)
                                             bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
                                            @else
                                              bg-[#FDEBEC] text-[#E63946] border-[#E63946]
                                        @endif">
                                        @if($accounting_i->status == 0)
                                        Pagata
                                        @elseif($accounting_i->status == 1)
                                        Da pagare
                                        @else
                                        Scaduta
                                        @endif
                                    </span></td>
                                <td>
                                    <button wire:click="showInvoice({{ $accounting_i->id }})" title="Dettaglio"
                                        class=" text-gray-600 rounded  hover:cursor-pointer">
                                        <flux:icon.eye class="text-[#10BDD4]" />
                                    </button>
                                    <button wire:click="showInvoice({{ $accounting_i->id }})" title="Dettaglio"
                                        class="ml-[10px] text-gray-600 rounded  hover:cursor-pointer">
                                        <flux:icon.arrow-down-tray class="text-[#10BDD4]" />
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>


            <div x-show="activeTab === 'communication'" x-data="{ activeTabCommunication: 'activities' }" x-cloak>

                {{-- <div class="flex space-x-4 border-b">
                    <button @click="activeTabCommunication = 'activities'"
                        :class="{ 'border-b-2 border-cyan-500 text-cyan-600': activeTabCommunication === 'activities' }"
                        class="py-2 px-4 focus:outline-none">
                        Attività
                    </button>

                    <button @click="activeTabCommunication = 'email';"
                        :class="{ 'border-b-2 border-cyan-500 text-cyan-600': activeTabCommunication === 'email' }"
                        class="py-2 px-4 focus:outline-none">
                        Email
                    </button>

                    <button @click="activeTabCommunication = 'notes';"
                        :class="{ 'border-b-2 border-cyan-500 text-cyan-600': activeTabCommunication === 'notes' }"
                        class="py-2 px-4 focus:outline-none">
                        Note
                    </button>
                </div> --}}
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
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
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

                {{-- <div x-show="activeTabCommunication === 'activities'" x-cloak> --}}
                    {{-- <input type="text" wire:model.live="query_activities" placeholder="Cerca"
                        class="border p-2 rounded w-full mb-4" /> --}}
                    @if(empty($activity_communications) || count($activity_communications) === 0)
                    <p class="text-gray-500">Nessuna Attività per questo cliente</p>
                    @else

                    <div class=" h-3/6 overflow-scroll">
                    
                        <ul class="border pt-4 mb-5">
                            <flux:badge variant="pill" icon="calendar"
                            class="bg-[#F9EDF1]! text-[#E873A0]! rounded-0  pl-8 pr-8  rounded-none!">Attività</flux:badge>
                            @foreach($activity_communications as $activity)
                            <li class=" m-3.5 mb-6">
                                <div>
                                    <div class="flex">
                                        @if (isset(Auth::user()->profile_photo))
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="User"
                                            class="w-8 h-8 rounded-full">
                                        @else
                                        <img alt="utente" src="{{ asset('icon/navbar/user.svg') }}" />
                                        @endif

                                        <div class="flex flex-col items-start ml-[20px]">
                                            <span
                                                class="text-[18px] leading-[21px] font-normal text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                                                {{ $activity->name . ' ' . $activity->last_name . ' - ' .
                                                $activity->role}} </span>
                                            <span
                                                class="text-[17px] leading-[20px] font-light text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                                                {{ Auth::user()->role }}</span>
                                            <span
                                                class="font-extralight">{{$activity->created_at->diffForHumans()}}</span>
                                        </div>

                                    </div>
                                    <div class="flex ml-5">
                                        <div class="m-4 flex">
                                            <p class="font-extralight">Assegnato a:</p>
                                            <img class=" w-5 h-5"
                                                src="{{ $activity->user->image_path? asset($activity->user->image_path) : asset('icon/navbar/user.svg') }}"
                                                class="rounded-full h-10 w-10 object-cover" />
                                        </div>
                                        <div class="m-4 flex">
                                            <p class="font-extralight">Conoscenza:</p>
                                            <img class="w-5 h-5"
                                                title=" {{ $activity->name . ' ' . $activity->last_name}}"
                                                src="{{ $activity->user->image_path? asset($activity->user->image_path) : asset('icon/navbar/user.svg') }}"
                                                class="rounded-full h-10 w-10 object-cover" />
                                        </div>

                                        <div class="m-4 flex">
                                            <p class="font-extralight">Scadenza:</p>
                                            <p class="text-[#28A745]">
                                                {{\Carbon\Carbon::parse($activity->expire_at)->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="m-4 flex">
                                            <p> <span class="px-2 py-1  font-semibold rounded-[15px] border border-solid 
                                                @if($activity->to_do == "Fatta") 
                                                    bg-[#EFF9F3] text-[#65C587] border-[#65C587] 
                                                    @elseif($activity->to_do == "Da Terminare")
                                                    bg-[] text-[#65C587] border-[#E63946]
                                                    @elseif($activity->to_do == "In sospeso")
                                                    bg-cyan-100 text-[#0C7BFF] border-[#65C587]
                                                    @else
                                                    bg-gray-100 text-gray-600 border-gray-600
                                                    @endif">
                                                    @if($activity->to_do == "Fatta")
                                                    Fatta
                                                    @elseif($activity->to_do == "Da Terminare")
                                                    Da terminare
                                                    @elseif($activity->to_do == "In sospeso")
                                                    In sospeso
                                                    @else
                                                    ---
                                                    @endif
                                                </span></p>
                                        </div>
                                    </div>
                                    <div class="flex ml-8">
                                        <p class="font-extralight">Titolo:</p>
                                        <p>{{$activity->activities}}</p>

                                    </div>
                                    <div class="mt-4">
                                        <button wire:click="showActivity({{ $activity->id }})" title="Dettaglio"
                                            class=" text-gray-600 rounded  hover:cursor-pointer">
                                            <flux:icon.eye class="text-[#10BDD4]" />
                                        </button>
                                        <button wire:click="edit({{ $activity->id }})" title="Modifica"
                                            class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer">
                                            <flux:icon.pencil class="text-[#6C757D]" />
                                        </button>
                                        <button wire:click="delete({{ $activity->id }})" title="Cancella"
                                            class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer">
                                            <flux:icon.trash class="text-[#E63946]" />
                                        </button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        {{--
                    </div> --}}
                    @endif
                    {{--
                </div> --}}

                {{-- <div x-show="activeTabCommunication === 'notes'" x-cloak> --}}
                    {{-- <input type="text" wire:model.live="query_notes" placeholder="Cerca"
                        class="border p-2 rounded w-full mb-4" /> --}}
                    @if(empty($note_communications) || count($note_communications) === 0)
                    <p class="text-gray-500">Nessuna Nota per questo cliente</p>
                    @else
                    {{-- <div class=" h-96 overflow-scroll"> --}}
                     
                        <ul class="border pt-4 mb-5">
                            <flux:badge variant="pill" icon="pencil"
                                class="bg-[#F3F3F3]! text-[#B0B0B0]! rounded-0!  pl-8 pr-8  rounded-none!">Nota</flux:badge>
                            @foreach($note_communications as $note)
                            <li class=" m-3.5 mb-6">
                                <div>
                                    <div class="m-2">
                                        <div class="flex">
                                            @if (isset(Auth::user()->profile_photo))
                                            <img src="{{ Auth::user()->profile_photo_url }}" alt="User"
                                                class="w-8 h-8 rounded-full">
                                            @else
                                            <img alt="utente" src="{{ asset('icon/navbar/user.svg') }}" />
                                            @endif

                                            <div class="flex flex-col items-start ml-[20px]">
                                                <span
                                                    class="text-[18px] leading-[21px] font-normal text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                                                    {{ $activity->name . ' ' . $activity->last_name . ' - ' .
                                                    $activity->role}} </span>
                                                <span
                                                    class="text-[17px] leading-[20px] font-light text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                                                    {{ Auth::user()->role }}</span>
                                                <span class="font-extralight">{{
                                                    \Carbon\Carbon::parse($activity->created_at)->format('d/m/Y')
                                                    }}</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="m-4">
                                            <p>{{$note->note}}</p>
                                        </div>
                                        {{-- <div class="m-4">
                                            <p>Allegati:</p>
                                            @php
                                            $paths = json_decode($note->path, true);
                                            @endphp

                                            @if($paths && is_array($paths))
                                            <ul>
                                                @foreach($paths as $path)
                                                <li><a href="{{ $path }}" target="_blank">{{ basename($path) }}</a></li>
                                                @endforeach
                                            </ul>
                                            @else
                                            <p>Nessun allegato</p>
                                            @endif
                                        </div> --}}
                                    </div>
                                    <div class="mt-4">
                                        <button wire:click="showNote{{ $note->id }})" title="Dettaglio"
                                            class=" text-gray-600 rounded  hover:cursor-pointer">
                                            <flux:icon.eye class="text-[#10BDD4]" />
                                        </button>
                                        <button wire:click="edit({{ $note->id }})" title="Modifica"
                                            class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer">
                                            <flux:icon.pencil class="text-[#6C757D]" />
                                        </button>
                                        <button wire:click="delete({{ $note->id }})" title="Cancella"
                                            class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer">
                                            <flux:icon.trash class="text-[#E63946]" />
                                        </button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        {{--
                    </div> --}}
                    @endif
                    {{--
                </div> --}}


                {{-- <div x-show="activeTabCommunication === 'email'" x-cloak> --}}
                    {{-- <input type="text" wire:model.live="query_emails" placeholder="Cerca"
                        class="border p-2 rounded w-full mb-4" /> --}}
                    @if(empty($email_communications) || count($email_communications) === 0)
                    <p class="text-gray-500">Nessuna Email per questo cliente</p>
                    @else


                    {{-- <div class=" h-96 overflow-scroll"> --}}
             
                        <ul class="border pt-4 mb-5">
                            <flux:badge variant="pill" icon="paper-airplane"
                                class="bg-[#E2EDF7]! text-[#1078D4! rounded-0!  pl-8 pr-8  rounded-none!">E-mail</flux:badge>
                            @foreach($email_communications as $email)
                            <li class=" m-3.5 mb-6">
                                <div>
                                    <div class="m-2">
                                        <div class="flex">
                                            @if (isset(Auth::user()->profile_photo))
                                            <img src="{{ Auth::user()->profile_photo_url }}" alt="User"
                                                class="w-8 h-8 rounded-full">
                                            @else
                                            <img alt="utente" src="{{ asset('icon/navbar/user.svg') }}" />
                                            @endif

                                            <div class="flex flex-col items-start ml-[20px]">
                                                <span
                                                    class="text-[18px] leading-[21px] font-normal text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                                                    {{ $activity->name . ' ' . $activity->last_name . ' - ' .
                                                    $activity->role}} </span>
                                                <span
                                                    class="text-[17px] leading-[20px] font-light text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                                                    {{ Auth::user()->role }}</span>
                                                <span class="font-extralight">{{
                                                    \Carbon\Carbon::parse($activity->created_at)->format('d/m/Y')
                                                    }}</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="m-4">
                                            <p>Mittente:</p>
                                            <p>{{$email->sender}}</p>
                                        </div>
                                        <div class="m-4">
                                            <p>Destinatario:</p>
                                            @foreach(explode(',', $email->receiver) as $recipient)
                                            <p>{{ trim($recipient) }}</p>
                                            @endforeach
                                        </div>

{{-- 
                                        <div class="m-4">
                                            <p>Allegati:</p>
                                            @php
                                            $paths = json_decode($email->path, true);
                                            @endphp

                                            @if($paths && is_array($paths))
                                            <ul>
                                                @foreach($paths as $path)
                                                <li><a href="{{ $path }}" target="_blank">{{ basename($path) }}</a></li>
                                                @endforeach
                                            </ul>
                                            @else
                                            <p>Nessun allegato</p>
                                            @endif
                                        </div> --}}
                                    </div>
                                    <div class="m-4 flex">
                                        <p>Oggetto:</p>
                                        <p>Fare modifica su DB</p>
                                      
                                    </div>
                                    <div class="m-4">
                                        {{-- <a wire:click='showEmail({{$email->id}})'>mostra di più -></a> --}}
                                        <p>{{ $email->note }}</p>

                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{--
                </div> --}}

                @if(empty($note_communications) || count($note_communications) === 0)
                <p class="text-gray-500">Nessuna Nota per questo cliente</p>
                @else
                {{-- <div class=" h-96 overflow-scroll"> --}}
                  
                    <ul class="border pt-4 mb-5">
                        <flux:badge variant="pill" icon="phone"
                            class="bg-purple-100! text-purple-400! rounded-0!  pl-8 pr-8  rounded-none!">Chiamate</flux:badge>
                        @foreach($note_communications as $note)
                        <li class=" m-3.5 mb-6">
                            <div>
                                <div class="m-2">
                                    <div class="flex">
                                        @if (isset(Auth::user()->profile_photo))
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="User"
                                            class="w-8 h-8 rounded-full">
                                        @else
                                        <img alt="utente" src="{{ asset('icon/navbar/user.svg') }}" />
                                        @endif

                                        <div class="flex flex-col items-start ml-[20px]">
                                            <span
                                                class="text-[18px] leading-[21px] font-normal text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                                                {{ $activity->name . ' ' . $activity->last_name . ' - ' .
                                                $activity->role}} </span>
                                            <span
                                                class="text-[17px] leading-[20px] font-light text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                                                {{ Auth::user()->role }}</span>
                                            <span class="font-extralight">{{
                                                \Carbon\Carbon::parse($activity->created_at)->format('d/m/Y')
                                                }}</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="m-4">
                                        <p>{{$note->note}}</p>
                                    </div>
                                    {{-- <div class="m-4">
                                        <p>Allegati:</p>
                                        @php
                                        $paths = json_decode($note->path, true);
                                        @endphp

                                        @if($paths && is_array($paths))
                                        <ul>
                                            @foreach($paths as $path)
                                            <li><a href="{{ $path }}" target="_blank">{{ basename($path) }}</a></li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <p>Nessun allegato</p>
                                        @endif
                                    </div> --}}
                                </div>
                                <div class="mt-4">
                                    <button wire:click="showNote{{ $note->id }})" title="Dettaglio"
                                        class=" text-gray-600 rounded  hover:cursor-pointer">
                                        <flux:icon.eye class="text-[#10BDD4]" />
                                    </button>
                                    <button wire:click="edit({{ $note->id }})" title="Modifica"
                                        class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer">
                                        <flux:icon.pencil class="text-[#6C757D]" />
                                    </button>
                                    <button wire:click="delete({{ $note->id }})" title="Cancella"
                                        class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer">
                                        <flux:icon.trash class="text-[#E63946]" />
                                    </button>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    {{--
                </div> --}}
                @endif
                {{--
            </div> --}}
            </div>
        </div>
    </div>







    <!-- Modal -->
    @if($isOpenReferent)
    <div class="fixed inset-0 flex justify-end z-50">
        <div class="bg-white p-6 rounded shadow-lg w-1/2">
            <h2 class="text-lg font-bold">{{ $editing ? 'Modifica Referente' : 'Nuovo Referente' }}</h2>

            <input type="text" wire:model="name" placeholder="Nome" class="border p-2 w-full my-2">
            <input type="text" wire:model="last_name" placeholder="Cognome" class="border p-2 w-full my-2">
            <input type="email" wire:model="email" placeholder="Email" class="border p-2 w-full my-2">
            <input type="text" wire:model="title" placeholder="Titolo" class="border p-2 w-full my-2">
            <input type="text" wire:model="job_position" placeholder="Posizione" class="border p-2 w-full my-2">
            <input type="text" wire:model="telephone" placeholder="Telefono" class="border p-2 w-full my-2">
            <input type="text" wire:model="role" placeholder="Ruolo" class="border p-2 w-full my-2">
            <input type="text" wire:model="note" placeholder="Nota" class="border p-2 w-full my-2">

            <button wire:click="save" class="bg-cyan-500 text-white p-2">Salva</button>
            <button wire:click="closeModal" class="bg-gray-500 text-white p-2">Annulla</button>
        </div>
    </div>
    @endif

    @if($showModal)
    <div class="fixed inset-0 flex justify-end z-50">
        <div class="fixed inset-0 bg-opacity-50"></div>

        <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
            style="right: 0;">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dettaglio Referente</h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <div class="p-6">
                @if($selectedReferent)
                <p><strong>Nome:</strong> {{ $selectedReferent->name }} {{ $selectedReferent->last_name }}</p>
                <p><strong>Titolo:</strong> {{ $selectedReferent->title }}</p>
                <p><strong>Posizione:</strong> {{ $selectedReferent->job_position }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $selectedReferent->email }}"
                        class="text-cyan-500 underline hover:text-cyan-700">{{ $selectedReferent->email }}</a></p>
                <p><strong>Telefono:</strong> {{ $selectedReferent->telephone }}</p>
                <p><strong>Nota:</strong> {{ $selectedReferent->note }}</p>
                @endif
            </div>
        </div>
    </div>
    @endif

    @if($showModalSale)
    <div class="fixed inset-0 flex justify-end z-50">
        <div class="fixed inset-0 bg-opacity-50"></div>

        <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
            style="right: 0;">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dettaglio Vendita</h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <div class="p-6">
                @if($selectedSale)
                <p><strong>Fattura:</strong> {{ $selectedSale->invoice }}</p>
                <p><strong>Importo:</strong> {{ $selectedSale->price }}</p>
                <p><strong>Stato:</strong> {{ $selectedSale->status }}</p>
                <p><strong>Data:</strong> {{ $selectedSale->date }}</p>

                @endif
            </div>
        </div>
    </div>
    @endif

    @if($showModalInvoice)
    <div class="fixed inset-0 flex justify-end z-50">
        <div class="fixed inset-0 bg-opacity-50"></div>

        <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
            style="right: 0;">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dettaglio Vendita</h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <div class="p-6">
                @if($selectedInvoice)
                <p><strong>Numero Fattura:</strong> {{ $selectedInvoice->number_invoice }}</p>
                <p><strong>Data:</strong> {{ $selectedInvoice->date_invoice }}</p>
                <p><strong>Scadenza:</strong> {{ $selectedInvoice->expire_invoice }}</p>
                <p><strong>Imponibile:</strong> {{ $selectedInvoice->taxable }}</p>
                <p><strong>Totale:</strong> {{ $selectedInvoice->total }}</p>
                <p><strong>Stato:</strong> {{ $selectedInvoice->status }}</p>
                @endif
            </div>
        </div>
    </div>
    @endif

    @if($isOpenActivity)
    <div class="fixed inset-0 flex justify-end z-50">
        <div class="bg-white p-6 rounded shadow-lg w-1/2">
            <h2 class="text-lg font-bold">{{ $editing ? 'Modifica Attività' : 'Nuova Attività' }}</h2>
            @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-2">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <input type="text" wire:model="activities" placeholder="Nome Attività" class="border p-2 w-full my-2">
            <input type="text" wire:model="label" placeholder="Etichetta" class="border p-2 w-full my-2">
            <select wire:model="to_do" class="border p-2 w-full my-2">
                <option value="">Seleziona un'opzione</option>
                <option value="to_do">Da Fare</option>
                <option value="done">Fatto</option>
            </select>
            <input type="text" wire:model="name" placeholder="Nome Utente" class="border p-2 w-full my-2">
            <input type="text" wire:model="last_name" placeholder="Cognome Utente" class="border p-2 w-full my-2">
            {{-- <input type="text" wire:model="role" placeholder="Ruolo" class="border p-2 w-full my-2"> --}}

            <input type="text" wire:model="assignee" placeholder="Assegnatario" class="border p-2 w-full my-2">
            <input type="date" wire:model="expire_at" placeholder="Scadenza" class="border p-2 w-full my-2">

            <button wire:click="saveActivity" class="bg-cyan-500 text-white p-2">Salva</button>
            <button wire:click="closeModal" class="bg-gray-500 text-white p-2">Annulla</button>
        </div>
    </div>
    @endif

    @if($isOpenEmail)
    <div>

        <div class="fixed inset-0 flex justify-end z-50">
            <div class="bg-white p-6 rounded shadow-lg w-1/2">
                <h2 class="text-lg font-semibold mb-4">Nuova Email</h2>

                @if (session()->has('message'))
                <div class="text-green-600 mb-2">{{ session('message') }}</div>
                @endif

                <form wire:submit.prevent="saveEmail" enctype="multipart/form-data">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block">Client ID</label>
                            <input type="number" wire:model="client_id" class="border p-2 w-full">
                            @error('client_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- <div>
                            <label class="block">Attività</label>
                            <input type="text" wire:model="task" class="border p-2 w-full">
                            @error('task') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div> --}}

                        <div>
                            <label class="block">Mittente</label>
                            <p wire:model='sender'>{{ Auth::user()->email }}</p>
                            @error('sender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <div x-data="{
                            query: '',
                            selectedEmails: @entangle('receiver').defer || [],
                            emails: @js($email_all_users) || [], 

                            filteredEmails() {
                                return this.emails.filter(email => email.toLowerCase().includes(this.query.toLowerCase()));
                            },

                            toggleEmail(email) {
                                if (!this.selectedEmails) this.selectedEmails = []; 
                                
                                if (this.selectedEmails.includes(email)) {
                                    this.selectedEmails = this.selectedEmails.filter(e => e !== email);
                                } else {
                                    this.selectedEmails.push(email);
                                }

                                // Manually update Livewire
                                $wire.set('receiver', this.selectedEmails);
                            }
                        }" class="space-y-2">

                                <label for="receiver" class="block text-sm font-medium text-gray-700">Seleziona
                                    Utente</label>

                                <!-- Dropdown search input -->
                                <div class="relative">
                                    <input type="text" x-model="query" placeholder="Ricerca utente..."
                                        class="w-full p-2 border rounded-md" autocomplete="off">

                                    <!-- List of filtered emails -->
                                    <div x-show="query.length > 0" x-transition
                                        class="absolute left-0 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg z-10">
                                        <ul>
                                            <template x-for="(email, index) in filteredEmails()" :key="index">
                                                <li @click="toggleEmail(email)"
                                                    class="cursor-pointer p-2 hover:bg-gray-100">
                                                    <span x-text="email"></span>
                                                    <span x-show="selectedEmails.includes(email)"
                                                        class="ml-2 text-green-500">✔</span>
                                                </li>
                                            </template>
                                            <li x-show="filteredEmails().length === 0" class="p-2 text-gray-500">No
                                                results</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Display selected emails -->
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <template x-for="(email, index) in selectedEmails" :key="index">
                                        <span class="bg-gray-200 text-gray-700 rounded-full px-3 py-1">
                                            <span x-text="email"></span>
                                            <button
                                                @click="selectedEmails = selectedEmails.filter(e => e !== email); $wire.set('receiver', selectedEmails)"
                                                class="ml-1 text-red-500">×</button>
                                        </span>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block">Oggetto</label>
                            <input type="text" wire:model="action" class="border p-2 w-full">
                            @error('action') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block">Email</label>
                            <textarea wire:model="note" class="border p-2 w-full"></textarea>
                            @error('note') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- upload --}}
                        <div class="flex">
                            <div class="flex flex-col items-center justify-center w-full">
                                @if ($logoPreview)
                                <div class="relative">
                                    <img src="{{ $logoPreview }}" class="w-32 h-32 object-cover rounded-lg shadow-md">
                                    <button type="button" wire:click="removeLogo"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                                        &times;
                                    </button>
                                </div>
                                @else
                                <label for="logo"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Clicca per
                                                caricare il file</span>
                                            oppure trascina</p>
                                        <p class="text-xs text-gray-500">Max: 20MB</p>
                                    </div>
                                    <input id="logo" type="file" wire:model="logo" class="hidden" />
                                </label>
                                @endif

                                @error('logo')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="button" wire:click="closeModal"
                                class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Annulla</button>

                            <button type="button" wire:click="saveEmail" wire:loading.attr="disabled"
                                class="bg-cyan-500 text-white px-4 py-2 rounded flex items-center">
                                <!-- Show spinner when sending -->
                                <svg wire:loading wire:target="saveEmail" class="animate-spin h-5 w-5 mr-2 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 1116 0A8 8 0 014 12z">
                                    </path>
                                </svg>

                                <!-- Change button text when sending -->
                                <span wire:loading.remove wire:target="saveEmail">Salva e Invia</span>
                                <span wire:loading wire:target="saveEmail">Invio...</span>
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @if($showModalActivity)
    <div class="fixed inset-0 flex justify-end z-50">
        <div class="fixed inset-0 bg-opacity-50"></div>

        <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
            style="right: 0;">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dettaglio Attività</h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <div class="p-6">
                @if($selectedActivity)
                <p><strong>Nome e Cognome: </strong> {{ $selectedActivity->name . ' ' . $selectedActivity->name }}</p>
                <p><strong>Ruolo:</strong> {{ $selectedActivity->role }}</p>
                <p><strong>Etichetta:</strong> {{ $selectedActivity->label }}</p>
                <p><strong>Da Fare:</strong> {{ $selectedActivity->to_do }}</p>
                <p><strong>Attività:</strong> {{ $selectedActivity->activities }}</p>
                <p><strong>Assegnatario:</strong> {{ $selectedActivity->assignee }}</p>
                <p><strong>Scadenza:</strong> {{ $selectedActivity->expired_at }}</p>
                @endif
            </div>
        </div>
    </div>
    @endif


    @if($showModalEmail)
    <div class="fixed inset-0 flex justify-end z-50">
        <div class="fixed inset-0 bg-opacity-50"></div>

        <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
            style="right: 0;">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dettaglio Email</h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <div class="p-6">
                @if($selectedEmail)
                <p><strong>Task:</strong> {{ $selectedEmail->task }}</p>
                <p><strong>Assegnato a:</strong> {{ $selectedEmail->assigned_to }}</p>
                <p><strong>Mittente:</strong> {{ $selectedEmail->sender }}</p>
                <p><strong>Destinatario/i:</strong> {{ $selectedEmail->receiver }}</p>
                @php
                $paths = json_decode($selectedEmail->path, true);
                @endphp
                <p><strong>Allegati:</strong> @if($paths && is_array($paths))
                <ul>
                    @foreach($paths as $path)
                    <li><a href="{{ $path }}" target="_blank">{{ basename($path) }}</a></li>
                    @endforeach
                </ul>
                @else
                <p>Nessun allegato</p>
                @endif</p>
                <p><strong>Messaggio Email:</strong> {{ $selectedEmail->note }}</p>
                <p><strong>Nome Utente:</strong> {{ $selectedEmail->name_user }}</p>
                <p><strong>Cognome Utente:</strong> {{ $selectedEmail->last_name_user }}</p>
                <p><strong>Posizione Utente:</strong> {{ $selectedEmail->job_position_user }}</p>
                <p><strong>Stato:</strong> {{ $selectedEmail->status_user }}</p>
                <p><strong>Attività:</strong> {{ $selectedEmail->action }}</p>

                @endif
            </div>
        </div>
    </div>
    @endif

    @if($showModalNote)
    <div class="fixed inset-0 flex justify-end z-50">
        <div class="fixed inset-0 bg-opacity-50"></div>

        <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
            style="right: 0;">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dettaglio Nota</h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <div class="p-6">
                @if($selectedNote)
                <p><strong>Nome e Cognome:</strong> {{ $selectedNote->name_user . ' ' . $selectedNote->last_name_user }}
                </p>
                <p><strong>Ruolo:</strong> {{ $selectedNote->role_user }}</p>
                <p><strong>Mittente:</strong> {{ $selectedNote->sender }}</p>
                <p><strong>Destinatario/i:</strong> {{ $selectedNote->receiver }}</p>
                @php
                $paths = json_decode($selectedNote->path, true);
                @endphp
                <p><strong>Allegati:</strong> @if($paths && is_array($paths))
                <ul>
                    @foreach($paths as $path)
                    <li><a href="{{ $path }}" target="_blank">{{ basename($path) }}</a></li>
                    @endforeach
                </ul>
                @else
                <p>Nessun allegato</p>
                @endif</p>
                <p><strong>Nota:</strong> {{ $selectedNote->note }}</p>


                @endif
            </div>
        </div>
    </div>
    @endif

    @if($isOpenNote)
    <div>

        <div class="fixed inset-0 flex justify-end z-50">
            <div class="bg-white p-6 rounded shadow-lg w-1/2">
                <h2 class="text-lg font-semibold mb-4">Nuova Nota</h2>

                @if (session()->has('message'))
                <div class="text-green-600 mb-2">{{ session('message') }}</div>
                @endif

                <form wire:submit.prevent="saveNote" enctype="multipart/form-data">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block">Client ID</label>
                            <input type="number" wire:model="client_id" class="border p-2 w-full">
                            @error('client_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block">Nota</label>
                            <input type="text" wire:model="note" class="border p-2 w-full">
                            @error('note') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- upload --}}
                        <div class="flex">
                            <div class="flex flex-col items-center justify-center w-full">
                                @if ($logoPreview)
                                <div class="relative">
                                    <img src="{{ $logoPreview }}" class="w-32 h-32 object-cover rounded-lg shadow-md">
                                    <button type="button" wire:click="removeLogo"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                                        &times;
                                    </button>
                                </div>
                                @else
                                <label for="logo"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Clicca per
                                                caricare il file</span>
                                            oppure trascina</p>
                                        <p class="text-xs text-gray-500">Max: 6MB</p>
                                    </div>
                                    <input id="logo" type="file" wire:model="logo" class="hidden" />
                                </label>
                                @endif

                                @error('logo')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="bg-cyan-500 text-white p-2">Salva</button>
                            <button wire:click="closeModal" class="bg-gray-500 text-white p-2">Annulla</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    @endif

</div>