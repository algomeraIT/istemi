<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-white">
        <div class="flex-col justify-between items-start p-6 bg-white h-24">
            <div class="flex justify-between items-start p-6 bg-white ">
                <h2 class="text-2xl font-bold">Aggiungi attività</h2>
                <button wire:click="$dispatch('closeModal')" class="hover:cursor-pointer">Chiudi</button>
            </div>



            <!-- Title -->
            <div class="pl-10 pr-10 pb-4 pt-10">
                <label class="flex text-sm text-gray-600"><flux:icon.map-pin />Titolo attività</label>
                <input type="text" wire:model="title" class="w-full mt-1 border-gray-300 border-1 h-8" />
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Assegnatario -->
            <div class="pl-10 pr-10 pb-4">
                <label class="flex text-sm text-gray-600"><flux:icon.at-symbol />Assegnato a</label>
                <input type="text" wire:model="assignee" class="w-full mt-1 border-gray-300  border-1 h-8" />
                @error('assignee')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- CC -->
            <div class="pl-10 pr-10 pb-4">
                <label class="text-sm text-gray-600"><flux:icon.at-symbol />Conoscenza</label>
                <input type="text" wire:model="cc" class="w-full mt-1 border-gray-300  border-1 h-8" />
                @error('cc')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Scadenza -->
            <div class="pl-10 pr-10 pb-4">
                <label class="flex text-sm text-gray-600">
                    <flux:icon.calendar />Data di scadenza
                </label>
                <input type="date" wire:model="expire" class="w-full mt-1 border-gray-300  border-1 h-8" />
                @error('expire')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Note -->
            <div class="p-10">
                <label class="flex text-sm text-gray-600">
                    <flux:icon.document />Note
                </label>
                <textarea wire:model="note" class="w-full mt-1 border-gray-300  border-1 h-8" rows="3"></textarea>
                @error('note')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Stato -->
            <div class="pl-10 pr-10 pb-4">
                <label class="text-sm text-gray-600">Stato</label>
                <select wire:model="status" class="w-full mt-1 border-gray-300  border-1 h-8">
                    <option value="">-- Seleziona stato --</option>
                    <option value="In attesa">In attesa</option>
                    <option value="Svolto">Svolto</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Save Button -->
            <div class="text-left pl-10 pr-10 pb-4">
                <button wire:click="create" class="px-4 py-2 bg-[#00C0D9] text-white  hover:bg-blue-700">
                    Assegna
                </button>
            </div>
        </div>
    </div>
</div>
