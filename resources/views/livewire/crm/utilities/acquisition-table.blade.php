@if(empty($acquisitions) || count($acquisitions) === 0)
<p class="text-gray-500">Nessun acquisto per questo cliente</p>
@else
<table class="w-full border-collapse  p-2 mt-4 ml-[45px]">
    <thead>
        <tr class="text-gray-600">
            <th class=" text-left ">Data</th>
            <th class=" text-left">Fattura</th>
            <th class=" text-left ">Importo</th>
            <th class=" text-left ">Stato</th>
            <th class="text-left">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($acquisitions as $acquisition)
        <tr class="bg-gray-100 ">
            <td class="">{{ \Carbon\Carbon::parse($acquisition->created_at)->format('d/m/Y') }}
            </td>
            <td class=" ">{{ $acquisition->invoice }}</td>
            <td class=" ">{{ $acquisition->price }}</td>
            <td class=" "> <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
            @if($acquisition->status == 0)
                bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
            @else
                bg-[#E9F6EC] text-[#28A745] border-[#28A745]
            @endif">
                    @if($acquisition->status == 0)
                    In arrivo
                    @else
                    Ricevuta
                    @endif
                </span></td>
            <td>
                @include('livewire.crm.utilities.detail-button', ['functionName' => 'showSale', 'id' => $acquisition->id])

              
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endif