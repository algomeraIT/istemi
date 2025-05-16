<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <!-- Left Section: Referents -->
    <div class="w-1/3  bg-gray-50">
        <div class="flex flex-row justify-between align-top items-start mx-auto bg-[#F5FCFD] h-24 p-6">
            <h2 class="text-2xl font-bold text-left">Task</h2>
            <button wire:click="$dispatch('closeModal')" class="hover:cursor-pointer ">Chiudi</button>
        </div>


        <form wire:submit.prevent="save" class="space-y-4 p-14 w-full">

            <div>
                <label class="block text-sm font-medium text-gray-700">Titolo</label>
                <input type="text" wire:model="title" class="w-full border border-gray-300 p-2 rounded">
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Assegnato a</label>
                <input type="text" wire:model="assignee" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">In CC</label>
                <input type="text" wire:model="cc" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Scadenza</label>
                <input type="date" wire:model="expire" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nota</label>
                <textarea wire:model="note" class="w-full border border-gray-300 p-2 rounded"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Stato</label>
                <select wire:model="status" class="w-full border border-gray-300 p-2 rounded">
                    <option value="In attesa">In attesa</option>
                    <option value="Svolto">Svolto</option>
                </select>
            </div>

            <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded">Salva</button>
        </form>
    </div>
</div>
