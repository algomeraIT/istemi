<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <!-- Left Section: Referents -->
    <div class="w-1/3  bg-white">
        <div class="flex flex-row justify-between align-top items-start mx-auto  h-24 p-6">
            <h2 class="text-2xl font-bold text-left">Attività</h2>
            <button wire:click="$dispatch('closeModal')" class="hover:cursor-pointer ">Chiudi</button>
        </div>

        <div class="p-20 bg-white ">

            @foreach ($this->microTask as $task)
                <div>
                    {{ $task['title'] }}
                </div>
                <div class="flex p-4 m-4 font-extralight">
                    <div class=" p-4 m-4">
                        <label class="flex"><flux:icon.at-symbol class="w-4 h-4" />Assegnato a</label>
                        {{ $task['user_name'] }}
                    </div>
                    <div class=" p-4 m-4">
                        <label class="flex">
                            <flux:icon.calendar class="w-4 h-4" />Scadenza
                        </label>
                        {{ $task['expire'] }}
                    </div>
                </div>
                <div class=" font-extralight">
                    {{ $task['note'] }}
                </div>
                <div class="flex mt-4  font-extralight">
                    <p>Creato da: {{ $task['assignee'] }}</p>
                    <div class="w-1 h-1 bg-gray-400 rounded-4xl self-center mr-1 ml-1"></div>
                    {{ $task['created_at'] }}
                </div>

                <div class="w-full h-full px-4 py-2 text-left font-extralight">
                    @php
                        $isDone = $task['status'] === 'Svolto';
                    @endphp
                    <select wire:change="updateMicroStatusStart({{ $task['id'] }}, $event.target.value)"
                        class="bg-transparent w-full appearance-none px-2 py-1 border-none focus:outline-none text-left
                                            {{ $task['status'] === 'Svolto' ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-[#FFF9E5] text-[#FEC106]' }}">
                        <option value="Svolto" {{ $task['status'] === 'Svolto' ? 'selected' : '' }}>
                            <flux:badge wire:click="updateMicroStatusStart({{ $task['id'] }}, 'Svolto')"
                                class="cursor-pointer {{ $isDone ? 'bg-[#E9F6EC] text-[#28A745]' : 'bg-white text-gray-400 border border-gray-200' }}">
                                Svolto
                            </flux:badge>
                        </option>
                        <option value="In attesa" {{ $task['status'] === 'In attesa' ? 'selected' : '' }}>
                            <flux:badge wire:click="updateMicroStatusStart({{ $task['id'] }}, 'In attesa')"
                                class="cursor-pointer {{ !$isDone ? 'bg-[#FFF9E5] text-[#FEC106]' : 'bg-white text-gray-400 border border-gray-200' }}">
                                In attesa
                            </flux:badge>
                        </option>
                    </select>


                </div>
            @endforeach

        </div>


    </div>
</div>
