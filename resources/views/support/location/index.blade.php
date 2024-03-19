
@extends("layouts/layout")

@section("title")
    동아대 취업지원실 - 찾아오시는 길
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/location.css">
@endpush

@php
    $major_menu = "취업지원실";
    $minor_menu = "찾아오시는 길";
@endphp

@section("content")
<div class="sub-content">
    <div class="sub-content_title">
        <h1>찾아오시는 길</h1>
    </div>

    <div class="sub_container_wrap pdt30">
        <div class="bullet_content_wrap">
            <div class="bullet_title">승학캠퍼스</div>
        </div>
        <div class="pdt30 content_imgwrap">
            <img src="/img/map01.png" alt="지도">
        </div>
        <div class="gray_bg_txtwrap">
            <div class="add_wrap">
                <div class="add_bullet_txt">
                    <b>주소.</b> <p>부산광역시 사하구 낙동대로 550번길 37(하단동) 교수회관 2층</p>
                </div>
            </div>
            <div class="call_wrap">
                <div class="call_bullet_txt">
                    <b>문의하기.</b> <p>TEL 051-200-6222~4 / FAX 051-200-6225</p>
                </div>
            </div>
        </div>
    </div>

    <div class="sub_container_wrap pdt30">
        <div class="bullet_content_wrap">
            <div class="bullet_title">부민캠퍼스</div>
        </div>
        <div class="pdt30 content_imgwrap">
            <img src="/img/map02.png" alt="지도">
        </div>
        <div class="gray_bg_txtwrap">
            <div class="add_wrap">
                <div class="add_bullet_txt">
                    <b>주소.</b><p>부산광역시 서구 구덕로 222(부민동 2가) 종합강의동 1층<wbr>(BC-0116)</p>
                </div>
            </div>
            <div class="call_wrap">
                <div class="call_bullet_txt">
                    <b>문의하기.</b><p>TEL 051-8771~2 / FAX 051-200-8773</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
