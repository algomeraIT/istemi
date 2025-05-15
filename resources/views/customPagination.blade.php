@php
    $paginator->onEachSide(1);
@endphp

@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination" class="flex flex-col md:flex-row items-center p-4 pb-0">
    <!-- Summary -->
    <div class="text-sm text-gray-700">
        {!! __('Mostrati') !!}
        @if ($paginator->firstItem())
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('di') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
        @else
            {{ $paginator->count() }}
        @endif
    </div>

    <!-- Controls -->
    <div class="flex items-center space-x-4 mt-2 md:mt-0 ml-[30%]">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="text-gray-400 cursor-not-allowed px-3 py-1">← Precedente</span>
        @else
            <button wire:click="previousPage" class="text-gray-600 hover:underline px-3 py-1">
                ← Precedente
            </button>
        @endif

        {{-- Page X of Y --}}
        <span class="text-gray-700 px-3 py-1">
            Pagina {{ $paginator->currentPage() }} di {{ $paginator->lastPage() }}
        </span>

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" class="text-gray-600 hover:underline px-3 py-1">
                Successiva →
            </button>
        @else
            <span class="text-gray-400 cursor-not-allowed px-3 py-1">Successiva →</span>
        @endif
    </div>
</nav>
@endif