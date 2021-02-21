<div class="pagination">
    @if ($paginator->hasPages())
        <nav >
            <ul >
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"  style="border: 0;" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item"  style="border: 0;">
                        <a role="button" dusk="previousPage wire:loading.attr="disabled"  wire:click="previousPage" rel="prev"  aria-label="@lang('pagination.previous')">&lsaquo;</a>

                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="current active" wire:key="paginator-page-{{ $page }}" aria-current="page">
                                    <span >{{ $page }}</span></li>
                            @else
                                <li class="" wire:key="paginator-page-{{ $page }}">
                                    <a role="button" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                                    </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button type="button" dusk="nextPage" class=""  style="border: 0;"  wire:click="nextPage" wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')" style="border: 0;">
                        <span class="" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
