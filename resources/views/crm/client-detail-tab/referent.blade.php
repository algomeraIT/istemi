
<button class=" bg-cyan-500 text-white text-sm hover:bg-cyan-700 p-2" >Aggiungi</button>
   <button @click="open = true; editing = false; referent = {}" 
        class="bg-cyan-500 text-white text-sm hover:bg-cyan-700 p-2 rounded">
        Aggiungi Referente
    </button>
<div class="bg-white p-6 rounded-lg shadow-lg">

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class=" text-gray-600">
                    <th class="border border-gray-300 px-4 py-2">Nome e Cognome</th>
                    <th class="border border-gray-300 px-4 py-2">Titolo</th>
                    <th class="border border-gray-300 px-4 py-2">Posizione Lavorativa</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Telephone</th>
                <th></th>
                <th></th>
                <th></th>
                </tr>
            </thead>
            <tbody>
    
                @foreach($referents as $referent)
                <tr class="bg-gray-100 even:bg-gray-200 text-gray-800">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $referent->name . ' ' . $referent->last_name }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $referent->title }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $referent->job_position }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <a href="mailto:{{ $referent->email }}" class="text-blue-500 underline hover:text-blue-700">
                            {{ $referent->email }}
                        </a>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $referent->telephone }}</td>
                 {{--   <td class="border border-gray-300 px-4 py-2 text-center">
                        <span class="px-2 py-1 rounded-full text-white 
                            {{ $referent->status === 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ ucfirst($referent->status) }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $referent->role }}</td> --}}
                        <td class="px-4 py-2">
                        <button wire:click="goToDetail({{ $referent->id }})" title="Dettaglio"
                            class="px-3 py-1  text-gray-600 rounded  hover:cursor-pointer">
                            <flux:icon.eye />
                        </button>
                    </td>
                    <td>
                        <button @click="open = true; editing = true; referent = {{ $referent }}"
                            class="px-3 py-1  text-gray-600 rounded  ml-2 hover:cursor-pointer">
                            <flux:icon.pencil-square />
                        </button>
                    </td>
                    <td>
                        <button wire:click="delete({{ $referent->id }})" title="Cancella"
                            class="px-3 py-1  text-gray-600 rounded  ml-2 hover:cursor-pointer">
                            <flux:icon.x-mark />
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        @include('crm.client-detail-tab.referent-modal', ['client' => $client])

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="{{ asset('js/client-detail.js') }}"></script>