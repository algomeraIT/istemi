@if (empty($accounting_invoices) || count($accounting_invoices) === 0)
    <p class="text-gray-500">Nessuna fattura per questo cliente</p>
@else
    <!-- Responsive Table Wrapper -->
    <div class="overflow-x-auto mt-4">
        <table class="w-full min-w-[798px] border-collapse font-inter text-sm">
            <thead>
                <tr class="text-gray-600">
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Numero Fattura</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Data Fattura</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Data Scadenza</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Imponibile</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Totale</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Stato</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounting_invoices as $accounting_i)
                    <tr class="border-b h-[50px]">
                        <td class="px-4 py-2 text-left">{{ $accounting_i->number_invoice }}</td>
                        <td class="px-4 py-2 text-left">{{ $accounting_i->date_invoice }}</td>
                        <td class="px-4 py-2 text-left">{{ $accounting_i->expire_invoice }}</td>
                        <td class="px-4 py-2 text-left">{{ $accounting_i->taxable }}</td>
                        <td class="px-4 py-2 text-left">{{ $accounting_i->total }}</td>
                        <td class="px-4 py-2 text-left">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-[15px] border 
                                @if ($accounting_i->status == 0)
                                    bg-[#E9F6EC] text-[#28A745] border-[#28A745]
                                @elseif($accounting_i->status == 1)
                                    bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
                                @else
                                    bg-[#FDEBEC] text-[#E63946] border-[#E63946]
                                @endif">
                                @if ($accounting_i->status == 0)
                                    Pagata
                                @elseif($accounting_i->status == 1)
                                    Da pagare
                                @else
                                    Scaduta
                                @endif
                            </span>
                        </td>
                        <td class="px-4 py-2 text-left">
                            @include('livewire.crm.utilities.detail-button', [
                                'functionName' => 'showInvoice',
                                'id' => $accounting_i->id,
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif