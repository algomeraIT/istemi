<div>

    <div x-data="{ activeTab: 'referent' }">
        <!-- Tab Buttons -->
        <div class="flex space-x-4 ml-[10px]">
            <button @click="activeTab = 'referent'" :class="{ ' bg-[#FBFBFB] text-cyan-600': activeTab === 'referent' }"
                class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                Referenti
            </button>

            <button @click="activeTab = 'sale';" :class="{ ' bg-[#FBFBFB] text-cyan-600': activeTab === 'sale' }"
                class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                Vendite e acquisti
            </button>

            <button @click="activeTab = 'accounting';"
                :class="{ ' bg-[#FBFBFB] text-cyan-600': activeTab === 'accounting' }"
                class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                Contabilità
            </button>

            <button @click="activeTab = 'communication';"
                :class="{ ' bg-[#FBFBFB] text-cyan-600': activeTab === 'communication' }"
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
                                        @include('livewire.crm.utilities.detail-button', ['functionName' => 'referent', 'id' => $contact->id])


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
                                        @include('livewire.crm.utilities.detail-button', ['functionName' => 'showSale', 'id' => $sale->id])

                            
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
                                        @include('livewire.crm.utilities.detail-button', ['functionName' => 'showSale', 'id' => $acquisition->id])

                                      
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
                                    @include('livewire.crm.utilities.detail-button', ['functionName' => 'showInvoice', 'id' => $accounting->id])

                               
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
                                    @include('livewire.crm.utilities.detail-button', ['functionName' => 'showInvoice', 'id' => $accounting_i->id])

                               
                           
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
                                class="bg-[#F9EDF1]! text-[#E873A0]! rounded-0  pl-8 pr-8  rounded-none!">Attività
                            </flux:badge>
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
                                                @if($activity->to_do == "Fatta") bg-[#EFF9F3] text-[#65C587]
                                                    border-[#65C587] @elseif($activity->to_do == "Da Terminare")
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
                                        @include('livewire.crm.utilities.detail-button', ['functionName' => 'showActivity', 'id' => $activity->id])

                                   
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
                                class="bg-[#F3F3F3]! text-[#B0B0B0]! rounded-0!  pl-8 pr-8  rounded-none!">Nota
                            </flux:badge>
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
                                        @include('livewire.crm.utilities.detail-button', ['functionName' => 'showNote', 'id' => $note->id])

                                   
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
                                class="bg-[#E2EDF7]! text-[#1078D4! rounded-0!  pl-8 pr-8  rounded-none!">E-mail
                            </flux:badge>
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
                            class="bg-purple-100! text-purple-400! rounded-0!  pl-8 pr-8  rounded-none!">Chiamate
                        </flux:badge>
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
                                    @include('livewire.crm.utilities.detail-button', ['functionName' => 'showNote', 'id' => $note->id])

                            
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


@include('livewire.crm.referent.modal', [
'showModalActivity' => $showModalActivity,
'isOpenEmail' => $isOpenEmail,
'isOpenActivity' => $isOpenActivity,
'showModalInvoice' => $showModalInvoice,
'showModalSale' => $showModalSale,
'showModal' => $showModal,
'isOpenReferent' => $isOpenReferent,
])