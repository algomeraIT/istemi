<div class="w-full overflow-x-auto">
    @if ($projects != null)
        <table class=" w-full min-w-[798px] font-inter text-sm text-left">
            <thead class="text-[#B0B0B0] font-light text-[14px]">
                <tr class="border-b h-10">
                    <th class="w-[calc(100%/6)]">Preventivo</th>
                    <th class="w-[calc(100%/3)]">Cliente</th>
                    <th class="w-[calc(100%/6)]">Tipo Cliente</th>
                    <th class="w-[calc(100%/6)]">Fase Progettuale</th>
                    <th class="w-[calc(100%/6)]">Responsabile</th>
                    <th class="flex justify-end">Azioni</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($projects as $project)
                    <tr class="border-b h-12 text-[#232323] font-medium xl:text-lg lg:text-base md:text-sm sm:text-xs">
                        <td class="  py-2">{{ $project->n_file }}</td>
                        <td class="  py-2">{{ $project->client_name }}</td>
                        <td class="  py-2 ">
                            <p>

                                <span
                                    class="px-2 py-1 text-xs font-semibold border-1 {{ $project->client_type === 'Pubblico' ? 'bg-[#F6F3F9] text-[#4D1A87] border-[#4D1B86]' : 'bg-[#F2F5F9] text-[#08468B] border-[#08468B]' }}">
                                    {{ $project->client_type }}
                                </span>

                            </p>
                        </td>
                        <td class="  py-2">
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
                                    {{ $project->current_phase ?? 'Non definito' }}
                                </span>
                            </p>
                        </td>
                        <td class="  py-2">{{ $project->responsible }}</td>
                        <td class="flex gap-2 mt-2.5 justify-end">
                            @include('livewire.crm.utilities.detail-button', [
                                'functionName' => 'show',
                                'id' => $project->id,
                            ])
                            @include('livewire.crm.utilities.delete-button', [
                                'functionName' => 'delete',
                                'id' => $project->id,
                            ])
                            {{-- Optional: Edit Button --}}
                            {{-- @include('livewire.crm.utilities.edit-button', ['functionName' => 'edit', 'id' => $lead->id]) --}}
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
