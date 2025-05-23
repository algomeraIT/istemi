<div class="fixed inset-0 bg-black/50 flex justify-end z-50">
    <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 bg-white h-full overflow-y-auto rounded-l-2xl shadow-xl">
        
        <!-- Modal Header -->
        <div class="flex justify-between items-start p-6 border-b">
            <h2 class="text-xl font-semibold text-gray-800">Attività</h2>
            <button wire:click="$dispatch('closeModal')" class="text-sm text-gray-500 hover:text-gray-700">
                Chiudi
            </button>
        </div>

        <!-- Modal Content -->
        <div class="p-6 space-y-8">
            @foreach ($this->microTask as $task)
                <div class="space-y-4 border-b pb-6">
                    <h3 class="text-lg font-medium text-gray-900">{{ $task['title'] }}</h3>

                    <div class="flex flex-wrap gap-6 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <flux:icon.at-symbol class="w-4 h-4 text-gray-400" />
                            <span>Assegnato a:</span>
                            <span class="font-medium text-gray-800">{{ $task['assignee'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <flux:icon.calendar class="w-4 h-4 text-gray-400" />
                            <span>Scadenza:</span>
                            <span class="font-medium text-gray-800">
                                {{ \Carbon\Carbon::parse($task['expire'])->format('d/m/Y') ?? '—' }}
                            </span>
                        </div>
                    </div>

                    <div class="text-sm text-gray-700 leading-relaxed">
                        {{ $task['note'] }}
                    </div>

                    <div class="text-xs text-gray-500 flex items-center gap-2">
                        <span>Creato da: {{ $task['assignee'] }}</span>
                        <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                        <span>{{ \Carbon\Carbon::parse($task['created_at'])->diffForHumans() }}</span>
                    </div>

                    <div class="mt-4">
                        @php $isDone = $task['status'] === 'Svolto'; @endphp
                        <select
                            wire:change="updateMicroStatus({{ $task['id'] }}, $event.target.value)"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-400 text-sm
                                {{ $isDone ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700' }}">
                            <option value="In attesa" {{ !$isDone ? 'selected' : '' }}>In attesa</option>
                            <option value="Svolto" {{ $isDone ? 'selected' : '' }}>Svolto</option>
                        </select>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>