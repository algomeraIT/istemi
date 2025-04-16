<div class="flex  xl:lg:md:w-1/7 sm:1/3 border-gray-300 justify-center"
x-data="{ activeTab: @entangle('activeTab') }">
<div
    class=" h-9 border-[0.5px] border-[#10BDD4] opacity-100">
    <button wire:click="setTab('list')"
        class="flex w-[78px] h-8 text-[16px] items-center text-[#B0B0B0] font-sans  opacity-100 focus:outline-none  transition-all duration-200 hover:cursor-pointer"
        :class="{ 'border-cyan-400 text-cyan-400 bg-[#F5FCFD] ': activeTab === 'list' }">
        <flux:icon.list-bullet class="w-[20px] ml-[10px] " /> Lista
    </button>
</div>

<div
    class=" h-9 border-[0.5px] border-[#10BDD4]  opacity-100">
    <button wire:click="setTab('kanban')"
        class="flex  w-[101px] h-8   text-[16px] items-center text-[#B0B0B0] font-sans  opacity-100 focus:outline-none  transition-all duration-200 hover:cursor-pointer"
        :class="{ 'border-cyan-400 text-cyan-400 bg-[#F5FCFD] ': activeTab === 'kanban' }">
        <flux:icon.squares-2x2 class="w-[20px] ml-[10px] " /> Kanban
    </button>
</div>
</div>