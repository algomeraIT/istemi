<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-white p-8 rounded shadow-lg">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold">Aggiungi attività</h2>
            <button wire:click="$dispatch('closeModal')" class="text-gray-500 hover:text-gray-700 text-sm">Chiudi</button>
        </div>

        <!-- Form -->
        <div class="space-y-4">
            <!-- Titolo attività -->
            <flux:field>
                <div class="flex items-center space-x-1 mb-1 text-xs text-gray-600">
                    <flux:icon.map-pin class="w-4 h-4" />
                    <flux:label class="text-xs">Titolo attività</flux:label>
                </div>
                <flux:input wire:model="title" />
                <flux:error name="title" />
            </flux:field>

            <!-- Assegnato a -->
            <flux:field>
                <div class="flex items-center space-x-1 mb-1 text-xs text-gray-600">
                    <flux:icon.at-symbol class="w-4 h-4" />
                    <flux:label class="text-xs">Assegnato a</flux:label>
                </div>
                <flux:input wire:model="assignee" />
                <flux:error name="assignee" />
            </flux:field>

            <!-- Conoscenza -->
            <flux:field>
                <div class="flex items-center space-x-1 mb-1 text-xs text-gray-600">
                    <flux:icon.at-symbol class="w-4 h-4" />
                    <flux:label class="text-xs">Conoscenza</flux:label>
                </div>
                <flux:input wire:model="cc" />
                <flux:error name="cc" />
            </flux:field>

            <!-- Data di scadenza -->
            <flux:field>
                <div class="flex items-center space-x-1 mb-1 text-xs text-gray-600">
                    <flux:icon.calendar class="w-4 h-4" />
                    <flux:label class="text-xs">Data di scadenza</flux:label>
                </div>
                <flux:input type="date" wire:model="expire" />
                <flux:error name="expire" />
            </flux:field>

            <!-- Note -->
            <flux:field>
                <div class="flex items-center space-x-1 mb-1 text-xs text-gray-600">
                    <flux:icon.document class="w-4 h-4" />
                    <flux:label class="text-xs">Note</flux:label>
                </div>
                <flux:textarea wire:model="note" rows="3" />
                <flux:error name="note" />
            </flux:field>

            <!-- Stato -->
            <flux:field>
                <div class="flex items-center space-x-1 mb-1 text-xs text-gray-600">
                    <flux:label class="text-xs">Stato</flux:label>
                </div>
                <flux:select wire:model="status">
                    <option value="">-- Seleziona stato --</option>
                    <option value="In attesa">In attesa</option>
                    <option value="Svolto">Svolto</option>
                </flux:select>
                <flux:error name="status" />
            </flux:field>

            <!-- Save Button -->
            <div class="pt-4">
                <button wire:click="create" class="px-4 py-2 bg-[#00C0D9] text-white rounded hover:bg-[#00A4B8] text-sm">
                    Assegna
                </button>
            </div>
        </div>
    </div>
</div>