<div class="w-full overflow-x-auto">
    @if ($clients)
        <div class="mx-auto">
            <table class="w-full min-w-[798px] font-inter text-sm text-left">
                <thead class="text-[#B0B0B0] font-light text-[14px]">
                    <tr class="border-b h-10">
                        <th class="w-[calc(100%/8)] whitespace-nowrap">ID</th>
                        <th class="w-[calc(100%/8)] whitespace-nowrap">Logo</th>
                        <th class="w-[calc(100%/8)] whitespace-nowrap">Ragione Sociale</th>
                        <th class="w-[calc(100%/8)] whitespace-nowrap">E-mail</th>
                        <th class="w-[calc(100%/8)] whitespace-nowrap">Telefono</th>
                        <th class="w-[calc(100%/8)] whitespace-nowrap">Sede</th>
                        <th class="w-[calc(100%/8)] whitespace-nowrap">Etichette</th>
                        <th class="flex justify-end whitespace-nowrap">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $statusMap = [
                            0 => [
                                'label'  => 'Call center',
                                'bg'     => 'bg-[#FEF7EF]',
                                'text'   => 'text-[#F5AD65]',
                                'border' => 'border-[#F5AD65]',
                            ],
                            1 => [
                                'label'  => 'Censimento',
                                'bg'     => 'bg-[#E3F1F4]',
                                'text'   => 'text-[#2A8397]',
                                'border' => 'border-[#2A8397]',
                            ]
                        ];
                    @endphp

                    @foreach ($clients as $client)
                        @php
                            $status = $statusMap[$client->status] ?? $statusMap[0];
                        @endphp
                    @include('livewire.crm.utilities.tr-body-table')
                    <!-- ID -->
                            <td class="font-medium whitespace-nowrap">{{ $client->id }}</td>
                            <!-- Logo -->
                            <td class="whitespace-nowrap">
                                <img src="{{ $client->logo_path ?: asset('icon/logo.svg') }}"
                                onerror="this.onerror=null;this.src='{{ asset('icon/logo.svg') }}';"
                                class="w-10 h-10 rounded" alt="Logo" />
                            </td>
                            <!-- Ragione Sociale -->
                            <td class="font-medium">
                                <div class="max-w-[200px] break-words whitespace-normal">
                                    {{ $client->company_name }}
                                </div>
                            </td>
                            <!-- E-mail -->
                            <td class="whitespace-nowrap">
                                <div class="flex items-center min-w-[150px]">
                                    <span class="truncate">{{ $client->email }}</span>
                                    @include('livewire.crm.utilities.copy-this-text-button', [
                                        'content' => $client->email,
                                    ])
                                </div>
                            </td>
                            <!-- Telefono -->
                            <td class="whitespace-nowrap">
                                <div class="flex items-center min-w-[150px]">
                                    <span>{{ $client->first_telephone }}</span>
                                    @include('livewire.crm.utilities.copy-this-text-button', [
                                        'content' => $client->first_telephone,
                                    ])
                                </div>
                            </td>
                            <!-- Sede -->
                            <td class="font-medium whitespace-nowrap">{{ $client->city }}</td>
                            <!-- Etichette (Status) -->
                            <td class="whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border {{ $status['bg'] }} {{ $status['text'] }} {{ $status['border'] }}">
                                    {{ $status['label'] }}
                                </span>
                            </td>
                            <!-- Azioni -->
                            <td class="flex gap-2 mt-2.5 justify-end">
                                @include('livewire.crm.utilities.detail-button', [
                                    'functionName' => 'goToDetail',
                                    'id' => $client->id,
                                ])
                                @include('livewire.crm.utilities.edit-button', [
                                    'functionName' => 'edit',
                                    'id' => $client->id,
                                ])
                                @include('livewire.crm.utilities.delete-button', [
                                    'functionName' => 'delete',
                                    'id' => $client->id,
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $clients->links('customPagination') }}
            </div>
        </div>
    @else
        <p class="text-gray-500">Nessun elemento da mostrare</p>
    @endif
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => alert("Copiato: " + text))
            .catch(err => console.error("Clipboard error:", err));
    }
</script>