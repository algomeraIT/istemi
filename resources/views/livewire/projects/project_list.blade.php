
<div class="w-full">

    @if ($listProjects)
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
                @foreach ($listProjects as $project)
                    <flux:table.row :key="$project->id">
                        <flux:table.cell class="flex items-center gap-3">{{ $project->estimate }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">{{ $project->client_name }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">
                            <flux:badge color="{{ $project->client_type === 'Pubblico' ? 'violet' : 'blue' }}">{{ $project->client_type }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">

                            @php
                                $phaseMap = [
                                    'Avvio' => [
                                        'bg' => 'bg-[#FFD500]',
                                    ],
                                    'Pianificazione' => [
                                        'bg' => 'bg-[#FF6F61]',
                                    ],
                                    'Esecuzione' => [
                                        'bg' => 'bg-[#FF6E0E]',
                                    ],
                                    'Verifica' => [
                                        'bg' => 'bg-[#FF2F85]',
                                    ],
                                    'Chiusura' => [
                                        'bg' => 'bg-[#019B00]',
                                    ],
                                ];

                                $phase = $phaseMap[$project->current_phase] ?? [
                                    'label' => 'Non definito',
                                    'bg' => 'bg-gray-400',
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs text-white font-medium rounded {{ $phase['bg'] }}">
                                {{ $project->current_phase }}
                            </span>
                        </flux:table.cell>

                        <flux:table.cell class="whitespace-nowrap">{{ $project->responsible()->first()->full_name }}</flux:table.cell>


                        <flux:table.cell align="end">
                            <flux:button wire:click="goToDetail({{ $project->id }})" variant="ghost"
                                data-variant="ghost" data-color="teal" data-rounded icon="eye" size="sm" />
                                <flux:button
                                wire:click="$dispatch('openModal', { component: 'projects.modals.edit-project', arguments: { id: {{ $project->id }} } })"
                                variant="ghost" data-variant="ghost" data-color="gray" data-rounded
                                icon="pencil" size="sm" />
                                
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        <div class="-mx-4 mt-4">
            {{ $listProjects->links('customPagination') }}
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
