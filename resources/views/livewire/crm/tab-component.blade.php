<!-- resources/views/livewire/tab-component.blade.php -->
<div x-data="{ selectedTab: @entangle('selectedTab') }">

    <!-- Tab Buttons -->
    <div class="flex mb-4">
        <button @click="selectedTab = 'referents'" class="px-4 py-2 text-sm bg-gray-200 rounded mr-2">
            Referenti
        </button>
        <button @click="selectedTab = 'sales'" class="px-4 py-2 text-sm bg-gray-200 rounded mr-2">
            Vendite
        </button>
        <button @click="selectedTab = 'accounting'" class="px-4 py-2 text-sm bg-gray-200 rounded mr-2">
            Contabilità
        </button>
        <button @click="selectedTab = 'communications'" class="px-4 py-2 text-sm bg-gray-200 rounded">
            Comunicazioni
        </button>
    </div>

    <!-- Tables for each Tab (Linked to client_id) -->
    <div x-show="selectedTab === 'referents'">
        <h3 class="text-lg font-semibold mb-2">Referenti</h3>
        <button @click="Livewire.emit('openModal', 'referents')" class="px-4 py-2 bg-blue-500 text-white rounded">
            Aggiungi Referente
        </button>
        <table class="min-w-full mt-4 border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Azione</th>
                </tr>
            </thead>
            <tbody>
                @foreach($referents as $referent)
                    <tr>
                        <td class="border px-4 py-2">{{ $referent->name }}</td>
                        <td class="border px-4 py-2">{{ $referent->email }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="openModal('referents', {{ $referent->id }})">Modifica</button>
                            <button wire:click="delete('referents', {{ $referent->id }})">Elimina</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Creating/Editing Referent -->
    @if($isModalOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded shadow-lg w-1/3">
                <form wire:submit.prevent="save">
                    @csrf
                    <div class="mb-4">
                        <label for="name">Nome</label>
                        <input type="text" wire:model="modalData.name" class="w-full px-4 py-2 border rounded" />
                    </div>

                    <div class="mb-4">
                        <label for="email">Email</label>
                        <input type="email" wire:model="modalData.email" class="w-full px-4 py-2 border rounded" />
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Salva</button>
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-red-500 text-white rounded">Annulla</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>
