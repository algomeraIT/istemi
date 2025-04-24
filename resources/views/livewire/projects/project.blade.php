<div class="ml-24 mr-24 relative top-14 overflow-auto ">
    <div class=" bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9 ">
        <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100">
            Progetti
        </h2>

        <div class="flex justify-between space-x-3 ">

            {{-- pulsante crea --}}
            <div class=" xl:lg:w-3/7 md:sm:w-1/3 mb-8 ">
                <flux:button wire:click="create"
                    class=" p-2.5! bg-[#10BDD4]! rounded-none! text-lg! text-white! opacity-100 hover:bg-[#0da9be]! transition duration-200">
                    Crea
                </flux:button>
            </div>

            {{-- tab --}}
            @include('livewire.crm.utilities.tab')
            {{-- filtro --}}
            <div class="flex md:flex-col xl:flex-row  xl:lg:w-3/7 md:sm:w-1/3 space-x-4 justify-center">
                <select wire:model.live="query_project" class="pl-2.5 md:w-full xl:w-48 border-gray-200 border h-9 text-[16px] leading-[20px] text-[#B0B0B0] font-medium opacity-100 w-36">
                    <option value="">Tutti i progetti</option>
                    <option value="Pubblico">Pubblico</option>
                    <option value="Privato">Privato</option>
                  </select>
                 
                <div class="flex flex-col md:flex-row gap-4 items-start">
                    <div class="w-full max-w-sm ">
                        <label for="responsible‐combo" class="sr-only">Filtra referente</label>
                        <input id="responsible‐combo" type="text" list="responsibles-list" wire:model.live="query"
                            placeholder="Tutti i referenti"
                            class="pl-2.5 md:w-full xl:w-48 border-gray-200 border h-9 p-1.5 text-[16px] leading-[20px] text-[#B0B0B0] font-medium opacity-100 w-36" />
                        <datalist id="responsibles-list" class="pl-2.5">
                            <option value="">Tutti i referenti</option>
                            @foreach ($responsibles as $resp)
                                <option value="{{ $resp }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <select wire:model.live="query_phase"
                    class="pl-2.5 md:w-full xl:w-48 border-gray-200 border h-9 text-[16px] leading-[20px] text-[#B0B0B0] font-medium opacity-100 w-36">
                    <option value="">Tutte le fasi</option>
                    <option value="0" class="bg-cyan-400 text-cyan-800">Non definito</option>
                    <option value="1" class="bg-purple-400 text-purple-800">Avvio</option>
                    <option value="2" class="bg-red-400 text-red-800">Pianificazione</option>
                    <option value="1" class="bg-purple-400 text-purple-800">Esecuzione</option>
                    <option value="2" class="bg-red-400 text-red-800">Verifica</option>
                    <option value="2" class="bg-red-400 text-red-800">Chiusura</option>

                </select>

                <div class="relative ">
            
                        <div x-data="{ searchQuery: @entangle('search').live }">
                            <div class="mb-4">
                                <span class="absolute inset-y-0 left-0 flex items-center pointer-events-none h-9 p-3.5">
                                    <flux:icon.magnifying-glass class="w-4 h-4 text-gray-300" />
                                </span>
                                <input type="text" x-model.live="searchQuery" placeholder="Cerca" class="md:w-full pl-9 border border-gray-200 h-9  focus:outline-none focus:ring text-sm placeholder:text-gray-300 placeholder:font-extralight" />
                            </div>
                        </div>
                </div>
            </div>
        </div>



        <div class=>
            @if ($activeTab === 'list')
                @include('livewire.projects.project_list')
            @elseif ($activeTab === 'kanban')
                @include('livewire.projects.project_kanban')
            @endif
        </div>


        <!-- Modal for Adding/Editing Lead -->
        @if ($isOpen)
            @include('livewire.projects.project_modal')
        @endif
    </div>
</div>
