<!-- Modal -->
@if($isOpenReferent)
<div class="fixed inset-0 flex justify-end z-50">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <h2 class="text-lg font-bold">{{ $editing ? 'Modifica Referente' : 'Nuovo Referente' }}</h2>

        <input type="text" wire:model="name" placeholder="Nome" class="border p-2 w-full my-2">
        <input type="text" wire:model="last_name" placeholder="Cognome" class="border p-2 w-full my-2">
        <input type="email" wire:model="email" placeholder="Email" class="border p-2 w-full my-2">
        <input type="text" wire:model="title" placeholder="Titolo" class="border p-2 w-full my-2">
        <input type="text" wire:model="job_position" placeholder="Posizione" class="border p-2 w-full my-2">
        <input type="text" wire:model="telephone" placeholder="Telefono" class="border p-2 w-full my-2">
        <input type="text" wire:model="role" placeholder="Ruolo" class="border p-2 w-full my-2">
        <input type="text" wire:model="note" placeholder="Nota" class="border p-2 w-full my-2">

        <button wire:click="save" class="bg-cyan-500 text-white p-2">Salva</button>
        <button wire:click="closeModal" class="bg-gray-500 text-white p-2">Annulla</button>
    </div>
</div>
@endif

@if($showModal)
<div class="fixed inset-0 flex justify-end z-50">
    <div class="fixed inset-0 bg-opacity-50"></div>

    <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
        style="right: 0;">
        <div class="p-4 border-b flex justify-between items-center">
            <h2 class="text-xl font-semibold">Dettaglio Referente</h2>
            <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                ✖
            </button>
        </div>

        <div class="p-6">
            @if($selectedReferent)
            <p><strong>Nome:</strong> {{ $selectedReferent->name }} {{ $selectedReferent->last_name }}</p>
            <p><strong>Titolo:</strong> {{ $selectedReferent->title }}</p>
            <p><strong>Posizione:</strong> {{ $selectedReferent->job_position }}</p>
            <p><strong>Email:</strong> <a href="mailto:{{ $selectedReferent->email }}"
                    class="text-cyan-500 underline hover:text-cyan-700">{{ $selectedReferent->email }}</a></p>
            <p><strong>Telefono:</strong> {{ $selectedReferent->telephone }}</p>
            <p><strong>Nota:</strong> {{ $selectedReferent->note }}</p>
            @endif
        </div>
    </div>
</div>
@endif

@if($showModalSale)
<div class="fixed inset-0 flex justify-end z-50">
    <div class="fixed inset-0 bg-opacity-50"></div>

    <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
        style="right: 0;">
        <div class="p-4 border-b flex justify-between items-center">
            <h2 class="text-xl font-semibold">Dettaglio Vendita</h2>
            <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                ✖
            </button>
        </div>

        <div class="p-6">
            @if($selectedSale)
            <p><strong>Fattura:</strong> {{ $selectedSale->invoice }}</p>
            <p><strong>Importo:</strong> {{ $selectedSale->price }}</p>
            <p><strong>Stato:</strong> {{ $selectedSale->status }}</p>
            <p><strong>Data:</strong> {{ $selectedSale->date }}</p>

            @endif
        </div>
    </div>
</div>
@endif

@if($showModalInvoice)
<div class="fixed inset-0 flex justify-end z-50">
    <div class="fixed inset-0 bg-opacity-50"></div>

    <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
        style="right: 0;">
        <div class="p-4 border-b flex justify-between items-center">
            <h2 class="text-xl font-semibold">Dettaglio Vendita</h2>
            <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                ✖
            </button>
        </div>

        <div class="p-6">
            @if($selectedInvoice)
            <p><strong>Numero Fattura:</strong> {{ $selectedInvoice->number_invoice }}</p>
            <p><strong>Data:</strong> {{ $selectedInvoice->date_invoice }}</p>
            <p><strong>Scadenza:</strong> {{ $selectedInvoice->expire_invoice }}</p>
            <p><strong>Imponibile:</strong> {{ $selectedInvoice->taxable }}</p>
            <p><strong>Totale:</strong> {{ $selectedInvoice->total }}</p>
            <p><strong>Stato:</strong> {{ $selectedInvoice->status }}</p>
            @endif
        </div>
    </div>
