<div>
    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
        @foreach ($client_kanban as $client)
        <div class="bg-white border-1 border-gray-300  p-4 ">
            <h3 class="text-lg font-bold text-[#232323]">{{ $client->company_name }}</h3>
            <div class="flex mb-[22px] mt-[8px]">
                <p class="italic font-extralight text-base leading-5 text-[#B0B0B0] tracking-normal text-left"> {{
                    $client->id }}&nbsp;-
                </p>
                <p class="italic font-extralight text-base leading-5 text-[#B0B0B0] tracking-normal text-left">&nbsp;
                    Acquisizione:
                    {{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}</p>
            </div>

            <div class="flex ">
                <div>
                    <p
                        class="flex font-light text-sm  text-[#B0B0B0] tracking-normal  text-[13px] text-left opacity-100 items-center">
                        <flux:icon.at-symbol class="w-[13px]" />
                        E-mail:
                    </p>
                    <span
                        class="myInput font-semibold text-base leading-5 text-[#B0B0B0] tracking-normal text-left flex mt-[8px]">
                        {{ $client->email }}
                        <flux:icon.document-duplicate onclick="myFunction('{{ $client->email }}')"
                            class="text-[#10BDD4] w-[26px] h-[26px] ml-[11px]" />
                    </span>
                </div>

                <div class="ml-[30px]">
                    <p
                        class="flex font-light text-sm  text-[#B0B0B0] tracking-normal  text-[13px] text-left opacity-100 items-center">
                        <flux:icon.phone class="w-[13px]" />
                        Telefono:
                    </p>
                    <span
                        class="font-semibold text-base leading-5 text-[#B0B0B0] tracking-normal text-left flex mt-[8px]">
                        {{ $client->first_telephone }}
                        <flux:icon.document-duplicate onclick="myFunction('{{ $client->first_telephone }}')"
                            class="text-[#10BDD4] w-[26px] h-[26px] ml-[11px]" />
                    </span>
                </div>

            </div>

            <p class="mt-2">
                <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                @if($client->status == 1)
                    bg-[#FEF7EF] text-[#F5AD65] border-[#F5AD65]
                @else
                    bg-[#E3F1F4] text-[#2A8397] border-[#2A8397]
                @endif">
                    @if($client->status == 1)
                    Call center
                    @else
                    Censimento
                    @endif
                </span>
            </p>
            <div class="mt-3 text-right">
                <button wire:click="goToDetail({{ $client->id }})" title="Dettaglio" class="   hover:cursor-pointer">
                    <flux:icon.eye class="text-[#10BDD4]" />
                </button>
                <button wire:click="edit({{ $client->id }})" class="  ml-[10px]  hover:cursor-pointer">
                    <flux:icon.pencil-square />
                </button>
                <button wire:click="delete({{ $client->id }})" title="Cancella"
                    class="  ml-[10px] hover:cursor-pointer">
                    <flux:icon.trash class="text-[#E63946]" />
                </button>
            </div>
        </div>
        @endforeach
    </div>

</div>