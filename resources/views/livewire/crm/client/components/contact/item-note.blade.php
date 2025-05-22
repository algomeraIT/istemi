<div class="border w-full p-4 mt-5 shadow">
    <div class="w-36 bg-[#F3F3F3] text-[#B0B0B0] flex items-center justify-center gap-2 py-2 -ml-8 mb-6">
        <flux:icon.pencil class="size-4" />
        <span class="text-xs font-bold">Nota</span>
    </div>

    <div class="ml-5">
        {{-- Creator --}}
        <div class="flex items-center space-x-3">
            @if ($note->user?->hasMedia('userImage'))
                <flux:avatar circle size="sm" src="{{ $note->user->getFirstMediaUrl('userImage', 'preview') }}" />
            @else
                <flux:avatar circle size="sm" name="{{ $note->user->full_name }}" title="{{ $note->user->full_name }}" />
            @endif
    
            <div class="flex-1">
                <div class="flex items-center space-x-2 text-sm">
                    <span class="text-sm font-medium">{{ $note->user->full_name }}</span>
                    <span class="text-xs capitalize"> -
                        {{ $note->user?->role_name }}</span>
                </div>
                <div class="flex items-center text-xs mt-1">
                    <span class="text-[#B0B0B0] font-light">{{ $note->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
        
        {{-- Note --}}
        <p class="mt-4 ml-12 text-sm font-semibold text-[#B0B0B0]">
            {{ $note->content }}
        </p>
        
        {{-- Action Buttons --}}
        {{-- <div class="flex items-center gap-2 mt-5">
            <flux:button variant="ghost" wire:click='showNote({{ $note->id }})' data-variant="ghost"
                data-color="teal" icon="eye" size="sm" />
    
            <flux:button wire:click="setNote({{ $note->id }})" variant="ghost" data-variant="ghost"
                data-color="gray" icon="pencil" size="sm" />
    
            <flux:button wire:click="deleteNote({{ $note->id }})"
                wire:confirm="Sei sicuro di voler eliminare questa attività?" variant="ghost" data-variant="ghost"
                data-color="red" icon="trash" size="sm" />
        </div> --}}
    </div>
</div>
