<div>
    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($leads_kanban as $lead)
        <div class="bg-white border-1 border-gray-300  p-4">
            <h3 class="text-lg font-bold text-[#232323]">{{ $lead->company_name }}</h3>
            <div class="flex mb-[22px] mt-[8px]">
                <p class="italic font-extralight text-base leading-5 text-[#B0B0B0] tracking-normal text-left"> {{ $lead->id }}&nbsp;-
                </p>
                <p class="italic font-extralight text-base leading-5 text-[#B0B0B0] tracking-normal text-left">&nbsp; Acquisizione: 
                    {{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y') }}</p>
            </div>

            <div class="flex ">
                <div>
                    <p class="flex font-light text-sm  text-[#B0B0B0] tracking-normal  text-[13px] text-left opacity-100 items-center">
                        <flux:icon.at-symbol class="w-[13px]" />
                        E-mail:
                    </p>
                    <span class="myInput font-semibold text-base leading-5 text-[#B0B0B0] tracking-normal text-left flex mt-[8px]">
                        {{ $lead->email }}
                        <flux:icon.document-duplicate onclick="myFunction('{{ $lead->email }}')"
                            class="text-[#10BDD4] w-[26px] h-[26px] ml-[11px]" />
                    </span>
                </div>

                <div class="ml-[30px]">
                    <p class="flex font-light text-sm  text-[#B0B0B0] tracking-normal  text-[13px] text-left opacity-100 items-center">
                        <flux:icon.phone class="w-[13px]" />
                        Telefono:
                    </p>
                    <span class="font-semibold text-base leading-5 text-[#B0B0B0] tracking-normal text-left flex mt-[8px]">
                        {{ $lead->first_telephone }}
                        <flux:icon.document-duplicate onclick="myFunction('{{ $lead->first_telephone }}')"
                            class="text-[#10BDD4] w-[26px] h-[26px] ml-[11px]" />
                    </span>
                </div>

            </div>

            <p class="mt-2">
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
            </p>
            <div class="mt-3 text-right">
                <button wire:click="show({{ $lead->id }})" title="Dettaglio"
                    class=" text-gray-600 rounded  hover:cursor-pointer">
                    <flux:icon.eye class="text-[#10BDD4]" />
                </button>
                {{-- <button wire:click="edit({{ $lead->id }})" class="px-3 py-1  text-gray-400 hover:cursor-pointer">
                    <flux:icon.pencil-square />
                </button> --}}
                <button wire:click="delete({{ $lead->id }})" title="Cancella"
                    class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer">
                    <flux:icon.trash class="text-[#E63946]" />
                </button>
            </div>
        </div>
        @endforeach
    </div>
{{--     <div class="mt-4">
        {{ $leads->links() }}
    </div> --}}
</div>