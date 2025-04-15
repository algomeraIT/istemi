<div class="mt-4 grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2 md:gap-3 xl:gap-4">
    @php
        $statusMap = [
            1 => ['label' => 'Call center', 'bg' => 'bg-[#FEF7EF]', 'text' => 'text-[#F5AD65]', 'border' => 'border-[#F5AD65]'],
            0 => ['label' => 'Censimento', 'bg' => 'bg-[#E3F1F4]', 'text' => 'text-[#2A8397]', 'border' => 'border-[#2A8397]'],
        ];
    @endphp

    @foreach ($client_kanban as $client)
        @php
            $status = $statusMap[$client->status] ?? $statusMap[0];
        @endphp

        <div class="bg-white border border-gray-300 p-4 rounded shadow-sm">
            <h3 class="text-lg font-bold text-[#232323]">{{ $client->company_name }}</h3>
            <div class="flex mb-5 mt-2 text-sm text-[#B0B0B0] italic font-extralight">
                <p>{{ $client->id }} -</p>
                <p class="ml-1">Acquisizione: {{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}</p>
            </div>

            <div class="flex flex-col md:flex-row md:justify-between">
                {{-- Email --}}
                <div class="mb-3 md:mb-0">
                    <p class="flex items-center text-[13px] text-[#B0B0B0] font-light">
                        <flux:icon.at-symbol class="w-[13px] mr-1" /> E-mail:
                    </p>
                    <div class="flex items-center mt-1 text-base font-semibold text-[#B0B0B0]">
                        {{ $client->email }}
                        <flux:icon.document-duplicate onclick="copyToClipboard('{{ $client->email }}')"
                            class="text-[#10BDD4] w-[26px] h-[26px] ml-3 cursor-pointer" />
                    </div>
                </div>

                {{-- Phone --}}
                <div>
                    <p class="flex items-center text-[13px] text-[#B0B0B0] font-light">
                        <flux:icon.phone class="w-[13px] mr-1" /> Telefono:
                    </p>
                    <div class="flex items-center mt-1 text-base font-semibold text-[#B0B0B0]">
                        {{ $client->first_telephone }}
                        <flux:icon.document-duplicate onclick="copyToClipboard('{{ $client->first_telephone }}')"
                            class="text-[#10BDD4] w-[26px] h-[26px] ml-3 cursor-pointer" />
                    </div>
                </div>
            </div>

            {{-- Status Tag --}}
            <div class="mt-2">
                <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border {{ $status['bg'] }} {{ $status['text'] }} {{ $status['border'] }}">
                    {{ $status['label'] }}
                </span>
            </div>

            {{-- Actions --}}
            <div class="mt-3 text-right flex justify-end items-center space-x-2">
                @include('livewire.crm.utilities.detail-button', ['functionName' => 'goToDetail', 'id' => $client->id])

                <button wire:click="edit({{ $client->id }})" class="text-gray-600 hover:text-blue-500">
                    <flux:icon.pencil-square />
                </button>

                @include('livewire.crm.utilities.delete-button', ['functionName' => 'delete', 'id' => $client->id])
            </div>
        </div>
    @endforeach
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => alert("Copiato: " + text))
            .catch(err => console.error("Clipboard error:", err));
    }
</script>