<div class="bg-white shadow-sm shadow-black/10 rounded-[3px] opacity-100 py-10 px-8 w-full">
    <h2 class="text-2xl mb-3 font-bold text-[#232323] font-sans opacity-100 ">
        {{ __('Crea Preventivo') }}
    </h2>

    <form wire:submit.prevent="saveQuote">
        <div class="grid grid-cols-1 gap-5">
            <!-- INFORMAZIONI GENERALI -->
            <div class="col-span-1">
                <h1 class="text-[#232323] text-sm font-semibold mb-2">{{ __('INFORMAZIONI GENERALI') }}</h1>
                <div class="bg-[#FAFAFA] p-5 shadow-[0px_0px_1px_#00000029] rounded-[1px]">

                    <div class="grid grid-cols-6">
                        <div class="col-span-4 pe-5  border-e border-color-[#E0E0E0]">
                            <!-- Prima riga: Numero preventivo, Emittente, Cliente -->
                            <div class="grid grid-cols-12 gap-4 mb-4">
                                <div class="col-span-3">
                                    <flux:field data-input>
                                        <flux:label>Numero preventivo</flux:label>
                                        <flux:input
                                                wire:model="form.code"
                                                placeholder="Generato automaticamente"
                                                disabled
                                        />
                                    </flux:field>
                                </div>

                                <div class="col-span-3">
                                    <flux:field data-input>
                                        <flux:label>Emittente</flux:label>
                                        <flux:select
                                                wire:model.live="form.issuer_id"
                                                variant="listbox"
                                                searchable
                                                clearable
                                                placeholder="Seleziona"
                                        >
                                            @foreach($issuers as $issuer)
                                                <flux:select.option value="{{ $issuer->id }}">{{ $issuer->name }}</flux:select.option>
                                            @endforeach
                                        </flux:select>
                                        <flux:error name="form.issuer_id" />
                                    </flux:field>
                                </div>

                                <div class="col-span-6">
                                    <flux:field data-input>
                                        <flux:label>Cliente</flux:label>
                                        <flux:select
                                                wire:model.live="form.client_id"
                                                variant="listbox"
                                                searchable
                                                clearable
                                                placeholder="Seleziona"
                                        >
                                            @foreach($clients as $client)
                                                <flux:select.option value="{{ $client->id }}">{{ $client->name }}</flux:select.option>
                                            @endforeach
                                        </flux:select>
                                        <flux:error name="form.client_id" />
                                    </flux:field>
                                </div>
                            </div>

                            <!-- Quarta riga: Indirizzo fatturazione -->
                            <div class="grid grid-cols-12 gap-4 mb-4">
                                <div class="col-span-12">
                                    <flux:field data-input>
                                        <flux:label>Indirizzo fatturazione</flux:label>
                                        <flux:input
                                                wire:model="form.billing_address"
                                                placeholder="Via, numero civico"
                                        />
                                        <flux:error name="form.billing_address" />
                                    </flux:field>
                                </div>
                            </div>

                            <!-- Quinta riga: Città, Comune, CAP, Nazione -->
                            <div class="grid grid-cols-12 gap-4 mb-4">
                                <div class="col-span-3">
                                    <flux:field data-input>
                                        <flux:label>Città</flux:label>
                                        <flux:input
                                                wire:model="form.billing_city"
                                                placeholder="Città"
                                        />
                                        <flux:error name="form.billing_city" />
                                    </flux:field>
                                </div>

                                <div class="col-span-3">
                                    <flux:field data-input>
                                        <flux:label>Comune</flux:label>
                                        <flux:select
                                                wire:model="form.billing_province"
                                                variant="listbox"
                                                searchable
                                                clearable
                                                placeholder="Provincia"
                                        >
                                            <flux:select.option value="Roma">Roma</flux:select.option>
                                            <flux:select.option value="Milano">Milano</flux:select.option>
                                            <flux:select.option value="Napoli">Napoli</flux:select.option>
                                            <!-- Aggiungere altre province -->
                                        </flux:select>
                                        <flux:error name="form.billing_province" />
                                    </flux:field>
                                </div>

                                <div class="col-span-3">
                                    <flux:field data-input>
                                        <flux:label>CAP</flux:label>
                                        <flux:input
                                                wire:model="form.billing_cap"
                                                placeholder="CAP"
                                        />
                                        <flux:error name="form.billing_cap" />
                                    </flux:field>
                                </div>

                                <div class="col-span-3">
                                    <flux:field data-input>
                                        <flux:label>Nazione</flux:label>
                                        <flux:select
                                                wire:model="form.billing_country"
                                                variant="listbox"
                                                searchable
                                                clearable
                                                placeholder="Nazione"
                                        >
                                            @foreach(countryList() as $country)
                                                <flux:select.option value="{{ $country }}">{{ $country }}</flux:select.option>
                                            @endforeach
                                        </flux:select>
                                        <flux:error name="form.billing_country" />
                                    </flux:field>
                                </div>
                            </div>

                            <!-- Settima riga: Città, Comune, CAP, Nazione (consegna) -->
                            <div class="grid grid-cols-12 gap-4 mb-4" x-show="!$wire.form.same_as_billing">
                                <div class="col-span-12">
                                    <flux:field data-input>
                                        <flux:label x-show="!$wire.form.same_as_billing">Indirizzo consegna</flux:label>
                                        <flux:input
                                                wire:model="form.delivery_address"
                                                placeholder="Via, numero civico"
                                                :disabled="$form->same_as_billing"
                                        />
                                        <flux:error name="form.delivery_address" />
                                    </flux:field>
                                </div>
                                <div class="col-span-3">
                                    <flux:field data-input>
                                        <flux:label>Città</flux:label>
                                        <flux:input
                                                wire:model="form.delivery_city"
                                                placeholder="Città"
                                                :disabled="$form->same_as_billing"
                                        />
                                        <flux:error name="form.delivery_city" />
                                    </flux:field>
                                </div>

                                <div class="col-span-3">
                                    <flux:field data-input>
                                        <flux:label>Comune</flux:label>
                                        <flux:select
                                                wire:model="form.delivery_province"
                                                variant="listbox"
                                                searchable
                                                clearable
                                                placeholder="Provincia"
                                                :disabled="$form->same_as_billing"
                                        >
                                            <flux:select.option value="Roma">Roma</flux:select.option>
                                            <flux:select.option value="Milano">Milano</flux:select.option>
                                            <flux:select.option value="Napoli">Napoli</flux:select.option>
                                            <!-- Aggiungere altre province -->
                                        </flux:select>
                                        <flux:error name="form.delivery_province" />
                                    </flux:field>
                                </div>

                                <div class="col-span-3">
                                    <flux:field data-input>
                                        <flux:label>CAP</flux:label>
                                        <flux:input
                                                wire:model="form.delivery_cap"
                                                placeholder="CAP"
                                                :disabled="$form->same_as_billing"
                                        />
                                        <flux:error name="form.delivery_cap" />
                                    </flux:field>
                                </div>

                                <div class="col-span-3">
                                    <flux:field data-input>
                                        <flux:label>Nazione</flux:label>
                                        <flux:select
                                                wire:model="form.delivery_country"
                                                variant="listbox"
                                                searchable
                                                clearable
                                                placeholder="Nazione"
                                                :disabled="$form->same_as_billing"
                                        >
                                            @foreach(countryList() as $country)
                                                <flux:select.option value="{{ $country }}">{{ $country }}</flux:select.option>
                                            @endforeach
                                        </flux:select>
                                        <flux:error name="form.delivery_country" />
                                    </flux:field>
                                </div>
                            </div>

                            <!-- Sesta riga: Indirizzo consegna -->
                            <div class="grid grid-cols-12 gap-4 mb-1">
                                <div class="col-span-12">
                                    <flux:field data-input>
                                        <flux:label x-show="$wire.form.same_as_billing">Indirizzo consegna</flux:label>
                                        <flux:field variant="inline" class="mb-2 mt-1" data-input>
                                            <flux:checkbox wire:model.live="form.same_as_billing" data-prodotti/>
                                            <flux:label>Stesso di fatturazione</flux:label>
                                        </flux:field>
                                        <flux:error name="form.same_as_billing" />
                                    </flux:field>
                                </div>
                            </div>

                            <!-- Ottava riga: Oggetto -->
                            <div class="grid grid-cols-12 gap-4 mb-4">
                                <div class="col-span-12">
                                    <flux:field data-input>
                                        <flux:label>Oggetto</flux:label>
                                        <flux:input
                                                wire:model="form.subject"
                                                placeholder="Scrivi qualcosa..."
                                        />
                                        <flux:error name="form.subject" />
                                    </flux:field>
                                </div>
                            </div>

                            <!-- Nona riga: Modello preventivo, Listino prezzi, Scadenza -->
                            <div class="grid grid-cols-12 gap-4 mb-4">
                                <div class="col-span-4">
                                    <flux:field data-input>
                                        <flux:label>Modello preventivo</flux:label>
                                        <flux:select
                                                wire:model.live="form.quote_template_id"
                                                variant="listbox"
                                                searchable
                                                clearable
                                                placeholder="Seleziona"
                                        >
                                            @foreach($templates as $template)
                                                <flux:select.option value="{{ $template->id }}">{{ $template->name }}</flux:select.option>
                                            @endforeach
                                        </flux:select>
                                        <flux:error name="form.quote_template_id" />
                                    </flux:field>
                                </div>

                                <div class="col-span-4">
                                    <flux:field data-input>
                                        <flux:label>Listino prezzi</flux:label>
                                        <flux:select
                                                wire:model="form.price_list_id"
                                                variant="listbox"
                                                searchable
                                                clearable
                                                placeholder="Seleziona"
                                        >
                                            @foreach($price_lists as $priceList)
                                                <flux:select.option value="{{ $priceList->id }}">{{ $priceList->name }}</flux:select.option>
                                            @endforeach
                                        </flux:select>
                                        <flux:error name="form.price_list_id" />
                                    </flux:field>
                                </div>

                                <div class="col-span-4">
                                    <flux:field data-input>
                                        <flux:label>Scadenza</flux:label>
                                        <flux:select
                                                wire:model="form.due_date"
                                                variant="listbox"
                                                clearable
                                                placeholder="Seleziona"
                                        >
                                            <flux:select.option value="{{ now()->addDays(30)->format('Y-m-d') }}">30 gg</flux:select.option>
                                            <flux:select.option value="{{ now()->addDays(60)->format('Y-m-d') }}">60 gg</flux:select.option>
                                            <flux:select.option value="{{ now()->addDays(90)->format('Y-m-d') }}">90 gg</flux:select.option>
                                        </flux:select>
                                        <flux:error name="form.due_date" />
                                    </flux:field>
                                </div>
                            </div>

                            <!-- Decima riga: Data creazione, Termini di pagamento, Metodo di pagamento -->
                            <div class="grid grid-cols-12 gap-4 mb-4">
                                <div class="col-span-4">
                                    <flux:field data-input>
                                        <flux:label>Data creazione</flux:label>
                                        <flux:select
                                                variant="listbox"
                                                disabled
                                                placeholder="gg/mm/aaaa"
                                        >
                                            <flux:select.option value="{{ now()->format('d/m/Y') }}">{{ now()->format('d/m/Y') }}</flux:select.option>
                                        </flux:select>
                                    </flux:field>
                                </div>

                                <div class="col-span-4">
                                    <flux:field data-input>
                                        <flux:label>Termini di pagamento</flux:label>
                                        <flux:select
                                                wire:model="form.payment_terms"
                                                variant="listbox"
                                                clearable
                                                placeholder="Seleziona"
                                        >
                                            <flux:select.option value="30 gg">30 gg</flux:select.option>
                                            <flux:select.option value="60 gg">60 gg</flux:select.option>
                                            <flux:select.option value="90 gg">90 gg</flux:select.option>
                                            <flux:select.option value="Bonifico anticipato">Bonifico anticipato</flux:select.option>
                                        </flux:select>
                                        <flux:error name="form.payment_terms" />
                                    </flux:field>
                                </div>

                                <div class="col-span-4">
                                    <flux:field data-input>
                                        <flux:label>Metodo di pagamento</flux:label>
                                        <flux:select
                                                wire:model="form.payment_method"
                                                variant="listbox"
                                                clearable
                                                placeholder="Seleziona"
                                        >
                                            <flux:select.option value="Da definire">Da definire</flux:select.option>
                                            <flux:select.option value="Bonifico bancario">Bonifico bancario</flux:select.option>
                                            <flux:select.option value="Carta di credito">Carta di credito</flux:select.option>
                                            <flux:select.option value="Contanti">Contanti</flux:select.option>
                                        </flux:select>
                                        <flux:error name="form.payment_method" />
                                    </flux:field>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 ps-5">
                            <!-- Seconda riga: Responsabile di area -->
                            <div class="grid grid-cols-12 gap-4 mb-4">
                                <div class="col-span-6">
                                    <flux:field data-input>
                                        <flux:label>Responsabile di area</flux:label>
                                        <flux:select
                                                wire:model="form.area_managers"
                                                variant="listbox"
                                                searchable
                                                clearable
                                                multiple
                                                placeholder="Seleziona"
                                        >
                                            @foreach($users as $user)
                                                <flux:select.option value="{{ $user->id }}">{{ $user->full_name }}</flux:select.option>
                                            @endforeach
                                        </flux:select>
                                        <flux:error name="form.area_managers" />
                                    </flux:field>
                                </div>

                                <div class="col-span-6">
                                    <flux:button type="button" size="sm" variant="outline" data-variant="outline" data-color="teal" class="mt-6 size-8!">
                                        <flux:icon.plus class="size-4!" />
                                    </flux:button>
                                </div>
                            </div>

                            <!-- Terza riga: Funzionario tecnico -->
                            <div class="grid grid-cols-12 gap-4 mb-4">
                                <div class="col-span-6">
                                    <flux:field data-input>
                                        <flux:label>Funzionario tecnico</flux:label>
                                        <flux:select
                                                wire:model="form.tech_users"
                                                variant="listbox"
                                                searchable
                                                clearable
                                                multiple
                                                placeholder="Seleziona"
                                        >
                                            @foreach($users as $user)
                                                <flux:select.option value="{{ $user->id }}">{{ $user->full_name }}</flux:select.option>
                                            @endforeach
                                        </flux:select>
                                        <flux:error name="form.tech_users" />
                                    </flux:field>
                                </div>

                                <div class="col-span-6">
                                    <flux:button type="button" size="sm" variant="outline" data-variant="outline" data-color="teal" class="mt-6 size-8!">
                                        <flux:icon.plus class="size-4!" />
                                    </flux:button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- SERVIZI -->
            <div class="col-span-1">
                <h1 class="text-[#232323] text-sm font-semibold mb-2">{{ __('SERVIZI') }}</h1>
                <div class="grid grid-cols-6 gap-5">
                    <div class="col-span-4 bg-[#FAFAFA] p-5 shadow-[0px_0px_1px_#00000029] rounded-[1px]">
                        <div class="flex items-center gap-3 mb-4">
                            <flux:button type="button" icon="plus" size="sm" variant="outline" data-variant="outline" data-color="teal" wire:click="addTitle">
                                Titolo
                            </flux:button>

                            <flux:button type="button" icon="plus" size="sm" variant="outline" data-variant="outline" data-color="teal" wire:click="addProduct">
                                Servizio
                            </flux:button>

                            <flux:button type="button" icon="plus" size="sm" variant="outline" data-variant="outline" data-color="teal" wire:click="addNote">
                                Nota
                            </flux:button>
                        </div>

                        <div class="p-6">
                            <flux:table class="border-collapse">
                                {{-- Header: span=2 sulla colonna Servizio --}}
                                <flux:table.columns>
                                    <flux:table.column span="2" class="px-4 py-2">Servizio</flux:table.column>
                                    <flux:table.column align="end" class="px-4 py-2">Quantità</flux:table.column>
                                    <flux:table.column          class="px-4 py-2">UdM</flux:table.column>
                                    <flux:table.column align="end" class="px-4 py-2">Prezzo unitario</flux:table.column>
                                    <flux:table.column align="end" class="px-4 py-2">Sconto</flux:table.column>
                                    <flux:table.column align="end" class="px-4 py-2">Totale riga</flux:table.column>
                                    <flux:table.column align="center" class="px-4 py-2"></flux:table.column>
                                </flux:table.columns>

                                {{-- Righe di esempio --}}
                                <flux:table.rows>
                                    @foreach([1,2] as $i)
                                        <flux:table.row>
                                            {{-- span=2 qui dentro --}}
                                            <flux:table.cell
                                                    span="2"
                                                    class="relative pl-6 pr-4 py-2 border-y border-l border-gray-200 first:rounded-l-lg"
                                            >
                                                APPR00
                                                <div class="absolute top-2 bottom-2 right-0 w-px bg-gray-200"></div>
                                            </flux:table.cell>

                                            <flux:table.cell
                                                    align="end"
                                                    class="relative px-4 py-2 border-y border-r border-gray-200"
                                            >
                                                1
                                                <div class="absolute top-2 bottom-2 right-0 w-px bg-gray-200"></div>
                                            </flux:table.cell>

                                            <flux:table.cell
                                                    class="relative px-4 py-2 border-y border-r border-gray-200"
                                            >
                                                a corpo
                                                <div class="absolute top-2 bottom-2 right-0 w-px bg-gray-200"></div>
                                            </flux:table.cell>

                                            <flux:table.cell
                                                    align="end" variant="strong"
                                                    class="relative px-4 py-2 border-y border-r border-gray-200"
                                            >
                                                € 10.000,00
                                                <div class="absolute top-2 bottom-2 right-0 w-px bg-gray-200"></div>
                                            </flux:table.cell>

                                            <flux:table.cell
                                                    align="end"
                                                    class="relative px-4 py-2 border-y border-r border-gray-200"
                                            >
                                                100 %
                                                <div class="absolute top-2 bottom-2 right-0 w-px bg-gray-200"></div>
                                            </flux:table.cell>

                                            <flux:table.cell
                                                    align="end" variant="strong"
                                                    class="relative px-4 py-2 border-y border-r border-gray-200"
                                            >
                                                € 0,00
                                                <div class="absolute top-2 bottom-2 right-0 w-px bg-gray-200"></div>
                                            </flux:table.cell>

                                            <flux:table.cell
                                                    align="center"
                                                    class="px-4 py-2 border-y border-r-0 border-gray-200 last:rounded-r-lg"
                                            >
                                                <flux:icon name="trash" size="sm"/>
                                            </flux:table.cell>
                                        </flux:table.row>
                                    @endforeach
                                </flux:table.rows>
                            </flux:table>
                        </div>


                    @foreach($form->item_groups as $groupIndex => $group)
                            <div class="mb-8 border-b pb-4">
                                @if(!empty($group['title']))
                                    <div class="mb-4">
                                        <flux:field data-input>
                                            <flux:label>Titolo</flux:label>
                                            <flux:input
                                                    wire:model="form.item_groups.{{ $groupIndex }}.title"
                                                    placeholder="Scrivi un titolo.."
                                            />
                                        </flux:field>
                                    </div>
                                @endif

                                    {{-- reset flag --}}
                                    @php($printedHeader = false)

                                    @foreach($group['items'] as $itemIndex => $item)
                                        @if($item['type'] === 'product')


                                        @else
                                            <!-- Nota -->
                                            <div class="grid grid-cols-12 gap-4">
                                                <div class="col-span-11">
                                                    <flux:field data-input>
                                                        <flux:label>Nota</flux:label>
                                                        <flux:input
                                                                wire:model="form.item_groups.{{ $groupIndex }}.items.{{ $itemIndex }}.title"
                                                                placeholder="Scrivi una nota.."
                                                        />
                                                    </flux:field>
                                                </div>

                                                <!-- Azioni -->
                                                <div class="col-span-1 flex items-end justify-end pb-1">
                                                    <flux:button type="button" wire:click="removeItem({{ $groupIndex }}, {{ $itemIndex }})" variant="ghost" data-variant="ghost" data-color="red" icon="trash" size="sm" />
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="col-span-2 bg-[#FAFAFA] p-5 shadow-[0px_0px_1px_#00000029] rounded-[1px]">
                        <!-- Riepilogo totali -->
                        <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-1">
                                    <!-- Spazio per eventuali elementi a sinistra -->
                                </div>
                                <div class="col-span-1 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Totale servizi</span>
                                        <span class="font-semibold">€ {{ number_format($subtotal, 2, ',', '.') }}</span>
                                    </div>

                                    @if($total_discounts > 0)
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">- di cui omaggi</span>
                                            <span class="font-semibold text-red-500">- € {{ number_format($total_discounts, 2, ',', '.') }}</span>
                                        </div>
                                    @endif

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-gray-600">CNPAIA</span>
                                            <flux:checkbox disabled checked class="opacity-50" />
                                        </div>
                                        <span class="font-semibold">€ {{ number_format($cnpaia_amount, 2, ',', '.') }}</span>
                                    </div>

                                    <div class="flex items-center justify-between pt-2 border-t">
                                        <span class="text-sm text-gray-600">Subtotale imponibile</span>
                                        <span class="font-semibold">€ {{ number_format($taxable_amount, 2, ',', '.') }}</span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">IVA ({{ $tax_rate }}%)</span>
                                        <span class="font-semibold">€ {{ number_format($tax_amount, 2, ',', '.') }}</span>
                                    </div>

                                    <div class="flex items-center justify-between pt-2 border-t">
                                        <span class="text-sm font-bold text-gray-800">TOTALE</span>
                                        <span class="font-bold text-lg">€ {{ number_format($total, 2, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Pulsanti di azione -->
            <div class="flex justify-between items-center mt-4">
                <flux:button type="button" variant="ghost" data-variant="ghost" data-color="gray" wire:click="$refresh">
                    Annulla
                </flux:button>

                <div class="flex space-x-3">
                    <flux:button type="submit" variant="primary" data-variant="primary" data-color="teal">
                        Salva e Crea
                    </flux:button>
                </div>
            </div>
    </form>
</div>