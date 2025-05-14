
<flux:table class="border-b">
    <flux:table.columns>
        <flux:table.column>Data</flux:table.column>
        <flux:table.column>Fattura</flux:table.column>
        <flux:table.column>Importo</flux:table.column>
        <flux:table.column>Stato</flux:table.column>
        <flux:table.column :align="'end'">Azioni</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
        @foreach ($sales as $sale)
            <flux:table.row wire:key="{{ $sale->id }}">
                <flux:table.cell>{{ dateItFormat($sale->create_at) }}</flux:table.cell>
                <flux:table.cell>{{ $sale->invoice }}</flux:table.cell>
                <flux:table.cell>@money($sale->price)</flux:table.cell>
                <flux:table.cell>
                    <flux:badge size="sm" data-step="{{ $sale->status }}">{{ ucfirst($sale->status) }}</flux:badge>
                </flux:table.cell>

                {{-- Actions --}}
                <flux:table.cell :align="'end'">
                    <flux:button variant="ghost" wire:click="setsale({{ $sale->id }}, 'show')" data-variant="ghost"
                        data-color="teal" icon="eye" size="sm" />
                </flux:table.cell>
            </flux:table.row>
        @endforeach
    </flux:table.rows>
</flux:table>

@if (!$sales)
    <div class="mt-4">
        <p class="text-gray-500 text-center">Nessun Vendita da mostrare</p>
    </div>
@endif

<div class="-mx-4 mt-4">
    {{ $sales->links('customPagination') }}
</div>
