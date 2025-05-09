<!-- resources/views/livewire/crm/sales.blade.php -->

<div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <button wire:click="openModalSale" class="bg-cyan-500 text-white text-sm hover:bg-cyan-700 p-2">Aggiungi
            Vendita</button>
<div x-data="{ open: @entangle('isOpenSale') }">
    <div x-show="open" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 shadow-lg">
            <h2>Modifica o Crea Vendita</h2>
            <button wire:click="closeModalSale">✖</button>
        </div>
    </div>
</div>
        @if(empty($sales) || count($sales) === 0)
            <p class="text-gray-500">Nessuna vendita per questo cliente</p>
        @else
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="text-gray-600">
                        <th class="border border-gray-300 px-4 py-2">Cliente</th>
                        <th class="border border-gray-300 px-4 py-2">Fattura</th>
                        <th class="border border-gray-300 px-4 py-2">Prezzo</th>
                        <th class="border border-gray-300 px-4 py-2">Stato</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr class="bg-gray-100 even:bg-gray-200 text-gray-800">
                            <td class="border border-gray-300 px-4 py-2">{{ $sale->client->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $sale->invoice }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $sale->price }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ ucfirst($sale->status) }}</td>
                            <td>
                                <button wire:click="showDetails({{ $sale->id }})"
                                    class="px-3 py-1 text-gray-600 rounded hover:cursor-pointer">
                                    View
                                </button>
                                <button wire:click="edit({{ $sale->id }})"
                                    class="px-3 py-1 text-gray-600 rounded ml-2 hover:cursor-pointer">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $sale->id }})"
                                    class="px-3 py-1 text-gray-600 rounded ml-2 hover:cursor-pointer">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    
</div>