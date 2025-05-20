<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <!-- Modal Panel -->
    <div class="w-1/3 bg-white p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Attività</h2>
            <button wire:click="$dispatch('closeModal')" class="text-sm text-gray-500 hover:text-gray-700">Chiudi</button>
        </div>

        <!-- Tabs -->
        <flux:tab.group>
            <flux:tabs wire:model="tab" class="border-none mb-4">
                <flux:tab name="profile" data-variant="detailNoBorders">Task</flux:tab>
                <flux:tab name="account" data-variant="detailNoBorders">Allegati</flux:tab>
                <flux:tab name="billing" data-variant="detailNoBorders">Note</flux:tab>
            </flux:tabs>

        
                
         
            <!-- Tab 1: Task -->
            <flux:tab.panel name="profile">
                @if (!empty($tasks))
                @foreach ($tasks as $task)
                    <div class="mb-6 border-b pb-4">
                        <p class="font-semibold text-base text-gray-700 mb-2">{{ $task->phase->microArea->name }}</p>

                        <div class="flex gap-4 text-sm text-gray-600 mb-2">
                            <div class="flex items-center gap-1">
                                <flux:icon.at-symbol class="w-4 h-4" />
                                <span>{{ $task->phase->user->name . ' ' . $task->phase->user->last_name }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:icon.calendar class="w-4 h-4" />
                                <span>{{ $task['expire'] }}</span>
                            </div>
                        </div>

                        <div class="text-sm text-gray-500 italic mb-2">
                            {{ $task['note'] }}
                        </div>

                        <div class="flex items-center text-xs text-gray-400 gap-2 mb-2">
                            <span>Creato: {{ $task['user'] }}</span>
                            <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                            <span>{{ $task['created_at']->diffForHumans() }}</span>
                        </div>

                        <div>
                            <select wire:change="updateStatusStart({{ $task['id'] }}, $event.target.value)"
                                class="text-sm w-full rounded border p-1 
                                {{ $task['status'] === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                                <option value="Svolto" {{ $task['status'] === 'Svolto' ? 'selected' : '' }}>Svolto
                                </option>
                                <option value="In attesa" {{ $task['status'] === 'In attesa' ? 'selected' : '' }}>In
                                    attesa</option>
                            </select>
                        </div>
                    </div>
                @endforeach
                @else
                <p>Nessun task da visualizzare</p>
                @endif
            </flux:tab.panel>

            <!-- Tab 2: Allegati -->
            <flux:tab.panel name="account">
                <div class="space-y-4 text-sm text-gray-700">
                    @if (!empty($tasks))
                    @foreach ($tasks as $task)
                        @if ($task->media)
                            <div>
                                <p class="text-xs text-gray-400 mb-1 font-medium uppercase tracking-wide">
                                    Allegati per fase: {{ $task->phase->microArea->name ?? '-' }}
                                </p>

                                <div class="flex flex-wrap gap-3">
                                    @foreach ($task as $file)
                                        <div class="w-24 text-center">
                                            <div class="w-20 h-20 flex flex-col items-center justify-center">
                                                <img src="{{ asset('icon/default-file.svg') }}"
                                                    class="w-full h-full object-cover rounded" alt="File" />
                                                    <p>file.doc</p>
                                            </div>
                                            <p class="mt-1 text-xs truncate text-gray-600"></p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <p class="text-xs text-gray-400 italic">Nessun allegato per questa fase.</p>
                        @endif
                    @endforeach
                    @else
                    <p>Nessun allegato da visualizzare</p>
                    @endif
                </div>
            </flux:tab.panel>

            <!-- Tab 3: Note -->
            <flux:tab.panel name="billing">
                <div class="px-2">
                    <!-- Flux Editor for Note -->

                    <div>
                        <label class="text-xs flex items-center gap-1 mb-1 text-gray-500">
                            <flux:icon.clipboard class="w-4 h-4" />
                            Nota
                        </label>

                        <flux:editor wire:model.defer="note" placeholder="Scrivi qualcosa…"
                            class="border border-gray-200 bg-white rounded" />

                        <button wire:click="saveNote({{ $id }})"
                            class="mt-2 px-4 py-2 bg-[#10BDD4] text-white rounded hover:bg-[#0caac0] text-sm transition">
                            Invia
                        </button>
                    </div>

                    <!-- Notes Timeline -->
                    @php
                        $groupedTasks = collect($notes)->groupBy(
                            fn($task) => $task['created_at']->locale('it')->isoFormat('MMMM YYYY'),
                        );
                    @endphp

                    @foreach ($groupedTasks as $month => $monthTasks)
                        <div class="mt-6 mb-2 flex items-center">
                            <span class="bg-[#F5FCFD] text-[#10BDD4] px-3 py-1 text-xs font-semibold border rounded">
                                {{ $month }}
                            </span>
                            <div class="h-px bg-gray-300 flex-1 ml-2"></div>
                        </div>

                        @foreach ($notes as $task)
                            <div class="border p-4 rounded mb-4">
                                <div class="flex items-start space-x-2">
                                    <div
                                        class="bg-[#F5FCFD] text-[#10BDD4] rounded-full w-6 h-6 flex items-center justify-center">
                                        <flux:icon.user class="w-3 h-3" />
                                    </div>
                                    <div class="text-sm flex-1">
                                        <div class="flex gap-2">
                                            <span class="font-medium">{{ $task['assignee'] }}</span>
                                            <span class="text-gray-500">{{ $task['cc'] }}</span>
                                        </div>
                                        <div class="text-xs text-gray-400 italic mt-1">
                                            ha scritto una nota •
                                            {{ \Carbon\Carbon::parse($task['created_at'])->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 text-gray-700 text-sm font-light">
                                    {!! $task['note'] !!}
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </flux:tab.panel>
        </flux:tab.group>
      
    </div>
</div>
