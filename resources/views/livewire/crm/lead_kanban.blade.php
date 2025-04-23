<div>
    <div class="mt-4 grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2 md:gap-4">


        @foreach ($leads_kanban as $lead)
            @php
                $status = $statusMap[$lead->status] ?? [
                    'label' => 'Sconosciuto',
                    'bg' => 'bg-gray-100',
                    'text' => 'text-gray-600',
                    'border' => 'border-gray-600',
                ];
            @endphp

            <div class="bg-white border border-gray-300 p-4 text-sm">
                {{-- Company Name --}}
                <h3 class="text-lg font-bold text-[#232323]">{{ $lead->company_name }}</h3>

                {{-- Acquisition Info --}}
                <div class="flex gap-2 mt-2 mb-4 text-[#B0B0B0] italic font-extralight text-base">
                    <span>ID: {{ $lead->id }}</span> -
                    <span>Acquisizione: {{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y') }}</span>
                </div>

                {{-- Contact Info --}}
                <div class="flex flex-col gap-4 md:flex-row">
                    {{-- Email --}}
                    <div>
                        <p class="flex items-center gap-1 text-[#B0B0B0] font-light">
                            <flux:icon.at-symbol class="w-4" /> E-mail:
                        </p>
                        <div class="flex items-center gap-2 mt-1 font-semibold text-[#B0B0B0]">
                            {{ $lead->email }}
                            @include('livewire.crm.utilities.copy-this-text-button', [
                                'content' => $lead->email,
                            ])
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div>
                        <p class="flex items-center gap-1 text-[#B0B0B0] font-light">
                            <flux:icon.phone class="w-4" /> Telefono:
                        </p>
                        <div class="flex items-center gap-2 mt-1 font-semibold text-[#B0B0B0]">
                            {{ $lead->first_telephone }}
                            @include('livewire.crm.utilities.copy-this-text-button', [
                                'content' => $lead->first_telephone,
                            ])
                        </div>
                    </div>
                </div>

                {{-- Status Badge --}}
                <div class="mt-3">
                    @php
                    $statusMap = [
                        1 => [
                            'text' => 'Nuovo',
                            'bg' => 'bg-[#339CFF]',
                            'textColor' => 'text-white',
                            'border' => 'border-[#339CFF]',
                        ],
                        2 => [
                            'text' => 'Assegnato',
                            'bg' => 'bg-[#8A63D2]',
                            'textColor' => 'text-white',
                            'border' => 'border-[#8A63D2]',
                        ],
                        3 => [
                            'text' => 'Da riassegnare',
                            'bg' => 'bg-[#F85C5C]',
                            'textColor' => 'text-white',
                            'border' => 'border-[#F85C5C]',
                        ],
                    ];
                    $status = $statusMap[$lead->status] ?? [
                        'text' => 'Sconosciuto',
                        'bg' => 'bg-gray-100',
                        'textColor' => 'text-gray-600',
                        'border' => 'border-gray-600',
                    ];
                @endphp
                @include('livewire.crm.utilities.span-status', [
                    'bg' => $status['bg'],
                    'textColor' => $status['textColor'],
                    'border' => $status['border'],
                    'text' => $status['text'],
                ]) 
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 m-3 text-right flex justify-end gap-2">
                    @include('livewire.crm.utilities.detail-button', [
                        'functionName' => 'show',
                        'id' => $lead->id,
                    ])
                    @include('livewire.crm.utilities.delete-button', [
                        'functionName' => 'delete',
                        'id' => $lead->id,
                    ])
                    {{-- @include('livewire.crm.utilities.edit-button', ['functionName' => 'edit', 'id' => $lead->id]) --}}
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
