<div>
    <div class="mt-4 grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2 md:gap-4">
        @php
            $statusMap = [
                0 => [
                    'label' => 'Call center',
                    'bg' => 'bg-[#FEF7EF]',
                    'text' => 'text-[#F5AD65]',
                    'border' => 'border-[#F5AD65]',
                ],
                1 => [
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
                <div class="flex flex-col gap-4 md:flex-row">
                    {{-- Email --}}
                    <div>
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
                    <div>
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
                </div>

                {{-- Status Badge --}}
                <div class="mt-3">
                    <span
                        class="inline-block px-2 py-1 text-xs font-semibold rounded-[15px] border {{ $status['bg'] }} {{ $status['text'] }} {{ $status['border'] }}">
                        {{ $status['label'] }}
                    </span>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 m-3 text-right flex justify-end gap-2">
                    @include('livewire.crm.utilities.detail-button', [
                        'functionName' => 'goToDetail',
                        'id' => $client->id,
                    ])
                    @include('livewire.crm.utilities.delete-button', [
                        'functionName' => 'delete',
                        'id' => $client->id,
                    ])
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
