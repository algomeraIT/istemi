<div wire:init="$refresh" wire:listener="projects-updated">

    @if ($kanbanProjects)
        @if ($kanbanTab == 'current_phase')
            <div x-data="{ draggedItem: null }">
                <div class="flex overflow-x-auto">
                    @php
                        $phases = ['Non Definito', 'Avvio', 'Pianificazione', 'Esecuzione', 'Verifica', 'Chiusura'];
                    @endphp

                    @foreach ($phases as $phaseLabel)
                        {{-- $nextTick() delays the execution of a function until after the DOM updates. --}}
                        <div class="w-full lg:w-1/5 min-w-[400px] p-4  space-y-4" @dragover.prevent
                            @drop.prevent="if(draggedItem) {   
                        $nextTick(() => { 
                            @this.call('updatePhase', draggedItem, '{{ $phaseLabel }}');
                            draggedItem = null;
                        }); 
                                }">

                            <div class="flex justify-between border-b-2">
                                <p class="text-lg font-medium  text-left text-[#6C757D] text-[19px] mb-4">
                                    <!-- Sorting Button -->
                                    <button wire:click="sortBy('estimate', '{{ $phaseLabel }}')"
                                        class="ml-2 text-sm text-blue-500">
                                        <!-- Default icon when not sorted -->
                                        @if ($activePhase !== $phaseLabel || $sortField !== 'estimate')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                                </path>
                                            </svg>
                                        @else
                                            <!-- Show sorting arrows only for the active sorting phase -->
                                            @if ($sortDirection === 'asc')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 15l7-7 7 7">
                                                    </path>
                                                </svg> <!-- Ascending arrow -->
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 9l-7 7-7-7">
                                                    </path>
                                                </svg> <!-- Descending arrow -->
                                            @endif
                                        @endif
                                    </button>
                                    {{ $phaseLabel }}
                                    </h2>
                                    @if (isset($kanbanProjects[$phaseLabel]) && is_array($kanbanProjects[$phaseLabel]))
                                        <div>
                                            <p class="text-[12px]">
                                                {{ count($kanbanProjects[$phaseLabel]) }}
                                            </p>
                                        </div>
                                    @endif

                            </div>


                            <div
                                class="grid sm:grid-cols-1 xl:grid-cols-1 gap-2 h-[500px] overflow-x-auto overflow-y-auto ">
                                @if (!isset($kanbanProjects) || !is_array($kanbanProjects))
                                    <p class="text-red-500">Errore: progetti non trovati</p>
                                @endif

                                @if (isset($kanbanProjects[$phaseLabel]) && is_array($kanbanProjects[$phaseLabel]))
                                    @foreach ($kanbanProjects[$phaseLabel] ?? [] as $project)
                                        @php
                                            $phaseMap = [
                                                'Avvio' => [
                                                    'bg' => 'bg-[#FFD500]',
                                                ],
                                                'Pianificazione' => [
                                                    'bg' => 'bg-[#FF6F61]',
                                                ],
                                                'Esecuzione' => [
                                                    'bg' => 'bg-[#FF6E0E]',
                                                ],
                                                'Verifica' => [
                                                    'bg' => 'bg-[#FF2F85]',
                                                ],
                                                'Chiusura' => [
                                                    'bg' => 'bg-[#019B00]',
                                                ],
                                            ];

                                            $phase = $phaseMap[$project['current_phase']] ?? [
                                                'label' => 'Non definito',
                                                'bg' => 'bg-gray-400',
                                            ];
                                        @endphp
                                        <div class="relative bg-white z-10"
                                            wire:click="goToDetail({{ $project['id'] }})">

                                            <div class="bg-white border font-inter border-gray-300 p-4 text-sm rounded shadow cursor-pointer hover:shadow-lg transition w-[360px] h-[231px] overflow-hidden flex flex-col justify-between"
                                                draggable="true"
                                                @dragstart.self="draggedItem = parseInt('{{ $project['id'] }}')">
                                                {{-- Project Info --}}
                                                <h3 class="text-lg font-semibold text-[#232323]">
                                                    {{ $project['estimate'] }}
                                                </h3>



                                                {{-- Phase Badge --}}
                                                {{-- todo mettere il badge flux!!! --}}
                                                <div class="mb-3 ">
                                                    <span
                                                        class="px-2 py-1 text-xs text-white font-medium rounded {{ $phase['bg'] }}">
                                                        {{ $project['current_phase'] }}
                                                    </span>
                                                </div>

                                                <div class="mb-3 ">
                                                    <span class=" text-[17px] text-[#B0B0B0] font-extralight  ">
                                                        Titolo pratica - {{ $project['name_project'] }}
                                                    </span>
                                                </div>

                                                {{-- Status + Actions --}}
                                                <div class="flex justify-between items-center mt-2 pr-3">
                                                    {{--              <span
                                                class="px-2 py-1 text-xs font-semibold rounded {{ $project['status'] ? 'bg-green-400' : 'bg-red-400' }}">
                                                {{ $project['status'] ? 'Attivo' : 'Archiviato' }}
                                            </span> --}}

                                                    {{-- Client Info --}}
                                                    <div
                                                        class="flex justify-between text-[#B0B0B0] italic font-extralight mt-1 mb-3 ">
                                                        <span>{{ $project['client_name'] }}</span>
                                                    </div>

                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold border-0 {{ $project['client_type'] === 'Pubblico' ? 'bg-[#F6F3F9] text-[#4D1A87] border-[#4D1B86]' : 'bg-[#F2F5F9] text-[#08468B] border-[#08468B]' }}">
                                                        {{ $project['client_type'] }}
                                                    </span>
                                                </div>
                                                <div class="flex gap-2 text-left">
                                                    <flux:button wire:click="edit({{ $project['id'] }})"
                                                        variant="ghost" data-variant="ghost" data-color="gray"
                                                        data-rounded icon="pencil" size="sm" />

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
        @else
            {{-- responsible kanban view --}}
            <div x-data="{ draggedItem: null }">
                <div class="flex overflow-x-auto">

                    @foreach ($responsibles as $responsible)
                        {{-- $nextTick() delays the execution of a function until after the DOM updates. --}}
                        <div class="w-full lg:w-1/5 min-w-[400px] p-4  space-y-4" @dragover.prevent
                            @drop.prevent="if(draggedItem) {   
                        $nextTick(() => { 
                            @this.call('updatePhaseResponsible', draggedItem, '{{ $responsible }}');
                            draggedItem = null;
                        }); 
                                }">

                            <div class="flex justify-between border-b-2">
                                <p class="text-lg font-medium  text-left text-[#6C757D] text-[19px] mb-4">
                                    <!-- Sorting Button -->
                                    <button wire:click="sortBy('responsible', '{{ $responsible }}')"
                                        class="ml-2 text-sm text-blue-500">
                                        <!-- Default icon when not sorted -->
                                        @if ($activePhase !== $responsible || $sortField !== 'estimate')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                                </path>
                                            </svg>
                                        @else
                                            <!-- Show sorting arrows only for the active sorting phase -->
                                            @if ($sortDirection === 'asc')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 15l7-7 7 7">
                                                    </path>
                                                </svg> <!-- Ascending arrow -->
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 9l-7 7-7-7">
                                                    </path>
                                                </svg> <!-- Descending arrow -->
                                            @endif
                                        @endif
                                    </button>
                                    {{ $responsible }}
                                    </h2>
                                    @if (isset($kanbanProjects[$responsible]) && is_array($kanbanProjects[$responsible]))
                                        <div>
                                            <p class="text-[12px]">
                                                {{ count($kanbanProjects[$responsible]) }}
                                            </p>
                                        </div>
                                    @endif

                            </div>


                            <div
                                class="grid sm:grid-cols-1 xl:grid-cols-1 gap-2 h-[500px] overflow-x-auto overflow-y-auto ">
                                @if (!isset($kanbanProjects) || !is_array($kanbanProjects))
                                    <p class="text-red-500">Errore: progetti non trovati</p>
                                @endif

                                @if (isset($kanbanProjects[$responsible]) && is_array($kanbanProjects[$responsible]))
                                    @foreach ($kanbanProjects[$responsible] ?? [] as $project)
                                        @php
                                            $phaseMap = [
                                                'Avvio' => [
                                                    'bg' => 'bg-[#FFD500]',
                                                ],
                                                'Pianificazione' => [
                                                    'bg' => 'bg-[#FF6F61]',
                                                ],
                                                'Esecuzione' => [
                                                    'bg' => 'bg-[#FF6E0E]',
                                                ],
                                                'Verifica' => [
                                                    'bg' => 'bg-[#FF2F85]',
                                                ],
                                                'Chiusura' => [
                                                    'bg' => 'bg-[#019B00]',
                                                ],
                                            ];

                                            $phase = $phaseMap[$project['current_phase']] ?? [
                                                'label' => 'Non definito',
                                                'bg' => 'bg-gray-400',
                                            ];
                                        @endphp


                                        <div class="relative bg-white z-50"
                                            wire:click="goToDetail({{ $project['id'] }})">
                                            <div class="bg-white border font-inter border-gray-300 p-4 text-sm rounded shadow cursor-pointer hover:shadow-lg transition w-[360px] h-[231px] overflow-hidden flex flex-col justify-between"
                                                draggable="true" @dragstart.self="draggedItem = {{ $project['id'] }}">
                                                {{-- Project Info --}}
                                                <h3 class="text-lg font-semibold text-[#232323]">
                                                    {{ $project['estimate'] }}
                                                </h3>



                                                {{-- Phase Badge --}}
                                                {{-- todo mettere il badge flux!!! --}}
                                                <div class="mb-3 ">
                                                    <span
                                                        class="px-2 py-1 text-xs text-white font-medium rounded {{ $phase['bg'] }}">
                                                        {{ $project['current_phase'] }}
                                                    </span>
                                                </div>

                                                <div class="mb-3 ">
                                                    <span class=" text-[17px] text-[#B0B0B0] font-extralight  ">
                                                        Titolo pratica - {{ $project['name_project'] }}
                                                    </span>
                                                </div>

                                                {{-- Status + Actions --}}
                                                <div class="flex justify-between items-center mt-2 pr-3">
                                                    {{--              <span
                                                class="px-2 py-1 text-xs font-semibold rounded {{ $project['status'] ? 'bg-green-400' : 'bg-red-400' }}">
                                                {{ $project['status'] ? 'Attivo' : 'Archiviato' }}
                                          

                                                    {{-- Client Info --}}
                                                    <div
                                                        class="flex justify-between text-[#B0B0B0] italic font-extralight mt-1 mb-3 ">
                                                        <span>{{ $project['client_name'] }}</span>
                                                    </div>

                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold border-0 {{ $project['client_type'] === 'Pubblico' ? 'bg-[#F6F3F9] text-[#4D1A87] border-[#4D1B86]' : 'bg-[#F2F5F9] text-[#08468B] border-[#08468B]' }}">
                                                        {{ $project['client_type'] }}
                                                    </span>
                                                </div>
                                                <div class="flex gap-2 text-left">
                                          {{--           <flux:button wire:click="edit({{ $project['id'] }})"
                                                        variant="ghost" data-variant="ghost" data-color="gray"
                                                        data-rounded icon="pencil" size="sm" /> --}}

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
        @endif
    @endif
</div>
