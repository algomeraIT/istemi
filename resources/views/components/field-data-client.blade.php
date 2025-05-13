@props(['label', 'data', 'copy' => false, 'link' => false])

<div class="text-[#B0B0B0] text-[15px] flex items-start justify-between gap-2 mt-0">
    <span class="whitespace-nowrap">{{ $label }}</span>

    <div class="ml-5 text-right font-semibold">
        @if ($link)
            <a href="{{ $data }}" class="hover:underline">{{ $data }}</a>
        @else
            <span>{{ $data ?? '---' }}</span>
        @endif

        @if ($copy)
            <button title="Copia" wire:click="copy('{{ $data }}')"
                x-on:click="$flux.toast('Copiato con successo.')" class="cursor-pointer ml-2">
                <flux:icon.document-duplicate class="size-4 text-[#10BDD4]" />
            </button>
        @endif
    </div>
</div>
