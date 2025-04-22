<div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-100 bg-opacity-50 p-4">
    <div class="bg-white shadow w-full  overflow-auto">
        <div class="p-6">
            <div class="flex justify-between mb-16">
                <h3 class="text-2xl font-semibold mb-6">
                    {{ $client_id ? 'Modifica Cliente' : 'Crea Cliente' }}
                </h3>
                @include('livewire.general.cancel')
            </div>
            <form x-data="{
                get isValid() {
                    return [
                        '{{ $tax_code }}',
                        '{{ $company_name }}',
                        '{{ $email }}',
                        '{{ $pec }}',
                        '{{ $first_telephone }}',
                        '{{ $second_telephone }}',
                        '{{ $registered_office_address }}',
                        '{{ $address }}',
                        '{{ $province }}',
                        '{{ $city }}',
                        '{{ $country }}',
                        '{{ $sdi }}',
                        '{{ $site }}',
                        '{{ $name_user_creation }}',
                        '{{ $last_name_user_creation }}',
                        '{{ $status }}',
                    ].every(v => v && v.trim().length > 0);
                }
            }">
                <div class="md:flex-row gap-6">
                    {{-- LEFT: All inputs --}}
                    <div class="flex bg-[#F8FEFF] p-4">
                        <div class=" w-2/3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            {{-- Ragione Sociale --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.clipboard class="w-4 h-4 mr-2 text-gray-500" />
                                    Ragione sociale
                                </label>
                                <input type="text" wire:model="company_name"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>

                            {{-- Partita IVA --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.clipboard class="w-4 h-4 mr-2 text-gray-500" />
                                    Partita IVA
                                </label>
                                <input type="text" wire:model="tax_code"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>



                            {{-- Email --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.at-symbol class="w-4 h-4 mr-2 text-gray-500" />
                                    Email
                                </label>
                                <input type="email" wire:model="email"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>

                            {{-- PEC --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.envelope-open class="w-4 h-4 mr-2 text-gray-500" />
                                    PEC
                                </label>
                                <input type="text" wire:model="pec"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>

                            {{-- Telefono --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.phone class="w-4 h-4 mr-2 text-gray-500" />
                                    Telefono
                                </label>
                                <input type="text" wire:model="first_telephone"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>

                            {{-- Secondo Telefono --}}
                      {{--       <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.phone class="w-4 h-4 mr-2 text-gray-500" />
                                    Secondo Telefono
                                </label>
                                <input type="text" wire:model="second_telephone"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div> --}}

                            {{-- Sede Legale --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.home class="w-4 h-4 mr-2 text-gray-500" />
                                    Sede Legale
                                </label>
                                <input type="text" wire:model="registered_office_address"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>

                            {{-- Indirizzo --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.map-pin class="w-4 h-4 mr-2 text-gray-500" />
                                    Indirizzo
                                </label>
                                <input type="text" wire:model="address"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>

                            {{-- Provincia --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.flag class="w-4 h-4 mr-2 text-gray-500" />
                                    Provincia
                                </label>
                                <input type="text" wire:model="province"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>

                            {{-- Città --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.clipboard class="w-4 h-4 mr-2 text-gray-500" />
                                    Città
                                </label>
                                <input type="text" wire:model="city"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>

                            {{-- Paese --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.clipboard class="w-4 h-4 mr-2 text-gray-500" />
                                    Paese
                                </label>
                                <input type="text" wire:model="country"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>

                            {{-- SDI --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.server class="w-4 h-4 mr-2 text-gray-500" />
                                    SDI
                                </label>
                                <input type="text" wire:model="sdi"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>

                            {{-- Sito --}}
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700">
                                    <flux:icon.link class="w-4 h-4 mr-2 text-gray-500" />
                                    Sito
                                </label>
                                <input type="text" wire:model="site"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300" />
                            </div>




                        </div>

                        {{-- RIGHT: Uploader + Etichetta --}}
                        <div class="md:w-1/3 bg-[#F8FEFF] p-4 flex flex-col gap-6">
                            {{-- Logo uploader --}}
                            <div
                                class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 p-6 bg-white">
                                @if ($logoPreview)
                                    <div class="relative">
                                        <img src="{{ $logoPreview }}" class="w-32 h-32 object-cover mb-4" />
                                        <button type="button" wire:click="removeLogo"
                                            class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1">&times;</button>
                                    </div>
                                @else
                                    <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <p class="text-gray-600">Clicca o trascina per caricare</p>
                                    <p class="text-xs text-gray-500">Max 2MB (JPG/PNG)</p>
                                @endif
                                <input type="file" wire:model="logo" class="sr-only" />
                                @error('logo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Etichetta select --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Etichetta</label>
                                <select wire:model="status"
                                    class="mt-1 w-full p-2 border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-cyan-300">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex justify-end space-x-2 mt-6">

                        <button type="button" wire:click="store" :disabled="!isValid"
                            :class="{
                                'bg-cyan-200  opacity-50 cursor-not-allowed': !isValid,
                                'bg-cyan-500 hover:bg-cyan-600': isValid
                            }"
                            class="px-4 py-2 text-white transition rounded-md">
                            Salva
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
