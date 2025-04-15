<div class="bg-white p-6 ">
    <table class="w-full border-b ">
        <thead>
            <tr class="h-[50px]">
                <th
                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                    Nome e Cognome</th>
                <th
                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                    Titolo</th>
                <th
                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                    Posizione</th>
                <th
                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                    E-mail</th>
                <th
                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-left opacity-100 font-inter">
                    Telefono</th>
                <th
                    class="text-[14px] leading-[17px] font-medium text-[#B0B0B0] text-center opacity-100 font-inter">
                    Azioni</th>

            </tr>
        </thead>
        <tbody>
            @foreach($referents as $referent)
            <tr class="bg-gray-100  text-gray-800 h-[50px] border-b ">
                <td
                    class=" text-[16px] leading-[20px] font-semibold text-[#232323] text-left opacity-100 font-inter">
                    {{ $referent->name }}
                    {{ $referent->last_name }}
                </td>
                <td
                    class=" b text-[16px] leading-[20px] font-semibold text-[#232323] text-left opacity-100 font-inter">
                    {{ $referent->title }}</td>
                <td
                    class="  text-[16px] leading-[20px] font-semibold text-[#232323] text-left opacity-100 font-inter">
                    {{ $referent->job_position }}</td>
                <td class=" ">{{ $referent->email }}</td>
                <td class="">{{ $referent->telephone }}</td>
                <td class="flex ">
                    @include('livewire.crm.utilities.detail-button', ['functionName' => 'referent', 'id' => $referent->id])


                    <button wire:click="edit({{ $referent->id }})"
                        class="px-3 py-1 text-[#6C757D] hover:cursor-pointer">
                        <flux:icon.pencil-square />
                    </button>

                    <button wire:click="delete({{ $referent->id }})"
                        class="px-3 py-1 text-[#E63946] hover:cursor-pointer">
                        <flux:icon.trash />
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>