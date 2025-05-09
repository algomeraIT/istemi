<div class="w-full overflow-x-auto">
    @if ($clients)
        <flux:table>
            <flux:table.columns>
                <flux:table.column>ID</flux:table.column>
                <flux:table.column>Ragione Sociale</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Telefono</flux:table.column>
                <flux:table.column>Acquisizione</flux:table.column>
                <flux:table.column>Stato</flux:table.column>
                <flux:table.column data-th-action>Azioni</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($clients as $client)
                    <flux:table.row :key="$client->id">
                        <flux:table.cell class="flex items-center gap-3">{{ $client->id }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">{{ $client->name }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">{{ $client->email }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">{{ $client->first_telephone }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">{{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}</flux:table.cell>
                        <flux:table.cell>
                            @php
                                $text = match ($client->status) {
                                    1 => 'Nuovo',
                                    2 => 'Assegnato',
                                    3 => 'Da riassegnare',
                                    default => 'Sconosciuto',
                                };
                            @endphp
                            <flux:badge size="sm" data-status="{{$client->status}}" inset="top bottom">{{ $text }}</flux:badge>
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            <flux:button wire:click="show({{ $client->id }})" variant="ghost" data-variant="ghost" data-color="teal" data-rounded icon="eye" size="sm"/>
                            <flux:button wire:click="delete({{ $client->id }})" wire:confirm="Sei sicuro di voler eliminare questo cliente?" variant="ghost" data-variant="ghost" data-color="red" data-rounded icon="trash" size="sm"/>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        <div class="-mx-4 mt-4">
            {{ $clients->links('customPagination') }}
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
