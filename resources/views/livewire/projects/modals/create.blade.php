<div class="p-4  w-10 h-10">
    <style>
        .ql-toolbar {
            background-color: #F5FCFD;
            height: 35px;
            padding: 2px;
            display: flex;
            align-items: center;
        }

        .ql-snow.ql-toolbar button,
        .ql-snow .ql-toolbar {
            width: 60px;
            font-size: 0.75rem;
            white-space: normal;
            padding: 4px;
        }

        .ql-list .ql-link .ql-image {
            width: 20px !important;
            font-size: 0.75rem;
            white-space: normal;
            padding: 4px;
        }
    </style>
    <div class="fixed inset-0 flex items-center justify-center bg-opacity-10 ">
        <div class="bg-white w-3/4  p-5 relative">
            @include('livewire.general.close')

            <div class="flex">
                <!-- Sidebar Tabs -->
                <div class="w-1/4 p-4 flex flex-col items-center relative">
                    <div class="absolute top-6 bottom-6  bg-cyan-400 max-h-72 w-[3px]"></div>

                    <ul class="flex flex-col space-y-4 items-center z-10 mt-16">
                        <li>
                            <button wire:click="$set('currentTab', 1)"
                                class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-cyan-400 text-cyan-400 font-bold
                    {{ $currentTab == 1 ? 'bg-cyan-500 text-white' : 'bg-white hover:bg-cyan-100' }}">
                                1
                            </button>
                        </li>
                        <li>
                            <button wire:click="$set('currentTab', 2)"
                                class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-cyan-400 text-cyan-400 font-bold
                    {{ $currentTab == 2 ? 'bg-cyan-500 text-white' : 'bg-white hover:bg-cyan-100' }}">
                                2
                            </button>
                        </li>
                        <li>
                            <button wire:click="$set('currentTab', 3)"
                                class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-cyan-400 text-cyan-400 font-bold
                    {{ $currentTab == 3 ? 'bg-cyan-500 text-white' : 'bg-white hover:bg-cyan-100' }}">
                                3
                            </button>
                        </li>
                        <li>
                            <button wire:click="$set('currentTab', 4)"
                                class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-cyan-400 text-cyan-400 font-bold
                    {{ $currentTab == 4 ? 'bg-cyan-500 text-white' : 'bg-white hover:bg-cyan-100' }}">
                                4
                            </button>
                        </li>
           
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="w-3/4 p-4 mt-10 mr-10 border-1 overflow-y-auto max-h-[500px] bg-[#F8FEFF]">
                    <div class="">
                        @if ($currentTab === 1)
                        <h2 class="text-lg font-medium italic mb-4">Informazioni Generali</h2>

                        <div class="grid grid-cols-2 gap-4">
                            <flux:field data-input>
                                <div><flux:icon.document /><flux:label>Pratica</flux:label></div>
                                <flux:select wire:model.live="formData.n_file">
                                    <option value="">Seleziona</option>
                                    @foreach ($estimates as $estimate)
                                        <option value="{{ $estimate['id'] }}">{{ $estimate['serial_number'] }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:error name="formData.n_file" />
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
                                    @foreach ($projectUser as $p)
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
                        <div>
                            <h2 class="text-lg font-medium italic mb-4">A cura dell'Area Gare</h2>
                        
                            <div class="lg:flex gap-4">
                                <flux:field data-input class="flex-1">
                                    <div>
                                        <flux:icon.currency-euro />
                                        <flux:label>Base D'Asta</flux:label>
                                    </div>
                                    <flux:input type="number" step="0.01" min="0" placeholder="Base D'Asta" wire:model.live="formData.starting_price" />
                                    <flux:error name="formData.starting_price" />
                                </flux:field>
                        
                                <flux:field data-input class="flex-1">
                                    <div>
                                        <flux:icon.percent-badge />
                                        <flux:label>Percentuale di Ribasso</flux:label>
                                    </div>
                                    <flux:input type="number" step="0.01" min="0" placeholder="Percentuale di Ribasso" wire:model.live="formData.discount_percentage" />
                                    <flux:error name="formData.discount_percentage" />
                                </flux:field>
                        
                                <flux:field data-input class="flex-1">
                                    <div>
                                        <flux:icon.percent-badge />
                                        <flux:label>Ribassato</flux:label>
                                    </div>
                                    <flux:input type="number" step="0.01" min="0" placeholder="Ribassato" wire:model.live="formData.discounted" />
                                    <flux:error name="formData.discounted" />
                                </flux:field>
                            </div>
                        
                            <div class="lg:flex gap-4 mt-6">
                                <flux:field data-input class="flex-1">
                                    <div>
                                        <flux:icon.users />
                                        <flux:label>Componenti del Raggruppamento</flux:label>
                                    </div>
                                    <flux:input type="number" placeholder="Componenti del Raggruppamento" wire:model.live="formData.n_firms" />
                                    <flux:error name="formData.n_firms" />
                                </flux:field>
                        
                                <flux:field data-input class="flex-1">
                                    <div>
                                        <flux:icon.percent-badge />
                                        <flux:label>Percentuali del Raggruppamento</flux:label>
                                    </div>
                                    <flux:input type="number" placeholder="Percentuali del Raggruppamento" wire:model.live="formData.firms_and_percentage" />
                                    <flux:error name="formData.firms_and_percentage" />
                                </flux:field>
                        
                                <flux:field data-input class="flex-1">
                                    <div>
                                        <flux:icon.clipboard />
                                        <flux:label>Note</flux:label>
                                    </div>
                                    <flux:textarea wire:model.live="formData.note" placeholder="Notes" />
                                    <flux:error name="formData.note" />
                                </flux:field>
                            </div>
                        </div>
                        
                        @elseif ($currentTab == 3)
                        <div class="">
                            <h2 class="text-lg font-bold mb-4">Descrizione</h2>
                        
                            <div class="flex flex-col">
                                {{-- Obiettivi --}}
                                <flux:field data-input>
                                    <div>
                                        <flux:icon.clipboard />
                                        <flux:label>Obiettivi</flux:label>
                                    </div>
                                    <flux:editor class="**:data-[slot=content]:min-h-[100px]!" wire:model.live="formData.goals" placeholder="Scrivi gli obiettivi..." />
                                    <flux:error name="formData.goals" />
                                </flux:field>
                        
                                {{-- Ambito del Progetto --}}
                                <flux:field data-input>
                                    <div>
                                        <flux:icon.clipboard />
                                        <flux:label>Ambito del Progetto</flux:label>
                                    </div>
                                    <flux:editor class="**:data-[slot=content]:min-h-[100px]!" wire:model.live="formData.project_scope" placeholder="Descrivi l'ambito..." />
                                    <flux:error name="formData.project_scope" />
                                </flux:field>
                        
                                {{-- Risultati attesi --}}
                                <flux:field data-input>
                                    <div>
                                        <flux:icon.clipboard />
                                        <flux:label>Risultati Attesi</flux:label>
                                    </div>
                                    <flux:editor class="**:data-[slot=content]:min-h-[100px]!" wire:model.live="formData.expected_results" placeholder="Inserisci i risultati attesi..." />
                                    <flux:error name="formData.expected_results" />
                                </flux:field>
                            </div>
                        
                            {{-- Stackholders --}}
                            <div class="mt-8">
                                <div
                                    x-data="{
                                        newStack: { name: '', role: '', email: '' },
                                        stackholders: @entangle('formData.stackholders').live,
                                        add() {
                                            if (!this.newStack.name.trim() || !this.newStack.email.trim() || !this.newStack.role) return;
                                            this.stackholders.push({ ...this.newStack });
                                            this.newStack = { name: '', role: '', email: '' };
                                        },
                                        remove(idx) {
                                            this.stackholders.splice(idx, 1);
                                        }
                                    }">
                                    <div class="flex items-center space-x-2 mb-4">
                                        <flux:icon.user class="w-5 h-5 text-gray-600" />
                                        <h3 class="text-sm font-medium text-gray-700">Stackholder coinvolti</h3>
                                    </div>
                        
                                    <div class="flex flex-wrap gap-2">
                                        <flux:input x-model="newStack.name" placeholder="Nome e Cognome" class="w-[300px]" />
                                        <flux:input type="email" x-model="newStack.email" placeholder="Email" class="w-[250px]" />
                                        <select x-model="newStack.role" class="border px-2 py-1 text-sm rounded">
                                            <option value="">Ruolo</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                        </select>
                                        <button @click="add()" type="button" class="w-10 h-10 bg-cyan-600 text-white rounded">+</button>
                                    </div>
                        
                                    <template x-for="(stk, i) in stackholders" :key="i">
                                        <div class="mt-4 bg-gray-50 p-2 border rounded">
                                            <div class="flex justify-between items-center">
                                                <p class="text-sm"><strong x-text="stk.name"></strong> - <span x-text="stk.role"></span> - <span x-text="stk.email"></span></p>
                                                <button type="button" @click="remove(i)" class="text-red-500 hover:text-red-700">&times;</button>
                                            </div>
                                            <input type="hidden" :name="'formData.stackholders['+i+'][name]'" :value="stk.name" wire:model="formData.stackholders[i].name" />
                                            <input type="hidden" :name="'formData.stackholders['+i+'][email]'" :value="stk.email" wire:model="formData.stackholders[i].email" />
                                            <input type="hidden" :name="'formData.stackholders['+i+'][role]'" :value="stk.role" wire:model="formData.stackholders[i].role" />
                                        </div>
                                    </template>
                        
                                    <div x-show="!stackholders.length" class="text-sm text-gray-400 mt-2 italic">
                                        Nessun stackholder aggiunto
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @elseif ($currentTab == 4)
                        <div>
                            <h2 class="text-lg font-medium italic mb-2">Fasi previste</h2>
                    
                            <div x-data="{ selectAll: false }" x-init="$watch('selectAll', val => { $el.querySelectorAll('.phase-checkbox').forEach(cb => cb.checked = val); })">
                                <div class="flex items-center mb-4">
                                    <input type="checkbox" wire:click="toggleAllPhases" class="mr-2" />
                                    <span>Seleziona tutti</span>
                                </div>
                    
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
                                        <div class="flex flex-col">
                                            @foreach ($phases as $id => $label)
                                                <label class="flex items-center space-x-2">
                                                    <input type="checkbox" class="phase-checkbox" id="{{ $id }}" value="{{ $id }}" wire:model="formData.selectedPhases">
                                                    <span>{{ $label }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    </div>
                </div>

            </div>
            <div class="bg-white p-4 flex justify-between">
                <button wire:click="prevTab"
                    class="bg-gray-300 px-4 py-2 rounded {{ $currentTab == 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ $currentTab == 1 ? 'disabled' : '' }}>
                    Indietro
                </button>

                <button wire:click="{{ $currentTab < 4 ? 'nextTab' : 'save' }}"
                    class="bg-cyan-600 text-white px-4 py-2 rounded ">
                    {{ $currentTab < 4 ? 'Avanti' : 'Salva' }}
                    
                </button>
            </div>
        </div>
    </div>


</div>

</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('quill-editor-area')) {
            var editor = new Quill('#quill-editor', {
                theme: 'snow'
            });
            var quillEditor = document.getElementById('quill-editor-area');
            editor.on('text-change', function() {
                quillEditor.value = editor.root.innerHTML;
            });
            quillEditor.addEventListener('input', function() {
                editor.root.innerHTML = quillEditor.value;
            });
        }
    });
</script>

</div>
