@if ($paginator->hasPages())
    <div class="grid-3">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="one-third"><span class="typcn typcn-arrow-left-thick"></span> Articles plus récents</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="one-third push align-right">Articles plus anciens <span class="typcn typcn-arrow-right-thick"></span></a>
        @endif
    </div>
@endif
