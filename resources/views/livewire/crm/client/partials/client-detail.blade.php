<div class="bg-white p-10 pb-4 shadow">
    <!-- Left Section: Referents -->
    @include('livewire.general.goback')

    <div class="mt-5 flex flex-col lg:flex-row gap-10">
        <div class="flex-grow">
            @livewire('crm.client.partials.clientTab', ['client' => $client])
        </div>

        <!-- Right Section: Client Info -->
        <div class="w-full lg:max-w-[419px]">
            <div class="border border-dashed border-[#10BDD4] rounded-sm">
                <!-- Client Logo -->
                <div class="border-b border-dashed border-[#10BDD4] bg-[#F5FCFD] h-18 relative">
                    <div class="flex items-center justify-center w-24 h-24 overflow-hidden p-2 rounded-full border border-dashed border-[#10BDD4] bg-white absolute right-10 -bottom-12">
                        <img src="{{ $client->getFirstMediaUrl('logos') ? $client->getFirstMediaUrl('logos') : asset('icon/logo.svg') }}"
                            alt="Logo" />
                    </div>
                </div>

                <!-- Client Details -->
                <div class="p-13 pb-6">
                    <h2 class="text-2xl font-bold text-left mb-5">{{ $client->name }}</h2>

                    <x-field-data-client :label="'Tipo cliente'" :data="$client->is_company ? 'Pubblico' : 'Privato'" />
                    <x-field-data-client :label="'Codice Fiscale'" :data="$client->tax_code" />
                    <x-field-data-client :label="'Partita IVA'" :data="$client->p_iva" />
                    <x-field-data-client :label="'Codice SDI'" :data="$client->sdi" />
                    <x-field-data-client :label="'Indirizzo'" :data="$client->address" />

                    <div class="w-full border-b border-dashed border-[#10BDD4] my-2"></div>

                    <x-field-data-client :label="'Sito'" :data="$client->site" :link="true" />
                    <x-field-data-client :label="'E-mail'" :data="$client->email" :copy="true" />
                    <x-field-data-client :label="'PEC'" :data="$client->pec" :copy="true" />
                    <x-field-data-client :label="'Telefono'" :data="$client->first_telephone" :copy="true" />

                    <div class="w-full border-b border-dashed border-[#10BDD4] my-2"></div>

                    <x-field-data-client :label="'Sede di riferimento'" :data="$client->registered_office_address" />
                    <x-field-data-client :label="'Creato da'" :data="$client->user?->full_name" />
                    <x-field-data-client :label="'Data creazione'" :data="dateItFormat($client->created_at)" />

                    <div class="flex justify-between mt-2 mb-8 pr-2">
                        <span class="text-[15px] text-[#B0B0B0]">Etichette:</span>
                        <flux:badge size="sm" data-step="{{ $client->step }}">
                            {{ ucfirst($client->step) }}
                        </flux:badge>
                    </div>

                    <flux:button variant="primary" size="sm" data-variant="primary" wire:click="newQuote" data-color="teal">
                        Crea preventivo
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
</div>
