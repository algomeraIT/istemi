<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-white p-8 flex flex-col space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Scrivi nota</h2>
            <button wire:click="$dispatch('closeModal')" class="text-gray-500 text-sm hover:text-gray-700">
                Chiudi
            </button>
        </div>

        <!-- Editor -->
        <div class="space-y-2">
            <label class="text-xs flex items-center gap-2 text-gray-500">
                <flux:icon.clipboard class="w-4 h-4" />
                Nota
            </label>

            <flux:editor
                wire:model.defer="note"
                placeholder="Scrivi qualcosa…"
                class="border border-gray-200 bg-white rounded min-h-[200px]"
            />
        </div>

        <!-- Action Buttons -->
        <div class="pt-4">
            <button
                wire:click="saveNote"
                class="px-4 py-2 bg-[#00C0D9] text-white rounded hover:bg-[#0caac0] transition text-sm">
                Scrivi
            </button>
        </div>
    </div>
</div>