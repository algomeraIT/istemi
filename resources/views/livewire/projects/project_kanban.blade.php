<div wire:init="$refresh" wire:listener="projects-updated">

    <div x-data="{ draggedItem: null }">
        <div class="flex overflow-x-auto">
            @php
                $phases = [
                    0 => 'Non Definito',
                    1 => 'Avvio',
                    2 => 'Pianificazione',
                    3 => 'Esecuzione',
                    4 => 'Verifica',
                    5 => 'Chiusura',
                ];
            @endphp

            @foreach ($phases as $phaseId => $phaseLabel)
                {{-- $nextTick() delays the execution of a function until after the DOM updates. --}}
                <div class="w-full lg:w-1/5 min-w-[400px] p-4  h-[500px] overflow-x-auto overflow-y-auto space-y-4"
                    @dragover.prevent
                    @drop.prevent="if(draggedItem) {   
                   $nextTick(() => { 
                       @this.call('updatePhase', draggedItem, '{{ $phaseId }}');
                       draggedItem = null;
                   }); 
                }">

                    <h2 class="text-lg font-bold border-b-2 text-left text-[#6C757D] text-[19px] mb-4">
                        {{ $phaseLabel }}

                        <!-- Sorting Button -->
                        <button wire:click="sortBy('n_file', '{{ $phaseId }}')" class="ml-2 text-sm text-blue-500">
                            <!-- Default icon when not sorted -->
                            @if ($activePhase !== $phaseId || $sortField !== 'n_file')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            @else
                                <!-- Show sorting arrows only for the active sorting phase -->
                                @if ($sortDirection === 'asc')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"></path>
                                    </svg> <!-- Ascending arrow -->
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                    </svg> <!-- Descending arrow -->
                                @endif
                            @endif
                        </button>
                    </h2>

                    <div class="grid sm:grid-cols-1 xl:grid-cols-1 gap-2">
                        @if (!isset($projects) || !is_array($projects))
                            <p class="text-red-500">Error: $projects is not defined or not an array.</p>
                        @endif

                        @if (isset($projects[$phaseId]) && is_array($projects[$phaseId]))
                            @foreach ($projects[$phaseId] ?? [] as $project)
                                @php
                                    $phaseMap = [
                                        1 => [
                                            'label' => 'Avvio',
                                            'bg' => 'bg-[#FFD500]',
                                        ],
                                        2 => [
                                            'label' => 'Pianificazione',
                                            'bg' => 'bg-[#FF6F61]',
                                        ],
                                        3 => [
                                            'label' => 'Esecuzione',
                                            'bg' => 'bg-[#FF6E0E]',
                                        ],
                                        4 => [
                                            'label' => 'Verifica',
                                            'bg' => 'bg-[#FF2F85]',
                                        ],
                                        5 => [
                                            'label' => 'Chiusura',
                                            'bg' => 'bg-[#019B00]',
                                        ],
                                    ];

                                    $phase = $phaseMap[$project['current_phase']] ?? [
                                        'label' => 'Non definito',
                                        'bg' => 'bg-gray-400',
                                    ];
                                @endphp

                                <div class="bg-white border border-gray-300 p-4 text-sm rounded shadow cursor-pointer hover:shadow-lg transition w-[380px] h-[231px] overflow-hidden flex flex-col justify-between"
                                    draggable="true" @dragstart.self="draggedItem = parseInt('{{ $project['id'] }}')">
                                    {{-- Project Info --}}
                                    <h3 class="text-lg font-bold text-[#232323]">{{ $project['n_file'] }}</h3>

                                    {{-- Client Info --}}
                                    <div class="flex justify-between text-[#B0B0B0] italic font-extralight mt-1 mb-3">
                                        <span>{{ $project['client_name'] }}</span>
                                    </div>

                                    {{-- Phase Badge --}}
                                    <div class="mb-3">
                                        <span
                                            class="px-2 py-1 text-xs text-white font-medium rounded {{ $phase['bg'] }}">
                                            {{ $phase['label'] }}
                                        </span>
                                    </div>

                                    {{-- Status + Actions --}}
                                    <div class="flex justify-between items-center mt-2">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded {{ $project['status'] ? 'bg-green-400' : 'bg-red-400' }}">
                                            {{ $project['status'] ? 'Attivo' : 'Archiviato' }}
                                        </span>

                                        <div class="flex gap-2 text-right">
                                            <button wire:click="edit({{ $project['id'] }})"
                                                class="text-gray-400 hover:text-gray-600 transition"><flux:icon.pencil-square /></button>
                                            {{--  <button wire:click="delete({{ $project['id'] }})"
                                                class="text-gray-400 hover:text-red-500 transition"><flux:icon.x-mark /></button> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>




{{-- <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    @foreach ($projects as $project)
    <div class="bg-white border-1 border-gray-400 rounded-lg shadow-md p-4">
        <h3 class="text-lg font-bold text-cyan-600">{{ $project->id }}</h3>

        <p class="mt-2">
            <span class="px-2 py-1 text-xs font-semibold ">
                {{ $project->client_name }}
            </span>
        </p>
        <p class="mt-2">
            <span class="px-2 py-1 text-xs font-semibold ">
                {{ $project->client_type}}
            </span>
        </p>
        <p class="mt-2">
            <span class="px-2 py-1 text-xs font-semibold ">
                {{ $project->current_phase}}
            </span>
        </p>
        <p class="mt-2">
            <span class="px-2 py-1 text-xs font-semibold ">
                {{ $project->responsible}}
            </span>
        </p>
        <p class="mt-2">
            <span
                class="px-2 py-1 text-xs font-semibold rounded {{ $project->status ? 'bg-green-400' : 'bg-red-400' }}">
                {{ $project->status ? 'Attivo' : 'Archiviato' }}
            </span>
        </p>
        <div class="mt-3 text-right">
            <button wire:click="edit({{ $project->id }})"
                class="px-3 py-1  text-gray-400 hover:cursor-pointer"><flux:icon.pencil-square /></button>
            <button wire:click="delete({{ $project->id }})"
                class="px-3 py-1  text-gray-400  hover:cursor-pointer"><flux:icon.x-mark /></button>
        </div>
    </div>
    @endforeach
</div> --}}
