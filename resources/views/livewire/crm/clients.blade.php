<div class="ml-24 mr-24 relative top-14">

    <div class=" bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">
        <h2 class="relative text-[24px] mb-5 font-bold text-[#232323] font-sans opacity-100">
            Clienti</h2>
        <!-- Add Lead Button -->
        <div class="flex mb-5">

            {{-- pulsante crea --}}

            <div class=" w-1/3 ">
                <flux:button wire:click="create"
                    class=" p-2.5! bg-[#10BDD4]! rounded-none! text-lg! text-white! opacity-100 hover:bg-[#0da9be]! transition duration-200">
                    Crea
                </flux:button>
            </div>

            {{-- tab --}}
            <div class="lg:xl:flex md:block sm:block border-gray-300 w-1/3 h-8  justify-center"
                x-data="{ activeTab: @entangle('activeTab') }">
                <div
                    class="  bg-[#F5FCFD] border-[0.5px] border-[#10BDD4] rounded-tr-[1px] rounded-br-[1px] opacity-100">
                    <button wire:click="setTab('list')"
                        class="flex w-[78px] h-[32px] text-[16px] m-[3px] text-[#B0B0B0] font-sans  opacity-100 focus:outline-none  transition-all duration-200 hover:cursor-pointer"
                        :class="{ 'border-cyan-400 text-cyan-400': activeTab === 'list' }">
                        <flux:icon.list-bullet class="w-[20px] ml-[10px] " /> Lista
                    </button>
                </div>

                <div
                    class="  bg-[#F5FCFD] border-[0.5px] border-[#10BDD4] rounded-tr-[1px] rounded-br-[1px] opacity-100">
                    <button wire:click="setTab('kanban')"
                        class="flex  w-[101px] h-[32px]   text-[16px] m-[3px] text-[#B0B0B0] font-sans  opacity-100 focus:outline-none  transition-all duration-200 hover:cursor-pointer"
                        :class="{ 'border-cyan-400 text-cyan-400': activeTab === 'kanban' }">
                        <flux:icon.squares-2x2 class="w-[20px] ml-[10px] " /> Kanban
                    </button>
                </div>

            </div>
            {{-- filtro --}}

            <div class="lg:xl:flex md:block sm:block space-x-4 w-1/3">
                <select wire:model.live="city"
                    class="border-gray-200 border p-1  h-8 text-[16px] w-32  text-[#B0B0B0] font-medium opacity-100">
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
                    class="border-gray-200 border p-1 h-8 text-[16px] text-[#B0B0B0] font-medium opacity-100">
                    <option value="">Tutte le etichette</option>
                    <option value="0" class="bg-cyan-400 text-cyan-800">Call center</option>
                    <option value="1" class="bg-purple-400 text-purple-800">Censimento</option>
                </select>

                {{-- <button wire:click="resetFilters" class="bg-gray-200 px-3 py-1  hover:cursor-pointer">
                    Reset Filtri
                </button> --}}

                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pointer-events-none h-5 p-4">
                        <flux:icon.magnifying-glass class="w-4 h-4 text-gray-300" />
                    </span>

                    <input type="text" wire:model.live="query" placeholder="Cerca..."
                        class="pl-9 border border-gray-200 h-8 w-40  px-3 py-2 focus:outline-none focus:ring text-sm placeholder:text-gray-300 placeholder:font-extralight" />
                </div>

            </div>
        </div>


        <div class=" ">
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
</div>