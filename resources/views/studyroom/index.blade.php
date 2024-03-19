@extends("layouts/layout")

@section("title")
    동아대 스터디룸 예약
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/studyroom.css">
    <script defer src="/js/studyroom/list.js"></script>
@endpush

@php
    $major_menu = "스터디룸 예약";
    $minor_menu = "스터디룸 예약";
@endphp

@section("content")
    @php
        $date = date('Y-m-d');
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $week = date('w');
    @endphp
    <div class="sub-content content-studyroom">
        <div class="sub-content_title">
            <h1>스터디룸 예약</h1>
        </div>

        <div class="body-wrap studyroom-index">
            <form action="/studyroom/view" method="get" name="forms">
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="type" value="{{ get_manager_type_value(session()->get('donga_type')) }}" >
                @csrf
                <div class="choose-campus">
                    <input type="radio" name="campus" id="campus01" class="radio-campus" value="1" checked>
                    <label for="campus01" class="campus01-label">
                        <img src="/img/campus_icon01_w.png" alt="학교 아이콘1">
                        <h2>승학 캠퍼스</h2>
                    </label>
                    <input type="radio" name="campus" id="campus02" class="radio-campus" value="2">
                    <label for="campus02" class="campus02-label">
                        <img src="/img/campus_icon02.png" alt="학교 아이콘2">
                        <h2>부민 캠퍼스</h2>
                    </label>
                </div>{{-- //.chooose-campus end --}}

                <div class="choose-calendar">
                    <div class="month-word">
                        <h3>{{ sprintf('%s년 %s월', $year, $month) }}</h3>
                    </div>

                    <ul class="choose-date">
                        @for($i=0; $i < 7; $i++)
                            @php
                                $_date = date("Y-m-d", strtotime("+ " .$i . " day", strtotime(date("Y-m-d"))));
                                $_year = date("Y", strtotime($_date));
                                $_month = date("m", strtotime($_date));
                                $_day = date("d", strtotime($_date));
                                $_week = date('w', strtotime($_date));
                            @endphp
                            <li class="day-list @if($i == 0)checked @endif">
                                <div class="day-word">
                                    <p class="@if($_week == 0 || $_week == 6) weekend @endif">{{ get_week_day($_week) }}</p>
                                </div>
                                <div class="_vail day-num">
                                    <p class="_vail" data-year="{{ $_year }}" data-month="{{ $_month }}" data-day="{{ $_day }}" data-week="{{ $_week }}">
                                        {{ $_day }}
                                    </p>
                                </div>
                            </li>
                        @endfor
                    </ul>
                </div>{{-- //.choose-calendar end --}}

                <div class="choose-room">
                    <div class="chosen-date">
                        <h4>{{ sprintf('%s월 %s일', $month, $day) }} ({{ get_week_day($week) }})</h4>
                    </div>

                    <div class="available-room">
                        <div class="room-name">
                            <h5>희망 스터디룸</h5>
                        </div>

                        <ul class="room-list">
                        </ul>
                    </div>{{-- //.available-room end --}}

                    <div class="available-time">
                        <div class="time-name">
                            <h5>희망 시간대</h5>
                        </div>

                        <ol>
                            <div>스터디룸 선택 후 선택 가능 합니다.</div>
                        </ol>

                    </div>{{-- //.available-time end --}}

                </div>{{-- //.choose-room end --}}

                <div class="btn-wrap">
                    <button type="button" class="btn01 btn-next" disabled>다음</button>
                </div>
            </form>
        </div>{{-- //.body-reservation end --}}

    </div>{{-- //.sub-content.content-studyroom end --}}

@endsection
