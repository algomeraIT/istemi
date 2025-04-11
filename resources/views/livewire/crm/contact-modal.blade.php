<div class="fixed inset-y-0 right-0 w-1/3 bg-white shadow-lg p-6 overflow-y-auto">
    <div class="bg-white p-6 rounded-lg shadow-lg h-full">
        <h3 class="text-xl font-semibold mb-4">{{ $lead_id ? 'Modifica Contatto' : 'Crea Contatto' }}</h3>

        <label class="block text-sm font-small">Ragione Sociale</label>
        <input type="text" wire:model="company_name" class="w-full border rounded p-2 mb-2">

        <label class="block text-sm font-small">Telefono</label>
        <input type="email" wire:model="first_telephone" class="w-full border rounded p-2 mb-2">

        <label class="block text-sm font-small">Email</label>
        <input type="email" wire:model="email" class="w-full border rounded p-2 mb-2">

        <div class="flex justify-end mt-4">
            <button wire:click="closeModal"
                class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 hover:cursor-pointer">
                Annulla
            </button>
            <button wire:click="store"
                class="px-4 py-2 bg-cyan-400 text-white rounded hover:bg-cyan-500 ml-2 hover:cursor-pointer">
                Salva
            </button>
        </div>
    </div>
</div>