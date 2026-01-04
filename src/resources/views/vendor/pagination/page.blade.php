@if ($paginator->hasPages())
    <div class="pagination">
        {{-- 前へリンク --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}">&lt;</a>
        @else
            <span class="disabled">&lt;</span>
        @endif

        {{-- ページ番号 --}}
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <span class="current">{{ $page }}</span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach

        {{-- 次へリンク --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">&gt;</a>
        @else
            <span class="disabled">&gt;</span>
        @endif
    </div>
@endif
