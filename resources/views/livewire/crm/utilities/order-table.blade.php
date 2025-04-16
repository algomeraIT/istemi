@if (empty($accounting_orders) || count($accounting_orders) === 0)
    <p class="text-gray-500">Nessun ordine per questo cliente</p>
@else
    <!-- Responsive Table Wrapper -->
    <div class="overflow-x-auto mt-4">
        <table class="w-full min-w-[798px] border-collapse font-inter text-sm">
            <thead>
                <tr class="text-gray-600">
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Numero d'ordine</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Data ordine</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Nazione</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Corriere</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Totale</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Stato</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounting_orders as $accounting)
                    <tr class="border-b h-[50px]">
                        <td class="px-4 py-2 text-left">{{ $accounting->order_number }}</td>
                        <td class="px-4 py-2 text-left">{{ $accounting->date }}</td>
                        <td class="px-4 py-2 text-left">{{ $accounting->country }}</td>
                        <td class="px-4 py-2 text-left">{{ $accounting->shipper }}</td>
                        <td class="px-4 py-2 text-left">{{ $accounting->total_price }}</td>
                        <td class="px-4 py-2 text-left">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-[15px] border 
                                @if ($accounting->status == 0)
                                    bg-[#FFF9E5] text-[#FEC106] border-[#FFC107]
                                @elseif($accounting->status == 1)
                                    bg-[#E9F6EC] text-[#28A745] border-[#28A745]
                                @else
                                    bg-[#F0F1F2] text-[#6C757D] border-[#6C757D]
                                @endif">
                                @if ($accounting->status == 0)
                                    In corso
                                @elseif($accounting->status == 1)
                                    Evaso
                                @else
                                    Annullato
                                @endif
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            @include('livewire.crm.utilities.detail-button', [
                                'functionName' => 'showInvoice',
                                'id' => $accounting->id,
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif