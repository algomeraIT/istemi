<div>
    @if (!empty($elements))
        <div x-data="{ open: false }" class="bg-white flex flex-col m-2.5">

            <!-- Collapsible Header -->
            <div @click="open = !open" class="cursor-pointer flex items-center justify-between px-6 py-4 border ">
                <div>
                    <h2 class="text-[#4D1B86] text-[14px] font-medium">{{ $nameSection }}
                    </h2>
                    <div class="flex space-x-2">

                        <p class="text-[#B0B0B0] text-[13px]">
                            {{ count($elements) }} task
                        <div class="w-1 h-1 bg-gray-400 rounded-4xl self-center"></div>
                        </p>
                        <p class="text-[#FDC106] text-[13px]">
                            {{ $elements->where('status', 'In attesa')->count() }}
                            in attesa</p>
                        <p class="text-[#28A745] text-[13px]">
                            {{ $elements->where('status', 'Svolto')->count() }}
                            svolti </p>
                    </div>
                </div>
                <!-- Arrow Icon -->
                <svg :class="open ? 'rotate-90' : 'rotate-0'"
                    class="transition-transform duration-300 w-6 h-6 text-purple-700" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>

            <!-- Collapsible Body -->
            <div x-show="open" x-transition
                class="flex-1 px-6 py-4 mt-8 overflow-auto text-purple-700 text-lg bg-[#5A2C8E03] border">

                <flux:table class="bg-white border rounded-md text-sm  border-l-3 border-l-[#4D1B83] border-l-solid">
                    <flux:table.columns class="">
                        <flux:table.column class="border px-4 py-2 text-center" data-detail="detailColumn">
                        </flux:table.column>
                        <flux:table.column class="border px-4 py-2 text-center" data-detail="detailColumn">Task
                        </flux:table.column>
                        <flux:table.column class="border px-4 py-2" data-detail="detailColumn">Attività
                        </flux:table.column>
                        <flux:table.column class="border px-4 py-2" data-detail="detailColumn">Assegnato a
                        </flux:table.column>
                        <flux:table.column class="border px-4 py-2" data-detail="detailColumn">Stato
                        </flux:table.column>
                        <flux:table.column class="border px-4 py-2" data-detail="detailColumn">Azioni
                        </flux:table.column>
                    </flux:table.columns>

                    @foreach ($elements as $element)
                        <tbody x-data="{ openMicro: false }">
                            <flux:table.row class="cursor-pointer border-b">
                                <flux:table.cell data-detail="detail" class="whitespace-nowrap border  ">


                                    @if (isset($groupedMicroTasks[0]) && $groupedMicroTasks[0]->project_start_id === $element->id)
                                        <flux:icon.arrow-down @click="openMicro = !openMicro" />
                                    @endif



                                </flux:table.cell>
                                <flux:table.cell data-detail="detail" class="whitespace-nowrap border  ">
                                    <p>{{ $element->name_phase }}</p>

                                </flux:table.cell>

                                <flux:table.cell class="whitespace-nowrap border " data-detail="detail">

                                    <flux:button
                                        wire:click="$dispatch('openModal', {
                                    component: 'projects.modals.create-task-project',
                                    arguments: {
                                        project_id: {{ $project->id }},
                                        phase: 'project_start_id',
                                        id: {{ $element->id }}
                                    }
                                })"
                                        variant="ghost" data-variant="ghost" icon="plus">
                                    </flux:button>
                                </flux:table.cell>

                                <flux:table.cell data-detail="detail" class="whitespace-nowrap border ">
                                    <div class="flex items-center justify-center font-extralight">
                                        <div
                                            class="flex h-6 w-6 items-center mr-2 justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4] dark:bg-neutral-700 dark:text-white">
                                            <flux:icon.user variant="micro" />
                                        </div>
                                        {{ $element->user }}
                                    </div>
                                </flux:table.cell>

                                <flux:table.cell data-detail="detail" class="whitespace-nowrap border p-0">
                                    <div class="w-full h-full px-4 py-2 text-center font-extralight">
                                        <select
                                            wire:change="updateStatusStart({{ $element->id }}, $event.target.value, '{{ $NameTable }}')"
                                            class="bg-transparent w-full appearance-none px-2 py-1 border-none focus:outline-none text-center
                                            {{ $element->status === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                                            <option value="Svolto"
                                                {{ $element->status === 'Svolto' ? 'selected' : '' }}>Svolto</option>
                                            <option value="In attesa"
                                                {{ $element->status === 'In attesa' ? 'selected' : '' }}>
                                                In attesa</option>
                                        </select>
                                    </div>
                                </flux:table.cell>



                                <flux:table.cell class="border" data-detail="detail">
                        
                                    <flux:button
                                        wire:click="$dispatch('openModal', { component: 'projects.modals.macro-task-detail', arguments: { id: {{ $element->id }}, nameSection: '{{ $nameSection }}' }})"
                                        variant="ghost" data-variant="ghost" data-color="teal" data-rounded
                                        icon="eye" size="sm" />

                                    <flux:button
                                        wire:click="$dispatch('openModal', { component: 'projects.modals.edit-task', arguments: { id: {{ $element->id }}, nameSection: '{{ $nameSection }}' }})"
                                        variant="ghost" data-variant="ghost" data-color="gray" data-rounded
                                        icon="pencil" size="sm" />
                                    <flux:button wire:click="deleteMacroTask({{ $element->id }})"
                                        wire:confirm="Sei sicuro di voler archiviare questo micro task?" variant="ghost"
                                        data-variant="ghost" data-color="red" data-rounded icon="trash"
                                        size="sm" />
                                </flux:table.cell>
                            </flux:table.row>
                            {{-- MicroTask children --}}
                            <tr x-show="openMicro" x-transition class="">
                                <td colspan="5" class="p-4 bg-gray-50 border-t border-l-4 border-[#4D1B83]">
                                    <flux:table class="bg-white border rounded-md text-sm">
                                        <flux:table.columns>
                                            <flux:table.column class="border px-4 py-2 text-left"
                                                data-detail="detailColumn">Task</flux:table.column>
                                            <flux:table.column class="border px-4 py-2 text-left"
                                                data-detail="detailColumn">Assegnatario</flux:table.column>
                                            <flux:table.column class="border px-4 py-2 text-right"
                                                data-detail="detailColumn">Azioni</flux:table.column>
                                        </flux:table.columns>

                                        @foreach ($groupedMicroTasks as $micro)
                                            <flux:table.row class="border-b hover:bg-gray-50">

                                                <flux:table.cell class="border px-4 py-2" data-detail="detail">
                                                    {{ $micro->title }}
                                                </flux:table.cell>

                                                <flux:table.cell class="border px-4 py-2" data-detail="detail">
                                                    {{ $micro->assignee ?? '—' }}
                                                </flux:table.cell>

                                                <flux:table.cell class="border px-4 py-2 text-right"
                                                    data-detail="detail">
                                                    <flux:button
                                                        wire:click="$dispatch('openModal', { component: 'projects.modals.show-micro-task', arguments: { id: {{ $micro->id }} }})"
                                                        variant="ghost" data-variant="ghost" data-color="teal"
                                                        data-rounded icon="eye" size="sm" />

                                                    <flux:button
                                                        wire:click="$dispatch('openModal', { component: 'projects.modals.edit-micro-task', arguments: { id: {{ $micro->id }} } })"
                                                        variant="ghost" data-variant="ghost" data-color="gray"
                                                        data-rounded icon="pencil" size="sm" />

                                                    <flux:button
                                                        wire:click="microDeleteTask({{ $micro->id }}, '{{ $NameTable }}')"
                                                        wire:confirm="Sei sicuro di voler archiviare questo micro task?"
                                                        variant="ghost" data-variant="ghost" data-color="red"
                                                        data-rounded icon="trash" size="sm" />
                                                </flux:table.cell>
                                            </flux:table.row>
                                        @endforeach
                                    </flux:table>
                                </td>
                            </tr>

                        </tbody>
                    @endforeach

                </flux:table>
            </div>
        </div>
    @endif


</div>
