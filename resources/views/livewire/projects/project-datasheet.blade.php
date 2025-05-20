<div class="p-4 bg-white border-none">
    <div class="flex">
        <flux:tab.group wire:model="datasheettabs" class="w-full flex">
            {{-- Left: Vertical Tabs --}}

            <flux:tabs class="flex flex-col  border-none">
                <flux:tab data-variant="detail" name="info">
                    Informazioni generali
                </flux:tab>
                <flux:tab data-variant="detail" name="desc">
                    Descrizione progetto
                </flux:tab>
                <flux:tab data-variant="detail" name="phases">
                    Fasi previste
                </flux:tab>
            </flux:tabs>

            <flux:tab.panel name="info">
                {{-- first line --}}
                <div class="flex">
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Pratica
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">
                            {{ $this->project['estimate'] }}
                        </p>

                    </div>
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Nome progetto
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {{ $this->project['name_project'] }}
                        </p>
                    </div>
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Cliente
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {{ $this->project['client_name'] }}
                        </p>
                    </div>
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Tipo progetto
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {{ $this->project['status'] }}
                        </p>
                    </div>
                </div>
                {{-- second line --}}
                <div class="flex mt-4">
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Budget allocato
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {{ $this->project['total_budget'] }}
                        </p>
                    </div>
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Responsabile di progetto
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {{ $this->project['chief_project'] }}
                        </p>
                    </div>
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Responsabile di area
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {{ $this->project['chief_area'] }}
                        </p>
                    </div>
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Data inizio
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {{ $this->project['start_at'] }}
                        </p>
                    </div>
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Data fine
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {{ $this->project['end_at'] }}
                        </p>
                    </div>
                </div>

                <flux:separator />

                {{-- third line --}}
                <div class="flex mt-4">
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Ribasso
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {{ $this->project['discounted'] }}
                        </p>
                    </div>
                </div>
                @php
                    $firms = json_decode($this->project['firms_and_percentage'], true);
                @endphp
                {{-- fourth line --}}
                <div class="flex mt-4">

                    @if (is_array($firms))
                        <div class="font-light p-2.5">
                            <p class="flex text-[13px] items-center">
                                <flux:icon.document class="w-3 h-3" />Componenti del raggruppamento
                            </p>

                            <div class="space-y-2">
                                @foreach ($firms as $firm => $percentage)
                                    <div class="flex justify-between items-center border-b pb-1">
                                        <span class="text-gray-700 font-medium">{{ $firm }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="font-light p-2.5">
                            <p class="flex text-[13px] items-center">
                                <flux:icon.document class="w-3 h-3" />Percentuali dei raggruppati
                            </p>
                            <div class="space-y-2">

                                @foreach ($firms as $firm => $percentage)
                                    <div class="flex justify-between items-center border-b pb-1">
                                        <span class="text-gray-700 font-medium">{{ $percentage }}%</span>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endif
                </div>

                {{-- last line --}}
                <div class="flex mt-4">
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.document class="w-3 h-3" />Note di accordi extra contrattuali
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {{ $this->project['note'] }}
                        </p>
                    </div>


                </div>


            </flux:tab.panel>
            <flux:tab.panel name="desc">
                <div class="flex mt-4">
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.star class="w-3 h-3" />Obiettivi
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {!! $this->project['goals'] !!}
                        </p>
                    </div>
                </div>
                <div class="flex mt-4">
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.square-3-stack-3d class="w-3 h-3" />Ambito del progetto
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {!! $this->project['project_scope'] !!}
                        </p>
                    </div>
                </div>
                <div class="flex mt-4">
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.trophy class="w-3 h-3" />Risultati attesi
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">

                            {!! $this->project['expected_results'] !!}
                        </p>
                    </div>
                </div>
                <div class="flex mt-4">
                    <div class="font-light p-2.5">
                        <p class="flex text-[13px] items-center">
                            <flux:icon.user-group class="w-3 h-3" />Stackholder coinvolti
                        </p>
                        <p class="text-[15px] text-[#A0A0A0] font-semibold">
                            @if ($this->stackholder && $this->stackholder->count())
                                @foreach ($this->stackholder as $stack)
                                    <div class="flex font-light text-[13px] space-x-5">
                                        <p class="text-[15px] text-[#A0A0A0]  font-semibold">{{ $stack['role'] }}</p>
                                        <p class="text-[15px] text-[#A0A0A0]  font-semibold">{{ $stack['name'] }}</p>
                                        <p class="text-[15px] text-[#A0A0A0]  font-semibold">{{ $stack['email'] }}</p>
                                    </div>
                                @endforeach
                            @endif
                        </p>
                    </div>
                </div>
            </flux:tab.panel>
            <flux:tab.panel name="phases">

                @php
                    $groupedPhases = collect($statusPhases)->groupBy(fn($item) => $item['area']['name']);
                @endphp

                @foreach ($groupedPhases as $areaName => $phases)
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-cyan-700 mb-2">{{ $areaName }}</h3>
                        <ul class="ml-4 list-disc text-gray-700">
                            @foreach ($phases as $phase)
                                <li class="list-none">{{ $phase->microArea->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </flux:tab.panel>

        </flux:tab.group>
    </div>
</div>
