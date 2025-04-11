<div class="container p-4">
    <h2 class="text-2xl font-bold text-cyan-600 mb-4 mt-24">Progetti</h2>
    <!-- Add Lead Button -->
    <button wire:click="create" class="mb-4 px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-800 hover:cursor-pointer">
        Crea
    </button>

   <div class="mb-4 flex space-x-4">
     {{--   <select wire:model.live="status" class="border-gray-300 rounded p-2">
            <option value="">Tutti gli stati</option>
            @foreach ($statuses as $status)
                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
            @endforeach
        </select> --}}

        {{-- <input type="date" wire:model.live="date" class="border-gray-300 rounded p-2 " /> --}}

{{--  <button wire:click="resetFilters" class="bg-gray-200 px-3 py-1 rounded hover:cursor-pointer">
    Reset Filtri
</button> --}}

  {{--   <form wire:submit="search">
        <input class=" border-2" type="text" wire:model="query">
        <button type="submit" class="hover:cursor-pointer">Cerca</button>
    </form> --}}

    </div>
    <div class="flex border-gray-300 pl-[50%]" x-data="{ activeTab: @entangle('activeTab') }">
        <button wire:click="setTab('list')"
            class="flex px-4 py-2 font-semibold focus:outline-none border-b-2 transition-all duration-200 hover:cursor-pointer"
            :class="{ 'border-cyan-400 text-cyan-400': activeTab === 'list' }">
            <flux:icon.list-bullet /> Lista
        </button>

        <button wire:click="setTab('kanban')"
            class="flex px-4 py-2 font-semibold focus:outline-none border-b-2 transition-all duration-200 hover:cursor-pointer"
            :class="{ 'border-cyan-400 text-cyan-400': activeTab === 'kanban' }">
        <flux:icon.squares-2x2 />  Kanban
        </button>
    </div>

    <div class="p-4 w-screen">
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

