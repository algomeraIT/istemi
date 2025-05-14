<div class="p-4 bg-white w-10 h-10">
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
    <div class="fixed inset-0 flex items-center justify-center bg-gray-200 bg-opacity-10 ">
        <div class="bg-white w-3/4  p-5 relative">
            @include('livewire.general.close')

            <div class="flex">
                <!-- Sidebar Tabs -->
                <div class="w-1/4 p-4 flex flex-col items-center relative">
                    <div class="absolute top-6 bottom-6 w-px bg-cyan-400 max-h-72"></div>

                    <ul class="flex flex-col space-y-4 items-center z-10">
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
                        {{--              <li>
                            <button wire:click="$set('currentTab', 5)"
                                class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-cyan-400 text-cyan-400 font-bold
                    {{ $currentTab == 5 ? 'bg-cyan-500 text-white' : 'bg-white hover:bg-cyan-100' }}">
                                5
                            </button>
                        </li> --}}
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="w-3/4 p-4 mt-10 mr-10 border-1 overflow-y-auto max-h-[500px] bg-[#F8FEFF]">
                    <div class="">
                        @if ($currentTab == 1)
                            <div class="">
                                <h2 class="text-lg font-medium italic mb-2">Informazioni Generali</h2>
                                {{--  
                            <input type="text" wire:model="formData.general_info" placeholder="Informazioni Generali"
                                class="border p-2 w-full"> --}}
                                <div class="lg:flex p-1">
                                    <div class=" p-4 ">

                                        <label class="flex items-center text-sm font-medium text-gray-700">
                                            <flux:icon.document class="w-4 h-4 mr-2 text-gray-500" />
                                            Pratica
                                        </label>
                                        <select id="n_file" wire:model="formData.n_file"
                                            class="w-full p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-300 bg-white">
                                            <option selected value="">Seleziona</option>
                                            @foreach ($estimates as $estimate)
                                                <option value="{{ $estimate['id'] }}">{{ $estimate['serial_number'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('formData.n_file')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class=" p-4 w-full">
                                        <label class="flex items-center text-sm font-medium text-gray-700">
                                            <img src="/icon/menu/progetti.svg" alt="Progetto"
                                                class="w-4 h-4 mr-2 text-gray-500">

                                            Nome progetto
                                        </label>
                                        <input type="text" wire:model="formData.name_project"
                                            placeholder="Nome del Progetto"
                                            class="w-full border border-gray-200 text-sm p-2 focus:outline-none bg-white">
                                        @error('formData.name_project')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="lg:flex p-1">
                                    <div class=" p-4">
                                        <label class="flex items-center text-sm font-medium text-gray-700">
                                            <flux:icon.user class="w-4 h-4 mr-2 text-gray-500" />
                                            Cliente
                                        </label>
                                        <select id="id_client" wire:model="formData.id_client"
                                            class="w-full p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-300 bg-white">
                                            <option selected>Seleziona</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client['id'] }}">{{ $client['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('formData.id_client')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class=" p-4">
                                        <label class="flex items-center text-sm font-medium text-gray-700">
                                            <flux:icon.tag class="w-4 h-4 mr-2 text-gray-500" />
                                            Tipo cliente
                                        </label>
                                        <select wire:model="formData.client_type"
                                            class="w-full p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-300 bg-white">
                                            <option value="" disabled selected>Seleziona</option>
                                            <option value="Pubblico">Pubblico</option>
                                            <option value="Privato">Privato</option>
                                        </select>
                                        @error('formData.client_type')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="p-4">
                                        <label class="inline-flex items-center space-x-2 p-2 cursor-pointer">
                                            <input type="checkbox" wire:model="formData.is_from_agent"
                                                class="h-5 w-5 text-cyan-600 border-gray-300 rounded focus:ring-cyan-500" />
                                            <span class="text-sm font-medium text-gray-700">Provenienza da Agente</span>
                                        </label>
                                        @error('formData.is_from_agent')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class=" p-4">
                                        <label class="flex items-center text-sm font-medium text-gray-700">
                                            <flux:icon.currency-euro class="w-4 h-4 mr-2 text-gray-500" />
                                            Budget allocato
                                        </label>
                                        <div class="relative">
                                            <span
                                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">€</span>
                                            <input type="number" min="0" step="0.01"
                                                wire:model="formData.total_budget"
                                                class=" p-2 w-full pl-8 mt-1 rounded bg-white" placeholder="0.00">
                                            @error('formData.total_budget')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:flex p-1">
                                    <div class=" p-4">
                                        <label class="flex items-center text-sm font-medium text-gray-700">
                                            <flux:icon.at-symbol class="w-4 h-4 mr-2 text-gray-500" />
                                            Responsabile di area
                                        </label>
                                        <select id="id_chief_area" wire:model="formData.id_chief_area"
                                            class="w-full p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-300 bg-white">
                                            <option selected>Seleziona</option>
                                            @foreach ($area as $a)
                                                <option value="{{ $a['id'] }}">{{ $a['name'] . ' ' . $a['last_name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('formData.id_chief_area')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class=" p-4">
                                        <label class="flex items-center text-sm font-medium text-gray-700">
                                            <flux:icon.at-symbol class="w-4 h-4 mr-2 text-gray-500" />
                                            Responsabile di progetto
                                        </label>
                                        <select id="id_chief_project" wire:model="formData.id_chief_project"
                                            class="w-full p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-300 bg-white">
                                            <option selected>Seleziona</option>
                                            @foreach ($project as $p)
                                                <option value="{{ $p['id'] }}">{{ $p['name'] . ' ' . $p['last_name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('formData.id_chief_project')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class=" p-4">
                                        <label class="flex items-center text-sm font-medium text-gray-700">
                                            <flux:icon.calendar class="w-4 h-4 mr-2 text-gray-500" />
                                            Data inizio
                                        </label>
                                        <input type="date" wire:model="formData.start_at"
                                            class="w-full border border-gray-200 text-sm p-2 focus:outline-none bg-white">
                                        @error('formData.start_at')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class=" p-4">
                                        <label class="flex items-center text-sm font-medium text-gray-700">
                                            <flux:icon.calendar class="w-4 h-4 mr-2 text-gray-500" />
                                            Data fine
                                        </label>
                                        <input type="date" wire:model="formData.end_at"
                                            class="w-full border border-gray-200 text-sm p-2 focus:outline-none bg-white">
                                        @error('formData.end_at')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @elseif ($currentTab == 2)
                            <div>
                                <h2 class="text-lg font-medium italic mb-2">A cura dell'Area Gare</h2>

                                <!-- First row (3 inputs) -->
                                <div class="lg:flex p-1">
                                    <div class="p-4 flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Base D'Asta</label>
                                        <input type="number" step="0.01" min="0"
                                            wire:model="formData.starting_price" placeholder="Base D'Asta"
                                            class="w-full border border-gray-200 text-sm p-2 focus:outline-none bg-white rounded" />
                                        @error('formData.starting_price')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="p-4 flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Percentuale di
                                            Ribasso</label>
                                        <input type="number" step="0.01" min="0"
                                            wire:model="formData.discount_percentage"
                                            placeholder="Percentuale di Ribasso"
                                            class="w-full border border-gray-200 text-sm p-2 focus:outline-none bg-white rounded" />
                                        @error('formData.discount_percentage')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="p-4 flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Ribassato</label>
                                        <input type="number" step="0.01" min="0"
                                            wire:model="formData.discounted" placeholder="Ribassato"
                                            class="w-full border border-gray-200 text-sm p-2 focus:outline-none bg-white rounded" />
                                        @error('formData.discounted')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Second row (3 inputs + textarea) -->
                                <div class="lg:flex p-1">
                                    <div class="p-4 flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Componenti del
                                            Raggruppamento</label>
                                        <input type="number" wire:model="formData.n_firms"
                                            placeholder="Componenti del Raggruppamento"
                                            class="w-full border border-gray-200 text-sm p-2 focus:outline-none bg-white rounded" />
                                        @error('formData.n_firms')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="p-4 flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Percentuali del
                                            Raggruppamento</label>
                                        <input type="number" wire:model="formData.firms_and_percentage"
                                            placeholder="Percentuali del Raggruppamento"
                                            class="w-full border border-gray-200 text-sm p-2 focus:outline-none bg-white rounded" />
                                        @error('formData.firms_and_percentage')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="p-4 flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Note</label>
                                        <textarea wire:model="formData.note" placeholder="Notes"
                                            class="w-full border border-gray-200 text-sm p-2 focus:outline-none bg-white rounded h-24"></textarea>
                                        @error('formData.note')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @elseif ($currentTab == 3)
                            <div>
                                <h2 class="text-lg font-bold mb-2">Descrizione</h2>

                                <!-- First row: Goals & Project Scope -->
                                <div class=" p-1">
                                    <div class="p-4 flex-1">

                                        <!-- Nota (rich text) -->


                                        {{-- The x-init directive allows you to hook into the initialization phase of any element in Alpine. --}}
                                        <div x-data x-init="$nextTick(() => {
                                            const Icon = Quill.import('ui/icons');
                                            Icon['bold'] = 'grassetto';
                                            Icon['italic'] = 'corsivo';
                                            Icon['underline'] = 'sottolineato';
                                        
                                            const quill = new Quill($refs.quillEditor, {
                                                theme: 'snow',
                                                placeholder: 'Scrivi qualcosa…',
                                                modules: {
                                                    toolbar: [
                                                        ['bold', 'italic', 'underline'],
                                                        [{ 'list': 'bullet' }, 'link', 'image'],
                                        
                                                    ]
                                                }
                                            });
                                        
                                            quill.root.innerHTML = $refs.hiddenInput.value;
                                            quill.on('text-change', () => {
                                                $refs.hiddenInput.value = quill.root.innerHTML;
                                                $refs.hiddenInput.dispatchEvent(new Event('input'));
                                            });
                                            Livewire.hook('message.processed', () => {
                                                quill.root.innerHTML = $refs.hiddenInput.value;
                                            });
                                        })" wire:ignore>
                                            <label class="text-xs flex items-center gap-2 mb-1 text-[#B0B0B0]">
                                                <flux:icon.clipboard class="w-[10px] text-gray-500" />
                                                Obiettivi
                                            </label>

                                            <!-- This is where Quill will render -->
                                            <div x-ref="quillEditor"
                                                class="bg-white border border-gray-200 h-[200px] mb-4 p-2 overflow-y-auto">
                                            </div>

                                            <!-- Hidden field Livewire listens to -->
                                            <input type="hidden" wire:model="formData.goals" x-ref="hiddenInput" />
                                            @error('formData.goals')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>



                                    </div>
                                    {{-- Ambito del progetto --}}
                                    <div class="p-4 flex-1">
                                        <div x-data x-init="$nextTick(() => {
                                            const Icon = Quill.import('ui/icons');
                                            Icon['bold'] = 'grassetto';
                                            Icon['italic'] = 'corsivo';
                                            Icon['underline'] = 'sottolineato';
                                        
                                            const quill = new Quill($refs.quillEditor, {
                                                theme: 'snow',
                                                placeholder: 'Scrivi qualcosa…',
                                                modules: {
                                                    toolbar: [
                                                        ['bold', 'italic', 'underline'],
                                                        [{ 'list': 'bullet' }, 'link', 'image'],
                                        
                                                    ]
                                                }
                                            });
                                        
                                            quill.root.innerHTML = $refs.hiddenInput.value;
                                            quill.on('text-change', () => {
                                                $refs.hiddenInput.value = quill.root.innerHTML;
                                                $refs.hiddenInput.dispatchEvent(new Event('input'));
                                            });
                                            Livewire.hook('message.processed', () => {
                                                quill.root.innerHTML = $refs.hiddenInput.value;
                                            });
                                        })" wire:ignore>
                                            <label class="text-xs flex items-center gap-2 mb-1 text-[#B0B0B0]">
                                                <flux:icon.clipboard class="w-[10px] text-gray-500" />
                                                Ambito del Progetto
                                            </label>

                                            <!-- This is where Quill will render -->
                                            <div x-ref="quillEditor"
                                                class="bg-white border border-gray-200 h-[200px] mb-4 p-2 overflow-y-auto">
                                            </div>

                                            <!-- Hidden field Livewire listens to -->
                                            <input type="hidden" wire:model="formData.project_scope"
                                                x-ref="hiddenInput" />
                                            @error('formData.project_scope')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    {{-- risultati attesi --}}
                                    <div class="p-4 flex-1">
                                        <div x-data x-init="$nextTick(() => {
                                            const Icon = Quill.import('ui/icons');
                                            Icon['bold'] = 'grassetto';
                                            Icon['italic'] = 'corsivo';
                                            Icon['underline'] = 'sottolineato';
                                        
                                            const quill = new Quill($refs.quillEditor, {
                                                theme: 'snow',
                                                placeholder: 'Scrivi qualcosa…',
                                                modules: {
                                                    toolbar: [
                                                        ['bold', 'italic', 'underline'],
                                                        [{ 'list': 'bullet' }, 'link', 'image'],
                                        
                                                    ]
                                                }
                                            });
                                        
                                            quill.root.innerHTML = $refs.hiddenInput.value;
                                            quill.on('text-change', () => {
                                                $refs.hiddenInput.value = quill.root.innerHTML;
                                                $refs.hiddenInput.dispatchEvent(new Event('input'));
                                            });
                                            Livewire.hook('message.processed', () => {
                                                quill.root.innerHTML = $refs.hiddenInput.value;
                                            });
                                        })" wire:ignore>
                                            <label class="text-xs flex items-center gap-2 mb-1 text-[#B0B0B0]">
                                                <flux:icon.clipboard class="w-[10px] text-gray-500" />
                                                Risultati attesi
                                            </label>

                                            <!-- This is where Quill will render -->
                                            <div x-ref="quillEditor"
                                                class="bg-white border border-gray-200 h-[200px] mb-4 p-2 overflow-y-auto">
                                            </div>

                                            <!-- Hidden field Livewire listens to -->
                                            <input type="hidden" wire:model="formData.expected_results"
                                                x-ref="hiddenInput" />
                                            @error('formData.expected_results')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    {{-- stackholder --}}
                                    {{-- quando clicco in avanti devo già inviare i dati al component inviare usare @entangle --}}
                                        <div class="p-4 flex-1">
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
                                            }"
                                            class="p-4 border-none mt-6"
                                        >
                                            <div class="flex items-center space-x-2 mb-4">
                                                <flux:icon.user class="w-5 h-5 text-gray-600" />
                                                <h3 class="text-sm font-medium text-gray-700">Stackholder coinvolti</h3>
                                            </div>
                                        
                                            <div class="lg:flex lg:items-end lg:space-x-4 space-y-3 lg:space-y-0">
                                                <input type="text" x-model="newStack.name" placeholder="Nome e cognome"
                                                    class="w-full border border-gray-200 text-sm p-2 rounded" />
                                                <input type="email" x-model="newStack.email" placeholder="Email"
                                                    class="w-full border border-gray-200 text-sm p-2 rounded" />
                                                <select x-model="newStack.role" class="w-full border border-gray-200 text-sm p-2 rounded">
                                                    <option value="">Ruolo</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="User">User</option>
                                                </select>
                                                <button @click="add()" type="button"
                                                    class="w-10 h-10 bg-cyan-600 text-white rounded hover:bg-cyan-700 flex items-center justify-center">
                                                    +
                                                </button>
                                            </div>
                                        
                                            <!-- Render list and wire:model inputs -->
                                            <template x-for="(stk, i) in stackholders" :key="i">
                                                <div class="mt-4 bg-gray-50 p-2 border rounded">
                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <p class="text-sm"><strong x-text="stk.name"></strong> &mdash; <span x-text="stk.role"></span> &mdash; <span x-text="stk.email"></span></p>
                                                        </div>
                                                        <button type="button" @click="remove(i)" class="text-red-500 hover:text-red-700">&times;</button>
                                                    </div>
                                        
                                                    <!-- Livewire-compatible hidden fields -->
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
                            </div>
                        @elseif ($currentTab == 4)
                            <h2 class="text-lg font-medium italic mb-2">Fasi previste</h2>
                            <div x-data="{ selectAll: false }" x-init="$watch('selectAll', val => {
                                $el.querySelectorAll('input[name=&quot;fields[]&quot;]').forEach(cb => cb.checked = val)
                            })">
                                <!-- “Select All” master checkbox -->
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" wire:model="formData.checked" x-model="selectAll"
                                        class="mr-2" />
                                    Seleziona tutti
                                </label>
                                <!-- project_start fields -->
                                <h3>Avvio progetto</h3>
                                <ul class="ml-5 space-y-1">
                                    {{-- This is Livewire’s two-way binding. It means: when this checkbox is checked, its value (contract_ver) will be added to the array formData.selectedPhases. If it’s unchecked, Livewire will remove it from the array. --}}
                                    <li>
                                        <input type="checkbox" id="contract_ver" value="contract_ver" data-phase wire:model="formData.selectedPhases">
                                        <label for="contract_ver">Verifica contratto</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cme_ver" value="cme_ver" data-phase wire:model="formData.selectedPhases">
                                        <label for="cme_ver">Verifica CME - Piano d'indagine e capitolato</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="reserves" value="reserves" data-phase wire:model="formData.selectedPhases">
                                        <label for="reserves">Riserve</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="expiring_date_project" value="expiring_date_project" data-phase wire:model="formData.selectedPhases">
                                        <label for="expiring_date_project">Impostare la data di scadenza del progetto</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="communication_plan" value="communication_plan" data-phase wire:model="formData.selectedPhases">
                                        <label for="communication_plan">Definizione del piano di comunicazione</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="extension" value="extension" data-phase wire:model="formData.selectedPhases">
                                        <label for="extension">Proroga</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="sal" value="sal" data-phase wire:model="formData.selectedPhases">
                                        <label for="sal">Possibilità di produrre dei SAL</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="warranty" value="warranty" data-phase wire:model="formData.selectedPhases">
                                        <label for="warranty">Garanzia definitiva</label>
                                    </li>
                                </ul>

                                <!-- invoices_sal fields -->
                                <h3>Fatture acconto e SAL</h3>
                                <ul class="ml-5 space-y-1">
                                    <li>
                                        <input type="checkbox" id="emission_invoice" value="emission_invoice" data-phase wire:model="formData.selectedPhases">
                                        <label for="emission_invoice">Emissione fattura</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="payment_invoice" value="payment_invoice" data-phase wire:model="formData.selectedPhases">
                                        <label for="payment_invoice">Pagamento fattura</label>
                                    </li>
                                </ul>

                                <!-- construction_site_plane fields -->
                                <h3>Pianificazione cantiere</h3>
                                <ul class="ml-5 space-y-1">
                                    <li>
                                        <input type="checkbox" id="construction_site_plane" value="construction_site_plane" wire:model="formData.selectedPhases">
                                        <label for="construction_site_plane">Verifica accesibilità e sopralluogo</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="travel" value="travel" wire:model="formData.selectedPhases">
                                        <label for="travel">Organizzazione trasferte</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="site_pass" value="site_pass" wire:model="formData.selectedPhases">
                                        <label for="site_pass">Permessi/pass accesso al sito</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="ztl" value="ztl" wire:model="formData.selectedPhases">
                                        <label for="ztl">Permessi/pass ZTL</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="supplier" value="supplier" wire:model="formData.selectedPhases">
                                        <label for="supplier">Selezione fornitori</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="timetable" value="timetable" wire:model="formData.selectedPhases">
                                        <label for="timetable">Cronoprogramma</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="security" value="security" wire:model="formData.selectedPhases">
                                        <label for="security">Sicurezza</label>
                                    </li>
                                </ul>

                                <!-- activities fields -->
                                <h3>Esecuzione attività</h3>
                                <ul class="ml-5 space-y-1">
                                    <li>
                                        <input type="checkbox" id="activities" value="activities" wire:model="formData.selectedPhases">
                                        <label for="activities">Activities</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="team" value="team" wire:model="formData.selectedPhases">
                                        <label for="team">Selezione della squadra (caposquadra + altre risorse)</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="field_activities" value="field_activities" wire:model="formData.selectedPhases">
                                        <label for="field_activities">Impartire indicazioni utili allo svolgimento delle attività in campo</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="daily_check_activities" value="daily_check_activities" wire:model="formData.selectedPhases">
                                        <label for="daily_check_activities">Riepilogo giornaliero delle attività eseguite</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="contruction_site_media" value="contruction_site_media" wire:model="formData.selectedPhases">
                                        <label for="contruction_site_media">Caricamento dati di cantiere (foto/grafici/schizzi ecc...)</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="activity_validation" value="activity_validation" wire:model="formData.selectedPhases">
                                        <label for="activity_validation">Controllo avanzamento attività/budget (PM)</label>
                                    </li>
                                </ul>

                                <!-- data fields -->
                                <h3>Elaborazione dati</h3>
                                <ul class="ml-5 space-y-1">
                                    <li>
                                        <input type="checkbox" id="data" value="data" wire:model="formData.selectedPhases">
                                        <label for="data">Data</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="foreman_docs" value="foreman_docs" wire:model="formData.selectedPhases">
                                        <label for="foreman_docs">Controllo documentazione fornita dal Caposquadra</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="sanding_sample_lab" value="sanding_sample_lab" wire:model="formData.selectedPhases">
                                        <label for="sanding_sample_lab">Spedizione campione ai laboratori</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="data_validation" value="data_validation" wire:model="formData.selectedPhases">
                                        <label for="data_validation">Avvio attività di analisi dati</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="internal_validation" value="internal_validation" wire:model="formData.selectedPhases">
                                        <label for="internal_validation">Validazione interna degli elaborati prodotti</label>
                                    </li>
                                </ul>

                                <!-- Report fields -->
                                <h3>trasmissione report</h3>
                                <ul class="ml-5 space-y-1">
                                    <li>
                                        <input type="checkbox" id="Report" value="Report" wire:model="formData.selectedPhases">
                                        <label for="Report">Report</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="create_note" value="create_note" wire:model="formData.selectedPhases">
                                        <label for="create_note">Predisposizione di nota di trasmissione</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="sending_note" value="sending_note" wire:model="formData.selectedPhases">
                                        <label for="sending_note">Invio nota di trasmissione</label>
                                    </li>
                                </ul>

                                <!-- accounting fields -->
                                <h3>Contabilità</h3>
                                <ul class="ml-5 space-y-1">
                                    <li>
                                        <input type="checkbox" id="accounting" value="accounting" wire:model="formData.selectedPhases">
                                        <label for="accounting">accounting</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="accounting_dec" value="accounting_dec" wire:model="formData.selectedPhases">
                                        <label for="accounting_dec">Predisporre la contabilità delle attività eseguite ed inviarla al DEC</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="create_cre" value="create_cre" wire:model="formData.selectedPhases">
                                        <label for="create_cre">Produrre riciesta CRE</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="expense_allocation" value="expense_allocation" wire:model="formData.selectedPhases">
                                        <label for="expense_allocation">Riparto spese</label>
                                    </li>
                                </ul>

                                <!-- external_validation fields -->
                                <h3>Conferma esterna</h3>
                                <ul class="ml-5 space-y-1">
                                    <li>
                                        <input type="checkbox" id="external_validation" value="external_validation" wire:model="formData.selectedPhases">
                                        <label for="external_validation">external_validation</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cre" value="cre" wire:model="formData.selectedPhases">
                                        <label for="cre">CRE</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="liquidation" value="liquidation" wire:model="formData.selectedPhases">
                                        <label for="liquidation">Liquidazione</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="balance_invoice" value="balance_invoice" wire:model="formData.selectedPhases">
                                        <label for="balance_invoice">Predisposizione della fattura di saldo</label>
                                    </li>
                                </ul>

                                <!-- accounting_validation fields -->
                                <h3>Verifica tecnico contabile</h3>
                                <ul class="ml-5 space-y-1">
                                    <li>
                                        <input type="checkbox" id="accounting_validation" value="accounting_validation" wire:model="formData.selectedPhases">
                                        <label for="accounting_validation">accounting_validation</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="balance" value="balance" wire:model="formData.selectedPhases">
                                        <label for="balance">Saldo</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cre_archiving" value="cre_archiving" wire:model="formData.selectedPhases">
                                        <label for="cre_archiving">Archiviazione CRE</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="pay_suppliers" value="pay_suppliers" wire:model="formData.selectedPhases">
                                        <label for="pay_suppliers">Pagamento fornitori</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="pay_allocation_expenses" value="pay_allocation_expenses" wire:model="formData.selectedPhases">
                                        <label for="pay_allocation_expenses">Pagamento riparto spese</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="learned_lesson" value="learned_lesson" wire:model="formData.selectedPhases">
                                        <label for="learned_lesson">Lezioni apprese</label>
                                    </li>
                                </ul>

                                <!-- non_compliance_management fields -->
                                <h3>Non-Compliance Management</h3>
                                <ul class="ml-5 space-y-1">
                                    <li>
                                        <input type="checkbox" id="non_compliance_management" value="non_compliance_management" wire:model="formData.selectedPhases">
                                        <label for="non_compliance_management">non_compliance_management</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="sa" value="sa" wire:model="formData.selectedPhases">
                                        <label for="sa">Accogliere le richieste/integrazioni della S.A.</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="integrate_doc" value="integrate_doc" wire:model="formData.selectedPhases">
                                        <label for="integrate_doc">Produrre ed inviare documentazione integrativa</label>
                                    </li>
                                </ul>

                                <!-- activity fields -->
                                <h3>Chiusura attività</h3>
                                <ul class="ml-5 space-y-1">
                                    <li>
                                        <input type="checkbox" id="close_activity" value="close_activity" wire:model="formData.selectedPhases">
                                        <label for="close_activity">close activity</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="sale" value="sale" wire:model="formData.selectedPhases">
                                        <label for="sale">Fatturato specifico</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="release" value="release" wire:model="formData.selectedPhases">
                                        <label for="release">Svincolo della polizza</label>
                                    </li>
                                </ul>
                            </div>
                            {{--      @elseif ($currentTab == 5)
                            <h2 class="text-lg font-bold mb-2">Crea Progetto</h2>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" wire:model="formData.agreement" class="form-checkbox">
                                <span>Seleziona</span>
                            </label> --}}
                        @endif
                    </div>
                </div>

            </div>
            <div class="bg-white p-4 border-t flex justify-between">
                <button wire:click="prevTab"
                    class="bg-gray-300 px-4 py-2 rounded {{ $currentTab == 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ $currentTab == 1 ? 'disabled' : '' }}>
                    Indietro
                </button>
                {{--      <div x-data="{
                    canProceed: @entangle('formData').defer,
                    isValid: false
                }" x-init="$watch('canProceed', () => { Livewire.emit('checkValid') })"
                    @canProceed-updated.window="isValid = $event.detail">
                    <button wire:click="{{ $currentTab < 4 ? 'nextTab' : 'save' }}"
                        class="bg-cyan-600 text-white px-4 py-2 rounded {{ !$canProceed ? 'opacity-50 cursor-not-allowed' : '' }}"
                        @if (!$canProceed) disabled @endif>
                        {{ $currentTab < 4 ? 'Avanti' : 'Salva' }}
                    </button>
                </div> --}}

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
        // Fallback Quill init if needed elsewhere
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
