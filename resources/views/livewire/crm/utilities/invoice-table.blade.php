@if (empty($accounting_invoices) || count($accounting_invoices) === 0)
<p class="text-gray-500">Nessuna fattura per questo cliente</p>
@else
<table class="w-full p-2 mt-4 ml-[45px]">
    <thead>
        <tr class="text-gray-600">
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Numero Fattura</th>
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Data Fattura</th>
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Data Scadenza</th>
            <th
                class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                Imponibile</th>
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
        @foreach ($accounting_invoices as $accounting_i)
            <tr class="bg-gray-100 border-b h-[50px]">
                <td class="text-left">{{ $accounting_i->number_invoice }}</td>
                <td class="text-left">{{ $accounting_i->date_invoice }}</td>
                <td class="text-left">{{ $accounting_i->expire_invoice }}</td>
                <td class="text-left">{{ $accounting_i->taxable }}</td>
                <td class="text-left">{{ $accounting_i->total }}</td>
                <td class="text-left"><span
                        class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                @if ($accounting_i->status == 0) bg-[#E9F6EC] text-[#28A745] border-[#28A745]
                   
                @elseif($accounting_i->status == 1)
                     bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
                    @else
                      bg-[#FDEBEC] text-[#E63946] border-[#E63946] @endif">
                        @if ($accounting_i->status == 0)
                            Pagata
                        @elseif($accounting_i->status == 1)
                            Da pagare
                        @else
                            Scaduta
                        @endif
                    </span></td>
                <td>
                    @include('livewire.crm.utilities.detail-button', [
                        'functionName' => 'showInvoice',
                        'id' => $accounting_i->id,
                    ])



                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif