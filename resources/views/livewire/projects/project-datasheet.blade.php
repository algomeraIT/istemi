<div class="p-4 bg-white border-none">
    <div class="flex">
        <flux:tab.group wire:model="datasheettabs" class="w-full flex">
            {{-- Left: Vertical Tabs --}}

            <flux:tabs class="flex flex-col gap-2 border-none">
                <flux:tab data-variant="detail" name="info">
                    Informazioni generali
                </flux:tab>
                <flux:tab data-variant="detail" name="desc">
                    Descrizione progetto
                </flux:tab>
                <flux:tab data-variant="detail" name="phases">
                    Fasi previste
                </flux:tab>
            </flux:tabs>

            <flux:tab.panel name="info">
                Contenuto Informazioni Generali
            </flux:tab.panel>
            <flux:tab.panel name="desc">
                <div class="text-sm">Contenuto Descrizione Progetto</div>
            </flux:tab.panel>
            <flux:tab.panel name="phases">
                <div class="text-sm">Contenuto Fasi Previste</div>
            </flux:tab.panel>

        </flux:tab.group>
    </div>
</div>
