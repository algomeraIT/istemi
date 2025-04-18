<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-white shadow-md border border-gray-200 p-4 overflow-y-auto h-full">
        @include('livewire.general.cancel')
        <div class="bg-white pt-2.5 border-none h-full">

            <!-- Ragione Sociale -->
            <div class=" ml-[105px] mb-[79px]">
                <label class="flex text-xs  items-center gap-2 text-[24px] leading-[23px] font-bold text-[#232323]">
                </label>
                <p class="font-semibold text-[16px] leading-[20px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">{{
                    $lead->company_name }}</p>
            </div>
            {{-- stato --}}
            <div class=" ml-[105px] mb-[79px]">
                <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                @if($lead->status == 1)
                    bg-purple-100 text-[#6F42C1] border-[#6F42C1]
                @elseif($lead->status == 2)
                    bg-red-100 text-[#E63946] border-[#E63946]
                @elseif($lead->status == 0)
                    bg-cyan-100 text-[#0C7BFF] border-[#0C7BFF]
                @else
                    bg-gray-100 text-gray-600 border-gray-600
                @endif">
                    @if($lead->status == 1)
                    Assegnato
                    @elseif($lead->status == 2)
                    Da riassegnare
                    @elseif($lead->status == 0)
                    Nuovo
                    @else
                    Unknown
                    @endif
                </span>
            </div>
            <div class="flex">
                <!-- Aggiunto il -->
                <div class="mb-[20px] ml-[105px]">
                    <label
                        class="flex font-light text-[13px] leading-[23px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">
                        <span class="text-gray-500 text-sm">
                            <flux:icon.calendar class="w-[10px] mr-[10px]" />
                        </span> Data acquisizione
                    </label>
                    <p class="font-semibold text-[16px] mt-[10px] leading-[20px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">{{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y') }}</p>
                </div>

                <!-- Provenienza -->
                <div class="mb-[20px]  ml-[105px]">
                    <label
                        class="flex font-light text-[13px] leading-[23px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">
                        <span class="text-gray-500 text-sm mr-[10px]">
                            ->
                        </span> Provenienza
                    </label>
                    <p class="font-semibold text-[16px] mt-[10px] leading-[20px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">{{ $lead->provenience }}</p>
                </div>
            </div>
            <!-- Email -->
            <div class="mb-[20px] ml-[105px]">
                <label
                    class="flex font-light text-[13px] leading-[23px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">
                    <span class="text-gray-500 text-sm">
                        <flux:icon.at-symbol class="w-[10px] mr-[10px]" />
                    </span> Email 
                </label>
                <p class="flex font-semibold text-[16px] leading-[20px] mt-[10px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">{{ $lead->email }}<flux:icon.document-duplicate onclick="myFunction('{{ $lead->email }}')"
                    class="text-[#10BDD4] w-[26px] h-[26px] ml-[11px]" /></p>
            </div>
            <!-- Telefono -->
            <div class="mb-[20px] ml-[105px]">
                <label
                    class="flex font-light text-[13px] leading-[23px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">
                    <span class="text-gray-500 text-sm">
                        <flux:icon.phone class="w-[10px] mr-[10px]" />
                    </span> Telefono 
                </label>
                <p class="flex font-semibold text-[16px] leading-[20px] mt-[10px]  tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">{{ $lead->first_telephone }}<flux:icon.document-duplicate onclick="myFunction('{{ $lead->first_telephone }}')"
                    class="text-[#10BDD4] w-[26px] h-[26px] ml-[11px]" /></p>
            </div>



            <!-- Servizio -->
            <div class="mb-[20px] ml-[105px]">
                <label
                    class="flex font-light text-[13px] leading-[23px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">
                    <span class="text-gray-500 text-sm">
                        <flux:icon.briefcase class="w-[10px] mr-[10px]" />
                    </span> Servizio
                </label>
                <p class="font-semibold text-[16px] leading-[20px] mt-[10px]  tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">{{ $lead->service }}</p>
            </div>

            <!-- Note -->
            <div class="mb-[20px] ml-[105px]">
                <label
                    class="flex font-light text-[13px] leading-[23px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">
                    <span class="text-gray-500 text-sm">
                        <flux:icon.clipboard class="w-[10px] mr-[10px]" />
                    </span> Note
                </label>
                {{-- !! serve per impedire che le doppie parentesi graffe tolgano l'html dal campo note --}}
                <p class="font-semibold text-[16px] leading-[20px] mt-[10px] tracking-[0px] text-[#B0B0B0] text-left font-inter opacity-100">{!! $lead->note !!}</p>
            </div>

                   <!-- Commerciale -->
                   <label class="flex ml-[105px] text-xs items-center gap-2 mb-1 text-[13px] leading-[23px] font-light text-[#B0B0B0] tracking-[0px] text-left opacity-100">
                    <span class="text-gray-500 text-sm"><flux:icon.user class="w-[10px]" /></span> Commerciale
                </label>
                <input type="text" wire:model="sales_manager" value="{{ $lead->sales_manager }}"
                    class="w-2/3 ml-[105px] border border-gray-300 rounded-md text-sm p-2 mb-3 focus:outline-none focus:ring-2 focus:ring-cyan-400">
                    <button wire:click="storeSaleManager"
                    class="ml-[105px] px-3 py-1.5 text-sm bg-cyan-400 text-white rounded-md hover:bg-cyan-500 transition">
                    Assegna
                </button>

        </div>
    </div>
</div>

<script>
    function myFunction(text) {
        var textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        textArea.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand('copy');
        document.body.removeChild(textArea);

        alert("Copiato: " + text);
    }
</script>