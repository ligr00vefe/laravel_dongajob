
@extends("layouts/layout")

@section("title")
    동아대 취업지원실 - 취업교육기금
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/educash.css">
@endpush

@php
    $major_menu = "취업지원실";
    $minor_menu = "취업교육기금";
@endphp

@section("content")

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>취업교육기금</h1>
        </div>

        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <h2>동아대학교 "후배사랑 취업교육기금"</h2>
                <p>2010년 7월부터 선배들의 자발적인 움직임으로 시작된 "후배사랑 취업교육기금"은 </p>
                <p>후배들이 졸업 후 사회로 나아가는 걸음에 커다란 격려가 되고 있습니다. </p>
                <p>이는 선배들의 교육과 지원을 받아 취업한 후 다시 후배들을 이끌어 주는 순환식 취업교육의 근간입니다.</p>
            </div>
            <div class="top_tab">
                <h2>동아대학교 "후배사랑 취업교육기금"</h2>
                <p>2010년 7월부터 선배들의 자발적인 움직임으로 시작된 "후배사랑 취업교육기금"은 </p>
                <p>후배들이 졸업 후 사회로 나아가는 걸음에 커다란 격려가 되고 있습니다. </p>
                <p>이는 선배들의 교육과 지원을 받아 취업한 후 다시 후배들을 이끌어 주는 순환식 취업교육의 근간입니다.</p>
            </div>
            <div class="top_m">
                <h2>동아대학교 "후배사랑 취업교육기금"</h2>
                <p>2010년 7월부터 선배들의 자발적인 움직임으로 시작된 "후배사랑 취업교육기금"은
                    후배들이 졸업 후 사회로 나아가는 걸음에 커다란 격려가 되고 있습니다.
                    이는 선배들의 교육과 지원을 받아 취업한 후 다시 후배들을 이끌어 주는 순환식 취업교육의 근간입니다.</p>
            </div>
        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">기금용도</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>기탁하여 주신 교육기금은 취업지원실에서 주관하는</p>
                <p>학생 취업교육, 취업캠프, 취업동아리 운영, 스터디룸 환경 개선 등의 재원으로 활용됩니다.</p>
            </div>
        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">세제혜택</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>후배사랑 취업교육기금은 소득세법 및 조세특레제한법에 따라 연말정산 또는 종합소득세 신고 시</p>
                <p>소득금액 100%한도 내에서 전액 세액공제대상이 됩니다.</p>
            </div>
        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">연도별 누적 모금액</div>
            </div>

            <div class="pdt30 content_imgwrap">
                <img class="top_pc" src="/img/graph.png" alt="그래프">
                <img class="top_tab" src="/img/graph_t.png" alt="그래프">
                <img class="top_m" src="/img/graph_m.png" alt="그래프">
            </div>

            <div class="pdt30">
                <div class="acc_cash_wrap">
                    <img src="/img/money_icon.png" alt="아이콘">동아대학교 누적 모금액(2020년 기준) <span>613,613,800원</span>
                </div>
            </div>
        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">약정방법</div>
            </div>

            <div class="contract_wrap pdt30">
                <div class="contract_computer_wrap">
                    <img src="/img/computer_icon.png" alt="컴퓨터 아이콘">
                    <p>온라인 약정</p>
                    <span class="blue_bt"><a href="https://www.ihappynanum.com/Nanum/nanum/banner/bridge/JO844M4Y0B.nanum?memPayType=null" target="_blank">
                            신청 링크 바로가기
                        </a></span>
                </div>
                <div class="contract_call_wrap">
                    <img src="/img/phone_icon.png" alt="전화기 아이콘">
                    <p>오프라인 약정</p>
                    <span class="blue_txt"><b>051-200-6222~4</b>로<br />문의바랍니다.</span>
                </div>
            </div>

        </div>
    </div>

@endsection
