<flux:modal name="show-email" variant="flyout" @close="resetEmail" :dismissible="false" class="w-2xl !px-26 hiddenXClose">
    <div class="w-full flex items-center justify-between mb-10">
        <div class="flex items-center gap-2">
            <h2 class="text-2xl font-bold text-left">E-mail</h2>
        </div>

        <button class="text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
            x-on:click="$flux.modals().close()">
            <flux:icon.x-mark class="size-4" />
            <span>Annulla</span>
        </button>
    </div>

    @if ($emailForm->email)
        <div class="flex flex-col justify-start items-start gap-10">
            <div class="w-full flex-1 overflow-hidden overflow-y-auto">
                <div class="w-full grid grid-cols-2 gap-x-5 gap-y-5 pl-10 relative">
                    <div class="absolute left-4 top-12 bottom-0 w-px bg-[#232323]"></div>

                    <div class="col-span-2 flex items-center space-x-3 -ml-10">
                        @if ($emailForm->email->user->hasMedia('userImage'))
                            <flux:avatar circle size="sm"
                                src="{{ $emailForm->email->user->getFirstMediaUrl('userImage', 'preview') }}" />
                        @else
                            <flux:avatar circle size="sm" name="{{ $emailForm->email->user->full_name }}"
                                title="{{ $emailForm->email->user->full_name }}">
                            </flux:avatar>
                        @endif

                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-medium">
                                    {{ $emailForm->email->user->full_name }}
                                    -
                                    {{ $emailForm->email->user->role_name }}
                                </span>
                            </div>
                            <span
                                class="text-xs font-light text-[#B0B0B0]">{{ dateItFormat($emailForm->email->created_at) }}</span>
                        </div>
                    </div>

                    <div class="col-span-2 grid grid-cols-3">
                        <x-field-data :label="'Mittente'">
                            <x-slot name="icon">
                                <flux:icon.paper-airplane class="size-4" />
                            </x-slot>

                            <x-slot name="avatar">
                                <flux:avatar.group>
                                    @if ($emailForm->email->sendBy->hasMedia('userImage'))
                                        <flux:avatar circle size="sm"
                                            src="{{ $emailForm->email->sendBy->getFirstMediaUrl('userImage', 'preview') }}" />
                                    @else
                                        <flux:avatar circle size="sm"
                                            name="{{ $emailForm->email->sendBy->full_name }}"
                                            title="{{ $emailForm->email->sendBy->full_name }}">
                                        </flux:avatar>
                                    @endif
                                </flux:avatar.group>
                            </x-slot>
                        </x-field-data>

                        <x-field-data :label="'Destinatari'">
                            <x-slot name="icon">
                                <flux:icon.at-symbol class="size-4" />
                            </x-slot>

                            <x-slot name="avatar">
                                <flux:avatar.group>
                                    @foreach ($emailForm->email->to() as $user)
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
                            </x-slot>
                        </x-field-data>
                    </div>

                    <div class="col-span-1">
                        <x-field-data :label="'Oggetto'" :data="$emailForm->subject">
                            <x-slot name="icon">
                                <span class="text-[#B0B0B0] font-light">T</span>
                            </x-slot>
                        </x-field-data>
                    </div>

                    {{-- Attached --}}
                    <div class="col-span-2">
                        @if ($emailForm->email->getMedia('attached')->isNotEmpty())
                            <div class="space-y-2">
                                <div class="text-[#B0B0B0] flex items-center gap-1">
                                    <flux:icon.paper-clip class="size-4" />
                                    <span class="text-xs font-light">Allegati</span>
                                </div>

                                <div class="flex flex-wrap items-center gap-2">
                                    @foreach ($emailForm->email->getMedia('attached') as $media)
                                        <div class="w-fit min-w-40 border px-2 flex items-center justify-between gap-5">
                                            <div class="flex items-center gap-2 text-[#888888]">
                                                <flux:icon.document class="size-4" />
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
                                <flux:label class="text-xs !font-light !text-[#B0B0B0]">E-mail</flux:label>
                            </div>
                            <flux:editor value="{{ $emailForm->body }}" disabled toolbar="align"
                                class="**:data-[slot=content]:min-h-[100px]!" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</flux:modal>
