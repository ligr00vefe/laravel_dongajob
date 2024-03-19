<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}

        @if ($page <= 1)
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="{{ url()->current() }}?page=1&keyword={{ $keyword ?? '' }}">처음</a>
            </li>
        @endif


        @if ($page <= 1)
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="{{ url()->current() }}?page={{ $page - 1 }}&keyword={{ $keyword ?? ''}}"><</a>
            </li>
        @endif



        @for($i = $start; $i <= $end; $i++)
            @if($page == $i)
                <li class="active" aria-current="page"><span>{{ $i }}</span></li>
            @else
                <li><a href="{{ url()->current() }}?page={{ $i }}&keyword={{ $keyword ?? ''}}">{{ $i }}</a></li>
            @endif
        @endfor

        @if($page >= $total_page)
        @else
            <li>
                <a href="{{ url()->current() }}?page={{ $page + 1 }}&keyword={{ $keyword ?? ''}}" rel="next" aria-label="@lang('pagination.next')">></a>
            </li>
        @endif

        @if($page >= $total_page)
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="{{ rtrim(url()->current(), '/') }}?page={{ $total_page }}&keyword={{ $keyword ?? ''}}">마지막</a>
            </li>
        @endif
    </ul>
</nav>


