<div class="p-4 w-10 h-10">
    <div class="fixed inset-0 flex items-center justify-center  bg-opacity-10 z-50">
        <div class="bg-white w-3/4 p-5 relative rounded shadow-xl">
            @include('livewire.general.close')

            <div class="flex">
                <!-- Sidebar Tabs -->
                <div class="w-1/4 p-4 flex flex-col items-center relative h-[50vh]">
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
                                    <div>
                                        <flux:icon.document />
                                        <flux:label>Pratica</flux:label>
                                    </div>
                                    <flux:select variant="listbox" wire:model.live="formData.estimate">
                                        <flux:select.option value="">Seleziona</flux:select.option>
                                        @foreach ($estimates as $estimate)
                                            <flux:select.option value="{{ $estimate['id'] }}">
                                                {{ $estimate['serial_number'] }}
                                            </flux:select.option>
                                        @endforeach
                                    </flux:select>
                                    <flux:error name="formData.estimate" />
                                </flux:field>

                                <flux:field data-input>
                                    <div>
                                        <flux:icon.clipboard />
                                        <flux:label>Nome progetto</flux:label>
                                    </div>
                                    <flux:input wire:model.live="formData.name_project"
                                        placeholder="Nome del Progetto" />
                                    <flux:error name="formData.name_project" />
                                </flux:field>

                                <flux:field data-input>
                                    <div>
                                        <flux:icon.user />
                                        <flux:label>Cliente</flux:label>
                                    </div>
                                    <flux:select variant="listbox" wire:model.live="formData.id_client">
                                        <flux:select.option value="">Seleziona</flux:select.option>
                                        @foreach ($clients as $client)
                                            <flux:select.option value="{{ $client['id'] }}">
                                                {{ $client['name'] }}
                                            </flux:select.option>
                                        @endforeach
                                    </flux:select>
                                    <flux:error name="formData.id_client" />
                                </flux:field>

                                <flux:field data-input>
                                    <div>
                                        <flux:icon.tag />
                                        <flux:label>Tipo cliente</flux:label>
                                    </div>
                                    <flux:select variant="listbox" wire:model.live="formData.client_type">
                                        @foreach (['Privato' => 'Privato', 'Pubblico' => 'Pubblico'] as $label => $value)
                                            <flux:select.option value="{{ $value }}">
                                                {{ $label }}
                                            </flux:select.option>
                                        @endforeach
                                    </flux:select>
                                    <flux:error name="formData.client_type" />
                                </flux:field>

                                <flux:field data-input>
                                    <div>
                                        <flux:label>Provenienza da Agente</flux:label>
                                    </div>
                                    <flux:checkbox wire:model.live="formData.is_from_agent" />
                                    <flux:error name="formData.is_from_agent" />
                                </flux:field>

                                <flux:field data-input>
                                    <div><flux:icon.currency-euro />
                                        <flux:label>Budget Allocato</flux:label>
                                    </div>

                                    <flux:input type="number" min="0" wire:model.live="formData.total_budget" />
                                    <flux:error name="formData.total_budget" />
                                </flux:field>

                                <flux:field data-input>
                                    <div>
                                        <flux:icon.at-symbol />
                                        <flux:label>Responsabile di Area</flux:label>
                                    </div>
                                    <flux:select variant="listbox" wire:model.live="formData.id_chief_area">
                                        <flux:select.option value="">Seleziona</flux:select.option>
                                        @foreach ($area as $a)
                                            <flux:select.option value="{{ $a['id'] }}">
                                                {{ $a['name'] . ' ' . $a['last_name'] }}
                                            </flux:select.option>
                                        @endforeach
                                    </flux:select>
                                    <flux:error name="formData.id_chief_area" />
                                </flux:field>

                                <flux:field data-input>
                                    <div>
                                        <flux:icon.at-symbol />
                                        <flux:label>Responsabile di Progetto</flux:label>
                                    </div>
                                    <flux:select variant="listbox" wire:model.live="formData.id_chief_project">
                                        <flux:select.option value="">Seleziona</flux:select.option>
                                        @foreach ($projectUser as $p)
                                            <flux:select.option value="{{ $p['id'] }}">
                                                {{ $p['name'] . ' ' . $p['last_name'] }}
                                            </flux:select.option>
                                        @endforeach
                                    </flux:select>
                                    <flux:error name="formData.id_chief_project" />
                                </flux:field>

                                <flux:field data-input>
                                    <div>
                                        <flux:icon.calendar />
                                        <flux:label>Data Inizio</flux:label>
                                    </div>
                                    <flux:input type="date" wire:model.live="formData.start_at" />
                                    <flux:error name="formData.start_at" />
                                </flux:field>

                                <flux:field data-input>
                                    <div>
                                        <flux:icon.calendar />
                                        <flux:label>Data Fine</flux:label>
                                    </div>
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
                                        <flux:input type="number" min="0"
                                            wire:model.live="formData.starting_price" />
                                        <flux:error name="formData.starting_price" />
                                    </flux:field>

                                    <flux:field data-input class="flex-1">
                                        <div>
                                            <flux:icon.percent-badge />
                                            <flux:label>Percentuale di Ribasso</flux:label>
                                        </div>
                                        <flux:input type="number" min="0"
                                            wire:model.live="formData.discount_percentage" />
                                        <flux:error name="formData.discount_percentage" />
                                    </flux:field>

                                    <flux:field data-input class="flex-1">
                                        <div>
                                            <flux:icon.percent-badge />
                                            <flux:label>Ribassato</flux:label>
                                        </div>
                                        <flux:input type="number" min="0" wire:model.live="formData.discounted"
                                            readonly />
                                        <flux:error name="formData.discounted" />
                                    </flux:field>
                                </div>

                                <div class="space-y-4 mt-5">
                                    @foreach ($firms_and_percentage_keys as $index => $key)
                                        <div class="flex gap-2 items-center mb-2">
                                            <flux:input wire:model="firms_and_percentage_keys.{{ $index }}"
                                                placeholder="Azienda {{ $index + 1 }}" />
                                            <flux:input class="w-10" type="number" min="0"
                                                wire:model="firms_and_percentage_values.{{ $index }}"
                                                placeholder="%" />
                                            <button type="button" wire:click="removeFirm({{ $index }})"
                                                class="text-red-500">✕</button>
                                        </div>
                                    @endforeach

                                    <button type="button" wire:click="addFirm"
                                        class="mt-2 bg-cyan-600 text-white px-3 py-1 rounded">
                                        +
                                    </button>
                                </div>
                                <flux:field data-input class="flex-1 mt-10">
                                    <div>
                                        <flux:icon.clipboard />
                                        <flux:label>Note</flux:label>
                                    </div>
                                    <flux:editor class="**:data-[slot=content]:min-h-[80px]!"
                                        wire:model.live="formData.note" placeholder="Notes" />
                                    <flux:error name="formData.note" />
                                </flux:field>
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
                                        <flux:editor class="**:data-[slot=content]:min-h-[100px]!"
                                            wire:model.live="formData.goals" placeholder="Scrivi gli obiettivi..." />
                                        <flux:error name="formData.goals" />
                                    </flux:field>

                                    {{-- Ambito del Progetto --}}
                                    <flux:field data-input>
                                        <div class="mt-10">
                                            <flux:icon.clipboard />
                                            <flux:label>Ambito del Progetto</flux:label>
                                        </div>
                                        <flux:editor class="**:data-[slot=content]:min-h-[100px]!"
                                            wire:model.live="formData.project_scope"
                                            placeholder="Descrivi l'ambito..." />
                                        <flux:error name="formData.project_scope" />
                                    </flux:field>

                                    {{-- Risultati attesi --}}
                                    <flux:field data-input>
                                        <div class="mt-10">
                                            <flux:icon.clipboard />
                                            <flux:label>Risultati Attesi</flux:label>
                                        </div>
                                        <flux:editor class="**:data-[slot=content]:min-h-[100px]!"
                                            wire:model.live="formData.expected_results"
                                            placeholder="Inserisci i risultati attesi..." />
                                        <flux:error name="formData.expected_results" />
                                    </flux:field>
                                </div>

                                {{-- Stackholders --}}
                                <div class="mt-8">
                                    <div x-data="{
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
                                            <flux:input x-model="newStack.name" placeholder="Nome e Cognome"
                                                class="w-[300px]" />
                                            <flux:input type="email" x-model="newStack.email" placeholder="Email"
                                                class="w-[250px]" />
                                            <select x-model="newStack.role" class="border px-2 py-1 text-sm rounded">
                                                <option value="">Ruolo</option>
                                                <option value="Admin">Admin</option>
                                                <option value="User">User</option>
                                            </select>
                                            <button @click="add()" type="button"
                                                class="w-10 h-10 bg-cyan-600 text-white rounded">+</button>
                                        </div>

                                        <template x-for="(stk, i) in stackholders" :key="i">
                                            <div class="mt-4 bg-gray-50 p-2 border rounded">
                                                <div class="flex justify-between items-center">
                                                    <p class="text-sm"><strong x-text="stk.name"></strong> - <span
                                                            x-text="stk.role"></span> - <span
                                                            x-text="stk.email"></span></p>
                                                    <button type="button" @click="remove(i)"
                                                        class="text-red-500 hover:text-red-700">&times;</button>
                                                </div>
                                                <input type="hidden" :name="'formData.stackholders[' + i + '][name]'"
                                                    :value="stk.name"
                                                    wire:model="formData.stackholders[i].name" />
                                                <input type="hidden" :name="'formData.stackholders[' + i + '][email]'"
                                                    :value="stk.email"
                                                    wire:model="formData.stackholders[i].email" />
                                                <input type="hidden" :name="'formData.stackholders[' + i + '][role]'"
                                                    :value="stk.role"
                                                    wire:model="formData.stackholders[i].role" />
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

                                <div x-data="{ selectAll: false }" x-init="$watch('selectAll', val => {
                                    $el.querySelectorAll('.phase-checkbox').forEach(cb => cb.checked = val);
                                    if (val) {
                                        @this.set('formData.selectedPhases', @json(array_keys(array_merge(...array_values($phaseGroups)))));
                                    } else {
                                        @this.set('formData.selectedPhases', []);
                                    }
                                })">
                                    <!-- Select All Toggle -->
                                    <div class="flex items-center mb-4">
                                        <input type="checkbox" x-model="selectAll" class="mr-2" />
                                        <span>Seleziona tutti</span>
                                    </div>

                                    <!-- Dynamic Phase Group Checkboxes -->
                                    @foreach ($phaseGroups as $groupTitle => $phases)
                                        <div class="mt-6">
                                            <h3 class="text-md font-semibold text-cyan-800">{{ $groupTitle }}</h3>
                                            <div class="flex flex-col ml-4">
                                                @foreach ($phases as $id => $label)
                                                    <label class="flex items-center space-x-2">
                                                        <input type="checkbox" class="phase-checkbox"
                                                            value="{{ $id }}"
                                                            wire:model="formData.selectedPhases" />
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