</div>
@endif

@if($isOpenActivity)
<div class="fixed inset-0 flex justify-end z-50">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <h2 class="text-lg font-bold">{{ $editing ? 'Modifica Attività' : 'Nuova Attività' }}</h2>
        @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-2 rounded mb-2">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <input type="text" wire:model="activities" placeholder="Nome Attività" class="border p-2 w-full my-2">
        <input type="text" wire:model="label" placeholder="Etichetta" class="border p-2 w-full my-2">
        <select wire:model="to_do" class="border p-2 w-full my-2">
            <option value="">Seleziona un'opzione</option>
            <option value="to_do">Da Fare</option>
            <option value="done">Fatto</option>
        </select>
        <input type="text" wire:model="name" placeholder="Nome Utente" class="border p-2 w-full my-2">
        <input type="text" wire:model="last_name" placeholder="Cognome Utente" class="border p-2 w-full my-2">
        {{-- <input type="text" wire:model="role" placeholder="Ruolo" class="border p-2 w-full my-2"> --}}

        <input type="text" wire:model="assignee" placeholder="Assegnatario" class="border p-2 w-full my-2">
        <input type="date" wire:model="expire_at" placeholder="Scadenza" class="border p-2 w-full my-2">

        <button wire:click="saveActivity" class="bg-cyan-500 text-white p-2">Salva</button>
        <button wire:click="closeModal" class="bg-gray-500 text-white p-2">Annulla</button>
    </div>
</div>
@endif

