@extends("layouts/layout")

@section("title")
    동아대 - 워크넷 직업/직무별 자소서가이드
@endsection

@push('scripts')
    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script type="text/javascript">
        if(!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "95dd8847356d10";
        if(window.wcs) {
            wcs_do();
        }
        location.href = 'https://www.work.go.kr/empSpt/empGuide/selfintroWriteGuide/selfintroWriteGuideViewList.do';
    </script>
@endpush

@php
    $major_menu = "워크넷 직업/진로정보";
    $minor_menu = "직무별 자소서 가이드";
@endphp

@section("content")
@endsection
