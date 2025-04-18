

@extends('layout.main')

@section('content')
  <div class="px-6 lg:px-24 pt-12">
    <div class="bg-white rounded shadow p-6">
        @include('livewire.general.goback')

      <div class="flex flex-col lg:flex-row gap-6">

        <!-- RIGHT Column; mobile: show first, lg+: last -->
        <div class="order-first lg:order-last w-full lg:w-1/3 mt-6">
          <div class="bg-white rounded-lg border-2 border-dashed border-cyan-300 p-6 space-y-4">
            <h2 class="text-2xl font-bold flex items-center space-x-2">
              <flux:icon.briefcase class="w-6 h-6" />
              <span>{{ $client->company_name }}</span>
            </h2>

            @php
              $statusMap = [
                0 => ['label'=>'Call center','bg'=>'bg-[#FEF7EF]','text'=>'text-[#F5AD65]','border'=>'border-[#F5AD65]'],
                1 => ['label'=>'Censimento','bg'=>'bg-[#E3F1F4]','text'=>'text-[#2A8397]','border'=>'border-[#2A8397]'],
              ];
              $fields = [
                'E-mail'            => $client->email,
                'Telefono'          => $client->first_telephone,
                'Servizio'          => $client->service,
                'Data acquisizione' => \Carbon\Carbon::parse($client->created_at)->format('d/m/Y'),
                'Commerciale'       => $client->tax_code,
                'Stato'             => $client->status,
              ];
            @endphp

            <div class="space-y-3 text-gray-600 font-inter">
              @foreach ($fields as $label => $value)
                <div class="flex justify-between">
                  <span class="text-gray-400">{{ $label }}:</span>
                  @if ($label === 'Stato')
                    @php
                      $s = $statusMap[$value] ?? ['label'=>'Sconosciuto','bg'=>'bg-gray-100','text'=>'text-gray-600','border'=>'border-gray-600'];
                    @endphp
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full border {{ $s['bg'] }} {{ $s['text'] }} {{ $s['border'] }}">
                      {{ $s['label'] }}
                    </span>
                  @else
                    <span class="font-semibold">{{ $value }}</span>
                  @endif
                </div>
              @endforeach
            </div>

            <button wire:click="openNewEstimateModal"
                    class="bg-cyan-500 hover:bg-cyan-600 text-white py-2 px-4 rounded">
              Crea preventivo
            </button>
          </div>
        </div>

        <!-- LEFT Column; mobile: show last, lg+: first -->
        <div class="order-last lg:order-first w-full lg:w-2/3">

          <div class="bg-white" x-data="{ mainTab: 'history', commTab: 'sales' }">
            <div class="w-full lg:w-2/3 ">

                <div class="bg-white" x-data="{ mainTab: 'history', commTab: 'sales' }">
                    {{-- Tab Buttons --}}
                    <nav class="flex mb-4">
                        <button @click="mainTab='history'"
                            :class="mainTab === 'history' ? 'bg-[#FBFBFB] text-cyan-600' : 'text-gray-400'"
                            class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                            Storico
                        </button>
                        <button @click="mainTab='communication'"
                            :class="mainTab === 'communication' ? 'bg-[#FBFBFB] text-cyan-400' : 'text-gray-400'"
                            class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                            Comunicazione
                        </button>
                        <button @click="mainTab='estimate'"
                            :class="mainTab === 'estimate' ? 'bg-[#FBFBFB] text-cyan-600' : 'text-gray-400'"
                            class="py-2 px-4 text-[16px] leading-[20px] font-medium text-[#888888] text-left opacity-100 font-inter">
                            Preventivi
                        </button>
                    </nav>

                    {{-- History Tab --}}
                    <div x-show="mainTab === 'history'" x-cloak class="mt-4 space-y-4 p-2.5">

                        @include('livewire.crm.utilities.historycontact', [
                            'histories' => $histories,
                        ])
                    </div>

                    {{-- Communication Tab --}}
                    <div x-show="mainTab === 'communication'" x-cloak class="mt-4 space-y-4">



                        <div x-data="{ tab: 'attività' }" class="bg-white p-6">
                            {{-- Tabs --}}
                            <nav class="flex  border-b border-gray-200 mb-6">
                                <button @click="tab='attività'"
                                    :class="tab === 'attività' ? 'bg-gray-100' :
                                        'text-gray-600'"
                                    class="flex p-[4px] border-1 border-[#10BDD4] text-[16px] leading-[25px] font-bold text-[#10BDD4] text-left opacity-100 font-inter">
                                    <flux:icon.archive-box class="w-3 h-3 mr-2 mt-2" /> Attività
                                </button>

                                <button @click="tab='e-mail'"
                                    :class="tab === 'e-mail' ? 'bg-gray-100' :
                                        'text-gray-600'"
                                    class="flex p-[4px] border-1 border-[#10BDD4] text-[16px] leading-[25px] font-bold text-[#10BDD4] text-left opacity-100 font-inter">
                                    <flux:icon.at-symbol class="w-3 h-3 mr-2 mt-2" /> E‑mail
                                </button>

                                <button @click="tab='note'"
                                    :class="tab === 'note' ? 'bg-gray-100' :
                                        'text-gray-600'"
                                    class="flex p-[4px] border-1 border-[#10BDD4] text-[16px] leading-[25px] font-bold text-[#10BDD4] text-left opacity-100 font-inter">
                                    <flux:icon.document-text class="w-3 h-3 mr-2 mt-2" /> Note
                                </button>
                            </nav>

                            {{-- Content Panels --}}
                            <div class="relative pl-8">
                                {{-- vertical line --}}
                                <div class="absolute left-3 top-0 bottom-0 w-px bg-gray-200"></div>

                                <ul class="space-y-8">
                                    {{-- Attività --}}
                                    <template x-if="tab==='attività'">
                                        @foreach (collect($histories)->where('type', 'attività') as $item)
                                            <li class="relative flex items-start">
                                                <div
                                                    class="absolute left-0 bg-white border border-gray-200 rounded-full p-1">
                                                    <flux:icon.archive-box class="w-4 h-4 text-green-600" />
                                                </div>
                                                <div class="ml-6">
                                                    <p class="font-semibold text-gray-800">
                                                        {{ $item['name'] }} {{ $item['last_name'] }}
                                                        <span
                                                            class="ml-2 text-sm text-gray-500 capitalize">({{ $item['role'] }})</span>
                                                    </p>
                                                    <p class="mt-1 text-gray-600">{{ $item['note'] ?? '—' }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </template>

                                    {{-- E‑mail --}}
                                    <template x-if="tab==='e-mail'">
                                        @foreach (collect($histories)->where('type', 'e-mail') as $item)
                                            <li class="relative flex items-start">
                                                <div
                                                    class="absolute left-0 bg-white border border-gray-200 rounded-full p-1">
                                                    <flux:icon.at-symbol class="w-4 h-4 text-blue-600" />
                                                </div>
                                                <div class="ml-6">
                                                    <p class="font-semibold text-gray-800">
                                                        {{ $item['name'] }} {{ $item['last_name'] }}
                                                        <span
                                                            class="ml-2 text-sm text-gray-500 capitalize">({{ $item['role'] }})</span>
                                                    </p>
                                                    <p class="mt-1 text-gray-600">{{ $item['note'] ?? '—' }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </template>

                                    {{-- Note --}}
                                    <template x-if="tab==='note'">
                                        @foreach (collect($histories)->where('type', 'note') as $item)
                                            <li class="relative flex items-start">
                                                <div
                                                    class="absolute left-0 bg-white border border-gray-200 rounded-full p-1">
                                                    <flux:icon.document-text class="w-4 h-4 text-gray-600" />
                                                </div>
                                                <div class="ml-6">
                                                    <p class="font-semibold text-gray-800">
                                                        {{ $item['name'] }} {{ $item['last_name'] }}
                                                        <span
                                                            class="ml-2 text-sm text-gray-500 capitalize">({{ $item['role'] }})</span>
                                                    </p>
                                                    <p class="mt-1 text-gray-600">{{ $item['note'] ?? '—' }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- Estimates Tab --}}
                    <div x-show="mainTab === 'estimate'" x-cloak class="mt-4">
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

                        @include('livewire.crm.utilities.estimate-sub-table', [
                            'estimates' => $estimates,
                        ])
                    </div>

                </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection