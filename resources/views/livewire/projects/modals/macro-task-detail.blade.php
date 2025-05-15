<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <!-- Left Section: Referents -->
    <div class="w-1/3  bg-gray-50">
        <div class="flex flex-row justify-between align-top items-start mx-auto bg-[#F5FCFD] h-36 p-10">
            <h2 class="text-2xl font-bold text-left">Task</h2>
            <button wire:click="$dispatch('closeModal')" class="hover:cursor-pointer" icon="close">Chiudi</button>
        </div>

        <div class="p-10 bg-white ">
            <flux:tab.group>
                <flux:tabs wire:model="tab" class="border-none" >
                    <flux:tab name="profile" data-variant="detailNoBorders">Task</flux:tab>
                    <flux:tab name="account" data-variant="detailNoBorders">Allegati</flux:tab>
                    <flux:tab name="billing" data-variant="detailNoBorders">Note</flux:tab>
                </flux:tabs>

                <flux:tab.panel name="profile">
                    @foreach ($tasks as $task)
                        <div class="flex justify-around">
                           <p class="font-semibold text-[20px] text-[#6C6C6C]"> {{ $task['name_phase'] }} </p>
                        </div>
                        <div class="flex p-4 m-4 font-extralight">
                            <div class=" p-4 m-4">
                                <label class="flex"><flux:icon.at-symbol class="w-4 h-4" />Assegnato a</label>
                                {{ $task['user'] }}
                            </div>
                            <div class=" p-4 m-4">
                                <label class="flex">
                                    <flux:icon.calendar class="w-4 h-4" />Scadenza
                                </label>
                                {{ $task['expire'] }}
                            </div>
                        </div>
                        <div class=" font-extralight">
                            {{ $task['note'] }}
                        </div>
                        <div class="flex mt-4  font-extralight">
                            <p>Creato da: {{ $task['user']  }}</p>
                            <div class="w-1 h-1 bg-gray-400 rounded-4xl self-center mr-1 ml-1"></div>
                            {{ $task['created_at']->diffForHumans() }}
                        </div>

                        <div class="font-extralight">
                            <select wire:change="updateStatusStart({{ $task['id'] }}, $event.target.value)"
                                class="bg-transparent w-full appearance-none px-2 py-1 border-none focus:outline-none text-left
                                            {{ $task['status'] === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                                <option value="Svolto" {{ $task['status'] === 'Svolto' ? 'selected' : '' }}>Svolto
                                </option>
                                <option value="In attesa" {{ $task['status'] === 'In attesa' ? 'selected' : '' }}>
                                    In attesa</option>
                            </select>
                        </div>
                    @endforeach

                </flux:tab.panel>
                <flux:tab.panel name="account">
                    <div>
                        @foreach ($tasks as $task)
                            <div class="border-1 border-[#8888881A]  h-4 flex">
                                <flux:icon.document class="w-4 h-4"></flux:icon.document> {{ $task['media'] }}
                                <flux:icon.eye class="w-4 h-4 text-[#10BDD4]"></flux:icon.eye>
                            </div>
                        @endforeach
                    </div>
                </flux:tab.panel>
                <flux:tab.panel name="billing">
                    <div class="pl-8 pr-8">

                        {{-- Rich text --}}
                        <div>

                            {{-- The x-init directive allows you to hook into the initialization phase of any element in Alpine. --}}
                            <div x-data x-init="$nextTick(() => {
                                const Icon = Quill.import('ui/icons');
                                Icon['bold'] = 'grassetto';
                                Icon['italic'] = 'corsivo';
                                Icon['underline'] = 'sottolineato';
                            
                                const quill = new Quill($refs.quillEditor, {
                                    theme: 'snow',
                                    placeholder: 'Scrivi qualcosa…',
                                    modules: {
                                        toolbar: [
                                            ['bold', 'italic', 'underline'],
                                            [{ 'list': 'bullet' }, 'link', 'image'],
                                        ]
                                    }
                                });
                            
                                quill.root.innerHTML = $refs.hiddenInput.value;
                                quill.on('text-change', () => {
                                    $refs.hiddenInput.value = quill.root.innerHTML;
                                    $refs.hiddenInput.dispatchEvent(new Event('input'));
                                });
                                Livewire.hook('message.processed', () => {
                                    quill.root.innerHTML = $refs.hiddenInput.value;
                                });
                            })" wire:ignore>

                                <label class="text-xs flex items-center gap-2 mb-1 text-[#B0B0B0]">
                                    <flux:icon.clipboard class="w-[10px] text-gray-500" />
                                    Nota
                                </label>

                                <!-- Quill Editor -->
                                <div x-ref="quillEditor"
                                    class="bg-white border border-gray-200 h-[200px] mb-4 p-2 overflow-y-auto">
                                </div>

                                <!-- Hidden field Livewire listens to -->
                                <input type="hidden" wire:model="note" x-ref="hiddenInput" />

                                <!-- Save Button -->
                                <button
                                    wire:click="saveNote({{ $task['id'] }}, {{ $task['project_id'] }}, {{ $task['project_start_id'] }}, {{ $task['client_id'] }})"
                                    class="mt-2 px-4 py-2 bg-[#10BDD4] text-white rounded hover:bg-[#0caac0] transition text-sm">
                                    Invia
                                </button>
                            </div>

                            <style>
                                .ql-toolbar {
                                    background-color: #F5FCFD;
                                    height: 35px;
                                    padding: 2px;
                                    display: flex;
                                    align-items: center;
                                }

                                .ql-snow.ql-toolbar button,
                                .ql-snow .ql-toolbar {
                                    width: 60px;
                                    font-size: 0.75rem;
                                    white-space: normal;
                                    padding: 4px;
                                }

                                .ql-list .ql-link .ql-image {
                                    width: 20px !important;
                                    font-size: 0.75rem;
                                    white-space: normal;
                                    padding: 4px;
                                }
                            </style>
                        </div>

                        @php

                            $groupedTasks = collect($tasks)->groupBy(function ($task) {
                                return $task['created_at']->locale('it')->isoFormat('MMMM YYYY');
                            });
                        @endphp

                        @foreach ($groupedTasks as $month => $monthTasks)
                            <div class="mt-8 mb-4 flex items-center">
                                <span
                                    class="bg-[#F5FCFD] text-[#10BDD4] px-3 py-1 border-[#E8E8E8] border-1 text-[13px] font-semibold ml-12">
                                    {{ $month }}
                                </span>
                                <div class="h-px bg-gray-300 flex-1"></div>
                            </div>

                            @foreach ($monthTasks as $task)
                                <div class="border w-full p-4 mb-6">
                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="flex h-6 w-6 items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                                            <flux:icon.user variant="micro" />
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 text-sm">
                                                <span>{{ $task['assignee'] }}</span>
                                                <div class="w-2 h-px bg-gray-400"></div>
                                                <span class="text-gray-500">{{ $task['cc'] }}</span>
                                            </div>
                                            <div class="flex items-center text-xs text-gray-600 mt-1">
                                                <span class="italic">ha scritto una nota</span>
                                                <div class="w-1 h-1 bg-gray-400 rounded-full mx-2"></div>
                                                <span>{{ \Carbon\Carbon::parse($task['created_at'])->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-base font-light text-gray-800">
                                        {{ $task['note'] }}
                                    </div>
                                </div>
                            @endforeach
                        @endforeach

                    </div>
                </flux:tab.panel>
            </flux:tab.group>
        </div>


    </div>
</div>
