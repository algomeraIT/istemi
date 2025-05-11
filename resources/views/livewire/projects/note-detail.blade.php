<div>
    <flux:button>Scrivi nota</flux:button>
    @if ($notes->isNotEmpty())
        @foreach ($notes->groupBy(fn($note) => $note->created_at->locale('it')->isoFormat('MMMM YYYY')) as $month => $monthNotes)
            <div class="mt-8 mb-4 flex items-center">
                <span
                    class="bg-[#F5FCFD] text-[#10BDD4] px-3 py-1 border-[#E8E8E8] border-1 text-[13px] font-semibold ml-12">
                    {{ $month }}
                </span>
                <div class="h-px bg-gray-300 flex-1 "></div>
            </div>

            {{-- All notes in this month --}}
            @foreach ($monthNotes as $note)
                <div class="border w-full p-4 mb-6">
                    <div class="flex items-start space-x-3">
                        <div
                            class="flex h-6 w-6 items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                            <flux:icon.user variant="micro" />
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 text-sm">
                                <span>{{ $note->user_name }}</span>
                                <div class="w-2 h-px bg-gray-400"></div>
                                <span class="text-gray-500">{{ $note->role }}</span>
                            </div>
                            <div class="flex items-center text-xs text-gray-600 mt-1">
                                <span class="italic">ha scritto una nota</span>
                                <div class="w-1 h-1 bg-gray-400 rounded-full mx-2"></div>
                                <span>{{ $note->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-base font-light text-gray-800">
                        {{ $note->note }}
                    </div>
                </div>
            @endforeach
        @endforeach
    @endif
</div>