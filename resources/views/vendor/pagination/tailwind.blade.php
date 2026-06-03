@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        {{-- Mobile View --}}
        <div class="flex flex-1 justify-between sm:hidden gap-2">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-xs font-semibold text-gray-400 bg-gray-50 border border-gray-200 rounded-xl cursor-not-allowed">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 text-xs font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-primary/5 hover:text-primary hover:border-primary/20 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 text-xs font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-primary/5 hover:text-primary hover:border-primary/20 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 text-xs font-semibold text-gray-400 bg-gray-50 border border-gray-200 rounded-xl cursor-not-allowed">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- Desktop View --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm text-gray-500">
                    {!! __('Menampilkan') !!}
                    @if ($paginator->firstItem())
                        <span class="font-bold text-dark">{{ $paginator->firstItem() }}</span>
                        {!! __('sampai') !!}
                        <span class="font-bold text-dark">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('dari') !!}
                    <span class="font-bold text-dark">{{ $paginator->total() }}</span>
                    {!! __('data') !!}
                </p>
            </div>

            <div>
                <span class="inline-flex gap-1.5 rtl:flex-row-reverse">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="inline-flex items-center justify-center w-10 h-10 text-gray-400 bg-gray-50 border border-gray-150 rounded-xl cursor-not-allowed" aria-hidden="true">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center w-10 h-10 text-gray-500 bg-white border border-gray-200 rounded-xl hover:bg-primary/5 hover:text-primary hover:border-primary/20 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-150" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="inline-flex items-center justify-center min-w-10 h-10 text-sm font-semibold text-gray-400 bg-white border border-gray-200 rounded-xl cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="inline-flex items-center justify-center min-w-10 h-10 text-sm font-bold text-white bg-primary rounded-xl cursor-default">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="inline-flex items-center justify-center min-w-10 h-10 text-sm font-semibold text-gray-500 bg-white border border-gray-200 rounded-xl hover:bg-primary/5 hover:text-primary hover:border-primary/20 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center w-10 h-10 text-gray-500 bg-white border border-gray-200 rounded-xl hover:bg-primary/5 hover:text-primary hover:border-primary/20 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition duration-150" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="inline-flex items-center justify-center w-10 h-10 text-gray-400 bg-gray-50 border border-gray-150 rounded-xl cursor-not-allowed" aria-hidden="true">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
