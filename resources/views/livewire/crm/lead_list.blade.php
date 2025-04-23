<div class="w-full overflow-x-auto">
    @if ($leads)
        <table class=" w-full min-w-[798px] font-inter text-sm text-left">
            <thead class="text-[#B0B0B0] font-light text-[14px]">
                <tr class="border-b h-10">
                    <th class="w-[calc(100%/9)]">ID</th>
                    <th class="w-[calc(100%/5)]">Ragione Sociale</th>
                    <th class="w-[calc(100%/5)]">E-mail</th>
                    <th class="w-[calc(100%/5)]">Telefono</th>
                    <th class="w-[calc(100%/6)]">Acquisizione</th>
                    <th class="w-[calc(100%/6)]">Stato</th>
                    <th class=" flex justify-end">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                    @include('livewire.crm.utilities.tr-body-table')
                    <td>{{ $lead->id }}</td>
                    <td>
                        <div class="max-w-[200px] break-words whitespace-normal">
                            {{ $lead->company_name }}
                        </div>
                    </td>

                    {{-- Email --}}
                    <td>
                        <div class="flex min-w-[200px] break-words whitespace-normal">
                            {{ $lead->email }}
                            @include('livewire.crm.utilities.copy-this-text-button', [
                                'content' => $lead->email,
                            ])
                        </div>

                    </td>

                    {{-- Phone --}}
                    <td>
                        <div class="flex min-w-[200px] break-words whitespace-normal">
                            {{ $lead->first_telephone }}
                            @include('livewire.crm.utilities.copy-this-text-button', [
                                'content' => $lead->first_telephone,
                            ])
                        </div>

                    </td>

                    {{-- Acquisition Date --}}
                    <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y') }}</td>

                    {{-- Status --}}
                    <td>
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
                        ]) </td>

                    {{-- Actions --}}
                    <td class="flex gap-2 mt-2.5 justify-end">
                        @include('livewire.crm.utilities.detail-button', [
                            'functionName' => 'show',
                            'id' => $lead->id,
                        ])
                        @include('livewire.crm.utilities.delete-button', [
                            'functionName' => 'delete',
                            'id' => $lead->id,
                        ])
                        {{-- Optional: Edit Button --}}
                        {{-- @include('livewire.crm.utilities.edit-button', ['functionName' => 'edit', 'id' => $lead->id]) --}}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $leads->links('customPagination') }}
        </div>
    @else
        <p class="text-gray-500">Nessun elemento da mostrare</p>
    @endif
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert("Copiato: " + text);
        }).catch(err => {
            console.error('Clipboard error:', err);
        });
    }
</script>
