<div>
    @section('content')
        <div class="container mx-auto pt-2">
            <div class=" bg-white p-6 ">
                <!-- Left Section: Referents -->
                <div class="mx-auto my-3">
                    @include('livewire.general.goback')
                </div>

                <div class="w-full flex  xl:flex-row flex-col-reverse ">

                    <div class="lg:flex lg:flex-nowrap xl:w-3/4">

                        <flux:tab.group wire:model="datasheetHideDiv" class="bg-white  p-2 w-full">

                            <div class="md:flex xl:justify-between items-baseline">

                                <flux:tabs class="flex 2xl:flex-nowrap flex-wrap gap-2 align-middle border-none">
                                    <flux:tab data-variant="detail" name="task"
                                        wire:click.native="$set('datasheetHideDiv','task')">Task</flux:tab>
                                    <flux:tab data-variant="detail" name="document"
                                        wire:click.native="$set('datasheetHideDiv','document')">Documenti</flux:tab>
                                    <flux:tab data-variant="detail" name="note"
                                        wire:click.native="$set('datasheetHideDiv','note')">Note</flux:tab>
                                    <flux:tab data-variant="detail" name="data-sheet"
                                        wire:click.native="$set('datasheetHideDiv','data-sheet')">Scheda tecnica</flux:tab>
                                </flux:tabs>

                                <div class="sm:flex md:flex-wrap lg:flex-nowrap gap-4 p-1">
                                    <flux:select wire:model.live="query_project" data-variant="status">
                                        <flux:select.option value="">Tutti gli stati</flux:select.option>
                                        <flux:select.option value="Pubblico">Pubblico</flux:select.option>
                                        <flux:select.option value="Privato">Privato</flux:select.option>
                                    </flux:select>
                                    <flux:select wire:model.live="query_project" data-variant="status">
                                        <flux:select.option value="">Assegnati a tutti</flux:select.option>
                                        <flux:select.option value="Pubblico">Pubblico</flux:select.option>
                                        <flux:select.option value="Privato">Privato</flux:select.option>
                                    </flux:select>
                                    <flux:input wire:model.live="query" data-variant="search" :loading="false"
                                        icon="magnifying-glass" placeholder="Cerca..." />
                                </div>
                            </div>
                            <flux:tab.panel name="task">
                                <flux:tab.group class=" p-2 ">

                                    <flux:tabs variant="segmented" class="lg:ml-[40%]">
                                        <flux:tab name="list" icon="list-bullet">Lista</flux:tab>
                                        <flux:tab name="kanban" icon="squares-2x2">Kanban</flux:tab>
                                    </flux:tabs>

                                    <flux:tab.panel name="list">

                                        @if (count($this->projectStart) > 0)
                                            @include('livewire.projects.project-detail-list-component', [
                                                'elements' => $this->projectStart,
                                                'nameSection' => 'Avvio progetto',
                                            ])
                                        @endif

                                        @if (count($this->invoicesSal) > 0)
                                            @include('livewire.projects.project-detail-list-component', [
                                                'elements' => $this->invoicesSal,
                                                'nameSection' => 'Fattura e acconto SAL',
                                            ])
                                        @endif

                                        @if (count($this->constructionSitePlane) > 0)
                                            @include('livewire.projects.project-detail-list-component', [
                                                'elements' => $this->constructionSitePlane,
                                                'nameSection' => 'Pianificazione cantiere',
                                            ])
                                        @endif

                                        @if (count($this->data) > 0)
                                            @include('livewire.projects.project-detail-list-component', [
                                                'elements' => $this->data,
                                                'nameSection' => 'Elaborazione dati',
                                            ])
                                        @endif

                                        @if (count($this->externalValidation) > 0)
                                            @include('livewire.projects.project-detail-list-component', [
                                                'elements' => $this->externalValidation,
                                                'nameSection' => 'Verifica esterna',
                                            ])
                                        @endif

                                        @if (count($this->accountingValidation) > 0)
                                            @include('livewire.projects.project-detail-list-component', [
                                                'elements' => $this->accountingValidation,
                                                'nameSection' => 'Verifica tecnico contabile',
                                            ])
                                        @endif

                                        @if (count($this->nonComplianceManagement) > 0)
                                            @include('livewire.projects.project-detail-list-component', [
                                                'elements' => $this->nonComplianceManagement,
                                                'nameSection' => 'Gestione non conformità',
                                            ])
                                        @endif

                                        @if (count($this->closeActivity) > 0)
                                            @include('livewire.projects.project-detail-list-component', [
                                                'elements' => $this->closeActivity,
                                                'nameSection' => 'Chiusura attività',
                                            ])
                                        @endif

                                    </flux:tab.panel>


                                    <flux:tab.panel name="kanban" class="flex overflow-auto max-w-[1000px]">
                                     
                                            @if (count($this->projectStart) > 0)
                                                @include(
                                                    'livewire.projects.project-detail-kanban-component',
                                                    [
                                                        'elements' => $this->projectStart,
                                                        'nameSection' => 'Avvio progetto',
                                                    ]
                                                )
                                            @endif

                                            @if (count($this->invoicesSal) > 0)
                                                @include(
                                                    'livewire.projects.project-detail-kanban-component',
                                                    [
                                                        'elements' => $this->invoicesSal,
                                                        'nameSection' => 'Fattura e acconto SAL',
                                                    ]
                                                )
                                            @endif

                                            @if (count($this->constructionSitePlane) > 0)
                                                @include(
                                                    'livewire.projects.project-detail-kanban-component',
                                                    [
                                                        'elements' => $this->constructionSitePlane,
                                                        'nameSection' => 'Pianificazione cantiere',
                                                    ]
                                                )
                                            @endif

                                            @if (count($this->data) > 0)
                                                @include(
                                                    'livewire.projects.project-detail-kanban-component',
                                                    [
                                                        'elements' => $this->data,
                                                        'nameSection' => 'Elaborazione dati',
                                                    ]
                                                )
                                            @endif

                                            @if (count($this->externalValidation) > 0)
                                                @include(
                                                    'livewire.projects.project-detail-kanban-component',
                                                    [
                                                        'elements' => $this->externalValidation,
                                                        'nameSection' => 'Verifica esterna',
                                                    ]
                                                )
                                            @endif

                                            @if (count($this->accountingValidation) > 0)
                                                @include(
                                                    'livewire.projects.project-detail-kanban-component',
                                                    [
                                                        'elements' => $this->accountingValidation,
                                                        'nameSection' => 'Verifica tecnico contabile',
                                                    ]
                                                )
                                            @endif

                                            @if (count($this->nonComplianceManagement) > 0)
                                                @include(
                                                    'livewire.projects.project-detail-kanban-component',
                                                    [
                                                        'elements' => $this->nonComplianceManagement,
                                                        'nameSection' => 'Gestione non conformità',
                                                    ]
                                                )
                                            @endif

                                            @if (count($this->closeActivity) > 0)
                                                @include(
                                                    'livewire.projects.project-detail-kanban-component',
                                                    [
                                                        'elements' => $this->closeActivity,
                                                        'nameSection' => 'Chiusura attività',
                                                    ]
                                                )
                                            @endif
                                    
                                    </flux:tab.panel>


                                </flux:tab.group>
                            </flux:tab.panel>

                            <flux:tab.panel name="document">
                                <div class="w-full overflow-x-auto">
                                    @if ($this->document)
                                        <flux:table>
                                            <flux:table.columns>
                                                <flux:table.column>Nome documento</flux:table.column>
                                                <flux:table.column>Data caricamento</flux:table.column>
                                                <flux:table.column>Fase progettuale</flux:table.column>
                                                <flux:table.column>Caricato da</flux:table.column>
                                                <flux:table.column data-th-action>Azioni</flux:table.column>
                                            </flux:table.columns>

                                            <flux:table.rows>
                                                @foreach ($this->document as $doc)
                                                    <flux:table.row :key="$doc->id">

                                                        <flux:table.cell class="whitespace-nowrap">
                                                            {{ $doc->document_name }}</flux:table.cell>
                                                        <flux:table.cell class="whitespace-nowrap">
                                                            {{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}
                                                        </flux:table.cell>
                                                        <flux:table.cell class="whitespace-nowrap">
                                                            {{ $doc->phase }}</flux:table.cell>
                                                        <flux:table.cell class="whitespace-nowrap">
                                                            {{ $doc->user_name }}</flux:table.cell>
                                                        <flux:table.cell align="end">
                                                            <flux:button wire:click="show({{ $doc->id }})"
                                                                variant="ghost" data-variant="ghost" data-color="teal"
                                                                data-rounded icon="eye" size="sm" />
                                                        </flux:table.cell>
                                                    </flux:table.row>
                                                @endforeach
                                            </flux:table.rows>
                                        </flux:table>
                                        {{--       <div class="-mx-4 mt-4">
                                            {{ $start->links('customPagination') }}
                                        </div> --}}
                                    @else
                                        <p class="text-gray-500">Nessun elemento da mostrare</p>
                                    @endif
                                </div>

                                <script>
                                    function copyToClipboard(text) {
                                        navigator.clipboard.writeText(text).then(() => {
                                            alert("Copiato: " + text);
                                        }).catch(err => {
                                            console.error('Clipboard error:', err);
                                        });
                                    }
                                </script>

                            </flux:tab.panel>
                            <flux:tab.panel name="note">
                                <flux:button>Scrivi nota</flux:button>
                                @if ($notes->isNotEmpty())
                                    @foreach ($notes->groupBy(fn($note) => $note->created_at->locale('it')->isoFormat('MMMM YYYY')) as $month => $monthNotes)
                                        <div class="mt-8 mb-4 flex items-center">
                                            <span
                                                class="bg-[#F5FCFD] text-[#10BDD4] px-3 py-1 border-[#E8E8E8] border-1 text-[13px] font-semibold ml-12">
                                                {{ $month }}
                                            </span>
                                            <div class="h-px bg-gray-300 flex-1 "></div>
                                        </div>

                                        {{-- All notes in this month --}}
                                        @foreach ($monthNotes as $note)
                                            <div class="border w-full p-4 mb-6">
                                                <div class="flex items-start space-x-3">
                                                    <div
                                                        class="flex h-6 w-6 items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4]">
                                                        <flux:icon.user variant="micro" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="flex items-center space-x-2 text-sm">
                                                            <span>{{ $note->user_name }}</span>
                                                            <div class="w-2 h-px bg-gray-400"></div>
                                                            <span class="text-gray-500">{{ $note->role }}</span>
                                                        </div>
                                                        <div class="flex items-center text-xs text-gray-600 mt-1">
                                                            <span class="italic">ha scritto una nota</span>
                                                            <div class="w-1 h-1 bg-gray-400 rounded-full mx-2"></div>
                                                            <span>{{ $note->created_at->diffForHumans() }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4 text-base font-light text-gray-800">
                                                    {{ $note->note }}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endif
                            </flux:tab.panel>
                            <flux:tab.panel name="data-sheet">
                                @include('livewire.projects.project-datasheet')
                            </flux:tab.panel>
                        </flux:tab.group>



                    </div>
                    @unless ($datasheetHideDiv === 'data-sheet')
                        <div class="xl:w-1/4">
                            <div class="mx-auto  bg-white border-2 border-dotted border-[#A0A0A0] rounded-sm ">


                                <div class="mt-1 p-7 ">
                                    <div class="flex items-center justify-between">
                                        <div class="flex justify-baseline items-center">
                                            <img src="/icon/menu/progetti.svg" alt="Progetto" class="w-5 h-5 mr-2">
                                            <h2 class="text-2xl font-bold text-left">{{ $project->estimate }}</h2>
                                        </div>
                                        <div class="">
                                            <flux:button variant="primary" data-variant="primary" data-color="small"
                                                icon="archive-box">
                                                Archivia</flux:button>
                                        </div>
                                    </div>
                                    @php
                                        $details = [
                                            'Nome progetto' => $project->name_project,
                                            'Cliente' => $project->client_name,
                                            'tipo di progetto' => $project->client_type,
                                            'Budget allocato' => $project->total_budget,
                                            'Responsabile di progetto' => $project->responsible,
                                            'Responsabile di area' => $project->chief_area,
                                            'Data inizio' => \Carbon\Carbon::parse($project->start_at)->format('d/m/Y'),
                                            'Data fine' => \Carbon\Carbon::parse($project->end_at)->format('d/m/Y'),
                                        ];
                                    @endphp

                                    @foreach ($details as $label => $value)
                                        <p class="flex flex-col mt-4 text-[15px] font-semibold text-[#A0A0A0]">
                                            <span
                                                class="@if ($label === 'Data fine') text-[#28A745] @else text-[#B0B0B0] @endif font-light pb-1">{{ $label }}:</span>
                                            <span>{!! $value !!}</span>
                                            @if ($label === 'Responsabile di progetto')
                                                <flux:separator />
                                            @endif
                                        </p>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    @endunless
                </div>

            </div>
        </div>
    @endsection
</div>
