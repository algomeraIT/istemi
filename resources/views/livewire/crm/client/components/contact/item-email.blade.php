<div class="border w-full p-4 mt-5 shadow">
    <div class="w-36 bg-[#E2EDF7] text-[#1278D4] flex items-center justify-center gap-2 py-2 -ml-8 mb-6">
        <flux:icon.envelope class="size-4" />
        <span class="text-xs font-bold">E-mail</span>
    </div>

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
                <span class="text-[#B0B0B0] text-xs capitalize"> -
                    {{ $email->user->role_name }}</span>
            </div>
            <div class="flex items-center text-xs text-gray-600 mt-1">
                <span class="italic">ha inviato un'email</span>
                <div class="w-1 h-1 bg-black rounded-full mx-2"></div>
                <span>{{ $email->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>

    <div class="ml-8">
        <div class="flex items-center gap-8 mt-5">
            <div class="flex items-center gap-2 text-[#B0B0B0]">
                <span class="text-xs font-light">Mittente:</span>
                <span class="font-semibold">{{ $email->sendBy->full_name }}</span>
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
            {{-- <div class="text-[#B0B0B0] flex items-center gap-2">
                <span class="text-xs font-light ">Allegati</span>
                <span class="font-semibold">sample.pdf</span>
            </div> --}}
        </div>

        <div class="flex items-center gap-2">
            <span class="text-xs font-light text-[#B0B0B0]">Oggetto:</span>
            <span class="font-medium text-[#232323]">{{ $email->subject }}</span>
        </div>
    </div>

    <div class="mt-5">
        <flux:button variant="ghost" wire:click='setEmail({{ $email->id }})' data-variant="ghost" data-color="teal"
            icon="eye" size="sm" />
    </div>
</div>
