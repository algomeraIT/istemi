<div>
    @if($contacts != null)
    <table class="w-full">
        <thead>
            <tr class="text-gray-400 h-10">
                <th
                class=" font-light text-[14px] tracking-[0px] text-[#B0B0B0] text-left font-inter">
                ID</th>
                <th
                    class=" font-light text-[14px] tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    Ragione Sociale</th>
                <th
                    class="font-light text-[14px] tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    Email</th>
                <th
                    class=" font-light text-[14px] tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    telefono</th>
                <th
                    class="font-light text-[14px] tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    Acquisizione</th>
                <th
                    class=" font-light text-[14px] tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    Stato</th>

                    <th
                    class="font-light text-[14px] tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr class="hover:bg-gray-100 h-12 border-b">
                <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">{{
                    $contact->id }}</td>
                <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">{{
                    $contact->company_name }}</td>
           <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">
            <div class="flex items-center">
                <span>{{ $contact->email }}</span>
                <div onclick="myFunction('{{ $contact->email }}')"
                    class="relative group w-[32px] h-[32px] flex items-center justify-center ml-[11px]">
                    <div class="absolute w-full h-full rounded-full border-[1px] border-transparent group-hover:border-[#10BDD4] transition-all"></div>
                    <flux:icon.document-duplicate class="text-[#10BDD4] w-[26px] h-[26px]" />
                </div>
            </div>
        </td>
                <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">
                    <div class="flex items-center">
                        <span>{{ $contact->first_telephone }}</span>
                        <div onclick="myFunction('{{ $contact->first_telephone }}')"
                            class="relative group w-[32px] h-[32px] flex items-center justify-center ml-[11px]">
                            <div class="absolute w-full h-full rounded-full border-[1px] border-transparent group-hover:border-[#10BDD4] transition-all"></div>
                            <flux:icon.document-duplicate class="text-[#10BDD4] w-[26px] h-[26px]" />
                        </div>
                    </div>
                </td>
                <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">{{
                    \Carbon\Carbon::parse($contact->created_at)->format('d/m/Y') }}</td>
                <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">
                    <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                                @if($contact->status == 1)
                                    bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
                                @else
                                    bg-[#F0F1F2] text-[#6C757D] border-[#6C757D]
                     
                                @endif ">
                        @if($contact->status == 1)
                        In contatto
                        @else
                        Non idoneo
                        @endif
                    </span>
                </td>
                </td>
                <td class="">
                    <button wire:click="show({{ $contact->id }})" title="Dettaglio"
                        class=" text-gray-600 rounded  hover:cursor-pointer">
                        <flux:icon.eye class="text-[#10BDD4]" />
                    </button>
                    <button wire:click="delete({{ $contact->id }})" title="Cancella"
                        class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer">
                        <flux:icon.trash class="text-[#E63946]" />
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $contacts->links('customPagination') }}
    </div>
    @else
    <p class="text-gray-500">Nessun elemento da mostrare</p>
    @endif
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