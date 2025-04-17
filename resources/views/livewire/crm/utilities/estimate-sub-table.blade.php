<div class="overflow-x-auto mt-4">
    <table class="w-full min-w-[798px] border-collapse font-inter text-sm">
        <thead>
            <tr class="text-gray-600">
                <th class="px-4 py-2 text-left text-[14px] font-medium">Numero preventivo</th>
                <th class="px-4 py-2 text-left text-[14px] font-medium">Data di creazione</th>
                <th class="px-4 py-2 text-left text-[14px] font-medium">Data di scadenza</th>
                <th class="px-4 py-2 text-left text-[14px] font-medium">Stato scadenza</th>
                <th class="px-4 py-2 text-left text-[14px] font-medium">Imponibile</th>
                <th class="px-4 py-2 text-left text-[14px] font-medium">Totale</th>
                <th class="px-4 py-2 text-left text-[14px] font-medium">Stato</th>
                <th class="px-4 py-2 text-left text-[14px] font-medium">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estimates as $estimate)
                <tr class="border-b h-[50px]">
                    <td class="px-4 py-2 text-left">{{ $estimate->serial_number }}</td>
                    <td class="px-4 py-2 text-left">
                        {{ \Carbon\Carbon::parse($estimate->created_at)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 text-left">
                            {{ \Carbon\Carbon::parse($estimate->date_expiration)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 text-left">{{ $estimate->status_expiration }}</td>
                    <td class="px-4 py-2 text-left">{{ $estimate->price }}</td>
                    <td class="px-4 py-2 text-left">{{ $estimate->total }}</td>
                    <td class="px-4 py-2 text-left">{{ $estimate->status }}</td>
                    <td class="px-4 py-2">
                        @include('livewire.crm.utilities.download-button', [
                            'functionName' => 'download',
                            'id' => $estimate->id,
                        ])
                        @include('livewire.crm.utilities.detail-button', [
                            'functionName' => 'showDetail',
                            'id' => $estimate->id,
                        ])

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
