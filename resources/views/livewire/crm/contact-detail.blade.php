@extends('layout.main')

@section('content')
    <div class="flex flex-col lg:flex-row px-6 lg:px-24 pt-12">
        <!-- Left: Referents -->
        <div class="w-full lg:w-2/3 p-6">
            <a href="{{ url()->previous() }}" class="block mb-6 text-lg font-light text-gray-400">
                &larr; Torna indietro
            </a>
            <div class="bg-white p-6 rounded shadow">
             
                <div>

                    <div x-data="{ activeTab: 'history' }">
                        <!-- Tab Buttons -->
                        <div class="flex space-x-4 ml-[10px]">
                            <button @click="activeTab = 'history'" :class="{ ' bg-[#FBFBFB] text-cyan-600': activeTab === 'history' }"
                                class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                                Storico
                            </button>
                
                            <button @click="activeTab = 'communication';"
                                :class="{ ' bg-[#FBFBFB] text-cyan-600': activeTab === 'communication' }"
                                class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                                Comunicazione
                            </button>
                
                            <button @click="activeTab = 'estimate';" :class="{ ' bg-[#FBFBFB] text-cyan-600': activeTab === 'estimate' }"
                                class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                                Preventivi
                            </button>
                        </div>
                
                        <div class="mt-4">
                            <!-- Referents Tab -->
                            <div x-show="activeTab === 'history'" x-cloak>
                                <div>
                                    <div class="flex place-content-between">
                                        <!-- Buttons -->
                                        <button wire:click="openModalReferent"
                                            class="bg-[#10BDD4] w-[88px] h-[32px] text-white text-sm hover:bg-cyan-700  ml-[22px] text-[16px] leading-[20px] font-medium  text-center opacity-100 font-inter">Aggiungi</button>
                
                                        <input type="text" wire:model.live="query_referent" placeholder="Cerca"
                                            class="border p-2 rounded " />
                
                
                                    </div>
                
                                    <!-- Referents Table -->
                                    TABLE
                
                                </div>
                            </div>
                
                            <!-- Sales Tab (Lazy Loaded) -->
                            <div x-show="activeTab === 'communication'" x-cloak>
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
                                                <input type="text" wire:model.live="query_sales" placeholder="Cerca"
                                                    class="border" />
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
                                        table sales
                
                                    </div>
                
                                    <div class="mt-2 " x-show="activeTabSales === 'acquisitions'" x-cloak>
                                        table acquisitions
                
                                    </div>
                
                                </div>
                            </div>
                            <div x-show="activeTab === 'estimate'" x-data="{ activeTabAccounting: 'orders' }" x-cloak>
                
                                <div class="flex  pt-[10px] pl-[40px] pb-[20px] h-[65px]">
                
                
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
                
                
                                <div class="mt-2">
                                    @include('livewire.crm.utilities.estimate-sub-table', [
                                        'estimates' => $estimates,
                                    ])
                
                                </div>
                            </div>
                        </div>
                
                    </div>
                </div>
                
                
                {{--     @include('livewire.crm.referent.modal', [
                        'showModalActivity' => $showModalActivity,
                        'isOpenEmail' => $isOpenEmail,
                        'isOpenActivity' => $isOpenActivity,
                        'showModalInvoice' => $showModalInvoice,
                        'showModalSale' => $showModalSale,
                        'showModal' => $showModal,
                        'isOpenReferent' => $isOpenReferent,
                    ]) --}}
            </div>
        </div>

        <!-- Right: Client Summary -->
        <div class="w-full lg:w-1/3 p-6">
            <div class="mx-auto bg-white border-2 border-dotted border-cyan-300 rounded p-6">

                <!-- Details -->
                <h2 class="mt-4 text-2xl font-bold flex mr-4">
                    <flux:icon.briefcase />{{ $client->company_name }}
                </h2>

                @php
                    $statusMap = [
                        0 => [
                            'label' => 'Call center',
                            'bg' => 'bg-[#FEF7EF]',
                            'text' => 'text-[#F5AD65]',
                            'border' => 'border-[#F5AD65]',
                        ],
                        1 => [
                            'label' => 'Censimento',
                            'bg' => 'bg-[#E3F1F4]',
                            'text' => 'text-[#2A8397]',
                            'border' => 'border-[#2A8397]',
                        ],
                    ];

                    $fields = [
                        'E-mail' => $client->email,
                        'Telefono' => $client->first_telephone,
                        'Servizio' => $client->service,
                        'Data acquisizione' => \Carbon\Carbon::parse($client->created_at)->format('d/m/Y'),
                        'Commerciale' => $client->tax_code,
                        'Stato' => $client->status,
                    ];
                @endphp

                <div class="mt-4 space-y-3 text-gray-600 font-inter">
                    @foreach ($fields as $label => $value)
                        <div class="flex justify-between">
                            <span class="text-gray-400">{{ $label }}:</span>

                            @if ($label === 'Stato')
                                @php
                                    $s = $statusMap[$value] ?? [
                                        'label' => 'Sconosciuto',
                                        'bg' => 'bg-gray-100',
                                        'text' => 'text-gray-600',
                                        'border' => 'border-gray-600',
                                    ];
                                @endphp
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold rounded-full border {{ $s['bg'] }} {{ $s['text'] }} {{ $s['border'] }}">
                                    {{ $s['label'] }}
                                </span>
                            @else
                                <span class="font-semibold">{{ $value }}</span>
                            @endif

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text)
                .then(() => alert(`Copiato: ${text}`))
                .catch(console.error);
        }
    </script>
@endsection
