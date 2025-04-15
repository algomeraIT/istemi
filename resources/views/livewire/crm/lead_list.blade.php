<div class="w-full overflow-x-auto">
    @if ($leads)
        <table class="w-full min-w-[768px] font-inter text-sm text-left">
            <thead class="text-[#B0B0B0] font-light text-[14px]">
                <tr class="h-10">
                    <th>ID</th>
                    <th>Ragione Sociale</th>
                    <th>E-mail</th>
                    <th>Telefono</th>
                    <th>Acquisizione</th>
                    <th>Stato</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                    <tr class="border-b hover:bg-gray-100 h-12 text-[#232323] font-medium xl:text-lg lg:text-base md:text-sm sm:text-xs">
                        <td>{{ $lead->id }}</td>
                        <td>{{ $lead->company_name }}</td>

                        {{-- Email --}}
                        <td>
                            <div class="flex items-center gap-2">
                                <span>{{ $lead->email }}</span>
                                <button onclick="copyToClipboard('{{ $lead->email }}')" class="group relative w-8 h-8 flex items-center justify-center">
                                    <div class="absolute inset-0 rounded-full border group-hover:border-[#10BDD4] transition-all"></div>
                                    <flux:icon.document-duplicate class="text-[#10BDD4] w-6 h-6" />
                                </button>
                            </div>
                        </td>

                        {{-- Phone --}}
                        <td>
                            <div class="flex items-center gap-2">
                                <span>{{ $lead->first_telephone }}</span>
                                <button onclick="copyToClipboard('{{ $lead->first_telephone }}')" class="group relative w-8 h-8 flex items-center justify-center">
                                    <div class="absolute inset-0 rounded-full border group-hover:border-[#10BDD4] transition-all"></div>
                                    <flux:icon.document-duplicate class="text-[#10BDD4] w-6 h-6" />
                                </button>
                            </div>
                        </td>

                        {{-- Acquisition Date --}}
                        <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y') }}</td>

                        {{-- Status --}}
                        <td>
                            @php
                                $statusMap = [
                                    0 => ['text' => 'Nuovo', 'bg' => 'bg-cyan-100', 'textColor' => 'text-[#0C7BFF]', 'border' => 'border-[#0C7BFF]'],
                                    1 => ['text' => 'Assegnato', 'bg' => 'bg-purple-100', 'textColor' => 'text-[#6F42C1]', 'border' => 'border-[#6F42C1]'],
                                    2 => ['text' => 'Da riassegnare', 'bg' => 'bg-red-100', 'textColor' => 'text-[#E63946]', 'border' => 'border-[#E63946]'],
                                ];
                                $status = $statusMap[$lead->status] ?? ['text' => 'Sconosciuto', 'bg' => 'bg-gray-100', 'textColor' => 'text-gray-600', 'border' => 'border-gray-600'];
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border {{ $status['bg'] }} {{ $status['textColor'] }} {{ $status['border'] }}">
                                {{ $status['text'] }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="flex flex-wrap gap-2">
                            @include('livewire.crm.utilities.detail-button', ['functionName' => 'show', 'id' => $lead->id])
                            @include('livewire.crm.utilities.delete-button', ['functionName' => 'delete', 'id' => $lead->id])
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