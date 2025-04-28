<div>
    <div class="mt-4 grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2 md:gap-4">
        @foreach ($contact_kanban as $contact)
            <div class="bg-white border border-gray-300 p-4 text-sm mt-5">
                {{-- Company Name --}}
                <h3 class="text-lg font-bold text-[#232323]">{{ $contact->company_name }}</h3>

                {{-- Info Line --}}
                <div class="flex flex-wrap mt-2 mb-4 gap-2 text-[#B0B0B0] italic font-extralight text-base">
                    <span>ID: {{ $contact->id }}</span>
                    <span>Acquisizione: {{ \Carbon\Carbon::parse($contact->created_at)->format('d/m/Y') }}</span>
                </div>

                {{-- Contact Info --}}
                <div class="flex flex-col gap-4 md:flex-row md:justify-between">
                    {{-- Email --}}
                    <div>
                        <p class="flex items-center gap-1 text-[#B0B0B0] font-light">
                            <flux:icon.at-symbol class="w-4" /> E-mail:
                        </p>
                        <div class="flex items-center gap-2 mt-1 font-semibold text-[#232323]">
                            {{ $contact->email }}
                            @include('livewire.crm.utilities.copy-this-text-button', [
                                'content' => $contact->email,
                            ])
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div>
                        <p class="flex items-center gap-1 text-[#B0B0B0] font-light">
                            <flux:icon.phone class="w-4" /> Telefono:
                        </p>
                        <div class="flex items-center gap-2 mt-1 font-semibold text-[#232323]">
                            {{ $contact->first_telephone }}
                            @include('livewire.crm.utilities.copy-this-text-button', [
                                'content' => $contact->first_telephone,
                            ])
                        </div>
                    </div>
                </div>

                {{-- Status Badge --}}
                <div class="mt-5">
                    @php
                    $text = match ($contact->status) {
                        1 => 'In contatto',
                        2 => 'Non idoneo',
                        default => 'Sconosciuto',
                    };
                @endphp
                <flux:badge size="sm" data-status="{{$contact->status}}" inset="top bottom">{{ $text }}</flux:badge>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 text-right flex justify-end gap-2">
                    <flux:button wire:click="goToDetail({{ $contact->id }})" variant="ghost" data-variant="ghost"
                        data-color="teal" data-rounded icon="eye" size="sm" />
           {{--          <flux:button wire:click="edit({{ $contact->id }})" variant="ghost" data-variant="ghost"
                        data-color="gray" data-rounded icon="pencil" size="sm" /> --}}
                    <flux:button wire:click="delete({{ $contact->id }})"
                        wire:confirm="Sei sicuro di voler eliminare questo contatto?" variant="ghost"
                        data-variant="ghost" data-color="red" data-rounded icon="trash" size="sm" />
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination (Optional) --}}
    {{-- <div class="mt-4">{{ $leads->links() }}</div> --}}
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => alert("Copiato: " + text))
            .catch(err => console.error("Clipboard error:", err));
    }
</script>
