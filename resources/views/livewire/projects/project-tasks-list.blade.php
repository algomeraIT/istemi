{{-- resources/views/livewire/projects/project-tasks-list.blade.php --}}
<div class="bg-white p-4 rounded shadow">
    <h2 class="font-semibold mb-2">Avvio progetto ({{ $tasks->count() }})</h2>
    <ul class="space-y-2">
      @foreach($tasks as $t)
        <li class="flex justify-between border-l-4 pl-3" 
            :class="{'border-green-500': $t->status_contract_ver, 'border-yellow-500': ! $t->status_contract_ver}">
          <div>
            <div class="font-medium">{{ $t->name_phase }}</div>
            <div class="text-xs">Assegnato a: {{ $t->user_contract_ver }}</div>
          </div>
          <div class="flex space-x-2">
            <flux:button wire:click="$emitUp('showTask', {{ $t->id }})" icon="eye" size="sm" />
            {{-- etc. --}}
          </div>
        </li>
      @endforeach
    </ul>
  </div>