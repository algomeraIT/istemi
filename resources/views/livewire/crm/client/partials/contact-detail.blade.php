<div class="rounded border-2 border-dashed border-cyan-300 p-10 space-y-4">
    <h2 class="text-2xl font-bold flex items-center space-x-2">
        <flux:icon.briefcase class="w-6 h-6" />
        <span>{{ $client->name }}</span>
    </h2>

    <div class="space-y-3 text-gray-600 font-inter">
        <x-field-data-client :label="'E-mail'" :data="$client->email" :copy="true" />
        <x-field-data-client :label="'Telefono'" :data="$client->first_telephone" :copy="true" />
        <x-field-data-client :label="'Servizio'" :data="$client->service" />

        <div class="w-full border-b border-dashed border-[#10BDD4] my-2"></div>

        <x-field-data-client :label="'Provenienza'" :data="$client->provenance" />
        <x-field-data-client :label="'Data acquisizione'" :data="dateItFormat($client->created_at)" />

        <div class="w-full border-b border-dashed border-[#10BDD4] my-2"></div>

        <x-field-data-client :label="'Commerciale'" :data="$client->salesManager?->full_name" />

        <div class="flex justify-between mt-2 mb-8">
            <span class="text-[15px] text-[#B0B0B0]">Stato</span>

            <flux:dropdown offset="-10" class="border rounded-lg px-2 bg-[#F0F1F2]">
                <button
                    class="flex items-center justify-between cursor-pointer text-xs font-semibold pt-0.5 capitalize">
                    {{ $client->step }}
                    <flux:icon.chevron-down variant="micro" />
                </button>

                <flux:menu>
                    <flux:menu.item wire:click="updateStatus('non idoneo')">
                        Non idoneo
                    </flux:menu.item>
                    <flux:menu.item wire:click="updateStatus('in contatto')">
                        In contatto
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>

    {{-- TODO da abilitare a seguito di sviluppo aerea preventivo --}}
    {{-- <flux:button variant="primary" size="sm" data-variant="primary" wire:click="newQuote"
        data-color="teal">
        Crea preventivo
    </flux:button> --}}
</div>

