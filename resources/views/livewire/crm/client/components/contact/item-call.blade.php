<div class="border w-full p-4 mt-5 shadow">
    <div class="w-36 bg-[#F2EAFA] text-[#A259F4] flex items-center justify-center gap-2 py-2 -ml-8 mb-6">
        <flux:icon.phone class="size-4" />
        <span class="text-xs font-bold">Chiamata</span>
    </div>

    <div class="ml-5">
        {{-- Creator --}}
        <div class="flex items-center space-x-3">
            @if ($call->user?->hasMedia('userImage'))
                <flux:avatar circle size="sm" src="{{ $call->user->getFirstMediaUrl('userImage', 'preview') }}" />
            @else
                <flux:avatar circle size="sm" name="{{ $call->user?->full_name }}" title="{{ $call->user?->full_name }}" />
            @endif
    
            <div class="flex-1">
                <div class="flex items-center space-x-2 text-sm">
                    <span class="text-sm font-medium">{{ $call->user?->full_name }}</span>
                    <span class="text-xs capitalize"> -
                        {{ $call->user?->role_name }}</span>
                </div>
                <div class="flex items-center text-xs mt-1">
                    <span class="text-[#B0B0B0] font-light">{{ $call->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="w-1/2 mt-3 ml-11 ">
            <div class="line-clamp-2 text-[#B0B0B0] text-xs font-medium">
                {!! $call->content !!}
            </div>
        </div>
        
        {{-- Action Buttons --}}
        <div class="flex items-center gap-2 mt-5">
            <flux:button variant="ghost" wire:click='showCall({{ $call->id }})' data-variant="ghost"
                data-color="teal" icon="eye" size="sm" />
    
            <flux:button wire:click="modifyCall({{ $call->id }})" variant="ghost" data-variant="ghost"
                data-color="gray" icon="pencil" size="sm" />
    
            <flux:button wire:click="deleteCall({{ $call->id }})"
                wire:confirm="Sei sicuro di voler eliminare questa chiamata?" variant="ghost" data-variant="ghost"
                data-color="red" icon="trash" size="sm" />
        </div>
    </div>
</div>
