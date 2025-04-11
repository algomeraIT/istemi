<div wire:init="$refresh" wire:listener="projects-updated">
    <div x-data="{ searchQuery: @entangle('search').live }">
        <div class="mb-4">
            <input type="text" x-model.live="searchQuery" placeholder="Cerca Pratica"
                class="px-4 py-2 border rounded" />
        </div>
    </div>
    <div x-data="{ draggedItem: null }">
        <div class="flex space-x-4 p-4">
            @php
                $phases = ["Non Definito", "Avvio", "Pianificazione", "Esecuzione", "Verifica", "Chiusura"];
            @endphp

            @foreach($phases as $phase)
                {{-- $nextTick() delays the execution of a function until after the DOM updates. --}}
                <div class="w-1/5 bg-gray-100 p-4 rounded shadow-md h-[500px] overflow-y-auto" @dragover.prevent
                    @drop.prevent="if(draggedItem) {   
                                $nextTick(() => { 
                                                      @this.call('updatePhase', draggedItem, '{{ $phase }}');
                                            draggedItem = null;
                                                }); 
                                            }">

                    <h2 class="text-lg font-bold text-center mb-4">
                        {{ $phase }}

                        <!-- Sorting Button -->
                        <button wire:click="sortBy('n_file', '{{ $phase }}')" class="ml-2 text-sm text-blue-500">
                            <!-- Default icon when not sorted -->
                            @if ($activePhase !== $phase || $sortField !== 'n_file')
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

                    <div class="space-y-2">

                        @if (!isset($projects) || !is_array($projects))
                            <p class="text-red-500">Error: $projects is not defined or not an array.</p>
                        @endif
                        @if(isset($projects[$phase]) && is_array($projects[$phase]))
                                    @foreach($projects[$phase] ?? [] as $project)
                                                <div class="bg-white p-3 rounded shadow cursor-pointer" draggable="true"
                                                    @dragstart.self="draggedItem = parseInt('{{ $project["id"] }}')">
                                                    <p class="font-semibold">{{ $project["n_file"] }}</p>
                                                    <p class="font-semibold">{{ $project["client_name"] }}</p>
                                                    <p>
                                                        @php
                                                            $typeClientClass = $project['client_type'] ? 'bg-gray-400' : 'bg-purple-400';
                                                            $valueTypeClient = $project['client_type'] ? 'Pubblico' : 'Privato';
                                                        @endphp
                                                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $typeClientClass }}">
                                                            {{ $valueTypeClient }}
                                                        </span>
                                                    </p>
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