

<div class="w-full overflow-x-auto">
    @if ($contacts)
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
                @foreach ($contacts as $contact)
                    <flux:table.row :key="$contact->id">
                        <flux:table.cell class="flex items-center gap-3">{{ $contact->id }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">{{ $contact->company_name }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">{{ $contact->email }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">{{ $contact->first_telephone }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">{{ \Carbon\Carbon::parse($contact->created_at)->format('d/m/Y') }}</flux:table.cell>
                        <flux:table.cell>
                            @php
                                $text = match ($contact->status) {
                                    1 => 'In contatto',
                                    2 => 'Non idoneo',
                                    default => 'Sconosciuto',
                                };
                            @endphp
                            <flux:badge size="sm" data-status="{{$contact->status}}" inset="top bottom">{{ $text }}</flux:badge>
                        </flux:table.cell>

                        <flux:table.cell align="end">
                            <flux:button wire:click="goToDetail({{ $contact->id }})" variant="ghost" data-variant="ghost" data-color="teal" data-rounded icon="eye" size="sm"/>
                            <flux:button wire:click="delete({{ $contact->id }})" wire:confirm="Sei sicuro di voler eliminare questo contact?" variant="ghost" data-variant="ghost" data-color="red" data-rounded icon="trash" size="sm"/>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        <div class="-mx-4 mt-4">
            {{ $contacts->links('customPagination') }}
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
