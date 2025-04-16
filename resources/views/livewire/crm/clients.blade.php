<div class="ml-24 mr-24 relative top-14 overflow-auto">
    <div class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">
        <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100">
            Clienti
        </h2>
        <!-- Row for Create Button, Tab, and Filters -->
        <div class="flex justify-between space-x-3">
            {{-- Create Button --}}
            <div class="xl:lg:w-3/7 md:sm:w-1/3 mb-8">
                <flux:button wire:click="create"
                    class="p-2.5! bg-[#10BDD4]! rounded-none! text-lg! text-white! opacity-100 hover:bg-[#0da9be]! transition duration-200">
                    Crea
                </flux:button>
            </div>

            {{-- Tab --}}
            @include('livewire.crm.utilities.tab')

            {{-- Filters --}}
            <div class="flex md:flex-col xl:flex-row xl:lg:w-3/7 md:sm:w-1/3 space-x-4 justify-center">
                <select wire:model.live="city"
                    class="md:w-full xl:w-48 border-gray-200 border h-9 text-[16px] leading-[20px] text-[#B0B0B0] font-medium opacity-100 w-32">
                    <option value="" selected>Tutti le sedi</option>
                    @if($cities->isNotEmpty())
                        @foreach($cities as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    @else
                        <option value="">Nessuna sede presente</option>
                    @endif
                </select>

                <select wire:model.live="status"
                    class="md:w-full xl:w-48 border-gray-200 border h-9 text-[16px] leading-[20px] text-[#B0B0B0] font-medium opacity-100">
                    <option value="">Tutte le etichette</option>
                    <option value="0" class="bg-cyan-400 text-cyan-800">Call center</option>
                    <option value="1" class="bg-purple-400 text-purple-800">Censimento</option>
                </select>

                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pointer-events-none h-9 p-3.5">
                        <flux:icon.magnifying-glass class="w-4 h-4 text-gray-300" />
                    </span>
                    <input type="text" wire:model.live="query" placeholder="Cerca..."
                           class="md:w-full pl-9 border border-gray-200 h-9 focus:outline-none focus:ring text-sm placeholder:text-gray-300 placeholder:font-extralight" />
                </div>
            </div>
        </div>

        <!-- Content Area -->
        @if ($activeTab === 'list')
            <div>
                @include('livewire.crm.client-list')
            </div>
        @elseif ($activeTab === 'kanban')
            <div>
                @include('livewire.crm.client-kanban')
            </div>
        @endif

        <!-- Modal for Adding/Editing Client -->
        @if ($isOpen)
            @include('livewire.crm.client-modal')
        @endif
    </div>
</div>