@if($showModalActivity)
<div class="fixed inset-0 flex justify-end z-50">
    <div class="fixed inset-0 bg-opacity-50"></div>

    <div class="bg-white w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
        style="right: 0;">
        <div class="p-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold">Attività</h2>
            <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                ✖
            </button>
        </div>

        <div class="p-6 ml-16 mr-16">
            @if($selectedActivity)
            <div class="flex m-2 mb-7 justify-between">
                <p> <span class="px-2 py-1  font-semibold rounded-[15px] border border-solid 
                    @if($activity->to_do == " Fatta") bg-[#EFF9F3] text-[#65C587] border-[#65C587]
                        @elseif($activity->to_do == "Da Terminare")
                        bg-[] text-[#65C587] border-[#E63946]
                        @elseif($activity->to_do == "In sospeso")
                        bg-cyan-100 text-[#0C7BFF] border-[#65C587]
                        @else
                        bg-gray-100 text-gray-600 border-gray-600
                        @endif">
                        @if($activity->to_do == "Fatta")
                        Fatta
                        @elseif($activity->to_do == "Da Terminare")
                        Da terminare
                        @elseif($activity->to_do == "In sospeso")
                        In sospeso
                        @else
                        ---
                        @endif
                    </span></p>

                <div class="flex space-x-2">
                    <button wire:click="edit({{ $note->id }})" title="Modifica"
                        class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer flex">
                        <flux:icon.pencil class="text-[#6C757D]" /> Modifica
                    </button>
                    <button wire:click="delete({{ $note->id }})" title="Cancella"
                        class=" text-gray-600 rounded  ml-[10px] hover:cursor-pointer flex">
                        <flux:icon.trash class="text-[#E63946]" /> Elimina
                    </button>
                </div>

            </div>

            <div>
                <div class="flex">
                    @if (isset(Auth::user()->profile_photo))
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="User" class="w-8 h-8 rounded-full">
                    @else
                    <img alt="utente" src="{{ asset('icon/navbar/user.svg') }}" />
                    @endif
                    <div class="flex flex-col items-start ml-5 mb-5">
                        <span
                            class="text-[18px]  font-normal text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                            {{ $selectedActivity->name . ' ' . $selectedActivity->last_name . ' - ' .
                            $selectedActivity->role}} </span>
                        <span
                            class="text-[17px]  font-light text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                            {{ Auth::user()->role }}</span>
                        <span class="font-extralight">{{$selectedActivity->created_at->diffForHumans()}}</span>
                    </div>

                </div>

                <div class="border-l">
                    <div class=" ml-8 ">
                        <p class="font-extralight flex">
                            <flux:icon.wrench class="" />Attività
                        </p>

                        <p>{{$selectedActivity->activities}}</p>


                    </div>
                    <div class="flex ml-5">
                        <div class="m-4 ">
                            <p class="font-extralight flex mb-1.5">
                                <flux:icon.at-symbol class="" />Assegnato a
                            </p>
                            <img class=" w-5 h-5"
                                src="{{ $selectedActivity->user->image_path? asset($selectedActivity->user->image_path) : asset('icon/navbar/user.svg') }}"
                                class="rounded-full h-10 w-10 object-cover" />
                        </div>
                        <div class="m-4 ">
                            <p class="font-extralight flex mb-1.5">
                                <flux:icon.at-symbol class="" />Conoscenza
                            </p>
                            <img class="w-5 h-5"
                                title=" {{ $selectedActivity->name . ' ' . $selectedActivity->last_name}}"
                                src="{{ $selectedActivity->user->image_path? asset($selectedActivity->user->image_path) : asset('icon/navbar/user.svg') }}"
                                class="rounded-full h-10 w-10 object-cover" />
                        </div>

                        <div class="m-4 ">
                            <p class="font-extralight flex mb-1.5">
                                <flux:icon.calendar-days class="" />Scadenza
                            </p>
                            <p class="text-[#28A745]">
                                {{\Carbon\Carbon::parse($selectedActivity->expire_at)->format('d/m/Y') }}</p>
                        </div>

                    </div>
                    <div class="m-4 ">
                        <p class="font-extralight">Allegati:</p>
                        <p>
                            {{ $selectedActivity->attach}}
                        </p>
                    </div>
                    <div class="m-4 ">
                        <p class="font-extralight">Note:</p>
                        <p>
                            {{ $selectedActivity->note}}
                        </p>
                    </div>
                </div>

                {{-- <p><strong>Nome e Cognome: </strong> {{ $selectedActivity->name . ' ' . $selectedActivity->name }}
                </p>
                <p><strong>Ruolo:</strong> {{ $selectedActivity->role }}</p>
                <p><strong>Etichetta:</strong> {{ $selectedActivity->label }}</p>
                <p><strong>Da Fare:</strong> {{ $selectedActivity->to_do }}</p>
                <p><strong>Attività:</strong> {{ $selectedActivity->activities }}</p>
                <p><strong>Assegnatario:</strong> {{ $selectedActivity->assignee }}</p>
                <p><strong>Scadenza:</strong> {{ $selectedActivity->expired_at }}</p> --}}
                @endif
            </div>
        </div>
    </div>
    @endif


    @if($showModalEmail)
    <div class="fixed inset-0 flex justify-end z-50">
        <div class="fixed inset-0 bg-opacity-50"></div>

        <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
            style="right: 0;">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dettaglio Email</h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <div class="p-6">
                @if($selectedEmail)
                <p><strong>Task:</strong> {{ $selectedEmail->task }}</p>
                <p><strong>Assegnato a:</strong> {{ $selectedEmail->assigned_to }}</p>
                <p><strong>Mittente:</strong> {{ $selectedEmail->sender }}</p>
                <p><strong>Destinatario/i:</strong> {{ $selectedEmail->receiver }}</p>
                @php
                $paths = json_decode($selectedEmail->path, true);
                @endphp
                <p><strong>Allegati:</strong> @if($paths && is_array($paths))
                <ul>
                    @foreach($paths as $path)
                    <li><a href="{{ $path }}" target="_blank">{{ basename($path) }}</a></li>
                    @endforeach
                </ul>
                @else
                <p>Nessun allegato</p>
                @endif</p>
                <p><strong>Messaggio Email:</strong> {{ $selectedEmail->note }}</p>
                <p><strong>Nome Utente:</strong> {{ $selectedEmail->name_user }}</p>
                <p><strong>Cognome Utente:</strong> {{ $selectedEmail->last_name_user }}</p>
                <p><strong>Posizione Utente:</strong> {{ $selectedEmail->job_position_user }}</p>
                <p><strong>Stato:</strong> {{ $selectedEmail->status_user }}</p>
                <p><strong>Attività:</strong> {{ $selectedEmail->action }}</p>

                @endif
            </div>
        </div>
    </div>
    @endif

    @if($showModalNote)
    <div class="fixed inset-0 flex justify-end z-50">
        <div class="fixed inset-0 bg-opacity-50"></div>

        <div class="bg-gray-200 w-1/3 h-full shadow-lg transform transition-transform duration-300 ease-in-out"
            style="right: 0;">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dettaglio Nota</h2>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <div class="p-6">
                @if($selectedNote)
                <p><strong>Nome e Cognome:</strong> {{ $selectedNote->name_user . ' ' . $selectedNote->last_name_user }}
                </p>
                <p><strong>Ruolo:</strong> {{ $selectedNote->role_user }}</p>
                <p><strong>Mittente:</strong> {{ $selectedNote->sender }}</p>
                <p><strong>Destinatario/i:</strong> {{ $selectedNote->receiver }}</p>
                @php
                $paths = json_decode($selectedNote->path, true);
                @endphp
                <p><strong>Allegati:</strong> @if($paths && is_array($paths))
                <ul>
                    @foreach($paths as $path)
                    <li><a href="{{ $path }}" target="_blank">{{ basename($path) }}</a></li>
                    @endforeach
                </ul>
                @else
                <p>Nessun allegato</p>
                @endif</p>
                <p><strong>Nota:</strong> {{ $selectedNote->note }}</p>


                @endif
            </div>
        </div>
    </div>
    @endif

    @if($isOpenNote)
    <div>

        <div class="fixed inset-0 flex justify-end z-50">
            <div class="bg-white p-6 rounded shadow-lg w-1/2">
                <h2 class="text-lg font-semibold mb-4">Nuova Nota</h2>

                @if (session()->has('message'))
                <div class="text-green-600 mb-2">{{ session('message') }}</div>
                @endif

                <form wire:submit.prevent="saveNote" enctype="multipart/form-data">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block">Client ID</label>
                            <input type="number" wire:model="client_id" class="border p-2 w-full">
                            @error('client_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block">Nota</label>
                            <input type="text" wire:model="note" class="border p-2 w-full">
                            @error('note') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- upload --}}
                        <div class="flex">
                            <div class="flex flex-col items-center justify-center w-full">
                                @if ($logoPreview)
                                <div class="relative">
                                    <img src="{{ $logoPreview }}" class="w-32 h-32 object-cover rounded-lg shadow-md">
                                    <button type="button" wire:click="removeLogo"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                                        &times;
                                    </button>
                                </div>
                                @else
                                <label for="logo"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Clicca per
                                                caricare il file</span>
                                            oppure trascina</p>
                                        <p class="text-xs text-gray-500">Max: 6MB</p>
                                    </div>
                                    <input id="logo" type="file" wire:model="logo" class="hidden" />
                                </label>
                                @endif

                                @error('logo')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="bg-cyan-500 text-white p-2">Salva</button>
                            <button wire:click="closeModal" class="bg-gray-500 text-white p-2">Annulla</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    @endif

