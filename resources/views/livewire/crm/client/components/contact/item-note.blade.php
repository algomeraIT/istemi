<div class="border w-full p-4 mt-5 shadow">
    <div class="w-36 bg-[#F3F3F3] text-[#B0B0B0] flex items-center justify-center gap-2 py-2 -ml-8 mb-6">
        <flux:icon.pencil class="size-4" />
        <span class="text-xs font-bold">Nota</span>
    </div>

    <div class="flex items-center space-x-3">
        <div class="flex h-6 w-6 items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
            <flux:icon.user class="size-4" />
        </div>
        <div class="flex-1">
            <div class="flex items-center space-x-2 text-sm">
                <span class="text-sm font-medium">{{ $record->user?->full_name }}</span>
                <span class="text-[#B0B0B0] text-xs capitalize"> -
                    {{ $record->user?->role_name }}</span>
            </div>
            <div class="flex items-center text-xs text-gray-600 mt-1">
                <span class="italic">ha scritto una nota</span>
                <div class="w-1 h-1 bg-black rounded-full mx-2"></div>
                <span>{{ $record->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>

    <div class="text-[#B0B0B0] mt-5 ml-8">
        <div class="flex items-center gap-1">
            <flux:icon.paper-clip class="size-4" />
            <span class="text-xs font-light ">Allegati</span>
        </div>
        <span class="font-semibold ml-4">sample.pdf</span>
    </div>

    <p class="mt-4 ml-12 text-lg font-light text-[#B0B0B0]">
        {{ $record->content }}
    </p>
</div>
