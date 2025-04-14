<div class="ml-24 mr-24 relative top-14">
<div class=" bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">
    <h2 class=" text-[24px]  font-bold text-[#232323] font-sans opacity-100">
        Contatti</h2>
    <!-- Add Lead Button -->
    <div class="flex  w-full">

        {{-- pulsante crea --}}
        {{-- <button wire:click="create"
            class="relative left-[50px] px-1 py-1 min-w-[56px] h-[32px] bg-[#10BDD4] rounded-[1px] text-white opacity-100 hover:bg-[#0da9be] transition duration-200">
            Crea
        </button> --}}

        <div class="w-1/3">
        </div>
        {{-- tab --}}
        <div class="lg:xl:flex md:block sm:block w-1/3 border-gray-300 justify-center"
            x-data="{ activeTab: @entangle('activeTab') }">
            <div
                class="top-[230px] left-[873px] lg:xl:w-28  md:sm:w-40 h-8 bg-[#F5FCFD] border-[0.5px] border-[#10BDD4] rounded-tr-[1px] rounded-br-[1px] opacity-100">
                <button wire:click="setTab('list')"
                    class="flex w-[78px] h-7 text-[16px] m-[3px] text-[#B0B0B0] font-sans  opacity-100 focus:outline-none  transition-all duration-200 hover:cursor-pointer"
                    :class="{ 'border-cyan-400 text-cyan-400': activeTab === 'list' }">
                    <flux:icon.list-bullet class="w-[20px] ml-[10px] " /> Lista
                </button>
            </div>

            <div
                class=" h-8 lg:xl:w-28  md:sm:w-40 bg-[#F5FCFD] border-[0.5px] border-[#10BDD4] rounded-tr-[1px] rounded-br-[1px] opacity-100">
                <button wire:click="setTab('kanban')"
                    class="flex  w-[101px] h-7   text-[16px] m-[3px] text-[#B0B0B0] font-sans  opacity-100 focus:outline-none  transition-all duration-200 hover:cursor-pointer"
                    :class="{ 'border-cyan-400 text-cyan-400': activeTab === 'kanban' }">
                    <flux:icon.squares-2x2 class="w-[20px] ml-[10px] " /> Kanban
                </button>
            </div>

        </div>
        {{-- filtro --}}
        <div class="flex  md:block sm:block w-1/3  space-x-4 justify-end">
            <select wire:model.live="status"
                class="border-gray-200 border h-7 text-[16px] leading-[20px] text-[#B0B0B0] font-medium opacity-100">
                <option value="">Tutti gli stati</option>
                <option value="1" class="text-[#FEC106]">In contatto</option>
                <option value="0" class="text-[#6C757D]">Non idoneo</option>
            </select>

            {{-- <input type="date" wire:model.live="date" class="border-gray-300  p-2 " />--}}
            <input type="number" wire:model.live="year"
                class="border-gray-200 xl:w-60 lg:w-52 md:w-40 sm:w-[90%]  h-7 text-[#B0B0B0] border placeholder:font-medium" min="1900"
                max="2099" step="1" placeholder="Tutte le date di acquisizione" />

            {{-- <button wire:click="resetFilters" class="bg-gray-200 px-3 py-1  hover:cursor-pointer">
                Reset Filtri
            </button> --}}

            <div class="relative xl:w-40 lg:w-32 md:w-40 sm:w-36 ">
                <span class="absolute inset-y-0 left-0 flex items-center pointer-events-none h-5 p-3.5">
                    <flux:icon.magnifying-glass class="w-4 h-4 text-gray-300" />
                </span>

                <input type="text" wire:model.live="query" placeholder="Cerca..."
                    class="pl-9 border border-gray-200 h-7 sm:w-[90%] focus:outline-none focus:ring text-sm placeholder:text-gray-300 placeholder:font-extralight" />
            </div>

        </div>
    </div>

    <div class="">
        @if ($activeTab === 'list')
        @include('livewire.crm.contact-list')
        @elseif ($activeTab === 'kanban')
        @include('livewire.crm.contact-kanban')
        @endif
    </div>


    <!-- Modal for Adding/Editing Lead -->
    @if ($isOpen)
    @include('livewire.crm.contact-modal')
    @endif
</div>
</div>