<div>
    <div class="w-full overflow-x-auto">
        @if ($this->document)
            <flux:table>
                <flux:table.columns>
                    <flux:table.column>Nome documento</flux:table.column>
                    <flux:table.column>Data caricamento</flux:table.column>
                    <flux:table.column>Fase progettuale</flux:table.column>
                    <flux:table.column>Caricato da</flux:table.column>
                    <flux:table.column data-th-action>Azioni</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($this->document as $doc)
                        <flux:table.row :key="$doc->id">

                            <flux:table.cell class="whitespace-nowrap">
                                {{ $doc->document_name }}</flux:table.cell>
                            <flux:table.cell class="whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}
                            </flux:table.cell>
                            <flux:table.cell class="whitespace-nowrap">
                                {{ $doc->phase }}</flux:table.cell>
                            <flux:table.cell class="whitespace-nowrap">
                                {{ $doc->user_name }}</flux:table.cell>
                            <flux:table.cell align="end">
                                <flux:button wire:click="show({{ $doc->id }})"
                                    variant="ghost" data-variant="ghost" data-color="teal"
                                    data-rounded icon="eye" size="sm" />
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
            {{--       <div class="-mx-4 mt-4">
                {{ $start->links('customPagination') }}
            </div> --}}
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
</div>