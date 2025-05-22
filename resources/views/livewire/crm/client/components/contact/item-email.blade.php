<div class="border w-full p-4 mt-5 shadow">
    <div class="w-36 bg-[#E2EDF7] text-[#1278D4] flex items-center justify-center gap-2 py-2 -ml-8 mb-6">
        <flux:icon.envelope class="size-4" />
        <span class="text-xs font-bold">E-mail</span>
    </div>

    <div class="ml-5">
        {{-- Creator --}}
        <div class="flex items-center space-x-3">
            @if ($email->user?->hasMedia('userImage'))
                <flux:avatar circle size="sm" src="{{ $email->user->getFirstMediaUrl('userImage', 'preview') }}" />
            @else
                <flux:avatar circle size="sm" name="{{ $email->user->full_name }}"
                    title="{{ $email->user->full_name }}" />
            @endif
    
            <div class="flex-1">
                <div class="flex items-center space-x-2 text-sm">
                    <span class="text-sm font-medium">{{ $email->user->full_name }}</span>
                    <span class="text-xs capitalize"> -
                        {{ $email->user->role_name }}</span>
                </div>
                <div class="flex items-center text-xs text-[#B0B0B0] mt-1">
                    <span>{{ $email->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    
        {{-- Mail --}}
        <div class="ml-8">
            <div class="flex items-center gap-8 my-5">
                <div class="flex items-center gap-2 text-[#B0B0B0]">
                    <span class="text-xs font-light">Mittente:</span>
                    @if ($email->sendBy?->hasMedia('userImage'))
                        <flux:avatar circle size="sm" src="{{ $email->sendBy->getFirstMediaUrl('userImage', 'preview') }}" />
                    @else
                        <flux:avatar circle size="sm" name="{{ $email->sendBy->full_name }}" title="{{ $email->sendBy->full_name }}">
                        </flux:avatar>
                    @endif
                </div>
    
                <div class="flex items-center gap-2 text-[#B0B0B0]">
                    <span class="text-xs font-light ">Destinatari:</span>
                    <flux:avatar.group>
                        @foreach ($email->to() as $user)
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
            </div>
    
            <div class="flex items-center gap-2">
                <span class="text-xs font-light text-[#B0B0B0]">Oggetto:</span>
                <span class="font-medium text-[#232323]">{{ $email->subject }}</span>
            </div>
    
            <div class="w-1/2 mt-3">
                <p class="line-clamp-2 text-[#B0B0B0] text-xs font-medium">{!! $email->body !!}</p>
            </div>
        </div>
    
        {{-- Action Button --}}
        <div class="mt-5">
            <flux:button variant="ghost" wire:click='setEmail({{ $email->id }})' data-variant="ghost" data-color="teal"
                icon="eye" size="sm" />
        </div>
    </div>
</div>
