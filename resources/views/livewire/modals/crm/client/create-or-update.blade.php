<div class="p-10 h-[85vh]">
    <div class="flex items-start justify-between mb-24">
        <h3 class="text-2xl font-semibold mb-6">
            {{ $clientForm->client ? 'Aggiorna' : 'Crea' }}
            {{ $clientForm->status }}
        </h3>

        <button wire:click="$dispatch('closeModal')"
            class="font-light text-[#B0B0B0] flex items-center gap-1 cursor-pointer">
            <flux:icon.x-mark class="size-4" /> Annulla
        </button>
    </div>

    <div class="md:flex-row gap-6">
        {{-- LEFT: All inputs --}}
        <div class="flex gap-4 pb-10">
            <div class="w-2/3 p-10 bg-[#F8FEFF] border">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-x-5 gap-y-10">
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
                            <flux:icon.tag />
                            <flux:label>Tipo cliente</flux:label>
                        </div>
                        <flux:select variant="listbox" wire:model.live="clientForm.is_company">
                            @foreach (['privato' => 0, 'pubblico' => 1] as $label => $value)
                                <flux:select.option value="{{ $value }}">
                                    {{ ucfirst($label) }}
                                </flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="clientForm.is_company" />
                    </flux:field>

                    <flux:field data-input>
                        <div>
                            <flux:icon.clipboard />
                            <flux:label>Codice fiscale</flux:label>
                        </div>
                        <flux:input wire:model.live="clientForm.tax_code" />
                        <flux:error name="clientForm.tax_code" />
                    </flux:field>

                    @if ($clientForm->is_company)
                        <flux:field data-input>
                            <div>
                                <flux:icon.credit-card />
                                <flux:label>Partita IVA</flux:label>
                            </div>
                            <flux:input wire:model.live="clientForm.p_iva" mask="99999999999" />
                            <flux:error name="clientForm.p_iva" />
                        </flux:field>

                        <flux:field data-input>
                            <div>
                                <flux:icon.clipboard />
                                <flux:label>Codice SDI</flux:label>
                            </div>
                            <flux:input wire:model.live="clientForm.sdi" mask="*******" />
                            <flux:error name="clientForm.sdi" />
                        </flux:field>
                    @endif

                    <flux:field data-input>
                        <div>
                            <flux:icon.globe-europe-africa />
                            <flux:label>Nazione</flux:label>
                        </div>
                        <flux:select variant="listbox" wire:model.live="clientForm.country">
                            @foreach (countryList() as $country)
                                <flux:select.option value="{{ $country }}">
                                    {{ ucfirst($country) }}
                                </flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="clientForm.country" />
                    </flux:field>

                    <flux:field data-input>
                        <div>
                            <flux:icon.map-pin />
                            <flux:label>Città</flux:label>
                        </div>
                        <flux:input wire:model.live="clientForm.city" />
                        <flux:error name="clientForm.city" />
                    </flux:field>

                    <flux:field data-input>
                        <div>
                            <flux:icon.map-pin />
                            <flux:label>Comune</flux:label>
                        </div>
                        <flux:input wire:model.live="clientForm.province" />
                        <flux:error name="clientForm.province" />
                    </flux:field>

                    <flux:field data-input>
                        <div>
                            <flux:icon.map-pin />
                            <flux:label>Indirizzo</flux:label>
                        </div>
                        <flux:input wire:model.live="clientForm.address" />
                        <flux:error name="clientForm.address" />
                    </flux:field>

                    <flux:field data-input>
                        <div>
                            <flux:icon.map-pin />
                            <flux:label>CAP</flux:label>
                        </div>
                        <flux:input wire:model.live="clientForm.cap" mask="99999" />
                        <flux:error name="clientForm.cap" />
                    </flux:field>

                    <flux:field data-input>
                        <div>
                            <flux:icon.at-symbol />
                            <flux:label>Email</flux:label>
                        </div>
                        <flux:input type="email" wire:model.live="clientForm.email" />
                        <flux:error name="clientForm.email" />
                    </flux:field>

                    <flux:field data-input>
                        <div>
                            <flux:icon.at-symbol />
                            <flux:label>PEC</flux:label>
                        </div>
                        <flux:input type="email" wire:model.live="clientForm.pec" />
                        <flux:error name="clientForm.pec" />
                    </flux:field>

                    <flux:field data-input>
                        <div>
                            <flux:icon.phone />
                            <flux:label>Telefono principale</flux:label>
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
                            <flux:icon.phone />
                            <flux:label>Telefono secondario</flux:label>
                        </div>
                        <flux:input.group>
                            <flux:select class="max-w-fit">
                                <flux:select.option selected>+39</flux:select.option>
                            </flux:select>
                            <flux:input wire:model.live="clientForm.second_telephone" mask="999 99 99 999" />
                        </flux:input.group>

                        <flux:error name="clientForm.second_telephone" />
                    </flux:field>

                    <flux:field data-input>
                        <div>
                            <flux:icon.globe-alt />
                            <flux:label>Sito</flux:label>
                        </div>
                        <flux:input.group>
                            <flux:input.group.prefix>https://</flux:input.group.prefix>
                            <flux:input wire:model.live="clientForm.site" />
                        </flux:input.group>
                        <flux:error name="clientForm.site" />
                    </flux:field>
                </div>

                {{-- ACTIONS --}}
                <div class="flex justify-start space-x-2 mt-6">
                    @if ($clientForm->client)
                        <flux:button variant="primary" data-variant="primary" wire:click="update" data-color="teal">
                            Modifica
                        </flux:button>
                    @else
                        <flux:button variant="primary" data-variant="primary" wire:click="create" data-color="teal">
                            Salva
                        </flux:button>
                    @endif
                </div>
            </div>

            <div class="md:w-1/3 p-10 px-26 bg-[#F8FEFF] flex flex-col gap-6 border">
                {{-- Logo uploader --}}
                <div class="flex flex-col items-center gap-4 relative">
                    <livewire:dropzone wire:model.live="clientForm.logo" :rules="['mimes:png,jpeg', 'max:2096']" :multiple="false"
                        wire:key="'dropzone-image'" />
                </div>

                <flux:field data-input>
                    <div>
                        <flux:icon.tag />
                        <flux:label>Etichetta</flux:label>
                    </div>
                    <flux:select variant="listbox" wire:model.live="clientForm.label">
                        @foreach (['call center', 'censimento', 'monitoraggio'] as $label)
                            <flux:select.option value="{{ $label }}">
                                {{ ucfirst($label) }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="clientForm.label" />
                </flux:field>
            </div>
        </div>
    </div>
</div>
