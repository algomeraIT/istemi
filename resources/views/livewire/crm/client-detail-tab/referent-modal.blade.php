<div x-data="{ open: false }">
    <!-- Button to Open Modal -->
    <button @click="open = true" class="bg-cyan-500 text-white text-sm hover:bg-cyan-700 p-2 rounded">
        {{ isset($referent) ? 'Modifica referente' : 'Aggiungi Referente' }}
    </button>


    <!-- Modal Overlay -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
        <div @click.away="open = false" class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-700">
                    {{ isset($referent) ? 'Edit Referent' : 'Add New Referent' }}
                </h2>
                <button @click="open = false" class="text-gray-600 hover:text-gray-900">&times;</button>
            </div>

            <!-- Referent Form -->
            <form method="POST"
                action="{{ isset($referent) ? route('referents.update', $referent->id) : route('referents.store') }}">
                @csrf
                @if(isset($referent))
                    @method('PUT')
                @endif

                <input type="hidden" name="client_id" value="{{ $client->id }}">

                <div class="mb-4">
                    <label class="block text-gray-700">Nome:</label>
                    <input type="text" name="name" value="{{ $referent->name ?? '' }}" required
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Cognome:</label>
                    <input type="text" name="last_name" value="{{ $referent->last_name ?? '' }}" required
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Titolo:</label>
                    <input type="text" name="title" value="{{ $referent->title ?? '' }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Posizione Lavorativa:</label>
                    <input type="text" name="job_position" value="{{ $referent->job_position ?? '' }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Email:</label>
                    <input type="email" name="email" value="{{ $referent->email ?? '' }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Telefono:</label>
                    <input type="text" name="telephone" value="{{ $referent->telephone ?? '' }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Note:</label>
                    <textarea name="note"
                        class="w-full p-2 border border-gray-300 rounded">{{ $referent->note ?? '' }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Stato:</label>
                    <select name="status" class="w-full p-2 border border-gray-300 rounded">
                        <option value="1" {{ (isset($referent) && $referent->status == 1) ? 'selected' : '' }}>Attivo
                        </option>
                        <option value="0" {{ (isset($referent) && $referent->status == 0) ? 'selected' : '' }}>Non Attivo
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Ruolo:</label>
                    <input type="text" name="role" value="{{ $referent->role ?? '' }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-cyan-500 text-white text-sm hover:bg-cyan-700 p-2 rounded">
                        {{ isset($referent) ? 'Modifica' : 'Aggiungi' }} Referente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>