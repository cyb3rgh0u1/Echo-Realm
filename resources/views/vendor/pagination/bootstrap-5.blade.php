@if ($paginator->hasPages())
<nav style="display:flex;justify-content:center;margin-top:1rem">
    <div style="display:flex;gap:0.35rem;flex-wrap:wrap">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="display:inline-flex;align-items:center;justify-content:center;padding:0.35rem 0.75rem;border-radius:6px;font-size:0.75rem;background:var(--panel2,#141428);border:1px solid var(--border,rgba(168,85,247,0.12));color:var(--dim,#3d3558)">«</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="display:inline-flex;align-items:center;justify-content:center;padding:0.35rem 0.75rem;border-radius:6px;font-size:0.75rem;background:var(--panel2,#141428);border:1px solid var(--border,rgba(168,85,247,0.12));color:var(--muted,#7a6f9a);text-decoration:none">«</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:0.75rem;color:var(--dim,#3d3558)">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:0.75rem;background:#a855f7;color:#fff;border:1px solid #a855f7">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;font-size:0.75rem;background:var(--panel2,#141428);border:1px solid var(--border,rgba(168,85,247,0.12));color:var(--muted,#7a6f9a);text-decoration:none">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="display:inline-flex;align-items:center;justify-content:center;padding:0.35rem 0.75rem;border-radius:6px;font-size:0.75rem;background:var(--panel2,#141428);border:1px solid var(--border,rgba(168,85,247,0.12));color:var(--muted,#7a6f9a);text-decoration:none">»</a>
        @else
            <span style="display:inline-flex;align-items:center;justify-content:center;padding:0.35rem 0.75rem;border-radius:6px;font-size:0.75rem;background:var(--panel2,#141428);border:1px solid var(--border,rgba(168,85,247,0.12));color:var(--dim,#3d3558)">»</span>
        @endif
    </div>
</nav>
@endif
