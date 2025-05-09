{{-- resources/views/livewire/projects/project-documents-list.blade.php --}}
<div class="overflow-auto">
    <flux:table>
      <flux:table.columns>
        <flux:table.column>Nome documento</flux:table.column>
        <flux:table.column>Data</flux:table.column>
        <flux:table.column>Fase</flux:table.column>
        <flux:table.column>Utente</flux:table.column>
        <flux:table.column>Azioni</flux:table.column>
      </flux:table.columns>
      <flux:table.rows>
        @foreach($docs as $d)
          <flux:table.row>
            <flux:table.cell>{{ $d->document_name }}</flux:table.cell>
            <flux:table.cell>{{ $d->created_at->format('d/m/Y') }}</flux:table.cell>
            <flux:table.cell>{{ $d->phase }}</flux:table.cell>
            <flux:table.cell>{{ $d->user_name }}</flux:table.cell>
            <flux:table.cell>
              <flux:button wire:click="$emitUp('previewDoc', {{ $d->id }})" icon="eye" size="sm" />
            </flux:table.cell>
          </flux:table.row>
        @endforeach
      </flux:table.rows>
    </flux:table>
  </div>