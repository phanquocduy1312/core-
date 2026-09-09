@if ($paginator->hasPages())
    <nav class="lux-pagination" role="navigation" aria-label="Pagination Navigation" style="display: flex; justify-content: center; align-items: center; gap: 8px; margin: 40px auto 20px auto; width: 100%;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="page-link disabled" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 4px; border: 1px solid #e2e8f0; color: #cbd5e1; background: #f8fafc; font-size: 18px; cursor: not-allowed; line-height: 1;">
                &lsaquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 4px; border: 1px solid #cbd5e1; color: #0B1523; background: #ffffff; font-size: 18px; text-decoration: none; transition: all 0.2s; line-height: 1;" onmouseover="this.style.borderColor='#EAA931';this.style.color='#EAA931'" onmouseout="this.style.borderColor='#cbd5e1';this.style.color='#0B1523'">
                &lsaquo;
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="page-link disabled" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; color: #94a3b8; font-size: 15px;">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-link active" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 4px; background: #0B1523; border: 1px solid #0B1523; color: #EAA931; font-weight: 700; font-size: 15px; font-family: 'DIN', sans-serif;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="page-link" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 4px; border: 1px solid #cbd5e1; color: #0B1523; background: #ffffff; font-size: 15px; font-family: 'DIN', sans-serif; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.borderColor='#EAA931';this.style.color='#EAA931'" onmouseout="this.style.borderColor='#cbd5e1';this.style.color='#0B1523'">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 4px; border: 1px solid #cbd5e1; color: #0B1523; background: #ffffff; font-size: 18px; text-decoration: none; transition: all 0.2s; line-height: 1;" onmouseover="this.style.borderColor='#EAA931';this.style.color='#EAA931'" onmouseout="this.style.borderColor='#cbd5e1';this.style.color='#0B1523'">
                &rsaquo;
            </a>
        @else
            <span class="page-link disabled" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 4px; border: 1px solid #e2e8f0; color: #cbd5e1; background: #f8fafc; font-size: 18px; cursor: not-allowed; line-height: 1;">
                &rsaquo;
            </span>
        @endif
    </nav>
@endif
