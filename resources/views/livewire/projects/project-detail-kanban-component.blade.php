<div class="max-h-screen bg-white p-4">
    <!-- Section Title -->
    <div>
        <h2 class="text-[#08468B] text-[14px] font-medium">{{ $nameSection }}</h2>
        <div class="flex space-x-2 text-[13px]">
            <p class="text-[#B0B0B0]">{{ count($elements) }} task</p>
            <div class="w-1 h-1 bg-gray-400 rounded-full self-center"></div>
            <p class="text-[#FDC106]">{{ $elements->where('status', 'In attesa')->count() }} in attesa</p>
            <p class="text-[#28A745]">{{ $elements->where('status', 'Svolto')->count() }} svolti</p>
        </div>
    </div>

    <!-- Task + MicroTasks List -->
    <ul class="space-y-8 mt-4 w-96">
        @foreach ($elements as $element)
            <!-- Parent Task Card -->
            <li class="w-full border-l-4 border-[#08468B] border p-4 shadow rounded bg-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $element->name_phase }}</p>
                        <div class="flex items-center text-xs text-gray-600 mt-1 font-extralight">
                            <div class="flex items-center mr-2">
                                <div
                                    class="h-6 w-6 flex items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                                    <flux:icon.user variant="micro" />
                                </div>
                                <span class="ml-2">{{ $element->user }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center w-[160px]">
                        <select
                            wire:change="updateStatusStart({{ $element->id }}, $event.target.value, '{{ $NameTable }}')"
                            class="bg-transparent w-full appearance-none px-2 py-1 border-none focus:outline-none text-center
                            {{ $element->status === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                            <option value="Svolto" {{ $element->status === 'Svolto' ? 'selected' : '' }}>Svolto</option>
                            <option value="In attesa" {{ $element->status === 'In attesa' ? 'selected' : '' }}>In
                                attesa</option>
                        </select>
                    </div>
                </div>

                <!-- Parent Action Buttons -->
                <div class="flex space-x-2 mt-3">
                    <div class="flex justify-between">
                        <div>
                            <flux:button
                                wire:click="$dispatch('openModal', { component: 'projects.modals.edit-task', arguments: { id: {{ $element->id }} } })"
                                variant="ghost" data-variant="ghost" data-color="gray" data-rounded icon="pencil"
                                size="sm" />

                            <flux:button wire:click="deleteMacroTask({{ $element->id }}, '{{ $NameTable }}')"
                                wire:confirm="Sei sicuro di voler archiviare questo micro task?" variant="ghost"
                                data-variant="ghost" data-color="red" data-rounded icon="trash" size="sm" />
                        </div>
                        <div>
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
                    </div>



                </div>
            </li>

            <!-- External MicroTasks Block -->
            @php
                $microTasks = $groupedMicroTasks->where('project_start_id', $element->id);
            @endphp

            @if ($microTasks->count())
                <div class="ml-5 pl-6 py-4 bg-white border-1 border-l-4 border-[#08468B] shadow space-y-2">


                    @foreach ($microTasks as $micro)
                        <div class="flex justify-between items-center  px-4 py-2">
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $micro->title }}</p>
                                <p class="text-xs text-gray-500">{{ $micro->assignee ?? '—' }}</p>
                            </div>

                            <div class="flex items-center space-x-3">
                                <select
                                    wire:change="updateMicroStatusStart({{ $micro->id }}, $event.target.value, '{{ $NameTable }}')"
                                    class="bg-transparent w-full appearance-none px-2 py-1 border-none focus:outline-none text-center
                                    {{ $micro->status === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                                    <option value="Svolto" {{ $micro->status === 'Svolto' ? 'selected' : '' }}>Svolto
                                    </option>
                                    <option value="In attesa" {{ $micro->status === 'In attesa' ? 'selected' : '' }}>In
                                        attesa</option>
                                </select>

                                <flux:button
                                    wire:click="$dispatch('openModal', { component: 'projects.modals.edit-micro-task', arguments: { id: {{ $micro->id }} } })"
                                    variant="ghost" data-variant="ghost" data-color="gray" data-rounded icon="pencil"
                                    size="sm" />

                                <flux:button wire:click="microDeleteTask({{ $micro->id }}, '{{ $NameTable }}')"
                                    wire:confirm="Sei sicuro di voler archiviare questo micro task?" variant="ghost"
                                    data-variant="ghost" data-color="red" data-rounded icon="trash" size="sm" />

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </ul>
</div>
