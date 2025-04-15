<div class="justify-between items-center">
    @if($leads != null)
    <table class="w-full">
        <thead>
            <tr class="text-gray-400 h-10">
                <th class=" font-light text-[14px]   text-[#B0B0B0] text-left font-inter">
                    ID
                </th>
                <th
                    class="font-light text-[14px]   text-[#B0B0B0] text-left font-inter">
                    Ragione Sociale</th>
                <th
                    class=" font-light text-[14px]   text-[#B0B0B0] text-left font-inter">
                    E-mail</th>
                <th
                    class="font-light text-[14px]   text-[#B0B0B0] text-left font-inter">
                    Telefono</th>
                <th class=" font-light text-[14px]   text-[#B0B0B0] text-left font-inter">
                    Acquisizione</th>
                <th class=" font-light text-[14px]   text-[#B0B0B0] text-left font-inter">
                    Stato</th>
                <th class="font-light text-[14px]   text-[#B0B0B0] text-left font-inter">
                    Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
            <tr class="hover:bg-gray-100 border-b h-12 xl:text-[18px] lg:text-[14px] md:text-[12px] sm:text-[10px]">
                <td class="font-medium  text-[#232323] tracking-normal text-left">{{ $lead->id
                    }}</td>
                <td class="font-medium  text-[#232323] tracking-normal text-left">{{
                    $lead->company_name }}</td>
                <td class="font-medium  text-[#232323] tracking-normal text-left">
                    <span class="myInput flex">{{ $lead->email }}
                        <div onclick="myFunction('{{ $lead->email }}')"
                            class="relative group w-[32px] h-[32px] flex items-center justify-center ml-[11px]">
                            <!-- Circle (only visible on hover) -->
                            <div
                                class="absolute w-full h-full rounded-full border-[1px] border-transparent group-hover:border-[#10BDD4] transition-all">
                            </div>

                            <!-- Icon -->
                            <flux:icon.document-duplicate class="text-[#10BDD4] w-[26px] h-[26px] " />
                        </div>
                    </span>
                </td>
                <td class="font-medium  text-[#232323] tracking-normal text-left">
                    <span class="flex">{{ $lead->first_telephone }}
                        <flux:icon.document-duplicate onclick="myFunction('{{ $lead->first_telephone }}')"
                            class="text-[#10BDD4] w-[26px] h-[26px] ml-[11px]" />
                    </span>
                </td>
                <td class="font-medium  text-[#232323] tracking-normal text-left">
                    {{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y') }}
                </td>
                <td class="font-medium  text-[#232323] tracking-normal text-left">
                    <span class="px-2 py-1  font-semibold rounded-[15px] border border-solid 
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
                </td>
                <td class=" md:flex sm:flex">
                    @include('livewire.crm.utilities.detail-button', ['functionName' => 'show', 'id' => $lead->id])
                    @include('livewire.crm.utilities.delete-button', ['functionName' => 'delete', 'id' => $lead->id])

                 
                </td>
                {{-- <td class="text-left w-1">
                    <button wire:click="edit({{ $lead->id }})" title="Modifica"
                        class="px-3 py-1  text-gray-600 rounded  hover:cursor-pointer">
                        <flux:icon.pencil-square />
                    </button>
                </td> --}}

            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $leads->links('customPagination') }}
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