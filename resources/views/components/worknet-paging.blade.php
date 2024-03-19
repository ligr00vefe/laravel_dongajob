<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}

        @if ($page <= 1)
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="{{ url()->current() }}?page=1&keyword={{ $keyword ?? '' }}&secondArea={{ $secondArea }}&firstJob={{ $firstJob }}&secondJob={{ $secondJob }}&thirdJob={{ $thirdJob }}&salTp={{ $salTp }}&minPay={{ $minPay }}&maxPay={{ $maxPay }}&education={{ $education }}&prefCd={{ $prefCd }}&pref={{ $pref }}&career={{ $career }}&regDt={{ $regDt }}&minCareerM={{ $minCareerM }}&maxCareerM={{ $maxCareerM }}&closeDt={{ $closeDt }}&regDate={{ $regDate }}&view_count={{ $view_count }}">
                    처음</a>
            </li>
        @endif


        @if ($page <= 1)
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="{{ url()->current() }}?page={{ $page - 1 }}&keyword={{ $keyword ?? ''}}&keyword={{ $keyword ?? '' }}&secondArea={{ $secondArea }}&firstJob={{ $firstJob }}&secondJob={{ $secondJob }}&thirdJob={{ $thirdJob }}&salTp={{ $salTp }}&minPay={{ $minPay }}&maxPay={{ $maxPay }}&education={{ $education }}&prefCd={{ $prefCd }}&pref={{ $pref }}&career={{ $career }}&regDt={{ $regDt }}&minCareerM={{ $minCareerM }}&maxCareerM={{ $maxCareerM }}&closeDt={{ $closeDt }}&regDate={{ $regDate }}&view_count={{ $view_count }}"><</a>
            </li>
        @endif



        @if($start == 1 && $end == 0)
            <li class="active" aria-current="page" data-page="1"><span>1</span></li>
        @endif

        @for($i = $start; $i <= $end; $i++)
            @if($page == $i)
                <li class="active" aria-current="page"><span>{{ number_format($i) }}</span></li>
            @else
                <li>
                    <a href="{{ url()->current() }}?page={{ $i }}&keyword={{ $keyword ?? ''}}&keyword={{ $keyword ?? '' }}&secondArea={{ $secondArea }}&firstJob={{ $firstJob }}&secondJob={{ $secondJob }}&thirdJob={{ $thirdJob }}&salTp={{ $salTp }}&minPay={{ $minPay }}&maxPay={{ $maxPay }}&education={{ $education }}&prefCd={{ $prefCd }}&pref={{ $pref }}&career={{ $career }}&regDt={{ $regDt }}&minCareerM={{ $minCareerM }}&maxCareerM={{ $maxCareerM }}&closeDt={{ $closeDt }}&regDate={{ $regDate }}&view_count={{ $view_count }}">{{ number_format($i) }}</a>
                </li>
            @endif
        @endfor

        @if($page >= $total_page)
        @else
            <li>
                <a href="{{ url()->current() }}?page={{ $page + 1 }}&keyword={{ $keyword ?? ''}}&keyword={{ $keyword ?? '' }}&secondArea={{ $secondArea }}&firstJob={{ $firstJob }}&secondJob={{ $secondJob }}&thirdJob={{ $thirdJob }}&salTp={{ $salTp }}&minPay={{ $minPay }}&maxPay={{ $maxPay }}&education={{ $education }}&prefCd={{ $prefCd }}&pref={{ $pref }}&career={{ $career }}&regDt={{ $regDt }}&minCareerM={{ $minCareerM }}&maxCareerM={{ $maxCareerM }}&closeDt={{ $closeDt }}&regDate={{ $regDate }}&view_count={{ $view_count }}"
                   rel="next" aria-label="@lang('pagination.next')">></a>
            </li>
        @endif

        @if($page >= $total_page)
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="{{ rtrim(url()->current(), '/') }}?page={{ $total_page }}&keyword={{ $keyword ?? ''}}&keyword={{ $keyword ?? '' }}&secondArea={{ $secondArea }}&firstJob={{ $firstJob }}&secondJob={{ $secondJob }}&thirdJob={{ $thirdJob }}&salTp={{ $salTp }}&minPay={{ $minPay }}&maxPay={{ $maxPay }}&education={{ $education }}&prefCd={{ $prefCd }}&pref={{ $pref }}&career={{ $career }}&regDt={{ $regDt }}&minCareerM={{ $minCareerM }}&maxCareerM={{ $maxCareerM }}&closeDt={{ $closeDt }}&regDate={{ $regDate }}">마지막</a>
            </li>
        @endif
    </ul>
</nav>


