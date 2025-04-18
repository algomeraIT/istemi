
<div class="w-full overflow-x-auto mt-10">
    @if ($contacts)
        <table class="w-full min-w-[798px] font-inter text-sm text-left">
            <thead class="text-[#B0B0B0] font-light text-[14px]">
                <tr class="border-b h-10">
                    <!-- Each <th> gets equal width using Tailwind v4 arbitrary value utility -->
                    <th class="w-[calc(100%/8)]">ID</th>
                    <th class="w-[calc(100%/6)]">Ragione Sociale</th>
                    <th class="w-[calc(100%/6)]">E-mail</th>
                    <th class="w-[calc(100%/6)]">Telefono</th>
                    <th class="w-[calc(100%/6)]">Acquisizione</th>
                    <th class="w-[calc(100%/6)]">Stato</th>
                    <th class="flex justify-end">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr class="border-b h-12 text-[#232323] font-medium xl:text-lg lg:text-base md:text-sm sm:text-xs">
                        <td>{{ $contact->id }}</td>
                        <td>
                            <div class="max-w-[200px] break-words whitespace-normal">
                                {{ $contact->company_name }}
                            </div>
                        </td>

                        {{-- Email --}}
                        <td>
                            <div class="flex min-w-[200px] break-words whitespace-normal">
                                {{ $contact->email }}
                                @include('livewire.crm.utilities.copy-this-text-button', [
                                    'content' => $contact->email,
                                ])
                            </div>
                        </td>

                        {{-- Phone --}}
                        <td>
                            <div class="flex min-w-[200px] break-words whitespace-normal">
                                {{ $contact->first_telephone }}
                                @include('livewire.crm.utilities.copy-this-text-button', [
                                    'content' => $contact->first_telephone,
                                ])
                            </div>
                        </td>

                        {{-- Acquisition Date --}}
                        <td>{{ \Carbon\Carbon::parse($contact->created_at)->format('d/m/Y') }}</td>

                        {{-- Status --}}
                        <td>
                            @php
                                $statusMap = [
                                    0 => [
                                        'text' => 'In contatto',
                                        'bg' => 'bg-[#FFF9E5]',
                                        'textColor' => 'text-[#FEC106]',
                                        'border' => 'border-[#FFC107]',
                                    ],
                                    1 => [
                                        'text' => 'Non idoneo',
                                        'bg' => 'bg-[#F0F1F2]',
                                        'textColor' => 'text-[#6C757D]',
                                        'border' => 'border-[#6C757D]',
                                    ],
                                ];
                                $status = $statusMap[$contact->status] ?? [
                                    'text' => 'Sconosciuto',
                                    'bg' => 'bg-gray-100',
                                    'textColor' => 'text-gray-600',
                                    'border' => 'border-gray-600',
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border {{ $status['bg'] }} {{ $status['textColor'] }} {{ $status['border'] }}">
                                {{ $status['text'] }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="flex gap-2 mt-2.5 justify-end">
                            @include('livewire.crm.utilities.detail-button', [
                                'functionName' => 'goToDetail',
                                'id' => $contact->id,
                            ])
                            @include('livewire.crm.utilities.delete-button', [
                                'functionName' => 'delete',
                                'id' => $contact->id,
                            ])
                            {{-- Optional: Edit Button --}}
                            {{-- @include('livewire.crm.utilities.edit-button', ['functionName' => 'edit', 'id' => $contact->id]) --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $contacts->links('customPagination') }}
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