<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}

        @if ($page <= 1)
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')" data-page="1">
                <a href="javascript:void(0)" data-page="1">처음</a>
            </li>
        @endif


        @if ($page <= 1)
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')" data-page="{{ $page - 1  }}">
                <a href="javascript:void(0)" data-page="{{ $page - 1  }}"><</a>
            </li>
        @endif




        @if($start == 1 && $end == 0)
            <li class="active" aria-current="page" data-page="1"><span>1</span></li>
            @endif

        @for($i = $start; $i <= $end; $i++)
            @if($page == $i)
                <li class="active" aria-current="page" data-page="{{ $i }}"><span>{{ $i }}</span></li>
            @else
                <li data-page="{{ $i }}"><a href="javascript:void(0)" data-page="{{ $i }}">{{ $i }}</a></li>
            @endif
        @endfor

        @if($page >= $total_page)
        @else
            <li data-page="{{ $page + 1 }}">
                <a href="javascript:void(0)" data-page="{{ $page + 1 }}" rel="next" aria-label="@lang('pagination.next')">></a>
            </li>
        @endif

        @if($page >= $total_page)
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')" data-page="{{ $total_page }}">
                <a href="javascript:void(0)" data-page="{{ $total_page }}">마지막</a>
            </li>
        @endif
    </ul>
</nav>


