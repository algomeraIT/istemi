<div class="fixed inset-0 flex items-center justify-center bg-gray-200 bg-opacity-10 ">
    <div class="bg-white w-3/4 max-w-4xl h-[90vh] rounded-lg shadow-lg p-5 relative">
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" wire:click="close">✖</button>

        <div class="flex">
            <!-- Sidebar Tabs -->
            <div class="w-1/4 border-r p-4 flex flex-col space-y-2">
                <ul class="flex flex-col space-y-4 items-center">
                    <li>
                        <button wire:click="$set('currentTab', 1)" class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-cyan-400 text-cyan-400 font-bold
                {{ $currentTab == 1 ? 'bg-cyan-500 text-white' : 'bg-white hover:bg-cyan-100' }}">
                            1
                        </button>
                    </li>
                    <li>
                        <button wire:click="$set('currentTab', 2)" class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-cyan-400 text-cyan-400 font-bold
                {{ $currentTab == 2 ? 'bg-cyan-500 text-white' : 'bg-white hover:bg-cyan-100' }}">
                            2
                        </button>
                    </li>
                    <li>
                        <button wire:click="$set('currentTab', 3)" class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-cyan-400 text-cyan-400 font-bold
                {{ $currentTab == 3 ? 'bg-cyan-500 text-white' : 'bg-white hover:bg-cyan-100' }}">
                            3
                        </button>
                    </li>
                    <li>
                        <button wire:click="$set('currentTab', 4)" class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-cyan-400 text-cyan-400 font-bold
                {{ $currentTab == 4 ? 'bg-cyan-500 text-white' : 'bg-white hover:bg-cyan-100' }}">
                            4
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="w-3/4 p-4 overflow-y-auto max-h-[80vh]">
                @if ($currentTab == 1)
                <h2 class="text-lg font-bold mb-2">Informazioni Generali</h2>
                <input type="text" wire:model="formData.general_info" placeholder="Informazioni Generali"
                    class="border p-2 w-full">
                <input type="text" wire:model="formData.n_file" placeholder="Numero Pratica"
                    class="border p-2 w-full mt-2">
                <input type="text" wire:model="formData.name_project" placeholder="Nome del Progetto"
                    class="border p-2 w-full mt-2">
                <input type="text" wire:model="formData.client_name" placeholder="Cliente"
                    class="border p-2 w-full mt-2">
                <select wire:model="formData.client_type" class="border p-2 w-full">
                    <option value="" disabled selected>Tipo Cliente</option>
                    <option value="0">Pubblico</option>
                    <option value="1">Privato</option>
                </select>
                <label class="flex items-center space-x-2 border p-2 w-full mt-2 rounded cursor-pointer">
                    <input type="checkbox" wire:model="formData.is_from_agent"
                        class="form-checkbox h-5 w-5 text-blue-600">
                    <span>Da Agente</span>
                </label>
                <label class="block text-sm font-medium text-gray-700">Budget Allocato</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">€</span>
                    <input type="number" min="0" step="0.01" wire:model="formData.total_budget"
                           class="border p-2 w-full pl-8 mt-1 rounded"
                           placeholder="0.00">
                </div>
                <input type="text" wire:model="formData.chief_area" placeholder="Responsabile Area"
                    class="border p-2 w-full mt-2">
                <input type="text" wire:model="formData.chief_project" placeholder="Responsabile Progetto"
                    class="border p-2 w-full mt-2">
                    <label class="block text-sm font-medium text-gray-700">Data Inizio</label>
                    <input type="date" wire:model="formData.start_at" 
                           class="border p-2 w-full mt-1 rounded">
                    
                    <label class="block text-sm font-medium text-gray-700 mt-2">Data Fine</label>
                    <input type="date" wire:model="formData.end_at" 
                           class="border p-2 w-full mt-1 rounded">
                @elseif ($currentTab == 2)
                <h2 class="text-lg font-bold mb-2">A cura dell'Area Gare</h2>
                <input type="number" wire:model="formData.starting_price" placeholder="Base D'Asta"
                    class="border p-2 w-full">
                <input type="number" wire:model="formData.discount_percentage" placeholder="Percentuale di Ribasso"
                    class="border p-2 w-full mt-2">
                <input type="number" wire:model="formData.discounted" placeholder="Ribassato" class="border p-2 w-full">
                <input type="number" wire:model="formData.n_firms" placeholder="Componenti del Raggruppamento"
                    class="border p-2 w-full mt-2">
                <input type="number" wire:model="formData.firms_and_percentage"
                    placeholder="Percentuali del Raggruppamento" class="border p-2 w-full mt-2">
                <textarea wire:model="formData.note" placeholder="Notes" class="border p-2 w-full mt-2"></textarea>
                @elseif ($currentTab == 3)
                <h2 class="text-lg font-bold mb-2">Descrizione</h2>
                <textarea wire:model="formData.goals" placeholder="Obiettivi" class="border p-2 w-full"></textarea>
                <textarea wire:model="formData.project_scope" placeholder="Ambito del Progetto"
                    class="border p-2 w-full"></textarea>
                <textarea wire:model="formData.expected_results" placeholder="Risultati Attesi"
                    class="border p-2 w-full"></textarea>
                <textarea wire:model="formData.stackholder_id" placeholder="Stackholder"
                    class="border p-2 w-full mt-2"></textarea>
                @elseif ($currentTab == 4)
                <h2 class="text-lg font-bold mb-2">Crea Progetto</h2>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="formData.agreement" class="form-checkbox">
                    <span>Seleziona</span>
                </label>
                @endif

                <div class="bg-white p-4 border-t flex justify-between">
                    <button wire:click="prevTab"
                        class="bg-gray-300 px-4 py-2 rounded {{ $currentTab == 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $currentTab==1 ? 'disabled' : '' }}>
                        Previous
                    </button>
                    <button wire:click="{{ $currentTab < 4 ? 'nextTab' : 'save' }}"
                        class="bg-cyan-600 text-white px-4 py-2 rounded">
                        {{ $currentTab < 4 ? 'Next' : 'Save' }} </button>
                </div>
            </div>

        </div>

    </div>
</div>