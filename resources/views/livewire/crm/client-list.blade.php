<div class="mx-auto">
    {{-- Responsive Table Wrapper --}}
    <div class="overflow-x-auto w-full">
        <table class="min-w-[800px] w-full text-sm">
            <thead>
                <tr class="text-gray-400 h-10 text-left">
                    @foreach (['ID', 'Logo', 'Ragione sociale', 'E-mail', 'Telefono', 'Sede', 'Etichette', ''] as $heading)
                        <th class="font-inter font-light text-[14px] text-[#B0B0B0] tracking-normal whitespace-nowrap">{{ $heading }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $statusMap = [
                        0 => ['label' => 'Call center', 'bg' => 'bg-[#FEF7EF]', 'text' => 'text-[#F5AD65]', 'border' => 'border-[#F5AD65]'],
                        1 => ['label' => 'Censimento', 'bg' => 'bg-[#E3F1F4]', 'text' => 'text-[#2A8397]', 'border' => 'border-[#2A8397]']
                    ];
                @endphp

                @foreach($clients as $client)
                    @php
                        $status = $statusMap[$client->status] ?? $statusMap[0];
                    @endphp
                    <tr class="border-b h-14 hover:bg-gray-100 text-[#232323]">
                        <td class="font-medium whitespace-nowrap">{{ $client->id }}</td>

                        <td class="whitespace-nowrap">
                            <img src="{{ $client->logo_path ?: asset('images/default-logo.webp') }}" class="w-10 h-10 rounded" />
                        </td>

                        <td class="font-medium whitespace-nowrap">{{ $client->company_name }}</td>

                        <td class="whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="truncate max-w-[150px]">{{ $client->email }}</span>
                                <button onclick="copyToClipboard('{{ $client->email }}')"
                                    class="ml-2 group relative flex items-center justify-center w-8 h-8">
                                    <div class="absolute w-full h-full rounded-full border border-transparent group-hover:border-[#10BDD4] transition-all"></div>
                                    <flux:icon.document-duplicate class="text-[#10BDD4] w-6 h-6" />
                                </button>
                            </div>
                        </td>

                        <td class="whitespace-nowrap">
                            <div class="flex items-center">
                                <span>{{ $client->first_telephone }}</span>
                                <button onclick="copyToClipboard('{{ $client->first_telephone }}')"
                                    class="ml-2 group relative flex items-center justify-center w-8 h-8">
                                    <div class="absolute w-full h-full rounded-full border border-transparent group-hover:border-[#10BDD4] transition-all"></div>
                                    <flux:icon.document-duplicate class="text-[#10BDD4] w-6 h-6" />
                                </button>
                            </div>
                        </td>

                        <td class="font-medium whitespace-nowrap">{{ $client->city }}</td>

                        <td class="whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border {{ $status['bg'] }} {{ $status['text'] }} {{ $status['border'] }}">
                                {{ $status['label'] }}
                            </span>
                        </td>

                        <td class="flex gap-2 whitespace-nowrap">
                            @include('livewire.crm.utilities.detail-button', ['functionName' => 'goToDetail', 'id' => $client->id])
                            @include('livewire.crm.utilities.edit-button', ['functionName' => 'edit', 'id' => $client->id])
                            @include('livewire.crm.utilities.delete-button', ['functionName' => 'delete', 'id' => $client->id])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $clients->links('customPagination') }}
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => alert("Copiato: " + text))
            .catch(err => console.error("Clipboard error:", err));
    }
</script>