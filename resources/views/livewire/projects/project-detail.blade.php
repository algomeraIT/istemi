<div>
    @section('content')
        <div class="container mx-auto pt-2">
            <div class="flex flex-col lg:flex-row px-6 lg:px-24">
                <!-- Left Section: Referents -->
                <div class="w-full p-6 bg-white">
                    <div class="mx-auto my-3">
                        @include('livewire.general.goback')
                    </div>
                    <div class="w-auto flex flex-row flex-nowrap justify-between items-baseline">
                        <flux:tab.group class="bg-white  p-2 w-[80%]">

                            <flux:tabs class="flex 2xl:flex-nowrap flex-wrap gap-2 align-middle border-none">
                                <flux:tab data-variant="detail" name="task">Task</flux:tab>
                                <flux:tab data-variant="detail" name="document">Documenti</flux:tab>
                                <flux:tab data-variant="detail" name="note">Note</flux:tab>
                                <flux:tab data-variant="detail" name="data-sheet">Scheda tecnica</flux:tab>
                            </flux:tabs>

                            <flux:tab.panel name="task">


                                <flux:tab.group class=" p-2 ">

                                    <flux:tabs variant="segmented">
                                        <flux:tab data-variant="detail" name="list">Lista</flux:tab>
                                        <flux:tab data-variant="detail" name="kanban">Kanban</flux:tab>
                                    </flux:tabs>

                                    <flux:tab.panel name="list">
                                        <div>
                                            @if ($this->projectStart)
                                                <div x-data="{ open: false }" class=" w-6xl bg-white flex flex-col">

                                                    <!-- Collapsible Header -->
                                                    <div @click="open = !open"
                                                        class="cursor-pointer flex items-center justify-between px-6 py-4 shadow-md">
                                                        <h2 class="text-purple-700 text-xl font-semibold">Avvio progetto
                                                        </h2>

                                                        <!-- Arrow Icon -->
                                                        <svg :class="open ? 'rotate-90' : 'rotate-0'"
                                                            class="transition-transform duration-300 w-6 h-6 text-purple-700"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </div>

                                                    <!-- Collapsible Body -->
                                                    <div x-show="open" x-transition
                                                        class="flex-1 px-6 py-4 overflow-auto text-purple-700 text-lg bg-white">
                                                        <flux:table>
                                                            <flux:table.columns>
                                                                <flux:table.column>Task</flux:table.column>
                                                                <flux:table.column>
                                                                    Attività</flux:table.column>
                                                                <flux:table.column>
                                                                    Assegnato a</flux:table.column>
                                                                <flux:table.column>
                                                                    Stato</flux:table.column>
                                                                <flux:table.column>
                                                                    Azioni</flux:table.column>
                                                            </flux:table.columns>
                                                            <flux:table.rows>
                                                                @foreach ($this->projectStart as $start)
                                                                    <flux:table.row>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            {{ $start->contract_ver ? 'Verifica contratto' : '' }}
                                                                        </flux:table.cell>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            +
                                                                        </flux:table.cell>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            {{ $start->user_contract_ver }}
                                                                        </flux:table.cell>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            {{ $start->status_contract_ver ? 'Svolto' : 'In attesa' }}
                                                                        </flux:table.cell>
                                                                        <flux:table.cell>
                                                                            <flux:button
                                                                                wire:click="goToDetail({{ $start->id }})"
                                                                                variant="ghost" data-variant="ghost"
                                                                                data-color="teal" data-rounded
                                                                                icon="eye" size="sm" />
                                                                            <flux:button
                                                                                wire:click="edit({{ $start->id }})"
                                                                                variant="ghost" data-variant="ghost"
                                                                                data-color="gray" data-rounded
                                                                                icon="pencil" size="sm" />
                                                                            <flux:button
                                                                                wire:click="delete({{ $start->id }})"
                                                                                wire:confirm="Sei sicuro di voler eliminare questo task?"
                                                                                variant="ghost" data-variant="ghost"
                                                                                data-color="red" data-rounded icon="trash"
                                                                                size="sm" />
                                                                        </flux:table.cell>
                                                                    </flux:table.row>
                                                                    <flux:table.row>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            {{ $start->user_contract_ver ? 'Verifica contratto' : '' }}
                                                                        </flux:table.cell>
                                                                    </flux:table.row>
                                                                    <flux:table.row>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            {{ $start->user_contract_ver ? 'Verifica contratto' : '' }}
                                                                        </flux:table.cell>
                                                                    </flux:table.row>
                                                                    <flux:table.row>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            {{ $start->user_contract_ver ? 'Verifica contratto' : '' }}
                                                                        </flux:table.cell>
                                                                    </flux:table.row>
                                                                    <flux:table.row>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            {{ $start->user_contract_ver ? 'Verifica contratto' : '' }}
                                                                        </flux:table.cell>
                                                                    </flux:table.row>
                                                                    <flux:table.row>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            {{ $start->user_contract_ver ? 'Verifica contratto' : '' }}
                                                                        </flux:table.cell>
                                                                    </flux:table.row>
                                                                    <flux:table.row>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            {{ $start->user_contract_ver ? 'Verifica contratto' : '' }}
                                                                        </flux:table.cell>
                                                                    </flux:table.row>
                                                                    <flux:table.row>
                                                                        <flux:table.cell class="whitespace-nowrap">
                                                                            {{ $start->user_contract_ver ? 'Verifica contratto' : '' }}
                                                                        </flux:table.cell>
                                                                    </flux:table.row>
                                                                @endforeach
                                                            </flux:table.rows>
                                                        </flux:table>



                                                    </div>

                                                </div>
                                            @endif
                                        </div>

                                    </flux:tab.panel>
                                    <flux:tab.panel name="kanban">
                                        kanban
                                    </flux:tab.panel>


                                </flux:tab.group>
                            </flux:tab.panel>


                        </flux:tab.group>



                        <flux:select wire:model.live="query_project" data-variant="status">
                            <flux:select.option value="">Tutti gli stati</flux:select.option>
                            <flux:select.option value="Pubblico">Pubblico</flux:select.option>
                            <flux:select.option value="Privato">Privato</flux:select.option>
                        </flux:select>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>
