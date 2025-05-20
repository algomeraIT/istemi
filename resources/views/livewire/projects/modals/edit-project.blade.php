<!-- Modal Container -->
<div class="p-4 w-10 h-10">
    <div class="fixed inset-0 flex items-center justify-center  bg-opacity-10 z-50">
        <div class="bg-white w-3/4 p-5 relative rounded shadow-xl">

            <!-- Close Button -->
            @include('livewire.general.close')


            <!-- Main Layout -->
            <div class="flex">
                <!-- Sidebar Tabs -->
                <div class="w-1/4 p-4 flex flex-col items-center relative">
                    <div class="absolute top-6 bottom-6 bg-cyan-400 w-[3px]"></div>
                    <ul class="flex flex-col space-y-4 items-center z-10 mt-16">
                        @for ($i = 1; $i <= 4; $i++)
                            <li>
                                <button wire:click="$set('currentTab', {{ $i }})"
                                    class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-cyan-400 text-cyan-400 font-bold
                                    {{ $currentTab == $i ? 'bg-cyan-500 text-white' : 'bg-white hover:bg-cyan-100' }}">
                                    {{ $i }}
                                </button>
                            </li>
                        @endfor
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="w-3/4 p-4 mt-10 mr-10 border overflow-y-auto max-h-[500px] bg-[#F8FEFF] rounded  h-[50vh]">
                    @if ($currentTab == 1)
                        <h2 class="text-lg font-medium italic mb-4">Informazioni Generali</h2>
                     
                        <div class="grid grid-cols-2 gap-4">
                            <flux:field data-input>
                                <div><flux:icon.document /><flux:label>Pratica</flux:label></div>
                                <flux:select wire:model.live="formData.estimate">
                                    @foreach ($estimates as $estimate)
                         
                                        <option value="{{ $estimate['id'] }}" @selected($estimate['serial_number'] === $project->estimate) >{{ $estimate['serial_number'] }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:error name="formData.estimate" />
                            </flux:field>

                            <flux:field data-input>
                                <div><flux:icon.clipboard /><flux:label>Nome progetto</flux:label></div>
                                <flux:input wire:model.live="formData.name_project" placeholder="Nome del Progetto" />
                                <flux:error name="formData.name_project" />
                            </flux:field>

                            <flux:field data-input>
                                <div><flux:icon.user /><flux:label>Cliente</flux:label></div>
                                <flux:select wire:model.live="formData.id_client">
                                    <option value="">Seleziona</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client['id'] }}">{{ $client['name'] }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:error name="formData.id_client" />
                            </flux:field>

                            <flux:field data-input>
                                <div><flux:icon.tag /><flux:label>Tipo cliente</flux:label></div>
                                <flux:select wire:model.live="formData.client_type">
                                    <option value="">Seleziona</option>
                                    <option value="Pubblico">Pubblico</option>
                                    <option value="Privato">Privato</option>
                                </flux:select>
                                <flux:error name="formData.client_type" />
                            </flux:field>

                            <flux:field data-input>
                                <div><flux:label>Provenienza da Agente</flux:label></div>
                                <flux:checkbox wire:model.live="formData.is_from_agent" />
                                <flux:error name="formData.is_from_agent" />
                            </flux:field>

                            <flux:field data-input>
                                <div><flux:icon.currency-euro /><flux:label>Budget Allocato</flux:label></div>
                                <flux:input type="number" step="0.01" min="0" wire:model.live="formData.total_budget" placeholder="0.00" />
                                <flux:error name="formData.total_budget" />
                            </flux:field>

                            <flux:field data-input>
                                <div><flux:icon.at-symbol /><flux:label>Responsabile di Area</flux:label></div>
                                <flux:select wire:model.live="formData.id_chief_area">
                                    <option value="">Seleziona</option>
                                    @foreach ($area as $a)
                                        <option value="{{ $a['id'] }}">{{ $a['name'] . ' ' . $a['last_name'] }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:error name="formData.id_chief_area" />
                            </flux:field>

                            <flux:field data-input>
                                <div><flux:icon.at-symbol /><flux:label>Responsabile di Progetto</flux:label></div>
                                <flux:select wire:model.live="formData.id_chief_project">
                                    <option value="">Seleziona</option>
                                    @foreach ($projectUsers as $p)
                                        <option value="{{ $p['id'] }}">{{ $p['name'] . ' ' . $p['last_name'] }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:error name="formData.id_chief_project" />
                            </flux:field>

                            <flux:field data-input>
                                <div><flux:icon.calendar /><flux:label>Data Inizio</flux:label></div>
                                <flux:input type="date" wire:model.live="formData.start_at" />
                                <flux:error name="formData.start_at" />
                            </flux:field>

                            <flux:field data-input>
                                <div><flux:icon.calendar /><flux:label>Data Fine</flux:label></div>
                                <flux:input type="date" wire:model.live="formData.end_at" />
                                <flux:error name="formData.end_at" />
                            </flux:field>
                        </div>

                    @elseif ($currentTab == 2)
                        <h2 class="text-lg font-medium italic mb-4">A cura dell'Area Gare</h2>
                        <div class="grid grid-cols-3 gap-4">
                            <flux:field data-input>
                                <flux:label>Base D'Asta</flux:label>
                                <flux:input type="number" step="0.01" min="0" wire:model.live="formData.starting_price" />
                                <flux:error name="formData.starting_price" />
                            </flux:field>
                            <flux:field data-input>
                                <flux:label>Percentuale di Ribasso</flux:label>
                                <flux:input type="number" step="0.01" min="0" wire:model.live="formData.discount_percentage" />
                                <flux:error name="formData.discount_percentage" />
                            </flux:field>
                            <flux:field data-input>
                                <flux:label>Ribassato</flux:label>
                                <flux:input type="number" step="0.01" min="0" wire:model.live="formData.discounted" />
                                <flux:error name="formData.discounted" />
                            </flux:field>
                        </div>
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <flux:field data-input>
                                <flux:label>Componenti del Raggruppamento</flux:label>
                                <flux:input type="number" wire:model.live="formData.n_firms" />
                                <flux:error name="formData.n_firms" />
                            </flux:field>
                            <flux:field data-input>
                                <flux:label>Percentuali del Raggruppamento</flux:label>
                                <flux:input type="number" wire:model.live="formData.firms_and_percentage" />
                                <flux:error name="formData.firms_and_percentage" />
                            </flux:field>
                            <flux:field data-input>
                                <flux:label>Note</flux:label>
                                <flux:textarea wire:model.live="formData.note" />
                                <flux:error name="formData.note" />
                            </flux:field>
                        </div>

                    @elseif ($currentTab == 3)
                        <h2 class="text-lg font-bold mb-4">Descrizione</h2>
                        <div class="space-y-6">
                            <flux:field data-input>
                                <flux:label>Obiettivi</flux:label>
                                <flux:editor wire:model.live="formData.goals" placeholder="Scrivi gli obiettivi..." />
                                <flux:error name="formData.goals" />
                            </flux:field>

                            <flux:field data-input>
                                <flux:label>Ambito del Progetto</flux:label>
                                <flux:editor wire:model.live="formData.project_scope" placeholder="Descrivi l'ambito..." />
                                <flux:error name="formData.project_scope" />
                            </flux:field>

                            <flux:field data-input>
                                <flux:label>Risultati Attesi</flux:label>
                                <flux:editor wire:model.live="formData.expected_results" placeholder="Inserisci i risultati attesi..." />
                                <flux:error name="formData.expected_results" />
                            </flux:field>
                        </div>

                        @elseif ($currentTab == 4)
                        <h2 class="text-lg font-medium italic mb-4">Fasi previste</h2>

                        <div>
                            @php
                            $phaseGroups = [
                                'Avvio progetto' => [
                                    'contract_ver' => 'Verifica contratto',
                                    'cme_ver' => "Verifica CME - Piano d'indagine e capitolato",
                                    'reserves' => 'Riserve',
                                    'expiring_date_project' => 'Impostare la data di scadenza del progetto',
                                    'communication_plan' => 'Definizione del piano di comunicazione',
                                    'extension' => 'Proroga',
                                    'sal' => 'Possibilità di produrre dei SAL',
                                    'warranty' => 'Garanzia definitiva',
                                ],
                                'Fatture acconto e SAL' => [
                                    'emission_invoice' => 'Emissione fattura',
                                    'payment_invoice' => 'Pagamento fattura',
                                ],
                                'Pianificazione cantiere' => [
                                    'construction_site_plane' => 'Verifica accesibilità e sopralluogo',
                                    'travel' => 'Organizzazione trasferte',
                                    'site_pass' => 'Permessi/pass accesso al sito',
                                    'ztl' => 'Permessi/pass ZTL',
                                    'supplier' => 'Selezione fornitori',
                                    'timetable' => 'Cronoprogramma',
                                    'security' => 'Sicurezza',
                                ],
                                'Esecuzione attività' => [
                                    'team' => 'Selezione della squadra (caposquadra + altre risorse)',
                                    'field_activities' => 'Indicazioni per lo svolgimento delle attività in campo',
                                    'daily_check_activities' => 'Riepilogo giornaliero delle attività',
                                    'contruction_site_media' => 'Caricamento dati di cantiere',
                                    'activity_validation' => 'Controllo avanzamento attività/budget (PM)',
                                ],
                                'Elaborazione dati' => [
                                    'foreman_docs' => 'Controllo documentazione Caposquadra',
                                    'sanding_sample_lab' => 'Spedizione campione ai laboratori',
                                    'data_validation' => 'Avvio analisi dati',
                                    'internal_validation' => 'Validazione interna elaborati',
                                ],
                                'Trasmissione report' => [
                                    'create_note' => 'Predisposizione nota di trasmissione',
                                    'sending_note' => 'Invio nota di trasmissione',
                                ],
                                'Contabilità' => [
                                    'accounting_dec' => 'Contabilità attività eseguite (DEC)',
                                    'create_cre' => 'Produrre richiesta CRE',
                                    'expense_allocation' => 'Riparto spese',
                                ],
                                'Conferma esterna' => [
                                    'cre' => 'CRE',
                                    'liquidation' => 'Liquidazione',
                                    'balance_invoice' => 'Fattura di saldo',
                                ],
                                'Verifica tecnico contabile' => [
                                    'balance' => 'Saldo',
                                    'cre_archiving' => 'Archiviazione CRE',
                                    'pay_suppliers' => 'Pagamento fornitori',
                                    'pay_allocation_expenses' => 'Pagamento riparto spese',
                                    'learned_lesson' => 'Lezioni apprese',
                                ],
                                'Gestione non conformità' => [
                                    'sa' => 'Accogliere richieste della S.A.',
                                    'integrate_doc' => 'Inviare documentazione integrativa',
                                ],
                                'Chiusura attività' => [
                                    'sale' => 'Fatturato specifico',
                                    'release' => 'Svincolo della polizza',
                                ],
                            ];
                        @endphp
            

                            @foreach ($phaseGroups as $groupTitle => $phases)
                                <div class="mt-6">
                                    <h3 class="text-md font-semibold text-cyan-800">{{ $groupTitle }}</h3>
                                    <div class="flex flex-col ml-4">
                                        @foreach ($phases as $id => $label)
                                            <label class="flex items-center space-x-2">
                                                <input type="checkbox" id="{{ $id }}" value="{{ $id }}"
                                                    wire:model="formData.selectedPhases" class="phase-checkbox">
                                                <span>{{ $label }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-white p-4 flex justify-between border-t mt-4">
                <button wire:click="prevTab"
                    class="bg-gray-300 px-4 py-2 rounded disabled:opacity-50"
                    @disabled($currentTab == 1)>
                    Indietro
                </button>

                <button wire:click="{{ $currentTab < 4 ? 'nextTab' : 'save' }}"
                    class="bg-cyan-600 text-white px-4 py-2 rounded">
                    {{ $currentTab < 4 ? 'Avanti' : 'Salva' }}
                </button>
            </div>

        </div>
    </div>
</div>
