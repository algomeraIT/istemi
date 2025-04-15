@if (empty($accounting_orders) || count($accounting_orders) === 0)
<p class="text-gray-500">Nessun ordine per questo cliente</p>
@else
<table class="w-full border-collapse  p-2 mt-4 ml-[45px]">
    <thead>
        <tr class="text-gray-600">
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Numero d'ordine</th>
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Data ordine</th>
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Nazione</th>
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Corriere</th>
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Totale</th>
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Stato</th>
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accounting_orders as $accounting)
            <tr class="bg-gray-100 border-b h-[50px]">
                <td class="text-left">{{ $accounting->order_number }}</td>
                <td class="text-left">{{ $accounting->date }}</td>
                <td class="text-left">{{ $accounting->country }}</td>
                <td class="text-left">{{ $accounting->shipper }}</td>
                <td class="text-left">{{ $accounting->total_price }}</td>
                <td class="text-left"> <span
                        class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                @if ($accounting->status == 0) bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
                @elseif($accounting->status == 1)
                    bg-[#E9F6EC] text-[#28A745] border-[#28A745]
                    @else
                      bg-[#F0F1F2] text-[#6C757D] border-[#6C757D] @endif">
                        @if ($accounting->status == 0)
                            In corso
                        @elseif($accounting->status == 1)
                            Evaso
                        @else
                            Annullato
                        @endif
                    </span></td>
                <td>
                    @include('livewire.crm.utilities.detail-button', [
                        'functionName' => 'showInvoice',
                        'id' => $accounting->id,
                    ])


                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif