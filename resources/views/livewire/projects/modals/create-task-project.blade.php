<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-gray-50">
        <div class="flex-col justify-between items-start p-6 bg-[#F5FCFD] h-24">
            <div class="flex justify-between items-start p-6 bg-[#F5FCFD] h-24">
                <h2 class="text-2xl font-bold">Crea nuovo Task</h2>
                <button wire:click="$dispatch('closeModal')" class="hover:cursor-pointer">Chiudi</button>
            </div>
    

            <!-- Title -->
            <div>
                <label class="text-sm text-gray-600">Titolo</label>
                <input type="text" wire:model="title" class="w-full mt-1 border-gray-300 rounded shadow-sm" />
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Assegnatario -->
            <div>
                <label class="text-sm text-gray-600">Assegnato a</label>
                <input type="text" wire:model="assignee" class="w-full mt-1 border-gray-300 rounded shadow-sm" />
                @error('assignee')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- CC -->
            <div>
                <label class="text-sm text-gray-600">In copia (CC)</label>
                <input type="text" wire:model="cc" class="w-full mt-1 border-gray-300 rounded shadow-sm" />
                @error('cc')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Scadenza -->
            <div>
                <label class="text-sm text-gray-600">Data di scadenza</label>
                <input type="date" wire:model="expire" class="w-full mt-1 border-gray-300 rounded shadow-sm" />
                @error('expire')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Note -->
            <div>
                <label class="text-sm text-gray-600">Note</label>
                <textarea wire:model="note" class="w-full mt-1 border-gray-300 rounded shadow-sm" rows="3"></textarea>
                @error('note')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Stato -->
            <div>
                <label class="text-sm text-gray-600">Stato</label>
                <select wire:model="status" class="w-full mt-1 border-gray-300 rounded shadow-sm">
                    <option value="">-- Seleziona stato --</option>
                    <option value="In attesa">In attesa</option>
                    <option value="Svolto">Svolto</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Save Button -->
            <div class="text-right">
                <button wire:click="create" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Salva
                </button>
            </div>
        </div>
    </div>
</div>
