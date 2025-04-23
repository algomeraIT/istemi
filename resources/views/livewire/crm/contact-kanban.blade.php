<div>
    <div class="mt-4 grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2 md:gap-4">


        @foreach ($contact_kanban as $contact)

            <div class="bg-white border border-gray-300 p-4 text-sm mt-5">
                {{-- Company Name --}}
                <h3 class="text-lg font-bold text-[#232323]">{{ $contact->company_name }}</h3>

                {{-- Info Line --}}
                <div class="flex flex-wrap mt-2 mb-4 gap-2 text-[#B0B0B0] italic font-extralight text-base">
                    <span>ID: {{ $contact->id }}</span>
                    <span>Acquisizione: {{ \Carbon\Carbon::parse($contact->created_at)->format('d/m/Y') }}</span>
                </div>

                {{-- Contact Info --}}
                <div class="flex flex-col gap-4 md:flex-row md:justify-between">
                    {{-- Email --}}
                    <div>
                        <p class="flex items-center gap-1 text-[#B0B0B0] font-light">
                            <flux:icon.at-symbol class="w-4" /> E-mail:
                        </p>
                        <div class="flex items-center gap-2 mt-1 font-semibold text-[#232323]">
                            {{ $contact->email }}
                            @include('livewire.crm.utilities.copy-this-text-button', [
                                'content' => $contact->email,
                            ])
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div>
                        <p class="flex items-center gap-1 text-[#B0B0B0] font-light">
                            <flux:icon.phone class="w-4" /> Telefono:
                        </p>
                        <div class="flex items-center gap-2 mt-1 font-semibold text-[#232323]">
                            {{ $contact->first_telephone }}
                            @include('livewire.crm.utilities.copy-this-text-button', [
                                'content' => $contact->first_telephone,
                            ])
                        </div>
                    </div>
                </div>

                {{-- Status Badge --}}
                <div class="mt-5">
                    @php
                    $statusMap = [
                        0 => [
                            'text' => 'In contatto',
                            'bg' => 'bg-[#F7C548]',
                            'textColor' => 'text-white',
                            'border' => 'border-[#F7C548]',
                        ],
                        1 => [
                            'text' => 'Non idoneo',
                            'bg' => 'bg-[#A0A7AF]',
                            'textColor' => 'text-white',
                            'border' => 'border-[#A0A7AF]',
                        ],
                    ];
                    $status = $statusMap[$contact->status] ?? [
                        'text' => 'Sconosciuto',
                        'bg' => 'bg-gray-400',
                        'textColor' => 'text-white',
                        'border' => 'border-gray-400',
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
                <div class="mt-4 text-right flex justify-end gap-2">
                    @include('livewire.crm.utilities.detail-button', ['functionName' => 'goToDetail', 'id' => $contact->id])
                    @include('livewire.crm.utilities.delete-button', ['functionName' => 'delete', 'id' => $contact->id])
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination (Optional) --}}
    {{-- <div class="mt-4">{{ $leads->links() }}</div> --}}
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => alert("Copiato: " + text))
            .catch(err => console.error("Clipboard error:", err));
    }
</script>