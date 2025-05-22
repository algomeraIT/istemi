<flux:modal name="show-activity" variant="flyout" :dismissible="false" class="w-2xl !px-26">
    <button class="absolute top-4 right-4 text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
        x-on:click="$flux.modals().close()">
        <flux:icon.x-mark class="size-4" />
        <span>Chiudi</span>
    </button>

    @if ($activityForm->activity)
        <div class="flex flex-col justify-start items-start gap-10">
            <div class="flex items-center gap-2">
                <h2 class="text-2xl font-bold text-left">Attività</h2>
            </div>

            <div class="w-full flex items-center justify-between">
                <flux:badge size="sm" data-step="{{ $activityForm->status }}" class="capitalize">
                    {{ $activityForm->status }}

                    <flux:dropdown offset="-15" gap="2">
                        <button class="flex items-center cursor-pointer">
                            <flux:icon.chevron-down class="text-white" variant="micro" />
                        </button>

                        <flux:menu>
                            <flux:menu.item wire:click="updateActivityStatus('presa in carico')"
                                class="!text-custom-9C1216">Presa in carico
                            </flux:menu.item>
                            <flux:menu.item wire:click="updateActivityStatus('completato')" class="!text-custom-126C9C">
                                Completato
                            </flux:menu.item>
                            <flux:menu.item wire:click="updateActivityStatus('in ritardo')" class="!text-custom-126C9C">
                                In ritardo
                            </flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </flux:badge>

                {{-- Action button --}}
                <div>
                    <flux:button wire:click="setActivity({{ $activityForm->activity->id }})" variant="ghost"
                        data-variant="ghost" data-color="gray" icon="pencil" size="sm"
                        class="text-[#6C757D] text-xs font-medium">Modifica</flux:button>

                    <flux:button wire:click="deleteActivity({{ $activityForm->activity->id }})"
                        wire:confirm="Sei sicuro di voler eliminare questa attività?" variant="ghost"
                        data-variant="ghost" data-color="red" icon="trash" size="sm"
                        class="text-[#E63946] text-xs font-medium">Elimina</flux:button>
                </div>
            </div>

            <div class="w-full flex-1 overflow-hidden overflow-y-auto">
                <div class="w-full grid grid-cols-2 gap-x-5 gap-y-5 px-10 relative">
                    <div class="absolute left-4 top-12 bottom-0 w-px bg-[#232323]"></div>

                    <div class="col-span-2 flex items-center space-x-3 -ml-10">
                        @if ($activityForm->activity->user->hasMedia('userImage'))
                            <flux:avatar circle size="sm"
                                src="{{ $activityForm->activity->user->getFirstMediaUrl('userImage', 'preview') }}" />
                        @else
                            <flux:avatar circle size="sm" name="{{ $activityForm->activity->user->full_name }}"
                                title="{{ $activityForm->activity->user->full_name }}">
                            </flux:avatar>
                        @endif

                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-medium">
                                    {{ $activityForm->activity->user->full_name }}
                                    -
                                    {{ $activityForm->activity->user->role_name }}
                                </span>
                            </div>
                            <span
                                class="text-xs font-light text-[#B0B0B0]">{{ dateItFormat($activityForm->activity->created_at) }}</span>
                        </div>
                    </div>

                    <div class="col-span-1">
                        <x-field-data :label="'Attività'" :data="$activityForm->title">
                            <x-slot name="icon">
                                <flux:icon.briefcase class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>

                    <div class="col-span-2 flex items-start justify-between">
                        <x-field-data :label="'Assegnato a'">
                            <x-slot name="icon">
                                <flux:icon.at-symbol class="size-4" />
                            </x-slot>

                            <x-slot name="avatar">
                                <flux:avatar.group>
                                    @foreach ($activityForm->activity->assigned()->where('role', 'assegnato')->get() as $user)
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

                        <x-field-data :label="'Conoscenza'">
                            <x-slot name="icon">
                                <flux:icon.at-symbol class="size-4" />
                            </x-slot>

                            <x-slot name="avatar">
                                <flux:avatar.group>
                                    @foreach ($activityForm->activity->assigned()->where('role', 'conoscenza')->get() as $user)
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

                        <x-field-data :label="'Scadenza'" :data="dateItFormat($activityForm->expiration)">
                            <x-slot name="icon">
                                <flux:icon.calendar-days class="size-4" />
                            </x-slot>
                        </x-field-data>
                    </div>

                    <div class="col-span-2 mt-4">
                        <div>
                            <div class="flex items-center gap-1 mb-1 ml-1">
                                <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                                <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
                            </div>
                            <flux:editor wire:model="activityForm.note" disabled toolbar="align"
                                class="**:data-[slot=content]:min-h-[100px]!" />
                        </div>
                    </div>
                </div>

                {{-- Conversazioni --}}
            </div>


            {{-- TODO da abilitare a seguito di creazione risposte --}}
            {{-- <div class="w-[calc(100%-200px)] fixed bottom-5">
                <flux:editor wire:model="response" placeholder="Scrivi qualcosa..."
                    class="**:data-[slot=content]:min-h-[100px]!" />
            </div> --}}
        </div>
    @endif
</flux:modal>
