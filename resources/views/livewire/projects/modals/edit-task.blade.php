<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-white shadow-xl rounded-lg">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold text-gray-800">Modifica Fase</h2>
            <button wire:click="$dispatch('closeModal')" class="text-sm text-gray-500 hover:text-gray-700">
                Chiudi
            </button>
        </div>

        <!-- Form -->
        <div class="p-6 space-y-5">

            <!-- Assegnato a -->
            <flux:field>
                <flux:label>Assegnato a</flux:label>
                <flux:input wire:model.defer="id_user" />
                <flux:error name="user" />
            </flux:field>

            <!-- Stato -->
            <flux:field>
                <flux:label>Stato</flux:label>
                <flux:select wire:model.defer="status">
                    <option value="">-- Seleziona stato --</option>
                    <option value="In attesa">In attesa</option>
                    <option value="Svolto">Svolto</option>
                </flux:select>
                <flux:error name="status" />
            </flux:field>

            <!-- Save -->
            <div class="pt-4">
                <button wire:click="save"
                    class="w-full px-4 py-2 bg-[#10BDD4] text-white rounded hover:bg-[#0caac0] transition text-sm">
                    Salva
                </button>
            </div>
        </div>
    </div>
</div>