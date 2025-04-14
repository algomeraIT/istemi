<div class=" mx-auto">

    <!-- Clients Table -->
    <table class="w-full">
        <thead>
            <tr class="text-gray-400 h-10">
                <th
                class=" font-light text-[14px]  tracking-[0px] text-[#B0B0B0] text-left font-inter">
                ID</th>
                <th
                    class=" font-light text-[14px]  tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    logo</th>
                <th
                    class="font-light text-[14px]  tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    Ragione sociale</th>
                <th
                    class=" font-light text-[14px]  tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    E-mail</th>
                <th
                    class=" font-light text-[14px]  tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    Telefono</th>
                <th
                    class=" font-light text-[14px]  tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    Sede</th>
                <th
                    class=" w-[200px] font-light text-[14px]  tracking-[0px] text-[#B0B0B0] text-left font-inter">
                    Etichette</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr class="hover:bg-gray-100 border-b h-12 xl:text-[18px] lg:text-[14px] md:text-[12px] sm:text-[10px]">
                <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">{{
                    $client->id }}</td>
                <td class=" font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">
                    <img class="w-10 h-10" src="{{ $client->logo_path ?: asset('images/default-logo.webp') }}" />
                </td>
                <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">{{
                    $client->company_name }}</td>
                <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">
                    <div class="flex items-center">
                        <span>{{ $client->email }}</span>
                        <div onclick="myFunction('{{ $client->email }}')"
                            class="relative group w-[32px] h-[32px] flex items-center justify-center ml-[11px]">
                            <div
                                class="absolute w-full h-full rounded-full border-[1px] border-transparent group-hover:border-[#10BDD4] transition-all">
                            </div>
                            <flux:icon.document-duplicate class="text-[#10BDD4] w-[26px] h-[26px]" />
                        </div>
                    </div>
                </td>
                <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">
                    <div class="flex items-center">
                        <span>{{ $client->first_telephone }}</span>
                        <div onclick="myFunction('{{ $client->first_telephone }}')"
                            class="relative group w-[32px] h-[32px] flex items-center justify-center ml-[11px]">
                            <div
                                class="absolute w-full h-full rounded-full border-[1px] border-transparent group-hover:border-[#10BDD4] transition-all">
                            </div>
                            <flux:icon.document-duplicate class="text-[#10BDD4] w-[26px] h-[26px]" />
                        </div>
                    </div>
                </td>
                <td class="font-medium text-[18px] leading-[21px] text-[#232323] tracking-normal text-left">{{
                    $client->city }}</td>
                <td>
                <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                    @if($client->status == 0)
                        bg-[#FEF7EF] text-[#F5AD65] border-[#F5AD65]
                    @else
                        bg-[#E3F1F4] text-[#2A8397] border-[#2A8397]
                    @endif">
                    @if($client->status == 0)
                    Call center
                    @else
                    Censimento
                    @endif
                </span>
                </td>
                <td class="font-medium text-[18px] text-[#232323] tracking-normal text-left">
                    <button wire:click="goToDetail({{ $client->id }})" title="Dettaglio"
                        class=" text-gray-600 rounded  hover:cursor-pointer">
                        <flux:icon.eye class="text-[#10BDD4]" />
                    </button>
                    <button wire:click="edit({{ $client->id }})" title="Modifica"
                        class="px-3 py-1  text-gray-600 rounded  hover:cursor-pointer">
                        <flux:icon.pencil-square />
                    </button>
                    <button wire:click="delete({{ $client->id }})" title="Cancella"
                        class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer">
                        <flux:icon.trash class="text-[#E63946]" />
                    </button>
               

                 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>
<div class="mt-4">
    {{ $clients->links('customPagination') }}
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