<div class="w-full overflow-x-auto">
    @if ($contacts)
        <table class="w-full min-w-[768px] text-left text-sm font-inter">
            <thead class="text-[#B0B0B0] font-light text-lg">
                <tr class="h-10">
                    <th>ID</th>
                    <th>Ragione Sociale</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Acquisizione</th>
                    <th>Stato</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr class="border-b hover:bg-gray-100 h-12">
                        <td class="text-[#232323]">{{ $contact->id }}</td>
                        <td class="text-[#232323]">{{ $contact->company_name }}</td>

                        <td class="text-[#232323]">
                            <div class="flex items-center gap-2">
                                <span>{{ $contact->email }}</span>
                                <button onclick="copyToClipboard('{{ $contact->email }}')" title="Copia email"
                                    class="group relative w-8 h-8 flex items-center justify-center">
                                    <div
                                        class="absolute inset-0 rounded-full border group-hover:border-[#10BDD4] transition-all">
                                    </div>
                                    <flux:icon.document-duplicate class="text-[#10BDD4] w-6 h-6" />
                                </button>
                            </div>
                        </td>

                        <td class="text-[#232323]">
                            <div class="flex items-center gap-2">
                                <span>{{ $contact->first_telephone }}</span>
                                <button onclick="copyToClipboard('{{ $contact->first_telephone }}')"
                                    title="Copia telefono"
                                    class="group relative w-8 h-8 flex items-center justify-center">
                                    <div
                                        class="absolute inset-0 rounded-full border group-hover:border-[#10BDD4] transition-all">
                                    </div>
                                    <flux:icon.document-duplicate class="text-[#10BDD4] w-6 h-6" />
                                </button>
                            </div>
                        </td>

                        <td class="text-[#232323]">
                            {{ \Carbon\Carbon::parse($contact->created_at)->format('d/m/Y') }}
                        </td>

                        <td>
                            @php
                                $isActive = $contact->status == 1;
                                $statusClasses = $isActive
                                    ? 'bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]'
                                    : 'bg-[#F0F1F2] text-[#6C757D] border-[#6C757D]';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border {{ $statusClasses }}">
                                {{ $isActive ? 'In contatto' : 'Non idoneo' }}
                            </span>
                        </td>

                        <td>
                            @include('livewire.crm.utilities.detail-button', [
                                'functionName' => 'show',
                                'id' => $contact->id,
                            ])
                            @include('livewire.crm.utilities.delete-button', [
                                'functionName' => 'delete',
                                'id' => $contact->id,
                            ])
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
        });
    }
</script>
