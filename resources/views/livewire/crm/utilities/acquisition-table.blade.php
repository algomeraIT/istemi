@if(empty($acquisitions) || count($acquisitions) === 0)
    <p class="text-gray-500">Nessun acquisto per questo cliente</p>
@else
    <!-- Responsive Table Wrapper -->
    <div class="overflow-x-auto mt-4">
        <table class="w-full min-w-[798px] border-collapse font-inter text-sm">
            <thead>
                <tr class="text-gray-600">
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Data</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Fattura</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Importo</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Stato</th>
                    <th class="px-4 py-2 text-left text-[14px] font-medium">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($acquisitions as $acquisition)
                    <tr class=" border-b">
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($acquisition->created_at)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $acquisition->invoice }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $acquisition->price }}
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-[15px] border 
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
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            @include('livewire.crm.utilities.detail-button', [
                                'functionName' => 'showSale',
                                'id' => $acquisition->id
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif