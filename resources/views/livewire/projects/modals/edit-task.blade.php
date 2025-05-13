<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-gray-50">
        <div class="flex justify-between items-start p-6 bg-[#F5FCFD] h-24">
            <h2 class="text-2xl font-bold">Modifica Task</h2>
            <button wire:click="$dispatch('closeModal')" class="hover:cursor-pointer">Chiudi</button>
        </div>

        <div class="p-6 space-y-4 bg-white">
            <div>
                <label class="text-sm text-gray-600">Titolo</label>
                <input type="text" wire:model.defer="title"
                    class="w-full border border-gray-300 rounded p-2 text-sm">
            </div>

            <div>
                <label class="text-sm text-gray-600">Assegnato a</label>
                <input type="text" wire:model.defer="assignee"
                    class="w-full border border-gray-300 rounded p-2 text-sm">
            </div>

            <div>
                <label class="text-sm text-gray-600">Scadenza</label>
                <input type="date" wire:model.defer="expire"
                    class="w-full border border-gray-300 rounded p-2 text-sm">
            </div>

            <div>
                <label class="text-sm text-gray-600">Nota</label>
                <textarea wire:model.defer="note"
                    class="w-full border border-gray-300 rounded p-2 text-sm h-28"></textarea>
            </div>

            <div class="pt-4">
                <button wire:click="save"
                    class="px-4 py-2 bg-[#10BDD4] text-white rounded hover:bg-[#0caac0] transition text-sm">
                    Salva
                </button>
            </div>
        </div>
    </div>
</div>