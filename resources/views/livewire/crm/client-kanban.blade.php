<div>
    <div class="mt-4 grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2 md:gap-4">
        @php
            $statusMap = [
                1 => [
                    'label' => 'Call center',
                    'bg' => 'bg-[#FEF7EF]',
                    'text' => 'text-[#F5AD65]',
                    'border' => 'border-[#F5AD65]',
                ],
                2 => [
                    'label' => 'Censimento',
                    'bg' => 'bg-[#E3F1F4]',
                    'text' => 'text-[#2A8397]',
                    'border' => 'border-[#2A8397]',
                ],
            ];
        @endphp

        @foreach ($clients as $client)
            @php
                $status = $statusMap[$client->status] ?? [
                    'label' => 'Sconosciuto',
                    'bg' => 'bg-gray-100',
                    'text' => 'text-gray-600',
                    'border' => 'border-gray-600',
                ];
            @endphp

            <div class="bg-white border border-gray-300 p-4 text-sm">
                {{-- Company Name --}}
                <div class="flex justify-between">
                    <h3 class="text-lg font-bold text-[#232323]">{{ $client->company_name }}</h3>
                    <img src="{{ $client->logo_path ?: asset('icon/logo.svg') }}"
                        onerror="this.onerror=null;this.src='{{ asset('icon/logo.svg') }}';" class="w-10 h-10 rounded"
                        alt="Logo" />
                </div>
                {{-- Acquisition Info --}}
                <div class="flex gap-2 mt-2 mb-4 text-[#B0B0B0] italic font-extralight text-base">
                    <span>{{ $client->id }}</span>
                    {{--                     <span> - Acquisizione: {{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}</span>
 --}}
                </div>

                {{-- Contact Info --}}
                <div class="flex flex-col gap-4  mt-2 mb-4">
                    {{-- Email --}}
                    <div class="font-extralight">
                        <p class="flex items-center gap-1 text-[#B0B0B0] font-light">
                            <flux:icon.at-symbol class="w-4" /> E-mail:
                        </p>
                        <div class="flex items-center gap-2 mt-1 font-semibold text-[#B0B0B0]">
                            {{ $client->email }}
                            @include('livewire.crm.utilities.copy-this-text-button', [
                                'content' => $client->email,
                            ])
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="font-extralight">
                        <p class="flex items-center gap-1 text-[#B0B0B0] font-light">
                            <flux:icon.phone class="w-4" /> Telefono:
                        </p>
                        <div class="flex items-center gap-2 mt-1 font-semibold text-[#B0B0B0]">
                            {{ $client->first_telephone }}
                            @include('livewire.crm.utilities.copy-this-text-button', [
                                'content' => $client->first_telephone,
                            ])
                        </div>
                    </div>

                    {{-- City --}}
                    <div class="font-extralight">
                        <p class="flex items-center gap-1 text-[#B0B0B0] font-light">
                            <flux:icon.map-pin class="w-4" /> Sede:
                        </p>
                        <div class="flex items-center gap-2 mt-1 font-light italic text-[#B0B0B0]">
                            {{ $client->city }}
                        
                        </div>
                    </div>
                </div>

                {{-- Status Badge --}}
                <div class="mt-3">
                    @php
                    $text = match ($client->status) {
                        1 => 'Call center',
                        2 => 'Censimento',
                        default => 'Sconosciuto',
                    };
                @endphp
                <flux:badge size="sm" data-statusClient="{{ $client->status }}" inset="top bottom">
                    {{ $text }}</flux:badge>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 text-right flex justify-end gap-2">
                    <flux:button wire:click="goToDetail({{ $client->id }})" variant="ghost"
                        data-variant="ghost" data-color="teal" data-rounded icon="eye" size="sm" />
                        <flux:button wire:click="edit({{ $client->id }})" variant="ghost"
                            data-variant="ghost" data-color="gray" data-rounded icon="pencil" size="sm" />
                    <flux:button wire:click="delete({{ $client->id }})"
                        wire:confirm="Sei sicuro di voler eliminare questo client?" variant="ghost"
                        data-variant="ghost" data-color="red" data-rounded icon="trash" size="sm" />
                    {{-- Optionally, you can include an edit button here if needed --}}
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => alert("Copiato: " + text))
            .catch(err => console.error("Clipboard error", err));
    }
</script>
