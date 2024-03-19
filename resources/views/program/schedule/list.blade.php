@extends("layouts.layout")

@section("title")
    동아대 취업지원실 프로그램 - 주요 일정
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">

    <link href='/lib/fullcalendar/core/main.css' rel='stylesheet'/>
    <link href='/lib/fullcalendar/daygrid/main.css' rel='stylesheet'/>
    <script src='/lib/fullcalendar/core/main.js'></script>
    <script src='/lib/fullcalendar/daygrid/main.js'></script>
    <script src='/lib/fullcalendar/interaction/main.js'></script>
    <script src="/lib/moment-with-locales.js"></script>
    <script src="/js/program/schedule/calendar.js"></script>

@endpush

@php
    $major_menu = "취업지원실 프로그램";
    $minor_menu = "주요일정";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>주요일정</h1>
        </div>


        <div class="date-area">
            <div class="icon_wrap">
                <div class="calendar_program_icon">프로그램 모집</div>
                <div class="calendar_notice_icon">공지사항</div>
            </div>
            <div class="date_wrap">
                <button type="button" data-type="prev"></button>
                <h3>{{ date('Y년 m월') }}</h3>
                <button type="button" data-type="next"></button>
            </div>
        </div>

        <div id='calendar' class="calendar"></div>
    </div>

@endsection



