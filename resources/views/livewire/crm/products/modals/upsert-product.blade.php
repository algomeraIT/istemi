<form class="bg-[#FFFFFF] px-12 py-9 rounded-lg" wire:submit.prevent="updateOrCreate">


    <div class="flex items-start justify-between mb-6">
        <h3 class="text-2xl font-semibold">
            {{ $isEdit ? 'Modifica servizio' : 'Aggiungi servizio' }}
        </h3>

        <button wire:click.prevent="$dispatch('closeModal')"
                class="font-light text-[#B0B0B0] flex items-center gap-1 cursor-pointer">
            <flux:icon.x-mark class="size-4" /> Annulla
        </button>
    </div>
    <div class="bg-[#F8FEFF] p-5 border border-color-[#00000029] mb-5">

        <div class="grid grid-cols-2 gap-4">
            {{-- Categoria --}}
            <flux:field data-input>
                <flux:label>Categoria</flux:label>
                <flux:select variant="listbox"  searchable clearable  wire:model="productForm.product_category_id " placeholder="Seleziona">
                    @foreach($categories as $cat)
                        <flux:select.option value="{{ $cat->id }}">{{ $cat->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="productForm.product_category_id " />
            </flux:field>

            {{-- Codice --}}
            <flux:field data-input>
                <flux:label>Codice</flux:label>
                <flux:input
                        wire:model.live="productForm.unique_code"
                        placeholder="Generato automaticamente"
                        disabled />
            </flux:field>
        </div>

        {{-- Titolo --}}
        <div class="mt-4">
            <flux:field data-input>
                <flux:label>Titolo</flux:label>
                <flux:input wire:model.live.debounce.500ms="productForm.title" />
                <flux:error name="productForm.title" />
            </flux:field>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            {{-- UdM --}}
            <flux:field data-input>
                <flux:label>UdM</flux:label>
                <flux:select variant="listbox" searchable clearable wire:model="productForm.uom" placeholder="Seleziona o digita">
                    @foreach($uoms as $u)
                        <flux:select.option value="{{ $u }}">{{ $u }}</flux:select.option>
                    @endforeach
                </flux:select>

            </flux:field>


            {{-- Prezzo --}}
            <flux:field data-input>
                <flux:label>Prezzo</flux:label>
                <flux:input.group>
                    <flux:input.group.prefix class="bg-[#F5FCFD]"> <span class="font-semibold text-[#10BDD4] px-2.5 py-1.5">€</span> </flux:input.group.prefix>
                    <flux:input wire:model="productForm.price" type="number" step="0.01" />
                </flux:input.group>
                <flux:error name="productForm.price" />
            </flux:field>
        </div>

        {{-- Descrizione --}}
        <div class="mt-4">
            <flux:field data-input>
                <flux:label>Descrizione</flux:label>
                <flux:textarea wire:model="productForm.description" name="description" rows="4" />
                <flux:error name="productForm.description" />
            </flux:field>
        </div>

        {{-- Checkbox --}}
        <div class="flex gap-6 mt-6">

            <flux:field variant="inline" data-input>
                <flux:checkbox wire:model="productForm.is_active" name="is_active" data-prodotti />
                <flux:label>Attivo</flux:label>
                <flux:error name="productForm.is_active" />
            </flux:field>
            <flux:field variant="inline" data-input>
                <flux:checkbox wire:model="productForm.is_cnpaia"  data-prodotti />
                <flux:label>CNPAIA</flux:label>
                <flux:error name="productForm.is_cnpaia" />
            </flux:field>
        </div>

        {{-- Buttons --}}
    </div>
    <div class="flex justify-start space-x-2 mt-6">
        @if ($isEdit)
            <flux:button variant="primary" data-variant="primary" data-color="teal" :disabled="!$productForm->title" type="submit">
                Modifica
            </flux:button>
        @else
            <flux:button variant="primary" data-variant="primary" data-color="teal" :disabled="!$productForm->title" type="submit">
                Aggiungi
            </flux:button>
        @endif
    </div>
</form>