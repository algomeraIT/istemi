@props(['label', 'data' => null, 'copy' => false])

<div class="text-[#B0B0B0] flex flex-col items-start justify-start gap-2">
    <div class="flex items-center gap-1">
        {{ $icon ?? '' }}
        <small class="font-light">{{ $label }}</small>
    </div>
    <div class="ml-5 text-left max-h-32 overflow-x-hidden overflow-y-auto">
        <span>{{ $data ?? '' }}</span>

        {{ $avatar ?? '' }}

        @if ($copy)
            <button title="Copia" wire:click="copy('{{ $data }}')" x-on:click="$flux.toast('Copiato con successo.')"
                class="cursor-pointer ml-5">
                <flux:icon.document-duplicate class="size-4 text-[#10BDD4]" />
            </button>
        @endif
    </div>
</div>
