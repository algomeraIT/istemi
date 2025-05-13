<flux:tab.group class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-10 pb-8">

    <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100 capitalize">
        {{ $this->clientStatusPlural }}
    </h2>

    <div class="space-y-3 lg:space-y-0 lg:flex lg:items-center lg:justify-between lg:flex-wrap gap-2 pb-4 relative">
        <!-- Crea Button -->
        @if ($clientStatus === 'lead')
            <flux:modal.trigger name="now-lead">
                <flux:button variant="ghost" size="sm" variant="primary" data-variant="primary" data-color="teal">
                    Nuovo {{ $clientStatus }}
                </flux:button>
            </flux:modal.trigger>
        @elseif ($clientStatus === 'cliente')
            <flux:button variant="primary" size="sm" data-variant="primary" data-color="teal"
                wire:click="$dispatch('openModal', { component: 'modals.crm.client.create-or-update', arguments: { clientStatus: '{{ $clientStatus }}'} })">
                Nuovo {{ $clientStatus }}
            </flux:button>
        @endif

        <!-- Tabs -->
        <div class="absolute left-1/2 transform -translate-x-1/2">
            <flux:tabs variant="segmented">
                <flux:tab name="list">
                    <flux:icon.list-bullet class="size-5" /> Lista
                </flux:tab>
                <flux:tab name="kanban">
                    <flux:icon.squares-2x2 class="size-5" /> Kanban
                </flux:tab>
            </flux:tabs>
        </div>

        <!-- Filters -->
        <div class="flex gap-3">
            @if ($clientStatus === 'cliente')
                {{-- City Filter --}}
                <flux:select variant="listbox" wire:model.live="city" placeholder="Tutte le città" data-custom
                    clearable>
                    @foreach ($cities as $city)
                        <flux:select.option value="{{ $city }}">{{ $city }}</flux:select.option>
                    @endforeach
                </flux:select>

                {{-- Label Filter --}}
                <flux:select variant="listbox" wire:model.live="label" placeholder="Tutte le etichette" data-custom
                    clearable>
                    @foreach ($labels as $label)
                        <flux:select.option>{{ $label }}</flux:select.option>
                    @endforeach
                </flux:select>
            @else
                {{-- Status Filter --}}
                <flux:select variant="listbox" wire:model.live="step" placeholder="Tutti gli stati"
                    data-variant="status" data-custom clearable>
                    @foreach ($steps as $step)
                        <flux:select.option>{{ $step }}</flux:select.option>
                    @endforeach
                </flux:select>

                {{-- Year Filter --}}
                <flux:select variant="listbox" wire:model.live="year" placeholder="Date di acquisizione" data-custom
                    clearable>
                    @foreach ($years as $year)
                        <flux:select.option>{{ $year }}</flux:select.option>
                    @endforeach
                </flux:select>
            @endif

            <!-- Search Input -->
            <flux:field data-input>
                <flux:input wire:model.live="search" data-variant="search" :loading="false" clearable
                    icon="magnifying-glass" placeholder="Cerca" />
            </flux:field>
        </div>
    </div>


    <flux:tab.panel name="list" class="!pt-0">
        @include('livewire.crm.client.partials.client-list')
    </flux:tab.panel>

    <flux:tab.panel name="kanban" class="!pt-0">
        @include('livewire.crm.client.partials.client-kanban')
    </flux:tab.panel>


    <!-- Modals -->
    <flux:modal name="now-lead" variant="flyout" class="w-2xl !px-32">
        <div class="flex flex-col justify-start items-start gap-10">
            <h2 class="text-2xl font-bold text-left">Crea lead</h2>

            <div class="w-full grid grid-cols-1 gap-x-5 gap-y-10">
                <flux:field data-input>
                    <div>
                        <flux:icon.clipboard />
                        <flux:label>Nome/Ragione sociale</flux:label>
                    </div>
                    <flux:input wire:model.live="clientForm.name" />
                    <flux:error name="clientForm.name" />
                </flux:field>

                <flux:field data-input>
                    <div>
                        <flux:icon.phone />
                        <flux:label>Telefono</flux:label>
                    </div>
                    <flux:input.group>
                        <flux:select class="max-w-fit">
                            <flux:select.option selected>+39</flux:select.option>
                        </flux:select>
                        <flux:input wire:model.live="clientForm.first_telephone" mask="999 99 99 999" />
                    </flux:input.group>

                    <flux:error name="clientForm.first_telephone" />
                </flux:field>

                <flux:field data-input>
                    <div>
                        <flux:icon.at-symbol />
                        <flux:label>E-mail</flux:label>
                    </div>
                    <flux:input type="email" wire:model.live="clientForm.email" />
                    <flux:error name="clientForm.email" />
                </flux:field>

                <flux:field data-input>
                    <div>
                        <flux:icon.tag />
                        <flux:label>Servizio</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model.live="clientForm.service">
                        @foreach (['privato' => 0, 'pubblico' => 1] as $label => $value)
                            <flux:select.option value="{{ $value }}">
                                {{ ucfirst($label) }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="clientForm.service" />
                </flux:field>


                <div>
                    <div class="flex items-center gap-1 mb-1 ml-1">
                        <flux:icon.document-text class="size-4 text-[#B0B0B0]" />
                        <flux:label class="text-xs !font-light !text-[#B0B0B0]">Nota</flux:label>
                    </div>
                    <flux:editor wire:model="clientForm.note" />
                </div>

                <flux:field data-input>
                    <div>
                        <flux:icon.user />
                        <flux:label>Commerciale</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model="selected_sales_manager">
                        @foreach ($sale_managers as $sale_manager)
                            <flux:select.option value="{{ $sale_manager->id }}">
                                {{ ucfirst($sale_manager->full_name) }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="selected_sales_manager" />
                </flux:field>
            </div>

            <flux:button variant="primary" data-variant="primary" wire:click="create" data-color="teal">
                Crea
            </flux:button>
        </div>
    </flux:modal>
</flux:tab.group>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('copyLink', (data) => {
                var copyText = data[0]['text'];

                if (!navigator.clipboard) {
                    console.warn("Clipboard API non disponibile, utilizzo metodo alternativo.");
                    fallbackCopyText(copyText);
                    return;
                }

                navigator.clipboard.writeText(copyText)
                    .catch(err => {
                        console.error("Errore nella copia del link", err);
                        fallbackCopyText(copyText); // Usa un metodo alternativo
                    });
            });
        });
    </script>
@endpush
