<div class="bg-white p-6">
    <!-- Responsive Wrapper -->
    <div class="overflow-x-auto">
        <table class="w-full border-b min-w-[798px]">
            <thead>
                <tr class="h-[50px]">
                    <th class="px-4 text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                        Nome e Cognome
                    </th>
                    <th class="px-4 text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                        Titolo
                    </th>
                    <th class="px-4 text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                        Posizione lavorativa
                    </th>
                    <th class="px-4 text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                        E-mail
                    </th>
                    <th class="px-4 text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                        Telefono
                    </th>
                    <th class="px-4 text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-center opacity-100 font-inter">
                        Azioni
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($referents as $referent)
                    <tr class="h-[50px] border-b text-gray-800">
                        <!-- Name & Last Name -->
                        <td class="px-4 py-2 text-[16px] leading-[20px] font-semibold text-[#232323] text-left opacity-100 font-inter">
                            {{ $referent->name }} {{ $referent->last_name }}
                        </td>
                        <!-- Title -->
                        <td class="px-4 py-2 text-[16px] leading-[20px] font-semibold text-[#232323] text-left opacity-100 font-inter">
                            {{ $referent->title }}
                        </td>
                        <!-- Job Position -->
                        <td class="px-4 py-2 text-[16px] leading-[20px] font-semibold text-[#232323] text-left opacity-100 font-inter">
                            {{ $referent->job_position }}
                        </td>
                        <!-- E-mail -->
                        <td class="px-4 py-2">
                            <div class="flex items-center">
                                <span class="truncate">{{ $referent->email }}</span>
                            </div>
                        </td>
                        <!-- Telephone -->
                        <td class="px-4 py-2">
                            <div class="flex items-center">
                                <span class="truncate">{{ $referent->telephone }}</span>
                            </div>
                        </td>
                        <!-- Azioni -->
                        <td class="px-4 py-2">
                            <div class="flex items-center justify-center space-x-2">
                                @include('livewire.crm.utilities.detail-button', ['functionName' => 'referent', 'id' => $referent->id])
                                <button wire:click="edit({{ $referent->id }})" class="px-3 py-1 text-[#6C757D] hover:cursor-pointer">
                                    <flux:icon.pencil-square />
                                </button>
                                <button wire:click="delete({{ $referent->id }})" class="px-3 py-1 text-[#E63946] hover:cursor-pointer">
                                    <flux:icon.trash />
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => alert("Copiato: " + text))
            .catch(err => console.error("Clipboard error:", err));
    }
</script>