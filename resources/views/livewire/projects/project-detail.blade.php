<div>
    @section('content')
        <div class="container mx-auto pt-12">
            <div class="flex flex-col lg:flex-row px-6 lg:px-24">
                <!-- Left Section: Referents -->
                <div class="w-full p-6 bg-white">
                    <div class="mx-auto my-3">
                        @include('livewire.general.goback')
                    </div>
                    <div class="flex">
                        <flux:tab.group class="bg-white shadow-sm shadow-black/10 rounded-[1px] opacity-100 p-9">

                            <flux:tabs class="flex 2xl:flex-nowrap flex-wrap gap-2 align-middle border-none">
                                <flux:tab data-variant="detail" name="task">Task</flux:tab>
                                <flux:tab data-variant="detail" name="document">Documenti</flux:tab>
                                <flux:tab data-variant="detail" name="note">Note</flux:tab>
                                <flux:tab data-variant="detail" name="data-sheet">Scheda tecnica</flux:tab>
                            </flux:tabs>

                            <flux:tab.panel name="task">
                                <flux:tabs wire:model="detailActiveTab" variant="segmented">
                                    <flux:tab name="detail-list" icon="list-bullet">Lista</flux:tab>
                                    <flux:tab name="detail-kanban" icon="squares-2x2">Kanban</flux:tab>
                                </flux:tabs>
                            </flux:tab.panel>


                        </flux:tab.group>

                        <flux:select wire:model.live="query_project" data-variant="status">
                            <flux:select.option value="">Tutti gli stati</flux:select.option>
                            <flux:select.option value="Pubblico">Pubblico</flux:select.option>
                            <flux:select.option value="Privato">Privato</flux:select.option>
                        </flux:select>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>
