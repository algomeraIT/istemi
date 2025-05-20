<div>
    @if (!empty($phasesTable))


        @foreach ($phasesTable->groupBy(fn($item) => $item->area->name ?? 'Sconosciuto') as $areaName => $groupedPhases)
            <div x-data="{ open: false }" class="bg-white border rounded-md shadow-sm my-4">
                <!-- Collapsible Header -->
                <div @click="open = !open"
                    class="flex items-center justify-between px-6 py-4 border-b cursor-pointer bg-white">
                    <div>
                        <h2 class="text-[#4D1B86] text-sm font-medium">{{ $areaName }}</h2>
                        <div class="flex space-x-2 mt-1">
                            <span class="text-[#B0B0B0] text-xs">{{ $groupedPhases->count() }} task</span>
                            <span class="text-[#FDC106] text-xs">
                                {{ $groupedPhases->where('status', 'In attesa')->count() }} in attesa
                            </span>
                            <span class="text-[#28A745] text-xs">
                                {{ $groupedPhases->where('status', 'Svolto')->count() }} svolti
                            </span>
                        </div>
                    </div>
                    <svg :class="open ? 'rotate-90' : 'rotate-0'"
                        class="w-5 h-5 text-[#4D1B86] transition-transform duration-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>

                <!-- Collapsible Content -->
                <div x-show="open" x-transition class="px-4 py-4">
                    <flux:table class="bg-white border rounded-md text-sm border-l-4 border-[#4D1B83]">
                        <flux:table.columns>
                            <flux:table.column class="border px-4 py-2"></flux:table.column>
                            <flux:table.column class="border px-4 py-2">Task</flux:table.column>
                            <flux:table.column class="border px-4 py-2">Attività</flux:table.column>
                            <flux:table.column class="border px-4 py-2">Assegnato a</flux:table.column>
                            <flux:table.column class="border px-4 py-2">Stato</flux:table.column>
                            <flux:table.column class="border px-4 py-2">Azioni</flux:table.column>
                        </flux:table.columns>

                        @foreach ($groupedPhases as $phase)
                            <flux:table.row >
                                <flux:table.cell class="border px-4 py-2">
                                    @if (isset($groupedMicroTasks[0]) && $groupedMicroTasks[0]->project_start_id === $phase->id)
                                    <flux:icon.arrow-down @click="openMicro = !openMicro" />
                                @endif
                                </flux:table.cell>
                                <flux:table.cell class="border px-4 py-2">
                                    {{ $phase->microArea->name ?? '—' }}
                                </flux:table.cell>
                                <flux:table.cell class="whitespace-nowrap border " data-detail="detail">

                                <flux:button
                                    wire:click="$dispatch('openModal', {
                                component: 'projects.modals.create-task-project',
                                arguments: {
                                    project_id: {{ $phase->id_project }},
                                    phase: 'project_start_id',
                                    id: {{ $phase->id }}
                                }
                            })"
                                    variant="ghost" data-variant="ghost" icon="plus">
                                </flux:button>
                            </flux:table.cell>
                                <flux:table.cell class="border px-4 py-2">
                                    {{ $phase->user->name . ' ' .  $phase->user->last_name}}
                                </flux:table.cell>

                                <flux:table.cell class="border px-4 py-2">
                                    <select wire:change="updateStatusStart({{ $phase->id }}, $event.target.value)"
                                        class="w-full bg-transparent text-sm border-none focus:outline-none text-center
                                        {{ $phase->status === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                                        
                                        <option value="In attesa" @selected($phase->status === 'In attesa')>In attesa</option>
                                        <option value="Svolto" @selected($phase->status === 'Svolto')>Svolto</option>
                                    </select>
                                </flux:table.cell>

                                <flux:table.cell class="border " data-detail="detail">
                        
                                <flux:button
                                    wire:click="$dispatch('openModal', { component: 'projects.modals.macro-task-detail', arguments: { id: {{ $phase->id }} }})"
                                    variant="ghost" data-variant="ghost" data-color="teal" data-rounded
                                    icon="eye" size="sm" />

                                <flux:button
                                    wire:click="$dispatch('openModal', { component: 'projects.modals.edit-task', arguments: { id: {{ $phase->id }}}})"
                                    variant="ghost" data-variant="ghost" data-color="gray" data-rounded
                                    icon="pencil" size="sm" />
   
                                    <flux:button
                                    wire:click="deleteMacroTask({{ $phase->id }})"
                                    wire:confirm="Sei sicuro di voler archiviare questo macro task?"
                                    variant="ghost" data-variant="ghost" data-color="red"
                                    data-rounded icon="trash" size="sm" />
                            </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table>
                </div>
            </div>
        @endforeach
    @endif
</div>
