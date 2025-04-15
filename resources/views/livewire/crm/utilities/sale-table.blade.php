@if(empty($sales) || count($sales) === 0)
<p class="text-gray-500">Nessuna vendita per questo cliente</p>
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
        @foreach($sales as $sale)
        <tr class="bg-gray-100  ">
            <td class="">{{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y') }}</td>
            <td class=" ">{{ $sale->invoice }}</td>
            <td class=" ">{{ $sale->price }}</td>
            <td class=" "> <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                @if($sale->status == 0)
                    bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
                @else
                    bg-[#E9F6EC] text-[#28A745] border-[#28A745]
                @endif">
                    @if($sale->status == 0)
                    In transito
                    @else
                    Consegnato
                    @endif
                </span></td>
            <td>
                @include('livewire.crm.utilities.detail-button', ['functionName' => 'showSale', 'id' => $sale->id])

    
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endif