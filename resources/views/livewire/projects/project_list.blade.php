
<div class="w-full overflow-x-auto">
    @if ($projects)


        <flux:table>
            <flux:table.columns>
                <flux:table.column>Preventivo</flux:table.column>
                <flux:table.column>Cliente</flux:table.column>
                <flux:table.column>Tipo cliente</flux:table.column>
                <flux:table.column>Fase progettuale</flux:table.column>
                <flux:table.column>Responsabile</flux:table.column>
                <flux:table.column data-th-action>Azioni</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($projects as $project)
                    <flux:table.row :key="$project->id">
                        <flux:table.cell class="flex items-center gap-3">{{ $project->n_file }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">{{ $project->client_name }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap"> <span
                                class="px-2 py-1 text-xs font-semibold border-1 {{ $project->client_type === 'Pubblico' ? 'bg-[#F6F3F9] text-[#4D1A87] border-[#4D1B86]' : 'bg-[#F2F5F9] text-[#08468B] border-[#08468B]' }}">
                                {{ $project->client_type }}
                            </span></flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">

                            @php
                                $phaseMap = [
                                    1 => [
                                        'label' => 'Avvio',
                                        'bg' => 'bg-[#FFD500]',
                                    ],
                                    2 => [
                                        'label' => 'Pianificazione',
                                        'bg' => 'bg-[#FF6F61]',
                                    ],
                                    3 => [
                                        'label' => 'Esecuzione',
                                        'bg' => 'bg-[#FF6E0E]',
                                    ],
                                    4 => [
                                        'label' => 'Verifica',
                                        'bg' => 'bg-[#FF2F85]',
                                    ],
                                    5 => [
                                        'label' => 'Chiusura',
                                        'bg' => 'bg-[#019B00]',
                                    ],
                                ];

                                $phase = $phaseMap[$project->current_phase] ?? [
                                    'label' => 'Non definito',
                                    'bg' => 'bg-gray-400',
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs text-white font-medium rounded {{ $phase['bg'] }}">
                                {{ $phase['label'] }}
                            </span>
                        </flux:table.cell>

                        <flux:table.cell class="whitespace-nowrap">{{ $project->responsible }}</flux:table.cell>


                        <flux:table.cell align="end">
                            <flux:button wire:click="goToDetail({{ $project->id }})" variant="ghost"
                                data-variant="ghost" data-color="teal" data-rounded icon="eye" size="sm" />
                            <flux:button wire:click="delete({{ $project->id }})"
                                wire:confirm="Sei sicuro di voler eliminare questo project?" variant="ghost"
                                data-variant="ghost" data-color="red" data-rounded icon="trash" size="sm" />
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        <div class="-mx-4 mt-4">
            {{ $projects->links('customPagination') }}
        </div>
    @else
        <p class="text-gray-500">Nessun elemento da mostrare</p>
    @endif
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert("Copiato: " + text);
        }).catch(err => {
            console.error('Clipboard error:', err);
        });
    }
</script>
