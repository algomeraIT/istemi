<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-gray-50">
        <div class="flex justify-between items-start p-6 bg-[#F5FCFD] h-24">
            <h2 class="text-2xl font-bold">Modifica progetto</h2>
            <button wire:click="$dispatch('closeModal')" class="hover:cursor-pointer">Chiudi</button>
        </div>

    <form wire:submit.prevent="update" class="p-10">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nome Progetto</label>
            <input type="text" wire:model.defer="form.name_project" class="w-full border p-2 rounded" />
            @error('form.name_project') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nome Cliente</label>
            <input type="text" wire:model.defer="form.client_name" class="w-full border p-2 rounded" />
            @error('form.client_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Tipo Cliente</label>
            <input type="text" wire:model.defer="form.client_type" class="w-full border p-2 rounded" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Budget Totale</label>
            <input type="number" wire:model.defer="form.total_budget" class="w-full border p-2 rounded" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Stato</label>
            <input type="text" wire:model.defer="form.status" class="w-full border p-2 rounded" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Obiettivi</label>
            <textarea wire:model.defer="form.goals" class="w-full border p-2 rounded"></textarea>
        </div>

        <!-- Add more fields as needed -->

        <div class="flex justify-end">
            <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded hover:bg-cyan-700">
                Salva modifiche
            </button>
        </div>
    </form>
</div>