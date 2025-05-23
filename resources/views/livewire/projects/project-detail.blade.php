<div class="container mx-auto pt-2">
    <div class=" bg-white p-6 ">
        <!-- Left Section: Referents -->
        <div class="mx-auto my-3">
            @include('livewire.general.goback')
        </div>

        <div class="w-full flex  xl:flex-row flex-col-reverse ">

            <div class="lg:flex lg:flex-nowrap xl:w-3/4">

                <flux:tab.group wire:model="datasheetHideDiv" class="bg-white  p-2 w-full">

                    <div class="md:flex xl:justify-between items-baseline">

                        <flux:tabs class="flex 2xl:flex-nowrap flex-wrap gap-2 align-middle border-none">
                            <flux:tab data-variant="detail" name="task"
                                wire:click.native="$set('datasheetHideDiv','task')">Task</flux:tab>
                            <flux:tab data-variant="detail" name="document"
                                wire:click.native="$set('datasheetHideDiv','document')">Documenti</flux:tab>
                            <flux:tab data-variant="detail" name="note"
                                wire:click.native="$set('datasheetHideDiv','note')">Note</flux:tab>
                            <flux:tab data-variant="detail" name="data-sheet"
                                wire:click.native="$set('datasheetHideDiv','data-sheet')">Scheda tecnica</flux:tab>
                        </flux:tabs>

                        <div class="sm:flex md:flex-wrap lg:flex-nowrap gap-4 p-1">
                            {{--        <flux:select wire:model.live="query_project" data-variant="status">
                                <flux:select.option value="">Tutti gli stati</flux:select.option>
                                <flux:select.option value="In attesa">In attesa</flux:select.option>
                                <flux:select.option value="Svolto">Svolto</flux:select.option>
                            </flux:select>

                            <flux:input wire:model.live="query" data-variant="search" placeholder="Cerca fase" /> --}}
                        </div>
                    </div>
                    <flux:tab.panel name="task">
                        <div>
                            <flux:tab.group class="p-2" wire:model="tabListKanbaDetail">

                                <flux:tabs variant="segmented" class="lg:ml-[40%]">
                                    <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
                                    <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
                                </flux:tabs>

                                <flux:tab.panel name="list">
                                    <div>
                                        @if (!empty($phasesTable))
                                            @php
                                                $groupedMicroTasks = $groupedMicroTasks->groupBy('id_phases');
                                            @endphp
                                            @foreach ($phasesTable->groupBy(fn($item) => $item->area->name ?? 'Sconosciuto') as $areaName => $groupedPhases)
                                                <div x-data="{ open: false }"
                                                    class="bg-white border rounded-md shadow-sm my-4">
                                                    <!-- Collapsible Header -->
                                                    <div @click="open = !open"
                                                        class="flex items-center justify-between px-6 py-4 border-b cursor-pointer bg-white">
                                                        <div>
                                                            <h2 class="text-[#4D1B86] text-sm font-medium">
                                                                {{ $areaName }}</h2>
                                                            <div class="flex space-x-2 mt-1">
                                                                <span
                                                                    class="text-[#B0B0B0] text-xs">{{ $groupedPhases->count() }}
                                                                    task</span>
                                                                <span class="text-[#FDC106] text-xs">
                                                                    {{ $groupedPhases->where('status', 'In attesa')->count() }}
                                                                    in attesa
                                                                </span>
                                                                <span class="text-[#28A745] text-xs">
                                                                    {{ $groupedPhases->where('status', 'Svolto')->count() }}
                                                                    svolti
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <svg :class="open ? 'rotate-90' : 'rotate-0'"
                                                            class="w-5 h-5 text-[#4D1B86] transition-transform duration-200"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </div>

                                                    <!-- Collapsible Content -->
                                                    <div x-show="open" x-transition class="px-4 py-4">
                                                        <flux:table
                                                            class="bg-white border rounded-md text-sm border-l-4 border-[#4D1B83]">
                                                            <flux:table.columns>
                                                                <flux:table.column class="border px-4 py-2">
                                                                </flux:table.column>
                                                                <flux:table.column class="border px-4 py-2">Task
                                                                </flux:table.column>
                                                                <flux:table.column class="border px-4 py-2">Attività
                                                                </flux:table.column>
                                                                <flux:table.column class="border px-4 py-2">Assegnato a
                                                                </flux:table.column>
                                                                <flux:table.column class="border px-4 py-2">Stato
                                                                </flux:table.column>
                                                                <flux:table.column class="border px-4 py-2">Azioni
                                                                </flux:table.column>
                                                            </flux:table.columns>

                                                            @foreach ($groupedPhases as $phase)
                                                                <flux:table.row>
                                                                    <flux:table.cell
                                                                        class="border px-4 py-2 text-center">

                                                                        @if ($groupedMicroTasks->has($phase->id))
                                                                            <button
                                                                                wire:click="togglePhase({{ $phase->id }})"
                                                                                class="cursor-pointer">
                                                                                @if ($openPhaseId == $phase->id)
                                                                                    <flux:icon.chevron-right
                                                                                        class="w-4" />
                                                                                @else
                                                                                    <flux:icon.chevron-down
                                                                                        class="w-4" />
                                                                                @endif

                                                                            </button>
                                                                        @endif

                                                                    </flux:table.cell>
                                                                    <flux:table.cell class="border px-4 py-2">
                                                                        {{ $phase->microArea->name ?? '—' }}
                                                                    </flux:table.cell>
                                                                    <flux:table.cell class="whitespace-nowrap border "
                                                                        data-detail="detail">

                                                                        <flux:button
                                                                            wire:click="$dispatch('openModal', {
                                                                                                                component: 'projects.modals.create-task-project',
                                                                                                                arguments: {
                                                                                                                    project_id: {{ $phase->id_project }},phase_id: {{ $phase->id }}
                                                                                                                }
                                                                                                            })"
                                                                            variant="ghost" data-variant="ghost"
                                                                            icon="plus">
                                                                        </flux:button>

                                                                    </flux:table.cell>
                                                                    <flux:table.cell class="border px-4 py-2">
                                                                        {{ $phase->user->name . ' ' . $phase->user->last_name }}
                                                                    </flux:table.cell>

                                                                    <flux:table.cell class="border px-4 py-2">
                                                                        <select
                                                                            wire:change="updateStatusStart({{ $phase->id }}, $event.target.value)"
                                                                            class="w-full bg-transparent text-sm border-none focus:outline-none text-center
                                                                                                {{ $phase->status === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">

                                                                            <option value="In attesa"
                                                                                @selected($phase->status === 'In attesa')>In attesa
                                                                            </option>
                                                                            <option value="Svolto"
                                                                                @selected($phase->status === 'Svolto')>Svolto
                                                                            </option>
                                                                        </select>
                                                                    </flux:table.cell>

                                                                    <flux:table.cell class="border "
                                                                        data-detail="detail">

                                                                        <flux:button
                                                                            wire:click="$dispatch('openModal', { component: 'projects.modals.macro-task-detail', arguments: { id: {{ $phase->id }} }})"
                                                                            variant="ghost" data-variant="ghost"
                                                                            data-color="teal" data-rounded
                                                                            icon="eye" size="sm" />

                                                                        <flux:button
                                                                            wire:click="$dispatch('openModal', {
                                                                                component: 'projects.modals.create-task-project',
                                                                                arguments: {
                                                                                    taskId: {{ $phase->id ?? 'null' }},
                                                                                    phase_id: {{ $phase->id }},
                                                                                    project_id: {{ $phase->id_project }}
                                                                                }
                                                                            })"
                                                                            variant="ghost" data-variant="ghost"
                                                                            icon="pencil" size="sm" />

                                                                        <flux:button
                                                                            wire:click="deleteMacroTask({{ $phase->id }})"
                                                                            wire:confirm="Sei sicuro di voler archiviare questo macro task?"
                                                                            variant="ghost" data-variant="ghost"
                                                                            data-color="red" data-rounded icon="trash"
                                                                            size="sm" />
                                                                    </flux:table.cell>

                                                                </flux:table.row>

                                                                @if ($openPhaseId == $phase->id)
                                                                    <flux:table.row>
                                                                        <flux:table.cell colspan="6"
                                                                            class="bg-white p-4">

                                                                            @php

                                                                                $tasksForPhase =
                                                                                    $groupedMicroTasks[$phase->id];

                                                                            @endphp

                                                                            <flux:table
                                                                                class="w-full text-[13px] border-l-4 border-r-1 border-t-1 border-b-1 border-[#4D1B83] bg-white ml-5 mt-4 mb-4">
                                                                                <flux:table.columns
                                                                                    class="bg-white text-center text-xs font-semibold text-gray-600 justify-center">
                                                                                    <flux:table.column data-flux-column
                                                                                        class=" border-b justify-center">
                                                                                        Attività</flux:table.column>
                                                                                    <flux:table.column
                                                                                        class="border-b text-center">
                                                                                        Assegnato a</flux:table.column>

                                                                                    <flux:table.column
                                                                                        class="  border-b text-center">
                                                                                        Stato</flux:table.column>
                                                                                    <flux:table.column
                                                                                        class="  border-b text-center">
                                                                                        Azioni</flux:table.column>
                                                                                </flux:table.columns>

                                                                                @foreach ($tasksForPhase as $task)
                                                                                    <flux:table.row
                                                                                        class="hover:bg-gray-50">
                                                                                        <flux:table.cell
                                                                                            class="  border-t text-center">
                                                                                            {{ $task['title'] }}
                                                                                        </flux:table.cell>
                                                                                        <flux:table.cell
                                                                                            class="  border-t text-center">
                                                                                            {{ $task['assignee'] }}
                                                                                        </flux:table.cell>

                                                                                        <flux:table.cell
                                                                                            class="  border-t">
                                                                                            <select
                                                                                                wire:change="updateStatusStartMicro({{ $task['id'] }}, $event.target.value)"
                                                                                                class="w-full bg-transparent text-sm border-none focus:outline-none text-center
                                                                                                        {{ $task['status'] === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">

                                                                                                <option
                                                                                                    value="In attesa"
                                                                                                    @selected($task['status'] === 'In attesa')>
                                                                                                    In attesa
                                                                                                </option>
                                                                                                <option value="Svolto"
                                                                                                    @selected($task['status'] === 'Svolto')>
                                                                                                    Svolto
                                                                                                </option>
                                                                                            </select>
                                                                                        </flux:table.cell>
                                                                                        <flux:table.cell
                                                                                            class="  border-t text-center">
                                                                                            <flux:button
                                                                                                wire:click="$dispatch('openModal', { component: 'projects.modals.show-micro-task', arguments: { id: {{ $task['id'] }} }})"
                                                                                                variant="ghost"
                                                                                                data-variant="ghost"
                                                                                                data-color="teal"
                                                                                                data-rounded
                                                                                                icon="eye"
                                                                                                size="sm" />

                                                                                            <flux:button
                                                                                                wire:click="$dispatch('openModal', {
                                                                                                    component: 'projects.modals.create-task-project',
                                                                                                    arguments: {
                                                                                                        taskId: {{ $task['id'] ?? 'null' }},
                                                                                                        phase_id: {{ $phase->id }},
                                                                                                        project_id: {{ $phase->id_project }}
                                                                                                    }
                                                                                                })"
                                                                                                variant="ghost"
                                                                                                data-variant="ghost"
                                                                                                icon="pencil"
                                                                                                size="sm" />

                                                                                            <flux:button
                                                                                                wire:click="microDeleteTask({{ $task['id'] }})"
                                                                                                wire:confirm="Sei sicuro di voler archiviare questo macro task?"
                                                                                                variant="ghost"
                                                                                                data-variant="ghost"
                                                                                                data-color="red"
                                                                                                data-rounded
                                                                                                icon="trash"
                                                                                                size="sm" />
                                                                                        </flux:table.cell>
                                                                                    </flux:table.row>
                                                                                @endforeach
                                                                            </flux:table>

                                                                        </flux:table.cell>
                                                                    </flux:table.row>
                                                                @endif
                                                            @endforeach
                                                        </flux:table>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>


                                </flux:tab.panel>

                                <flux:tab.panel name="kanban" class="flex overflow-auto max-w-[1000px]">

                                    @if (count($this->phasesTable) > 0)
                                        <div class=" bg-white p-4 overflow-x-auto">
                                            <div class="flex space-x-6 min-w-fit">
                                                @foreach ($phasesTable->groupBy(fn($el) => $el->area->name ?? 'Sconosciuto') as $areaName => $groupedElements)
                                                    <div class="min-w-[360px] w-96  bg-white p-4 flex-shrink-0">
                                                        <!-- Area Header -->
                                                        <h3 class="text-[#4D1B83] text-sm font-semibold mb-2">
                                                            {{ $areaName }}</h3>

                                                        <!-- Area Columns -->
                                                        <div class="space-y-6">
                                                            <div class="mt-4 pl-4 border-l-2 border-[#E0E0E0]"
                                                                style="max-height: 450px; overflow-y: auto;">
                                                                @foreach ($groupedElements as $element)
                                                                    <!-- Parent Task Card -->
                                                                    <div class="w-full border-l-4 border-[#08468B] p-4 shadow rounded bg-white"
                                                                        wire:click="$dispatch('openModal', { component: 'projects.modals.macro-task-detail', arguments: { id: {{ $element->id }} }})">
                                                                        <div class="flex justify-between items-start">
                                                                            <div>
                                                                                <p
                                                                                    class="text-sm font-medium text-gray-800">
                                                                                    {{ $element->name_phase }}</p>
                                                                                <div
                                                                                    class=" items-center text-xs text-gray-600 mt-1 font-extralight">
                                                                                    <div>
                                                                                        <p
                                                                                            class="text-[18px] font-medium w-40 wrap-break-word">
                                                                                            {{ $element->microArea->name }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div
                                                                                        class="flex items-center mr-2 mt-2">

                                                                                        <div
                                                                                            class="h-6 w-6 flex items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                                                                                            <flux:icon.user
                                                                                                variant="micro" />
                                                                                        </div>
                                                                                        <span
                                                                                            class="ml-2">{{ $element->user->name . ' ' . $element->user->last_name }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-center ">
                                                                                <select
                                                                                    wire:change="updateStatusStart({{ $element->id }}, $event.target.value)"
                                                                                    class="bg-transparent w-full appearance-none px-2 py-1 border-none focus:outline-none text-center
                                                                                    {{ $element->status === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                                                                                    <option value="Svolto"
                                                                                        @selected($element->status === 'Svolto')>
                                                                                        Svolto
                                                                                    </option>
                                                                                    <option value="In attesa"
                                                                                        @selected($element->status === 'In attesa')>In
                                                                                        attesa</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Action Buttons -->
                                                                        <div
                                                                            class="flex space-x-2 mt-3 justify-between">
                                                                            <div>
                                                                                <flux:button
                                                                                    wire:click="$dispatch('openModal', { component: 'projects.modals.edit-task', arguments: { id: {{ $project->id }}}})"
                                                                                    variant="ghost"
                                                                                    data-variant="ghost"
                                                                                    data-color="gray" data-rounded
                                                                                    icon="pencil" size="sm" />
                                                                                <flux:button
                                                                                    wire:click="deleteMacroTask({{ $project->id }})"
                                                                                    wire:confirm="Sei sicuro di voler archiviare questo macro task?"
                                                                                    variant="ghost"
                                                                                    data-variant="ghost"
                                                                                    data-color="red" data-rounded
                                                                                    icon="trash" size="sm" />
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
                                                                        @if (isset($groupedMicroTasks[$element->id]))
                                                                            @php
                                                                                $tasksForPhase =
                                                                                    $groupedMicroTasks[$element->id];
                                                                            @endphp
                                                                            <div
                                                                                class="mt-4 pl-4 border-l-2 border-[#E0E0E0] space-y-2">
                                                                                @foreach ($tasksForPhase as $micro)
                                                                                    <div
                                                                                        class="flex justify-between items-center px-2 py-1 h-20">
                                                                                        <div>
                                                                                            <p
                                                                                                class="text-sm font-medium text-gray-800">
                                                                                                {{ $micro->title }}
                                                                                            </p>
                                                                                            <p
                                                                                                class="text-xs text-gray-500">
                                                                                                {{ $micro->assignee ?? '—' }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="flex items-center space-x-2">
                                                                                            <select
                                                                                                wire:change="updateMicroStatus({{ $micro->id }}, $event.target.value)"
                                                                                                class="bg-transparent px-1 py-0.5 text-xs focus:outline-none
                                                                                                {{ $micro->status === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                                                                                                <option value="Svolto"
                                                                                                    @selected($micro->status === 'Svolto')>
                                                                                                    Svolto</option>
                                                                                                <option
                                                                                                    value="In attesa"
                                                                                                    @selected($micro->status === 'In attesa')>
                                                                                                    In attesa</option>
                                                                                            </select>

                                                                                            <flux:button
                                                                                                wire:click="$dispatch('openModal', { component: 'projects.modals.edit-micro-task', arguments: { id: {{ $micro->id }} } })"
                                                                                                variant="ghost"
                                                                                                icon="pencil"
                                                                                                size="sm" />

                                                                                            <flux:button
                                                                                                wire:click="microDeleteTask({{ $micro->id }})"
                                                                                                wire:confirm="Sei sicuro di voler archiviare questo micro task?"
                                                                                                variant="ghost"
                                                                                                icon="trash"
                                                                                                data-color="red"
                                                                                                size="sm" />
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    @endif

                                </flux:tab.panel>


                            </flux:tab.group>

                        </div>

                    </flux:tab.panel>

                    <flux:tab.panel name="document">
                        @include('livewire.projects.document-detail')
                    </flux:tab.panel>

                    <flux:tab.panel name="note">
                        <div>

                            <flux:button variant="primary" data-variant="primary"
                                wire:click="$dispatch('openModal', { component: 'projects.modals.create-note', arguments: { id: {{ $id }} }})"
                                data-color="teal">
                                Scrivi nota</flux:button>
                            @if ($notes->isNotEmpty())
                                @foreach ($notes->groupBy(fn($note) => $note->created_at->locale('it')->isoFormat('MMMM YYYY')) as $month => $monthNotes)
                                    <div class="mt-8 mb-4 flex items-center">
                                        <span
                                            class="bg-[#F5FCFD] text-[#10BDD4] px-3 py-1 border-[#E8E8E8] border-1 text-[13px] font-semibold ml-12">
                                            {{ $month }}
                                        </span>
                                        <div class="h-px bg-gray-300 flex-1 "></div>
                                    </div>

                                    {{-- All notes in this month --}}
                                    @foreach ($monthNotes as $note)
                                        <div class="border w-full p-4 mb-6">
                                            <div class="flex items-start space-x-3">
                                                <div
                                                    class="flex h-6 w-6 items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                                                    <flux:icon.user variant="micro" />
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-2 text-sm">
                                                        <span>{{ $note->user_name }}</span>
                                                        <div class="w-2 h-px bg-gray-400"></div>
                                                        <span class="text-gray-500">{{ $note->role }}</span>
                                                    </div>
                                                    <div class="flex items-center text-xs text-gray-600 mt-1">
                                                        <span class="italic">ha scritto una nota</span>
                                                        <div class="w-1 h-1 bg-gray-400 rounded-full mx-2"></div>
                                                        <span>{{ $note->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 text-base font-light text-gray-800">
                                                {!! $note->note !!}
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>
                    </flux:tab.panel>

                    <flux:tab.panel name="data-sheet">
                        @include('livewire.projects.project-datasheet')
                    </flux:tab.panel>
                </flux:tab.group>

            </div>
            @unless ($datasheetHideDiv === 'data-sheet')
                <div class="xl:w-1/4">
                    @include('livewire.projects.allDataRight-detail')
                </div>
            @endunless
        </div>

    </div>
</div>
