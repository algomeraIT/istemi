<div>
    <div class="mt-4 grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2 md:gap-4">
        @php
            $statusMap = [
                0 => ['label' => 'Nuovo', 'bg' => 'bg-cyan-100', 'text' => 'text-[#0C7BFF]', 'border' => 'border-[#0C7BFF]'],
                1 => ['label' => 'Assegnato', 'bg' => 'bg-purple-100', 'text' => 'text-[#6F42C1]', 'border' => 'border-[#6F42C1]'],
                2 => ['label' => 'Da riassegnare', 'bg' => 'bg-red-100', 'text' => 'text-[#E63946]', 'border' => 'border-[#E63946]'],
            ];
        @endphp

        @foreach ($leads_kanban as $lead)
            @php
                $status = $statusMap[$lead->status] ?? ['label' => 'Sconosciuto', 'bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'border' => 'border-gray-600'];
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
                            <button onclick="copyToClipboard('{{ $lead->email }}')">
                                <flux:icon.document-duplicate class="text-[#10BDD4] w-6 h-6" />
                            </button>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div>
                        <p class="flex items-center gap-1 text-[#B0B0B0] font-light">
                            <flux:icon.phone class="w-4" /> Telefono:
                        </p>
                        <div class="flex items-center gap-2 mt-1 font-semibold text-[#B0B0B0]">
                            {{ $lead->first_telephone }}
                            <button onclick="copyToClipboard('{{ $lead->first_telephone }}')">
                                <flux:icon.document-duplicate class="text-[#10BDD4] w-6 h-6" />
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Status Badge --}}
                <div class="mt-3">
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-[15px] border {{ $status['bg'] }} {{ $status['text'] }} {{ $status['border'] }}">
                        {{ $status['label'] }}
                    </span>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 m-3 text-right flex justify-end gap-2">
                    @include('livewire.crm.utilities.detail-button', ['functionName' => 'show', 'id' => $lead->id])
                    @include('livewire.crm.utilities.delete-button', ['functionName' => 'delete', 'id' => $lead->id])
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