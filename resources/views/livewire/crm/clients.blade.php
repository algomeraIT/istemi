<div
    class="absolute  top-[130px] left-[105px] right-[105px] w-[1710px] h-[880px] mt-[52px] bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100">
    <h2
        class="relative top-[1px] left-[50px] w-[56px] h-[29px] text-[24px] leading-[29px] font-bold text-[#232323] font-sans opacity-100">
        Clienti</h2>
    <!-- Add Lead Button -->
    <div class=" mt-[16px] w-full flex justify-between ">

        {{-- pulsante crea --}}
        <button wire:click="create"
            class="relative left-[50px] px-1 py-1 min-w-[56px] h-[32px] bg-[#10BDD4] rounded-[1px] text-white opacity-100 hover:bg-[#0da9be] transition duration-200">
            Crea
        </button>

        {{-- tab --}}
        <div class="flex border-gray-300 ml-[700px]" x-data="{ activeTab: @entangle('activeTab') }">
            <div
                class="top-[230px] left-[873px] w-[78px] h-[32px] bg-[#F5FCFD] border-[0.5px] border-[#10BDD4] rounded-tr-[1px] rounded-br-[1px] opacity-100">
                <button wire:click="setTab('list')"
                    class="flex w-[78px] h-[32px] text-[16px] m-[3px] text-[#B0B0B0] font-sans  opacity-100 focus:outline-none  transition-all duration-200 hover:cursor-pointer"
                    :class="{ 'border-cyan-400 text-cyan-400': activeTab === 'list' }">
                    <flux:icon.list-bullet class="w-[20px] ml-[10px] " /> Lista
                </button>
            </div>

            <div
                class="top-[230px] left-[873px] w-[101px] h-[32px] bg-[#F5FCFD] border-[0.5px] border-[#10BDD4] rounded-tr-[1px] rounded-br-[1px] opacity-100">
                <button wire:click="setTab('kanban')"
                    class="flex  w-[101px] h-[32px]   text-[16px] m-[3px] text-[#B0B0B0] font-sans  opacity-100 focus:outline-none  transition-all duration-200 hover:cursor-pointer"
                    :class="{ 'border-cyan-400 text-cyan-400': activeTab === 'kanban' }">
                    <flux:icon.squares-2x2 class="w-[20px] ml-[10px] " /> Kanban
                </button>
            </div>

        </div>
        {{-- filtro --}}

        <div class="flex space-x-4 ml-[100px]">
            <select wire:model.live="city"
                class="border-gray-200 border p-1 w-[150px] h-[32px] text-[16px] leading-[20px] text-[#B0B0B0] font-medium opacity-100">
                <option value="" selected>Tutti le sedi</option>
                @if($cities->isNotEmpty())
                @foreach ($cities as $city)
                <option value="{{ $city }}">{{ $city }}</option>
                @endforeach
                @else
                <option value="">Nessuna sede presente</option>
                @endif


            </select>

            {{-- <input type="date" wire:model.live="date" class="border-gray-300  p-2 " />--}}
            <select wire:model.live="status"
                class="border-gray-200 border p-1 w-[250px] h-[32px] text-[16px] leading-[20px] text-[#B0B0B0] font-medium opacity-100">
                <option value="">Tutti gli stati</option>
                <option value="0" class="bg-cyan-400 text-cyan-800">Call center</option>
                <option value="1" class="bg-purple-400 text-purple-800">Censimento</option>
            </select>

            {{-- <button wire:click="resetFilters" class="bg-gray-200 px-3 py-1  hover:cursor-pointer">
                Reset Filtri
            </button> --}}

            <div class="relative w-[200px]">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <flux:icon.magnifying-glass class="w-4 h-4 text-gray-300" />
                </span>

                <input type="text" wire:model.live="query" placeholder="Cerca..."
                    class="pl-9 border border-gray-200 h-[32px]  px-3 py-2 w-[200px] focus:outline-none focus:ring text-sm placeholder:text-gray-300 placeholder:font-extralight" />
            </div>

        </div>
    </div>


    <div class=" w-[1700px] ml-[65px] mt-[40px]">
        @if ($activeTab === 'list')
        @include('livewire.crm.client-list')
        @elseif ($activeTab === 'kanban')
        @include('livewire.crm.client-kanban')
        @endif
    </div>
    <!-- Pagination -->


    <!-- Modal for Adding/Editing Lead -->
    @if ($isOpen)
    @include('livewire.crm.client-modal')
    @endif
</div>