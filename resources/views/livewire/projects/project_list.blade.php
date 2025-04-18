<div class="w-full overflow-x-auto">
    @if ($projects != null)
        <table class="w-full bg-white border border-gray-300 shadow-md rounded-lg">
            <thead>
                <tr class=" text-gray-400">
                    <th class="px-4 py-2 text-left">Pratica</th>
                    <th class="px-4 py-2 text-left">Cliente</th>
                    <th class="px-4 py-2 text-left">Tipo Cliente</th>
                    <th class="px-4 py-2 text-left">Fase Progettuale</th>
                    <th class="px-4 py-2 text-left">Responsabile</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($projects as $project)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $project->n_file }}</td>
                        <td class="px-4 py-2">{{ $project->client_name }}</td>
                        <td class="px-4 py-2 ">
                            <p>
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded {{ $project->client_type ? 'bg-gray-400' : 'bg-purple-400' }}">
                                    {{ $project->client_type ? 'Pubblico' : 'Privato' }}
                                </span>
                            </p>
                        </td>
                        <td class="px-4 py-2">
                            <p>
                                @php
                                    switch ($project->current_phase) {
                                        case 'Avvio':
                                            $bgColor = 'bg-blue-400';
                                            break;
                                        case 'Pianificazione':
                                            $bgColor = 'bg-green-400';
                                            break;
                                        case 'Esecuzione':
                                            $bgColor = 'bg-yellow-400';
                                            break;
                                        case 'Verifica':
                                            $bgColor = 'bg-red-400';
                                            break;
                                        case 'Chiusura':
                                            $bgColor = 'bg-gray-400';
                                            break;
                                        default:
                                            $bgColor = 'bg-gray-400';
                                    }
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded {{ $bgColor }}">
                                    {{ $project->current_phase }}
                                </span>
                            </p>
                        </td>
                        <td class="px-4 py-2">{{ $project->responsible }}</td>
                        <td class="px-4 py-2 w-2">
                            <button wire:click="show({{ $project->id }})" title="Dettaglio"
                                class="py-1  text-gray-600 rounded  hover:cursor-pointer">
                                <flux:icon.eye />
                            </button>
                        </td>
                        <td class="px-4 py-2 w-2">
                            <button wire:click="edit({{ $project->id }})" title="Modifica"
                                class=" py-1  text-gray-600 rounded  hover:cursor-pointer">
                                <flux:icon.pencil-square />
                            </button>
                        </td>
                        <td class="px-4 py-2 w-2">
                            <button wire:click="delete({{ $project->id }})" title="Cancella"
                                class=" py-1  text-gray-600 rounded  ml-2 hover:cursor-pointer">
                                <flux:icon.x-mark />
                            </button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    @else
        <p class="text-gray-500">Nessun elemento da mostrare</p>
    @endif
</div>
