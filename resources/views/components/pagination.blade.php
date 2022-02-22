@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled pe-1" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">
                        {{ ('Назад') }}
                    </span>
                </li>
            @else
                <li class="page-item clickable pe-1">
                    <a class="page-link ripple" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       aria-label="@lang('pagination.previous')" data-mdb-ripple-color="light">
                        {{ ('Назад') }}
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled px-1" aria-disabled="true">
                        <span class="page-link">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active px-1" aria-current="page">
                                <span class="page-link ripple" data-mdb-ripple-color="light">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item clickable px-1">
                                <a class="page-link ripple" href="{{ $url }}" data-mdb-ripple-color="light">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item clickable ps-1">
                    <a class="page-link ripple" href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="@lang('pagination.next')" data-mdb-ripple-color="light">
                        {{ ('Далее') }}
                    </a>
                </li>
            @else
                <li class="page-item disabled ps-1" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">
                        {{ ('Далее') }}
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
