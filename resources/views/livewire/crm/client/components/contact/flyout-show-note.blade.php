<flux:modal name="show-note" variant="flyout" :dismissible="false" class="w-2xl !px-26 hiddenXClose">
    <div class="w-full flex items-center justify-between mb-10">
        <div class="flex items-center gap-2">
            <h2 class="text-2xl font-bold text-left">Nota</h2>
        </div>

        <button class="text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
            x-on:click="$flux.modals().close(); $wire.resetNote()">
            <flux:icon.x-mark class="size-4" />
            <span>Chiudi</span>
        </button>
    </div>

    @if ($noteForm->note)
        <div class="flex flex-col justify-start items-start gap-10">
            {{-- Action buttons --}}
            <div class="w-full flex items-center justify-end">
                <div>
                    <flux:button wire:click="modifyNote({{ $noteForm->note->id }})" variant="ghost"
                        data-variant="ghost" data-color="gray" icon="pencil" size="sm"
                        class="text-[#6C757D] text-xs font-medium">Modifica</flux:button>

                    <flux:button wire:click="deleteNote({{ $noteForm->note->id }})"
                        wire:confirm="Sei sicuro di voler eliminare questa nota?" variant="ghost"
                        data-variant="ghost" data-color="red" icon="trash" size="sm"
                        class="text-[#E63946] text-xs font-medium">Elimina</flux:button>
                </div>
            </div>

            <div class="w-full flex-1 overflow-hidden overflow-y-auto">
                <div class="w-full grid grid-cols-2 gap-x-5 gap-y-5">

                    <div class="col-span-2 flex items-center space-x-3">
                        @if ($noteForm->note->user->hasMedia('userImage'))
                            <flux:avatar circle size="sm"
                                src="{{ $noteForm->note->user->getFirstMediaUrl('userImage', 'preview') }}" />
                        @else
                            <flux:avatar circle size="sm" name="{{ $noteForm->note->user->full_name }}"
                                title="{{ $noteForm->note->user->full_name }}">
                            </flux:avatar>
                        @endif

                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-medium">
                                    {{ $noteForm->note->user->full_name }}
                                    -
                                    {{ $noteForm->note->user->role_name }}
                                </span>
                            </div>
                            <span
                                class="text-xs font-light text-[#B0B0B0]">{{ dateItFormat($noteForm->note->created_at) }}</span>
                        </div>
                    </div>

                    {{-- Attached --}}
                    <div class="col-span-2">
                        @if ($noteForm->note->getMedia('attached')->isNotEmpty())
                            <div class="space-y-2">
                                <div class="text-[#B0B0B0] flex items-center gap-1">
                                    <flux:icon.paper-clip class="size-4" />
                                    <span class="text-xs font-light">Allegati</span>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 ml-5">
                                    @foreach ($noteForm->note->getMedia('attached') as $media)
                                        <div class="w-fit min-w-40 border px-2 flex items-center justify-between gap-5">
                                            <div class="flex items-center gap-2 text-[#888888]">
                                                <flux:icon.paper-clip class="size-4" />
                                                <span
                                                    class="text-[11px] font-medium truncate">{{ $media->file_name }}</span>
                                            </div>

                                            <flux:button variant="ghost" href="{{ $media->getUrl() }}" target="_blank"
                                                data-variant="ghost" data-color="teal" icon="eye" size="sm" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-span-2 mt-4">
                        <div>
                            <div class="flex items-center gap-1 mb-1 ml-1">
                                <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                                <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
                            </div>
                            <flux:editor value="{{ $noteForm->content }}" disabled toolbar="align"
                                class="**:data-[slot=content]:min-h-[100px]!" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</flux:modal>
