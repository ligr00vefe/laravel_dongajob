
@extends("layouts.layout")

@section("title")
    동아대 온라인 취업컨텐츠 - 잡플래닛 제휴대학 서비스
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/jobplanet.css">
@endpush

@php
    $major_menu = "온라인 취업컨텐츠";
    $minor_menu = "잡플래닛";
@endphp

@section("content")

    <div class="sub-content">
    <div class="sub-content_title">
        <h1>잡플래닛 제휴대학 서비스</h1>
    </div>

    <div class="sub_topbanner_wrap">
        <div class="top_pc">
            <h2>잡플래닛</h2>
            <p>우리학교는 잡플래닛 제휴대학</p>
            <p>기업 리뷰, 면접 후기, 연봉 등 잡플래닛에서만 볼 수 있는 기업 정보를</p>
            <p>무제한 열람 취업리포트, 동영상 강의, 온라인 직무적성검사 등 무료 이용</p>

            <div class="link_blue_button">
                <a href="https://www.jobplanet.co.kr/contents" target="_blank">
                    <span>잡플래닛 바로가기</span>
                </a>
            </div>
        </div>
        <div class="top_tab">
            <h2>잡플래닛</h2>
            <p>우리학교는 잡플래닛 제휴대학</p>
            <p>기업 리뷰, 면접 후기, 연봉 등 잡플래닛에서만 볼 수 있는 기업 정보를</p>
            <p>무제한 열람 취업리포트, 동영상 강의, 온라인 직무적성검사 등 무료 이용</p>

            <div class="link_blue_button">
                <a href="https://www.jobplanet.co.kr/contents" target="_blank">
                    <span>잡플래닛 바로가기</span>
                </a>
            </div>
        </div>
        <div class="top_m">
            <h2>잡플래닛</h2>
            <p>우리학교는 잡플래닛 제휴대학
                기업 리뷰, 면접 후기, 연봉 등 잡플래닛에서만 볼 수 있는 기업 정보를
                무제한 열람 취업리포트, 동영상 강의, 온라인 직무적성검사 등 무료 이용</p>

            <div class="link_blue_button">
                <a href="https://www.jobplanet.co.kr/contents" target="_blank">
                    <span>잡플래닛 바로가기</span>
                </a>
            </div>
        </div>

    </div>


    <!-------- 내용 시작 -------->

    <div class="sub_container_wrap">

        <div class="half_content_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">이용방법</div>
                <div class="list_txt">
                    <p>1. 동아웹메일(@donga.ac.kr)계정 생성</p>
                    <p>2. 동아웹메일 계정으로 잡플래닛 회원가입</p>
                    <p>3. 인증메일 확인 후 잡플래닛 학적정보 등록</p>
                </div>
            </div>
        </div>

        <div class="half_content_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">제휴대학 서비스 제공 항목</div>
                <div class="list_txt">
                    <p>1. 기업리뷰/연봉정보/면접후기/채용정보 등</p>
                    <p>2. 기업/직무/산업 분석 리포트</p>
                    <p>3. 주요기업 온라인 직무적성검사</p>
                    <p>4. 각종 동영상 강의 및 취업 특강</p>
                </div>
            </div>
        </div>

    </div>


    <div class="sub_container_wrap pdt50">

        <div class="round_blue_box_wrap">
            동아 웹메일(@donga.ac.kr)계정 생성 방법
        </div>

        <div class="content_imgwrap pdt30">
            <img src="/img/sub3050_img01.png" alt="동아 웹메일(@donga.ac.kr)계정 생성 방법">
        </div>

        <div class="content_imgwrap_m pdt30">
            <img src="/img/sub3050_img01_m.png" alt="동아 웹메일(@donga.ac.kr)계정 생성 방법" style="display: block; margin: 0 auto;">
        </div>

    </div>


    <div class="sub_container_wrap pdt50">

        <div class="round_blue_box_wrap">
            잡플래닛 이용가이드
        </div>

        <div class="guide_wrap">

            <div class="info_img_wrap">
                <img src="/img/sub3050_img02.png" alt="제휴대학 학적 정보">
            </div>

            <div class="gray_bg_wrap">
                <div class="step_content_wrap">
                    <div class="step_number">
                        <li class="blue_step_txt">STEP1</li>
                        <li>잡플래닛(www.jobplanet.co.kr)에 접속하기</li>
                    </div>
                    <div class="step_number">
                        <li class="blue_step_txt">STEP2</li>
                        <li>
                            학교 웹메일 계정으로 잡플래닛에 회원가입하기<br />
                            <span class="skyblue_wrap">꼭 학교측에 웹메일을 먼저 신청/확인 필수!</span>
                        </li>
                    </div>
                    <div class="step_number">
                        <li class="blue_step_txt">STEP1</li>
                        <li>잡플래닛(www.jobplanet.co.kr)에 접속하기</li>
                    </div>
                    <div class="step_number">
                        <li class="blue_step_txt">STEP3</li>
                        <li>가입한 학교 이메일로 전송된 인증메일을 확인 하기</li>
                    </div>
                    <div class="step_number">
                        <li class="blue_step_txt">STEP4</li>
                        <li>잡플래닛 "계정" 페이지에서 학적정보를 등록하면 가입 최종 완료</li>
                    </div>
                </div>

                <div class="info_img_wrap_m">
                    <img src="/img/sub3050_img02.png" alt="제휴대학 학적 정보" style="display: block; margin: 0 auto;">
                </div>

            </div>

            <div class="notice_txt_wrap">
                문의사항은 취업센터나 잡플래닛(ihaveajob@jobplanet.co.kr)으로!
            </div>


        </div>

    </div>

</div>

@endsection
