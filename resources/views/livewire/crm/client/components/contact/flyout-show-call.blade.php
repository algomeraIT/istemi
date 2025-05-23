<flux:modal name="show-call" variant="flyout" :dismissible="false" class="w-2xl !px-26 hiddenXClose">
    <div class="w-full flex items-center justify-between mb-10">
        <div class="flex items-center gap-2">
            <h2 class="text-2xl font-bold text-left">Chiamata</h2>
        </div>

        <button class="text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
            x-on:click="$flux.modals().close(); $wire.resetCall()">
            <flux:icon.x-mark class="size-4" />
            <span>Chiudi</span>
        </button>
    </div>

    @if ($callForm->call)
        <div class="flex flex-col justify-start items-start gap-10">
            {{-- Action buttons --}}
            <div class="w-full flex items-center justify-end">
                <div>
                    <flux:button wire:click="modifyCall({{ $callForm->call->id }})" variant="ghost" data-variant="ghost"
                        data-color="gray" icon="pencil" size="sm" class="text-[#6C757D] text-xs font-medium">
                        Modifica</flux:button>

                    <flux:button wire:click="deleteCall({{ $callForm->call->id }})"
                        wire:confirm="Sei sicuro di voler eliminare questa chiamata?" variant="ghost" data-variant="ghost"
                        data-color="red" icon="trash" size="sm" class="text-[#E63946] text-xs font-medium">
                        Elimina</flux:button>
                </div>
            </div>

            <div class="w-full flex-1 overflow-hidden overflow-y-auto">
                <div class="w-full grid grid-cols-2 gap-x-5 gap-y-5">

                    <div class="col-span-2 flex items-center space-x-3">
                        @if ($callForm->call->user->hasMedia('userImage'))
                            <flux:avatar circle size="sm"
                                src="{{ $callForm->call->user->getFirstMediaUrl('userImage', 'preview') }}" />
                        @else
                            <flux:avatar circle size="sm" name="{{ $callForm->call->user->full_name }}"
                                title="{{ $callForm->call->user->full_name }}">
                            </flux:avatar>
                        @endif

                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-medium">
                                    {{ $callForm->call->user->full_name }}
                                    -
                                    {{ $callForm->call->user->role_name }}
                                </span>
                            </div>
                            <span
                                class="text-xs font-light text-[#B0B0B0]">{{ dateItFormat($callForm->call->created_at) }}</span>
                        </div>
                    </div>

                    {{-- Attached --}}
                    <div class="col-span-2">
                        @if ($callForm->call->getMedia('attached')->isNotEmpty())
                            <div class="space-y-2">
                                <div class="text-[#B0B0B0] flex items-center gap-1">
                                    <flux:icon.paper-clip class="size-4" />
                                    <span class="text-xs font-light">Allegati</span>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 ml-5">
                                    @foreach ($callForm->call->getMedia('attached') as $media)
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
                            <flux:editor value="{{ $callForm->content }}" disabled toolbar="align"
                                class="**:data-[slot=content]:min-h-[100px]!" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</flux:modal>
