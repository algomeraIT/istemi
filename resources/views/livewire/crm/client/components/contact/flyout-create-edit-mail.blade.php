<flux:modal name="new-email" variant="flyout" @close="resetEmail" :dismissible="false" class="w-2xl !px-26 hiddenXClose">
    <div class="flex flex-col justify-start items-start gap-10">
        <div class="w-full flex items-center justify-between">
            <h2 class="text-2xl font-bold text-left">
                Invia e-mail
            </h2>

            <button class="text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
                x-on:click="$flux.modals().close()">
                <flux:icon.x-mark class="size-4" />
                <span>Annulla</span>
            </button>
        </div>

        <div class="w-full grid grid-cols-2 gap-x-5 gap-y-8">
            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.paper-airplane />
                        <flux:label>Mittente</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model="emailForm.sent_by" searchable>
                        <x-slot name="search">
                            <flux:select.search placeholder="Cerca..." />
                        </x-slot>

                        @foreach ($users as $user)
                            <flux:select.option value="{{ $user->id }}">
                                <div class="flex items-center gap-2">
                                    @if ($user->hasMedia('userImage'))
                                        <flux:avatar circle size="sm"
                                            src="{{ $user->getFirstMediaUrl('userImage', 'preview') }}" />
                                    @else
                                        <flux:avatar circle size="sm" name="{{ $user->full_name }}"
                                            title="{{ $user->full_name }}">
                                        </flux:avatar>
                                    @endif

                                    <div class="flex flex-col">
                                        <div class="space-x-2">
                                            <span>{{ $user->full_name }}</span>
                                            <small class="text-[#B0B0B0] font-light">{{ $user->role_name }}</small>
                                        </div>
                                        <small class="-mt-1.5">{{ $user->email }}</small>
                                    </div>
                                </div>
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="emailForm.sent_by" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.at-symbol />
                        <flux:label>Destinatari</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model="emailForm.to" searchable multiple>
                        <x-slot name="search">
                            <flux:select.search placeholder="Cerca..." />
                        </x-slot>

                        @foreach ($all as $user)
                            <flux:select.option value="{{ $user->email }}">
                                <div class="flex items-center gap-2">
                                    @if ($user->hasMedia('userImage'))
                                        <flux:avatar circle size="sm"
                                            src="{{ $user->getFirstMediaUrl('userImage', 'preview') }}" />
                                    @else
                                        <flux:avatar circle size="sm" name="{{ $user->full_name }}"
                                            title="{{ $user->full_name }}">
                                        </flux:avatar>
                                    @endif

                                    <div class="flex flex-col">
                                        <div class="space-x-2">
                                            <span>{{ $user->full_name }}</span>
                                            <small class="text-[#B0B0B0] font-light">{{ $user->role_name }}</small>
                                        </div>
                                        <small class="-mt-1.5">{{ $user->email }}</small>
                                    </div>
                                </div>
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="emailForm.to" />
                </flux:field>
            </div>

            <div class="col-span-2">
                <flux:field data-input>
                    <div>
                        <flux:icon.document-text />
                        <flux:label>Oggetto</flux:label>
                    </div>
                    <flux:input wire:model="emailForm.subject" />
                    <flux:error name="emailForm.subject" />
                </flux:field>
            </div>

            @if (count($emailForm->attachments))
                <div class="col-span-2 space-y-2">
                    <div class="text-[#B0B0B0] flex items-center gap-1">
                        <flux:icon.paper-clip class="size-4" />
                        <span class="text-xs font-light">Allegati</span>
                    </div>

                    <div class="flex flex-wrap gap-2 pl-4">
                        @foreach ($emailForm->attachments as $file)
                            <div class="border text-[#B0B0B0] px-4 py-1 shadow flex items-center gap-1">
                                <flux:icon.document-plus class="size-4" />
                                {{ $file->getClientOriginalName() }}

                                <flux:icon.x-circle title="rimuovi"
                                    class="size-4 ml-4 cursor-pointer text-[#6C757D] hover:text-red-600"
                                    wire:click="removeMailAttachmentByIndex({{ $loop->index }})" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif


            <div class="col-span-2">
                <div>
                    <div class="flex items-center gap-1 mb-1 ml-1">
                        <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                        <flux:label class="text-xs !font-light !text-[#B0B0B0]">Email</flux:label>
                    </div>
                    <div class="w-full sticky bottom-0">
                        <div class="absolute right-3 top-3">
                            <input type="file" wire:model.live="emailForm.attachments" id="mail-attachment-upload"
                                multiple class="hidden" />

                            <label for="mail-attachment-upload"
                                class="cursor-pointer flex items-center gap-1 text-[#6C757D] hover:text-[#4E4E4E]">
                                <flux:icon.paper-clip class="size-5" />
                            </label>
                        </div>

                        <flux:editor wire:model="emailForm.body" class="**:data-[slot=content]:min-h-[200px]!" />
                    </div>
                </div>
            </div>
        </div>

        <flux:button variant="primary" data-variant="primary" wire:click="sendEmails" data-color="teal">
            Invia
        </flux:button>
    </div>
</flux:modal>
