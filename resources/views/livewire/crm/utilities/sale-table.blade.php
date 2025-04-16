@if(empty($sales) || count($sales) === 0)
    <p class="text-gray-500">Nessuna vendita per questo cliente</p>
@else
    <!-- Responsive Table Wrapper -->
    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="text-gray-600">
                    <th class="px-4 py-2 text-left text-[14px] font-medium font-inter">Data</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium font-inter">Fattura</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium font-inter">Importo</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium font-inter">Stato</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium font-inter">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr class="border-b">
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-2">{{ $sale->invoice }}</td>
                        <td class="px-4 py-2">{{ $sale->price }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-[15px] border 
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
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            @include('livewire.crm.utilities.detail-button', ['functionName' => 'showSale', 'id' => $sale->id])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif