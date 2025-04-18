<div class="ml-24 mr-24 relative top-14 overflow-auto ">
    <div class=" bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9 ">
        <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100">
            Lead
        </h2>
        <!-- Add Lead Button -->
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
                <select wire:model.live="status" class="pl-2.5 md:w-full xl:w-48 border-gray-200 border h-9 text-[16px] leading-[20px] text-[#B0B0B0] font-medium opacity-100 w-36">
                  <option value="">Tutti gli stati</option>
                  <option value="0" class="bg-cyan-400 text-cyan-800">Nuovo</option>
                  <option value="1" class="bg-purple-400 text-purple-800">Assegnato</option>
                  <option value="2" class="bg-red-400 text-red-800">Da riassegnare</option>
                </select>
              
                <input type="number" wire:model.live="year" 
                       class="md:w-full xl:w-80 border-gray-200  p-2.5 h-9 text-[#B0B0B0] border placeholder:font-medium placeholder:text-[16px] placeholder:leading-[20px] placeholder:text-[#B0B0B0] placeholder:opacity-100"
                       min="1900" max="2099" step="1" placeholder="Tutte le date di acquisizione" />
              
                <div class="relative ">
                    <span class="absolute inset-y-0 left-0 flex items-center pointer-events-none h-9 p-3.5">
                        <flux:icon.magnifying-glass class="w-4 h-4 text-gray-300" />
                    </span>
                    <input type="text" wire:model.live="query" placeholder="Cerca..."
                           class="md:w-full pl-9 border border-gray-200 h-9  focus:outline-none focus:ring text-sm placeholder:text-gray-300 placeholder:font-extralight" />
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
</div>