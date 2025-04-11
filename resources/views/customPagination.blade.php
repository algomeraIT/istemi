@php
    $paginator->onEachSide(1);
@endphp

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex ">
        <div>
            <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                {!! __('Mostrati') !!}
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('di') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
            </p>
        </div>

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-gray-400 cursor-not-allowed rounded-md ml-[33rem]">Precedente</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 text-gray-400  ml-[36rem] rounded-md hover:cursor-pointer"><- Precedente</a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex ">
            <span class="py-2 px-4 text-gray-700">
                Pagina {{ $paginator->currentPage() }} di {{ $paginator->lastPage() }}
            </span>
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 text-gray-400  rounded-md hover:cursor-pointer">Successiva -></a>
        @else
            <span class="px-4 py-2 text-gray-400 cursor-not-allowed  rounded-md">Successiva</span>
        @endif
    </nav>
@endif