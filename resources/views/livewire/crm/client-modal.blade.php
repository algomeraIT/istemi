<div class="fixed inset-0 flex items-center justify-center bg-gray-200 bg-opacity-10">
    <div class="bg-white p-6 rounded-lg shadow-lg w-2/3">
        <h3 class="text-xl font-semibold mb-4 p-4 ">{{ $client_id ? 'Modifica Cliente' : 'Crea Cliente' }}</h3>

        <form class="">
                <div class="flex">
                    <div class="mb-4 p-4 ">
                        <label for="tax_code" class="block text-sm font-medium text-gray-700">Partita IVA</label>
                        <input type="text" wire:model="tax_code"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="company_name" class="block text-sm font-medium text-gray-700">Nome
                            Compagnia</label>
                        <input type="text" wire:model="company_name"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" wire:model="email"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="pec" class="block text-sm font-medium text-gray-700">PEC</label>
                        <input type="text" wire:model="pec"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="first_telephone" class="block text-sm font-medium text-gray-700">Telefono</label>
                        <input type="text" wire:model="first_telephone"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>
                </div>
                <div class="flex">
                    <div class="mb-4 p-4 ">
                        <label for="second_telephone" class="block text-sm font-medium text-gray-700">Secondo
                            Telefono</label>
                        <input type="text" wire:model="second_telephone"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="registered_office_address" class="block text-sm font-medium text-gray-700">Indirizzo
                            Sede
                            Legale</label>
                        <input type="text" wire:model="registered_office_address"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="address" class="block text-sm font-medium text-gray-700">Indirizzo</label>
                        <input type="text" wire:model="address"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="province" class="block text-sm font-medium text-gray-700">Provincia</label>
                        <input type="text" wire:model="province"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="city" class="block text-sm font-medium text-gray-700">Città</label>
                        <input type="text" wire:model="city"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                </div>
                <div class="flex">
                    <div class="mb-4 p-4 ">
                        <label for="country" class="block text-sm font-medium text-gray-700">Paese</label>
                        <input type="text" wire:model="country"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="sdi" class="block text-sm font-medium text-gray-700">SDI</label>
                        <input type="text" wire:model="sdi"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="site" class="block text-sm font-medium text-gray-700">Sito</label>
                        <input type="text" wire:model="site"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="label" class="block text-sm font-medium text-gray-700">Etichetta</label>
                        <input type="text" wire:model="label"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="user_wire:model_creation" class="block text-sm font-medium text-gray-700">Utente
                            wire:model
                            Creatore</label>
                        <input type="text" wire:model="user_wire:model_creation"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>
                </div>
                <div class="flex">
                    <div class="mb-4 p-4 ">
                        <label for="name_user_creation" class="block text-sm font-medium text-gray-700">Nome Utente
                            Creatore</label>
                        <input type="text" wire:model="name_user_creation"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="last_name_user_creation" class="block text-sm font-medium text-gray-700">Cognome
                            Utente
                            Creatore</label>
                        <input type="text" wire:model="last_name_user_creation"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="has_referent" class="block text-sm font-medium text-gray-700">Ha Referente</label>
                        <input type="checkbox" wire:model="has_referent" class="mt-1" />
                    </div>

                    <div class="mb-4 p-4 ">
                        <label for="has_sales" class="block text-sm font-medium text-gray-700">Ha Venditore</label>
                        <input type="checkbox" wire:model="has_sales" class="mt-1" />
                    </div>

                <div class="mb-4 p-4 ">
                    <label for="status" class="block text-sm font-medium text-gray-700">Stato</label>
                    <select wire:model="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            {{-- upload --}}
       <div class="flex">
<div class="flex flex-col items-center justify-center w-full">
    @if ($logoPreview)
        <div class="relative">
            <img src="{{ $logoPreview }}" class="w-32 h-32 object-cover rounded-lg shadow-md">
            <button type="button" wire:click="removeLogo"
                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                &times;
            </button>
        </div>
    @else
        <label for="logo"
            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                </svg>
                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Clicca per caricare il logo</span>
                    oppure trascina</p>
                <p class="text-xs text-gray-500">Max: 2MB | Formati: JPG, PNG</p>
            </div>
            <input id="logo" type="file" wire:model="logo" class="hidden" />
        </label>
    @endif

    @error('logo')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
    </div>

    <!-- Show File Upload Progress -->
{{--    <div wire:loading wire:target="logo" class="text-gray-600 text-sm mt-2">
        Caricamento in corso...
    </div> --}}

    <!-- Preview Uploaded Image -->
  {{--  @if ($logo)
    <div class="mt-4">
        <img src="{{ $logo->temporaryUrl() }}" class="w-32 h-32 object-cover rounded-md">
    </div>
    @endif --}}

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
        </form>
    </div>
</div>