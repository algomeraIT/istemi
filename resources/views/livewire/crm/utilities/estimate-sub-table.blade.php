<div class="overflow-x-auto mt-4">
    @php
        $statusMap = [
            0 => [
                'label' => 'Inviato',
                'bg' => 'bg-[#E9F6EC]',
                'text' => 'text-[#28A745]',
                'border' => 'border-[#28A745]',
            ],
            1 => [
                'label' => 'Da inviare',
                'bg' => 'bg-[#FFF9E5]',
                'text' => 'text-[#FEC106]',
                'border' => 'border-[#FFC107]',
            ],
        ];
        $expiringMap = [
            'In scadenza' => [
                'label' => 'In scadenza',
                'text' => 'text-[#FFC107]',
            ],
            'Valido' => [
                'label' => 'Valido',
                'text' => 'text-[#28A745]',
            ],
            'Scaduto' => [
                'label' => 'Scaduto',
                'text' => 'text-[#DC3545]',
            ],
        ];
    @endphp
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

                    @php $e = $expiringMap[$estimate->status_expiration] ?? ['label'=>'Sconosciuto','text'=>'text-gray-600']; @endphp

                    <td class="px-4 py-2 text-left"> <span
                            class="inline-block px-2 py-1 text-xs font-semibold {{ $e['text'] }} ">
                            {{ $e['label'] }}
                        </span></td>

                    <td class="px-4 py-2 text-left">{{ $estimate->price }}</td>
                    <td class="px-4 py-2 text-left">{{ $estimate->total }}</td>
                    @php $s = $statusMap[$estimate->status] ?? ['label'=>'Sconosciuto','bg'=>'bg-gray-100','text'=>'text-gray-600','border'=>'border-gray-600']; @endphp

                    <td class="px-4 py-2 text-left"> <span
                            class="inline-block px-2 py-1 text-xs font-semibold rounded-full border {{ $s['bg'] }} {{ $s['text'] }} {{ $s['border'] }}">
                            {{ $s['label'] }}
                        </span></td>
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
