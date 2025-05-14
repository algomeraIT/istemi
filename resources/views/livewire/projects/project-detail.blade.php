
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
                                <div>
                                    <livewire:projects.project-tasks-list :id="$id"/>
                                </div>
                           
                            </flux:tab.panel>

                            <flux:tab.panel name="document">
                                @include('livewire.projects.document-detail')
                            </flux:tab.panel>

                            <flux:tab.panel name="note">
                                @include('livewire.projects.note-detail', ['id' => $id])
                            </flux:tab.panel>

                            <flux:tab.panel name="data-sheet">
                                @include('livewire.projects.project-datasheet')
                            </flux:tab.panel>
                        </flux:tab.group>

                    </div>
                    @unless ($datasheetHideDiv === 'data-sheet')
                        <div class="xl:w-1/4">
                            @include('livewire.projects.allDataRight-detail')
                        </div>
                    @endunless
                </div>

            </div>
        </div>

