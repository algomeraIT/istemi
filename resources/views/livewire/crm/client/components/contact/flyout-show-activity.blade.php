<flux:modal name="show-activity" variant="flyout" :dismissible="false" class="w-2xl !px-32">
    <button class="absolute top-4 right-4 text-lg z-10 bg-white text-[#A0A0A0] flex items-center gap-1 cursor-pointer"
        x-on:click="$flux.modals().close()">
        <flux:icon.x-mark class="size-4" />
        <span>Chiudi</span>
    </button>

    @if ($activityForm->activity)
        <div class="flex flex-col justify-start items-start gap-10">
            <div class="flex items-center gap-2">
                <h2 class="text-2xl font-bold text-left">Attività programmata</h2>
            </div>

            <div class="w-full grid grid-cols-2 gap-x-5 gap-y-10">
                <div class="col-span-2 flex items-center space-x-3 -ml-10">
                    <div class="flex h-6 w-6 items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                        <flux:icon.user class="size-4" />
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-2">
                            <span class="text-[15px] font-medium">{{ $activityForm->activity->user->full_name }}</span>
                            <span class="text-[#B0B0B0] text-xs capitalize"> -
                                {{ $activityForm->activity->user->role_name }}</span>
                        </div>
                        <div class="flex items-center text-xs text-gray-600 mt-1">
                            <span class="italic">ha programmato un'attività</span>
                            <div class="w-1 h-1 bg-black rounded-full mx-2"></div>
                            <span>{{ $activityForm->activity->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

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
                                <flux:menu.item wire:click="updateActivityStatus('completato')"
                                    class="!text-custom-126C9C">Completato
                                </flux:menu.item>
                                <flux:menu.item wire:click="updateActivityStatus('in ritardo')"
                                    class="!text-custom-126C9C">In ritardo
                                </flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    </flux:badge>
                </div>

                <div class="col-span-1">
                    <x-field-data :label="'Attività'" :data="$activityForm->title">
                        <x-slot name="icon">
                            <flux:icon.briefcase class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>

                <div class="col-span-1">
                    <x-field-data :label="'Scadenza'" :data="dateItFormat($activityForm->expiration)">
                        <x-slot name="icon">
                            <flux:icon.calendar-days class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>

                <div class="col-span-2">
                    <x-field-data :label="'Assegnato a'" :data="$activityForm->activity->assigned->pluck('full_name')->implode(', ')">
                        <x-slot name="icon">
                            <flux:icon.at-symbol class="size-4" />
                        </x-slot>
                    </x-field-data>
                </div>

                <div class="col-span-2">
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

            {{-- <flux:button variant="ghost" data-color="teal">
                <flux:icon.arrow-turn-down-right class="size-4" />
                Rispondi
            </flux:button> --}}
        </div>
    @endif
</flux:modal>
