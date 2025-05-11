<div class=" max-h-screen bg-white p-4">
    {{-- Title with counts --}}
    <div>
        <h2 class="text-[#08468B] text-[14px] font-medium">{{ $nameSection }}
        </h2>
        <div class="flex space-x-2">

            <p class="text-[#B0B0B0] text-[13px]">
                {{ count($elements) }} task
            <div class="w-1 h-1 bg-gray-400 rounded-4xl self-center"></div>
            </p>
            <p class="text-[#FDC106] text-[13px]">
                {{ $elements->where('status_contract_ver', false)->count() }}
                in attesa</p>
            <p class="text-[#28A745] text-[13px]">
                {{ $elements->where('status_contract_ver', true)->count() }}
                svolti </p>
        </div>
    </div>


    {{-- Vertical list --}}
    <ul class="flex space-x-4 overflow-x-auto">
        @foreach ($elements as $element)
            <li class="w-[400px] border-l-4 border-l-[#08468B] border-1 shadow pl-3 p-4">
                <div class="text-sm font-medium text-gray-800">
                    {{ $nameSection }}
                </div>
                <div class="flex justify-between items-center text-xs text-gray-600 mt-0.5">
                    <div class="flex items-center font-extralight">
                        <div
                            class="flex h-6 w-6 items-center mr-2 justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4] dark:bg-neutral-700 dark:text-white">
                            <flux:icon.user variant="micro" />
                        </div>
                        {{ $element->user }}
                    </div>
                
                    <div>
                        <span class="font-semibold {{ $element->status_contract_ver ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ $element->status_contract_ver ? 'Svolto' : 'In attesa' }}
                        </span>
                    </div>
                </div>

                <div>
                    <flux:button wire:click="edit({{ $element->id }})" variant="ghost" data-variant="ghost"
                        data-color="gray" data-rounded icon="pencil" size="sm" />
                    <flux:button wire:click="delete({{ $element->id }})"
                        wire:confirm="Sei sicuro di voler eliminare questa fase?" variant="ghost" data-variant="ghost"
                        data-color="red" data-rounded icon="trash" size="sm" />
                </div>
            </li>
        @endforeach
    </ul>
</div>
