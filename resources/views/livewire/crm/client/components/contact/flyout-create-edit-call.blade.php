<flux:modal name="new-call" variant="flyout" @close="resetCall" :dismissible="false" class="w-2xl !px-26 hiddenXClose">
    <div class="flex flex-col justify-start items-start gap-10">
        <div class="w-full flex items-center justify-between">
            <h2 class="text-2xl font-bold text-left">
                @if ($callForm->call)
                    Modifica chiamata
                @else
                    Aggiungi chiamata
                @endif
            </h2>

            <button class="text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
                x-on:click="$flux.modals().close()">
                <flux:icon.x-mark class="size-4" />
                <span>Annulla</span>
            </button>
        </div>

        @if (count($callForm->attachments))
            <div class="space-y-2">
                <div class="text-[#B0B0B0] flex items-center gap-1">
                    <flux:icon.paper-clip class="size-4" />
                    <span class="text-xs font-light">Allegati</span>
                </div>

                <div class="flex flex-wrap gap-2 pl-4">
                    @foreach ($callForm->attachments as $file)
                        <div class="border text-[#B0B0B0] px-4 py-1 shadow flex items-center gap-1">
                            <flux:icon.document-plus class="size-4" />
                            {{ $file->getClientOriginalName() }}

                            <flux:icon.x-circle title="rimuovi"
                                class="size-4 ml-4 cursor-pointer text-[#6C757D] hover:text-red-600"
                                wire:click="removeActivityAttachmentByIndex({{ $loop->index }})" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="w-full">
            <div class="flex items-center gap-1 mb-1 ml-1">
                <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
            </div>

            <div class="w-full sticky bottom-0">
                <div class="absolute right-3 top-3">
                    <input type="file" wire:model="callForm.attachments" id="NewCall-attachment-upload" multiple
                        class="hidden" />

                    <label for="NewCall-attachment-upload"
                        class="cursor-pointer flex items-center gap-1 text-[#6C757D] hover:text-[#4E4E4E]">
                        <flux:icon.paper-clip class="size-5" />
                    </label>
                </div>

                <flux:editor wire:model="callForm.content" class="**:data-[slot=content]:min-h-[150px]!" />
                <flux:error name="callForm.content" />
            </div>
        </div>

        @if ($callForm->call)
            <flux:button variant="primary" data-variant="primary" wire:click="updateCall" data-color="teal">
                Modifica
            </flux:button>
        @else
            <flux:button variant="primary" data-variant="primary" wire:click="createCall" data-color="teal">
                Scrivi
            </flux:button>
        @endif
    </div>
</flux:modal>
