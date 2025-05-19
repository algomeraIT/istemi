<div class="max-h-screen bg-white p-4 overflow-x-auto">
    <div class="flex space-x-6 min-w-fit">
        @foreach ($elements->groupBy(fn($el) => $el->area->name ?? 'Sconosciuto') as $areaName => $groupedElements)
            <div class="min-w-[320px] w-96  bg-white p-4 flex-shrink-0">
                <!-- Area Header -->
                <h3 class="text-[#4D1B83] text-sm font-semibold mb-2">{{ $areaName }}</h3>

                <!-- Area Columns -->
                <div class="space-y-6">
                    @foreach ($groupedElements as $element)
                        <!-- Parent Task Card -->
                        <div class="w-full border-l-4 border-[#08468B] p-4 shadow rounded bg-white">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">{{ $element->name_phase }}</p>
                                    <div class="flex items-center text-xs text-gray-600 mt-1 font-extralight">
                                        <div class="flex items-center mr-2">
                                            <div class="h-6 w-6 flex items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                                                <flux:icon.user variant="micro" />
                                            </div>
                                            <span class="ml-2">{{ $element->user->name . ' ' . $element->user->last_name}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center w-[140px]">
                                    <select
                                        wire:change="updateStatusStart({{ $element->id }}, $event.target.value)"
                                        class="bg-transparent w-full appearance-none px-2 py-1 border-none focus:outline-none text-center
                                            {{ $element->status === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                                        <option value="Svolto" @selected($element->status === 'Svolto')>Svolto</option>
                                        <option value="In attesa" @selected($element->status === 'In attesa')>In attesa</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-2 mt-3 justify-between">
                                <div>
                                    <flux:button
                                        wire:click="$dispatch('openModal', { component: 'projects.modals.edit-task', arguments: { id: {{ $element->id }} }})"
                                        variant="ghost" icon="pencil" size="sm" />

                                    <flux:button
                                        wire:click="deleteMacroTask({{ $element->id }})"
                                        wire:confirm="Sei sicuro di voler archiviare questo micro task?"
                                        variant="ghost" icon="trash" data-color="red" size="sm" />
                                </div>
                                <flux:button
                                    wire:click="$dispatch('openModal', {
                                        component: 'projects.modals.create-task-project',
                                        arguments: {
                                            project_id: {{ $project->id }},
                                            phase: 'project_start_id',
                                            id: {{ $element->id }}
                                        }
                                    })"
                                    variant="ghost" icon="plus" />
                            </div>

                            <!-- Micro Tasks -->
                            @php
                                $microTasks = $groupedMicroTasks->where('project_start_id', $element->id);
                            @endphp

                            @if ($microTasks->count())
                                <div class="mt-4 pl-4 border-l-2 border-[#E0E0E0] space-y-2">
                                    @foreach ($microTasks as $micro)
                                        <div class="flex justify-between items-center px-2 py-1">
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">{{ $micro->title }}</p>
                                                <p class="text-xs text-gray-500">{{ $micro->assignee ?? '—' }}</p>
                                            </div>

                                            <div class="flex items-center space-x-2">
                                                <select
                                                    wire:change="updateMicroStatusStart({{ $micro->id }}, $event.target.value, '{{ $NameTable }}')"
                                                    class="bg-transparent px-1 py-0.5 text-xs focus:outline-none
                                                        {{ $micro->status === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                                                    <option value="Svolto" @selected($micro->status === 'Svolto')>Svolto</option>
                                                    <option value="In attesa" @selected($micro->status === 'In attesa')>In attesa</option>
                                                </select>

                                                <flux:button
                                                    wire:click="$dispatch('openModal', { component: 'projects.modals.edit-micro-task', arguments: { id: {{ $micro->id }} } })"
                                                    variant="ghost" icon="pencil" size="sm" />

                                                <flux:button
                                                    wire:click="microDeleteTask({{ $micro->id }}, '{{ $NameTable }}')"
                                                    wire:confirm="Sei sicuro di voler archiviare questo micro task?"
                                                    variant="ghost" icon="trash" data-color="red" size="sm" />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>