<div class="grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2 md:gap-4">
    @foreach ($client_cards as $client)
        <div class="border border-gray-300 p-4 text-sm">
            {{-- Company Name --}}
            <div class="flex justify-between">
                <h3 class="text-lg font-bold text-[#232323]">{{ $client->name }}</h3>
                @if ($clientStatus === 'cliente')
                    <img src="{{ optional($client)->logo_path ? asset($client->logo_path) : asset('icon/logo.svg') }}"
                        class="size-10 rounded" alt="Logo" />
                @endif
            </div>

            {{-- Acquisition Info --}}
            <div class="flex gap-2 mb-4 text-[#B0B0B0] italic text-base">
                <span>{{ $client->id }}</span>
                @if ($clientStatus !== 'cliente')
                    <span>- Acquisizione: {{ dateItFormat($client->created_at) }}</span>
                @endif
            </div>

            {{-- Contact Info --}}
            <div class="grid grid-cols-2 gap-4  mt-2 mb-4 text-[#B0B0B0]">
                {{-- Email --}}
                <div>
                    <p class="flex items-center gap-1">
                        <flux:icon.at-symbol class="size-4" />
                        <span class="text-xs font-extralight">E-mail:</span>
                    </p>
                    <div class="flex items-center gap-2 mt-1 font-semibold">
                        {{ $client->email }}

                        <button title="Copia" wire:click="copy('{{ $client->email }}')"
                            x-on:click="$flux.toast('Mail copiata.')" class="cursor-pointer">
                            <flux:icon.document-duplicate variant="micro" class="text-[#10BDD4]" />
                        </button>
                    </div>
                </div>

                {{-- Phone --}}
                <div>
                    <p class="flex items-center gap-1">
                        <flux:icon.phone class="size-4" />
                        <span class="text-xs font-extralight">Telefono:</span>
                    </p>
                    <div class="flex items-center gap-2 mt-1 font-semibold">
                        {{ $client->first_telephone }}

                        <button title="Copia" wire:click="copy('{{ $client->first_telephone }}')"
                            x-on:click="$flux.toast('Contatto telefonico copiato.')" class="cursor-pointer">
                            <flux:icon.document-duplicate variant="micro" class="text-[#10BDD4]" />
                        </button>
                    </div>
                </div>

                {{-- City --}}
                @if ($clientStatus === 'cliente')
                    <div class="col-span-2">
                        <p class="flex items-center gap-1">
                            <flux:icon.map-pin class="size-4" />
                            <span class="text-xs font-extralight">Sede:</span>
                        </p>
                        <div class="flex items-center gap-2 mt-1 italic text-[#B0B0B0]">
                            {{ $client->city }}
                        </div>
                    </div>
                @endif
            </div>

            {{-- Status Badge --}}
            <div class="mt-3">
                <flux:badge size="sm" data-step="{{ $client->step }}">
                    {{ ucfirst($client->step) }}</flux:badge>
            </div>

            {{-- Action Buttons --}}
            <div class="text-right flex justify-end gap-2">
                @if ($clientStatus === 'lead')
                    <flux:button wire:click='setLead({{ $client->id }})' variant="ghost" data-variant="ghost"
                        data-color="teal" icon="eye" size="sm" />
                @else
                    <flux:button href="{{ route('crm.client.show', [$clientStatus, $client->id]) }}" variant="ghost"
                        data-variant="ghost" data-color="teal" icon="eye" size="sm" />
                @endif

                @if ($clientStatus === 'cliente')
                    <flux:button wire:click="edit({{ $client->id }})" variant="ghost" data-variant="ghost"
                        data-color="gray" data-rounded icon="pencil" size="sm" />
                @endif

                <flux:button wire:click="delete({{ $client->id }})"
                    wire:confirm="Sei sicuro di voler eliminare questo client?" variant="ghost" data-variant="ghost"
                    data-color="red" data-rounded icon="trash" size="sm" />
            </div>
        </div>
    @endforeach
</div>
