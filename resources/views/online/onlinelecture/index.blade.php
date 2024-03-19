
@extends("layouts.layout")

@section("title")
    동아대 온라인 취업컨텐츠 - 기업/직무/산업분석 인강(위포트)
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/onlinelecture.css">
@endpush

@php
    $major_menu = "온라인 취업컨텐츠";
    $minor_menu = "기업/직무/산업분석 인강(위포트)";
@endphp

@section("content")

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>기업/직무/산업분석 & 인강</h1>
            <h1><span>위포트</span></h1>
        </div>

        <div class="sub_topbanner_wrap">
            <div class="top_pc1">
                <p class="topbanner_title">온라인 취업자료 이용 안내</p>
                <p>2021. 3. 1 ~ 2022. 2. 28</p>
            </div>

            <div class="top_pc2">
                <div class="post_img_wrap">
                    <img src="/img/sub3020_img01.png" alt="사진">
                </div>

                <div class="gray_bg_wrap">
                    <div class="bullet_title">이용가능 컨텐츠 목록(위포트)</div>
                    <div class="pdt20">
                        <p class="dot_bullet_wrap">인적성 & NCS 언어/수리/추리 집중완성(온라인강의)</p>
                        <p class="dot_bullet_wrap">공기업 경영학 강의 김윤상 경영학개론 조직행위론</p>
                        <p class="dot_bullet_wrap">기업/산업/직무/전공/합격자소서 분석자료</p>
                        <p class="dot_bullet_wrap">온라인 직무적성검사(9종)</p>
                    </div>

                    <div class="link_blue_button">
                        <form name="theFrom" id="theFrom" method="post" target="_blank">
                            <input type="hidden" name="step" value="2">
                        </form>
                        <form method="post" name="educeForm" id="educeForm" action="https://www.weport.co.kr/alliance/check-alliance?alliance_id=5" data-user="{{ session()->get('donga_type') }}">
                            <input type="hidden" name="token" value="DWWLKooia34df2gg">
                            <input type="hidden" name="user_id" value="{{ session()->get('account') }}" />
                            <input type="hidden" name="email" value="{{ session()->get('email') }}" />
                            <input type="hidden" name="name" value="{{ session()->get('name') }}" />
                            <input type="hidden" name="phone" value="{{ session()->get('phone_number') }}" />
                            <button  type="button" onclick="EduceLogin()">
                                <span>위포트 바로가기</span>
                            </button>
                        </form>

                    </div>

                    <div class="post_img_wrap_m">
                        <img src="/img/sub3020_img01.png" alt="사진">
                    </div>
                </div>

            </div><!-- top_pc2 end -->
        </div><!-- sub_topbanner_wrap end -->



        <script>

            function EduceLogin(){

                if(__common.isAdminCheck(document.educeForm.dataset.user)) {
                    alert('학생으로 로그인하여 이용 부탁드립니다.');
                } else {
                    document.educeForm.submit();
                }

            }

            $(document).ready(function(){
                var loginCheck = '{{ session()->get('login_check') }}';
                var linkBtns = document.querySelectorAll('.link_blue_button button');
                var linkURL = 'https://www.weport.co.kr/';

                // for (var i = 0; i < linkBtns.length; i++) {
                //     linkBtns[i].addEventListener('click', function () {
                //         if (loginCheck){
                //             window.open(linkURL); // 링크
                //         }else {
                //             var loginYes = confirm('로그인 후 이용 가능합니다. 로그인 페이지로 이동하시겠습니까?');
                //
                //             if (loginYes) {
                //                 location.href = "/login";
                //             }
                //         }
                //     })
                // }
            });
        </script>


        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">위포트 컨텐츠 무료 이용방법</div>
            </div>
            <div class="content_basic_txt_wrap">
                <h3>1. 취업지원실 홈페이지 접속 후 로그인해서 '위포트'아이콘 클릭</h3>
                <p>(로그인 ID : 학번 / 비밀번호 : 학생정보 로그인 비밀번호)</p>
            </div>
            <div class="content_imgwrap">
                <img src="/img/sub3020_img02.png" alt="1번">
            </div>

            <div class="content_basic_txt_wrap">
                <h3>2. 나의 강의실 클릭</h3>
                <p>나의 강의실 클릭시에만 '무료 컨텐츠'이용 가능</p>
                <p>나의 강의실을 경유하지 않고 컨텐츠 클릭 시 유료 결제 화면 이동</p>
            </div>
            <div class="content_imgwrap">
                <img src="/img/sub3020_img03.png" alt="2번">
            </div>

            <div class="content_basic_txt_wrap">
                <h3>3. '프리패스 컨텐츠 수강 신청하기' 버튼 클릭</h3>
            </div>
            <div class="content_imgwrap">
                <img src="/img/sub3020_img04.png" alt="3번">
            </div>
            <div class="bullet_gray_bg_wrap">
                <div class="dot_bullet_wrap">
                    온라인 인강
                </div>
                <div class="gray_bg">
                    <p>1. 동영상 클릭</p>
                    <p>2. 수강 희망 과정 클릭</p>
                    <p>3. 동영상 강의 선택(1개 or 2개)</p>
                    <p>4. 콘텐츠 추가</p>
                    <p>5. 나의 강의실에서 강의 수강</p>
                </div>
            </div>

            <div class="content_imgwrap pdt20">
                <img src="/img/sub3020_img05.png" alt="4번">
            </div>

            <div class="bullet_gray_bg_wrap">
                <div class="dot_bullet_wrap">
                    직무자료
                </div>
                <div class="gray_bg">
                    <p>1. 취업핵심분석 클릭</p>
                    <p>2. 직무핵심분석 클릭</p>
                    <p>3. 관심있는 직무 선택(1개 or 2개)</p>
                    <p>4. 콘텐츠 추가</p>
                    <p>5. 나의 강의실에서 컨텐츠 열기</p>
                </div>
            </div>

            <div class="content_imgwrap pdt20">
                <img src="/img/sub3020_img06.png" alt="5번">
            </div>

            <div class="bullet_gray_bg_wrap">
                <div class="dot_bullet_wrap">
                    온라인 모의 직무 적성검사
                </div>
                <div class="gray_bg">
                    <p>1. 직무적성검사 클릭</p>
                    <p>2. 응시 기업 클릭</p>
                    <p>3. 시험 선택(1개 or 2개)</p>
                    <p>4. 콘텐츠 추가</p>
                    <p>5. 나의 강의실에서 시험 실시</p>
                </div>
            </div>

            <div class="content_imgwrap pdt20">
                <img src="/img/sub3020_img07.png" alt="6번">
            </div>


        </div>


    </div>

@endsection