</div>

@if($isOpenEmail)
<div>

    <div class="fixed inset-0 flex justify-end z-50">
        <div class="bg-white p-6 rounded shadow-lg w-1/2">
            <h2 class="text-lg font-semibold mb-4">Nuova Email</h2>

            @if (session()->has('message'))
            <div class="text-green-600 mb-2">{{ session('message') }}</div>
            @endif

            <form wire:submit.prevent="saveEmail" enctype="multipart/form-data">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block">Client ID</label>
                        <input type="number" wire:model="client_id" class="border p-2 w-full">
                        @error('client_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- <div>
                        <label class="block">Attività</label>
                        <input type="text" wire:model="task" class="border p-2 w-full">
                        @error('task') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div> --}}

                    <div>
                        <label class="block">Mittente</label>
                        <p wire:model='sender'>{{ Auth::user()->email }}</p>
                        @error('sender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <div x-data="{
                            query: '',
                            selectedEmails: @entangle('receiver').defer || [],
                            emails: @js($email_all_users) || [], 

                            filteredEmails() {
                                return this.emails.filter(email => email.toLowerCase().includes(this.query.toLowerCase()));
                            },

                            toggleEmail(email) {
                                if (!this.selectedEmails) this.selectedEmails = []; 
                                
                                if (this.selectedEmails.includes(email)) {
                                    this.selectedEmails = this.selectedEmails.filter(e => e !== email);
                                } else {
                                    this.selectedEmails.push(email);
                                }

                                // Manually update Livewire
                                $wire.set('receiver', this.selectedEmails);
                            }
                        }" class="space-y-2">

                            <label for="receiver" class="block text-sm font-medium text-gray-700">Seleziona
                                Utente</label>

                            <!-- Dropdown search input -->
                            <div class="relative">
                                <input type="text" x-model="query" placeholder="Ricerca utente..."
                                    class="w-full p-2 border rounded-md" autocomplete="off">

                                <!-- List of filtered emails -->
                                <div x-show="query.length > 0" x-transition
                                    class="absolute left-0 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg z-10">
                                    <ul>
                                        <template x-for="(email, index) in filteredEmails()" :key="index">
                                            <li @click="toggleEmail(email)"
                                                class="cursor-pointer p-2 hover:bg-gray-100">
                                                <span x-text="email"></span>
                                                <span x-show="selectedEmails.includes(email)"
                                                    class="ml-2 text-green-500">✔</span>
                                            </li>
                                        </template>
                                        <li x-show="filteredEmails().length === 0" class="p-2 text-gray-500">No
                                            results</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Display selected emails -->
                            <div class="flex flex-wrap gap-2 mt-2">
                                <template x-for="(email, index) in selectedEmails" :key="index">
                                    <span class="bg-gray-200 text-gray-700 rounded-full px-3 py-1">
                                        <span x-text="email"></span>
                                        <button
                                            @click="selectedEmails = selectedEmails.filter(e => e !== email); $wire.set('receiver', selectedEmails)"
                                            class="ml-1 text-red-500">×</button>
                                    </span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block">Oggetto</label>
                        <input type="text" wire:model="action" class="border p-2 w-full">
                        @error('action') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-2">
                        <label class="block">Email</label>
                        <textarea wire:model="note" class="border p-2 w-full"></textarea>
                        @error('note') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- upload --}}
                    <div class="flex">
                        <div class="flex flex-col items-center justify-center w-full">
                            @if ($logoPreview)
                            <div class="relative">
                                <img src="{{ $logoPreview }}" class="w-32 h-32 object-cover rounded-lg shadow-md">
                                <button type="button" wire:click="removeLogo"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                                    &times;
                                </button>
                            </div>
                            @else
                            <label for="logo"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Clicca per
                                            caricare il file</span>
                                        oppure trascina</p>
                                    <p class="text-xs text-gray-500">Max: 20MB</p>
                                </div>
                                <input id="logo" type="file" wire:model="logo" class="hidden" />
                            </label>
                            @endif

                            @error('logo')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="button" wire:click="closeModal"
                            class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Annulla</button>

                        <button type="button" wire:click="saveEmail" wire:loading.attr="disabled"
                            class="bg-cyan-500 text-white px-4 py-2 rounded flex items-center">
                            <!-- Show spinner when sending -->
                            <svg wire:loading wire:target="saveEmail" class="animate-spin h-5 w-5 mr-2 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 1116 0A8 8 0 014 12z">
                                </path>
                            </svg>

                            <!-- Change button text when sending -->
                            <span wire:loading.remove wire:target="saveEmail">Salva e Invia</span>
                            <span wire:loading wire:target="saveEmail">Invio...</span>
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endif