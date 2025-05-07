<div>
    @section('content')
        <div class="container mx-auto pt-2">
            <div class=" bg-white p-6 ">
                <!-- Left Section: Referents -->
                <div class="mx-auto my-3">
                    @include('livewire.general.goback')
                </div>
                <div class="w-full flex  xl:flex-row flex-col-reverse ">

                    <div class="lg:flex lg:flex-nowrap xl:w-3/4">

                        <flux:tab.group class="bg-white  p-2 w-full">

                            <div class="md:flex xl:justify-between items-baseline">
                                <flux:tabs class="flex 2xl:flex-nowrap flex-wrap gap-2 align-middle border-none">
                                    <flux:tab data-variant="detail" name="task">Task</flux:tab>
                                    <flux:tab data-variant="detail" name="document">Documenti</flux:tab>
                                    <flux:tab data-variant="detail" name="note">Note</flux:tab>
                                    <flux:tab data-variant="detail" name="data-sheet">Scheda tecnica</flux:tab>
                                </flux:tabs>

                                <div class="sm:flex md:flex-wrap lg:flex-nowrap gap-4 p-1">
                                    <flux:select wire:model.live="query_project" data-variant="status">
                                        <flux:select.option value="">Tutti gli stati</flux:select.option>
                                        <flux:select.option value="Pubblico">Pubblico</flux:select.option>
                                        <flux:select.option value="Privato">Privato</flux:select.option>
                                    </flux:select>
                                    <flux:select wire:model.live="query_project" data-variant="status">
                                        <flux:select.option value="">Assegnati a tutti</flux:select.option>
                                        <flux:select.option value="Pubblico">Pubblico</flux:select.option>
                                        <flux:select.option value="Privato">Privato</flux:select.option>
                                    </flux:select>
                                    <flux:input wire:model.live="query" data-variant="search" :loading="false"
                                        icon="magnifying-glass" placeholder="Cerca..." />
                                </div>
                            </div>
                            <flux:tab.panel name="task">
                                <flux:tab.group class=" p-2 ">

                                    <flux:tabs variant="segmented" class="lg:ml-[40%]">
                                        <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
                                        <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
                                    </flux:tabs>

                                    <flux:tab.panel name="list">

                                        @if ($this->projectStart)
                                            <div x-data="{ open: false }" class="bg-white flex flex-col">

                                                <!-- Collapsible Header -->
                                                <div @click="open = !open"
                                                    class="cursor-pointer flex items-center justify-between px-6 py-4 border ">
                                                    <div>
                                                        <h2 class="text-[#4D1B86] text-[14px] font-medium">Avvio progetto
                                                        </h2>
                                                        <div class="flex space-x-2">

                                                            <p class="text-[#B0B0B0] text-[13px]">
                                                                {{ count($this->projectStart) }} task <div class="w-1 h-1 bg-gray-400 rounded-4xl self-center"></div></p>
                                                            <p class="text-[#FDC106] text-[13px]">
                                                                {{ $this->projectStart->where('status_contract_ver', false)->count() }}
                                                                in attesa</p>
                                                            <p class="text-[#28A745] text-[13px]">
                                                                {{ $this->projectStart->where('status_contract_ver', true)->count() }}
                                                                svolti </p>
                                                        </div>
                                                    </div>
                                                    <!-- Arrow Icon -->
                                                    <svg :class="open ? 'rotate-90' : 'rotate-0'"
                                                        class="transition-transform duration-300 w-6 h-6 text-purple-700"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </div>

                                                <!-- Collapsible Body -->
                                                <div x-show="open" x-transition
                                                    class="flex-1 px-6 py-4 mt-8 overflow-auto text-purple-700 text-lg bg-[#5A2C8E03] border">

                                                    <flux:table class="bg-white border rounded-md text-sm  border-l-3 border-l-[#4D1B83] border-l-solid">
                                                        <flux:table.columns class="">
                                                            <flux:table.column class="border px-4 py-2 text-center"
                                                                data-detail="detailColumn">Task
                                                            </flux:table.column>
                                                            <flux:table.column class="border px-4 py-2"
                                                                data-detail="detailColumn">Attività
                                                            </flux:table.column>
                                                            <flux:table.column class="border px-4 py-2"
                                                                data-detail="detailColumn">Assegnato a
                                                            </flux:table.column>
                                                            <flux:table.column class="border px-4 py-2"
                                                                data-detail="detailColumn">Stato
                                                            </flux:table.column>
                                                            <flux:table.column class="border px-4 py-2"
                                                                data-detail="detailColumn">Azioni
                                                            </flux:table.column>
                                                        </flux:table.columns>

                                                        @foreach ($this->projectStart as $start)
                                                            <flux:table.row class="border-b">
                                                                <flux:table.cell data-detail="detail"
                                                                    class="whitespace-nowrap border  ">
                                                                    {{ $start->name_phase }}
                                                                </flux:table.cell>

                                                                <flux:table.cell class="whitespace-nowrap border "
                                                                    data-detail="detail">
                                                                    <flux:button wire:click="addTask({{ $start->id }})"
                                                                        variant="ghost" data-variant="ghost"
                                                                        data-color="teal" data-rounded icon="plus"
                                                                        size="sm" />
                                                                </flux:table.cell>

                                                                <flux:table.cell data-detail="detail"
                                                                    class="whitespace-nowrap border ">
                                                                    <div
                                                                        class="flex items-center justify-center font-extralight">
                                                                        <div
                                                                            class="flex h-6 w-6 items-center mr-2 justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4] dark:bg-neutral-700 dark:text-white">
                                                                            <flux:icon.user variant="micro" />
                                                                        </div>
                                                                        {{ $start->user_contract_ver }}
                                                                    </div>
                                                                </flux:table.cell>

                                                                <flux:table.cell data-detail="detail"
                                                                    class="whitespace-nowrap border p-0">
                                                                    <div
                                                                        class="w-full h-full text-center px-4 py-2 font-extralight
                                                                        {{ $start->status_contract_ver ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                                                                        {{ $start->status_contract_ver ? 'Svolto' : 'In attesa' }}
                                                                    </div>
                                                                </flux:table.cell>

                                                                <flux:table.cell class="border " data-detail="detail">
                                                                    <flux:button
                                                                        wire:click="goToDetail({{ $start->id }})"
                                                                        variant="ghost" data-variant="ghost"
                                                                        data-color="teal" data-rounded icon="eye"
                                                                        size="sm" />
                                                                    <flux:button wire:click="edit({{ $start->id }})"
                                                                        variant="ghost" data-variant="ghost"
                                                                        data-color="gray" data-rounded icon="pencil"
                                                                        size="sm" />
                                                                    <flux:button wire:click="delete({{ $start->id }})"
                                                                        wire:confirm="Sei sicuro di voler eliminare questo task?"
                                                                        variant="ghost" data-variant="ghost"
                                                                        data-color="red" data-rounded icon="trash"
                                                                        size="sm" />
                                                                </flux:table.cell>
                                                            </flux:table.row>
                                                        @endforeach

                                                    </flux:table>
                                                </div>
                                            </div>
                                        @endif


                                    </flux:tab.panel>
                                    <flux:tab.panel name="kanban">
                                        kanban
                                    </flux:tab.panel>


                                </flux:tab.group>
                            </flux:tab.panel>
                        </flux:tab.group>



                    </div>
                    <div class="xl:w-1/4">
                        <div class="mx-auto  bg-white border-2 border-dotted border-[#A0A0A0] rounded-sm ">


                            <div class="mt-1 p-7 ">
                                <div class="flex items-center justify-between">
                                    <div class="flex justify-baseline items-center">
                                        <img src="/icon/menu/progetti.svg" alt="Progetto" class="w-5 h-5 mr-2">
                                        <h2 class="text-2xl font-bold text-left">{{ $project->estimate }}</h2>
                                    </div>
                                    <div class="">
                                        <flux:button variant="primary" data-variant="primary" data-color="small"
                                            icon="archive-box">
                                            Archivia</flux:button>
                                    </div>
                                </div>
                                @php
                                    $details = [
                                        'Nome progetto' => $project->name_project,
                                        'Cliente' => $project->client_name,
                                        'tipo di progetto' => $project->client_type,
                                        'Budget allocato' => $project->total_budget,
                                        'Responsabile di progetto' => $project->responsible,
                                        'Responsabile di area' => $project->chief_area,
                                        'Data inizio' => \Carbon\Carbon::parse($project->start_at)->format('d/m/Y'),
                                        'Data fine' => \Carbon\Carbon::parse($project->end_at)->format('d/m/Y'),
                                    ];
                                @endphp

                                @foreach ($details as $label => $value)
                                    <p class="flex flex-col mt-4 text-[15px] font-semibold text-[#A0A0A0]">
                                        <span
                                            class="@if ($label === 'Data fine') text-[#28A745] @else text-[#B0B0B0] @endif font-light pb-1">{{ $label }}:</span>
                                        <span>{!! $value !!}</span>
                                        @if ($label === 'Responsabile di progetto')
                                            <flux:separator />
                                        @endif
                                    </p>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>
