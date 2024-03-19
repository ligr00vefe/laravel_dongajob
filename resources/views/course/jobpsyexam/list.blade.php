@extends("layouts/layout")

@section("title")

@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">

    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script type="text/javascript">
        if(!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "1324a927e201800";
        if(window.wcs) {
            wcs_do();
        }
    </script>


@endpush

@php
    $major_menu = "워크넷 직업/진로정보";
    $minor_menu = "직업심리검사";
@endphp

@section("content")
    <div class="sub-content jobpsyexam-content">
        <div class="sub-content_title">
            <h1>직업심리검사</h1>
        </div>

        <div class="jobpsyexam-view">
            <div class="view-wr">
                <div class="img-wr">
                    <img src="/img/jobpsyexam_bg.png" alt="직업심리검사 배경 이미지">
                </div>
                <div class="text-wr">
                    <h3>워크넷 직업심리검사</h3>
                    <p>25~30분이 소요됩니다.</p>
                    <p>신뢰도 높은 검사결과를 위해 가능하면 시간적 여유를 가지고 한번에 검사를 수행해 주시기 바랍니다.</p>
                    <p>원활한 상담지도를 위해 검사결과를 지도교수님 또는 전문상담원이 열람할 수 있습니다.</p>
                </div>

                <a href="{{ $mentality->getUrl() }}" target="_blank" class="btn-examStart">검사실시</a>

            </div>
        </div>

        <div class="jobpsyexam-sub">
            <p>
                <span class="img-wr">
                    <img src="/img/Warning.png" alt="주의 아이콘">
                </span>
                <span class="text-wr">
                    워크넷의 검사 결과와 학생경력개발시스템의 검사 결과가 상이할 수 있습니다. <br/>
                    검사 결과는 단순 참조하시기 바라며 전문가 상담을 통해 진로 및 취업에 대한 더욱 많은 정보를 얻을 수 있습니다.
                </span>
            </p>
        </div>

     </div>{{-- //.sub-content.jobsrch-content end --}}

@endsection
