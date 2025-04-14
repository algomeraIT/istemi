<div class=" bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100">
    <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100">
        Lead
    </h2>
    <!-- Add Lead Button -->
    <div class="flex justify-between space-x-3 ">

        {{-- pulsante crea --}}
        <div class=" w-1/3 mb-8 ">
            <flux:button wire:click="create"
                class=" p-2.5! bg-[#10BDD4]! rounded-none! text-lg! text-white! opacity-100 hover:bg-[#0da9be]! transition duration-200">
                Crea
            </flux:button>
        </div>

        {{-- tab --}}
        <div class="flex w-1/3 border-gray-300 justify-center" x-data="{ activeTab: @entangle('activeTab') }">
            <div
                class=" h-7 bg-[#F5FCFD] border-[0.5px] border-[#10BDD4] rounded-tr-[1px] rounded-br-[1px] opacity-100">
                <button wire:click="setTab('list')"
                    class="flex w-[78px] h-7 text-[16px] m-[3px] text-[#B0B0B0] font-sans  opacity-100 focus:outline-none  transition-all duration-200 hover:cursor-pointer"
                    :class="{ 'border-cyan-400 text-cyan-400': activeTab === 'list' }">
                    <flux:icon.list-bullet class="w-[20px] ml-[10px] " /> Lista
                </button>
            </div>

            <div
                class=" h-7 bg-[#F5FCFD] border-[0.5px] border-[#10BDD4] rounded-tr-[1px] rounded-br-[1px] opacity-100">
                <button wire:click="setTab('kanban')"
                    class="flex  w-[101px] h-7   text-[16px] m-[3px] text-[#B0B0B0] font-sans  opacity-100 focus:outline-none  transition-all duration-200 hover:cursor-pointer"
                    :class="{ 'border-cyan-400 text-cyan-400': activeTab === 'kanban' }">
                    <flux:icon.squares-2x2 class="w-[20px] ml-[10px] " /> Kanban
                </button>
            </div>

        </div>
        {{-- filtro --}}
        <div class="flex space-x-4 w-1/3">
            <select wire:model.live="status"
                class="border-gray-200 border h-7 text-[16px] leading-[20px] text-[#B0B0B0] font-medium opacity-100">
                <option value="">Tutti gli stati</option>
                <option value="0" class="bg-cyan-400 text-cyan-800">Nuovo</option>
                <option value="1" class="bg-purple-400 text-purple-800">Assegnato</option>
                <option value="2" class="bg-red-400 text-red-800">Da riassegnare</option>
            </select>

            {{-- <input type="date" wire:model.live="date" class="border-gray-300  p-2 " />--}}
            <input type="number" wire:model.live="year"
                class="border-gray-200 w-3xl h-7 text-[#B0B0B0] border placeholder:font-medium" min="1900" max="2099"
                step="1" placeholder="Tutte le date di acquisizione" />

            {{-- <button wire:click="resetFilters" class="bg-gray-200 px-3 py-1  hover:cursor-pointer">
                Reset Filtri
            </button> --}}

            <div class="relative w-full">
                <span class="absolute inset-y-0 left-0 flex items-center pointer-events-none h-5 p-3.5">
                    <flux:icon.magnifying-glass class="w-4 h-4 text-gray-300" />
                </span>

                <input type="text" wire:model.live="query" placeholder="Cerca..."
                    class="pl-9 border border-gray-200 h-7  focus:outline-none focus:ring text-sm placeholder:text-gray-300 placeholder:font-extralight" />
            </div>

        </div>
    </div>


    @if ($activeTab === 'list')
    <div class=" ">
        @include('livewire.crm.lead_list')
        @elseif ($activeTab === 'kanban')
        <div class=" ">
            @include('livewire.crm.lead_kanban')
            @endif
        </div>



        @if ($isOpen)
        @include('livewire.crm.lead_modal')
        @endif

        @if ($isOpenShow)
        @include('livewire.crm.lead-detail')
        @endif
    </div>
</div>