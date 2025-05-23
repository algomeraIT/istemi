<div class="border w-full p-4 mt-5 shadow">
    <div class="w-36 bg-[#F9EDF1] text-[#E873A0] flex items-center justify-center gap-2 py-2 -ml-8 mb-6">
        <flux:icon.calendar class="size-4" />
        <span class="text-xs font-bold">Attività</span>
    </div>

    <div class="ml-5">
        {{-- Creator --}}
        <div class="flex items-center space-x-3">
            @if ($activity->user?->hasMedia('userImage'))
                <flux:avatar circle size="sm" src="{{ $activity->user->getFirstMediaUrl('userImage', 'preview') }}" />
            @else
                <flux:avatar circle size="sm" name="{{ $activity->user->full_name }}"
                    title="{{ $activity->user->full_name }}" />
            @endif
    
            <div class="flex-1">
                <div class="flex items-center space-x-2 text-sm">
                    <span class="text-sm font-medium">{{ $activity->user?->full_name }}</span>
                    <span class="text-xs capitalize"> -
                        {{ $activity->user?->role_name }}</span>
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-600 mt-1">
                    <span class="text-[#B0B0B0]">{{ $activity->created_at->diffForHumans() }}</span>
                    @if (count($activity->messages))
                        <span>• {{ count($activity->messages) }} risposte</span>
                    @endif
                </div>
            </div>
        </div>
    
        {{-- Activity --}}
        <div class="ml-11">
            <div class="flex flex-wrap items-center gap-8 mt-5 mb-3">
                <div class="flex items-center gap-2 text-[#B0B0B0]">
                    <span class="text-xs font-light ">Assegnato a:</span>
                    <flux:avatar.group>
                        @foreach ($activity->assigned()->where('role', 'assegnato')->get() as $user)
                            @if ($user?->hasMedia('userImage'))
                                <flux:avatar circle size="sm"
                                    src="{{ $user->getFirstMediaUrl('userImage', 'preview') }}" />
                            @else
                                <flux:avatar circle size="sm" name="{{ $user->full_name }}"
                                    title="{{ $user->full_name }}">
                                </flux:avatar>
                            @endif
                        @endforeach
                    </flux:avatar.group>
                </div>
    
                @if (count($activity->assigned()->where('role', 'conoscenza')->get()))
                    <div class="flex items-center gap-2 text-[#B0B0B0]">
                        <span class="text-xs font-light ">Conoscenza:</span>
                        <flux:avatar.group>
                            @foreach ($activity->assigned()->where('role', 'conoscenza')->get() as $user)
                                @if ($user?->hasMedia('userImage'))
                                    <flux:avatar circle size="sm"
                                        src="{{ $user->getFirstMediaUrl('userImage', 'preview') }}" />
                                @else
                                    <flux:avatar circle size="sm" name="{{ $user->full_name }}"
                                        title="{{ $user->full_name }}">
                                    </flux:avatar>
                                @endif
                            @endforeach
                        </flux:avatar.group>
                    </div>
                @endif
    
                <div class="flex items-center gap-2 text-[#B0B0B0] text-xs ">
                    <span class="font-light ">Scadenza:</span>
                    <span
                        class="font-medium {{ \Carbon\Carbon::parse($activity->expiration)->isPast() ? 'text-red-600' : 'text-[#28A745]' }}">
                        {{ dateItFormat($activity->expiration) }}
                    </span>
                </div>
    
                <flux:badge size="sm" data-step="{{ $activity->status }}" class="capitalize">
                    {{ $activity->status }}
    
                    <flux:dropdown offset="-15" gap="2">
                        <button class="flex items-center cursor-pointer">
                            <flux:icon.chevron-down class="text-white" variant="micro" />
                        </button>
    
                        <flux:menu>
                            <flux:menu.item wire:click="updateActivityStatus('presa in carico', {{ $activity->id }})"
                                class="!text-custom-9C1216">Presa in carico
                            </flux:menu.item>
                            <flux:menu.item wire:click="updateActivityStatus('completato', {{ $activity->id }})"
                                class="!text-custom-126C9C">Completato
                            </flux:menu.item>
                            <flux:menu.item wire:click="updateActivityStatus('in ritardo', {{ $activity->id }})"
                                class="!text-custom-126C9C">In ritardo
                            </flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </flux:badge>
            </div>
    
            <div class="flex items-center gap-2">
                <span class="text-xs font-light text-[#B0B0B0] ">Titolo:</span>
                <span class="font-medium text-[#232323]">{{ $activity->title }}</span>
            </div>
        </div>
    
        {{-- Action buttons --}}
        <div class="flex items-center gap-2 mt-5">
            <flux:button variant="ghost" wire:click='showActivity({{ $activity->id }})' data-variant="ghost"
                data-color="teal" icon="eye" size="sm" />
    
            <flux:button wire:click="modifyActivity({{ $activity->id }})" variant="ghost" data-variant="ghost"
                data-color="gray" icon="pencil" size="sm" />
    
            <flux:button wire:click="deleteActivity({{ $activity->id }})"
                wire:confirm="Sei sicuro di voler eliminare questa attività?" variant="ghost" data-variant="ghost"
                data-color="red" icon="trash" size="sm" />
        </div>
    </div>
</div>
