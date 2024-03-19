
@extends("layouts.layout")

@section("title")
    동아대 온라인 취업컨텐츠 - 취업진로진단검사(에듀스)
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/checkup.css">
@endpush

@php
    $major_menu = "온라인 취업컨텐츠";
    $minor_menu = "취업진로진단검사(에듀스)";
@endphp

@section("content")

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>취업진로진단검사</h1>
            <h1><span>에듀스</span></h1>
        </div>

        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <h2>아우란트<span class="comment_txt"> 에듀스 진로 진단검사(아우란트)솔루션</span></h2>
                <p>㈜에듀스에서 제공하는 인 적성검사 Auland. 아우란트 는 성공적인 대학생활과 실질적인 진로 적성의 가이드를 제공 해주는 검사입니다</p>
                <p>본 적성검사는 , 검사 대상의 특징과 성향을 구분 , 맞춤형 정보를 제공 함으로서 진로 취업 선택의 가이드로 활용할 수 있습니다.</p>

                <div class="link_blue_button">
                    <form method="post" name="educeForm" id="educeForm" action="https://u.educe.co.kr/jobdonga/" data-user="{{ session()->get('donga_type') }}">
                        <input type="hidden" name="SetupNo" value="41" />
                        <input type="hidden" name="UnivNum" value="71" />
                        <input type="hidden" name="UserID" value="{{ session()->get('account') }}" />
                        <input type="hidden" name="UserName" value="{{ session()->get('name') }}" />
                        <button type="button" onclick="EduceLogin()"><span>아우란트 바로가기</span></button>
                    </form>
                </div>
            </div>

            <div class="top_tab">
                <h2>아우란트<span class="comment_txt"> 에듀스 진로 진단검사(아우란트)솔루션</span></h2>
                <p>㈜에듀스에서 제공하는 인 적성검사 Auland. 아우란트 는 성공적인 대학생활과 실질적인 진로 적성의 가이드를 제공 해주는 검사입니다</p>
                <p>본 적성검사는 , 검사 대상의 특징과 성향을 구분 , 맞춤형 정보를 제공 함으로서 진로 취업 선택의 가이드로 활용할 수 있습니다.</p>

                <div class="link_blue_button">
                    <button onclick="EduceLogin()"><span>아우란트 바로가기</span></button>
                </div>
            </div>
            <div class="top_m">
                <h2>아우란트<span class="comment_txt"> 에듀스 진로 진단검사(아우란트)솔루션</span></h2>
                <p>㈜에듀스에서 제공하는 인 적성검사 Auland. 아우란트 는 성공적인 대학생활과 실질적인 진로 적성의 가이드를 제공 해주는 검사입니다
                    본 적성검사는 , 검사 대상의 특징과 성향을 구분 , 맞춤형 정보를 제공 함으로서 진로 취업 선택의 가이드로 활용할 수 있습니다.</p>

                <div class="link_blue_button">
                    <button onclick="EduceLogin()"><span>아우란트 바로가기</span></button>
                </div>
            </div>

        </div>


        <div class="sub_container_wrap">

            <div class="bullet_content_wrap">
                <div class="bullet_title">Why?Auland</div>
            </div>

            <div class="content_basic_txt_wrap">
                <p>
                    국내 대학생들을 대상으로 실시한 실태조사 연구 결과 , 대학생들이 가장 많은 심리적 부담감을 가지고 있으며 가장 큰 고민거리로 생각하는 문제는 자신의 현재 진로 상태 및 졸업 후 진로선택에 관한 문제 인 것으로 나타나고 있습니다 특히 취업을 염두에 두고 있는 대다수 대학생들은 자신이 어떤 기업을 선택해야 하는지 그리고 어떠한 직무를 원하고 있으며 어떤 직무가 적합한지 등의 문제에 있어서 많은 어려움을 겪고 있습니다 본 검사의 기본 목적은 진로 결정 또는 취업을 앞두고 어려움을 겪는 고등학생 , 대학생들로 하여금 자기자신을 진단해 볼 수 있는 기회를 제공 하여 학생들이 자신의 진로를 결정하는데 도움을 주기 위한 것입니다
                </p>
            </div>

            <div class="gray_bg_wrap ">
                <div class="list_content_wrap">
                    <p class="blue_tit">저학년</p>
                    <p>
                        아직 자신의 진로에 대한 확신이 없는 저학년들이 자신의 직업적성을 파악하고
                        향후 진로 계획을 세울 수 있도록 도와드립니다 . 향후 어떻게 대학생활을 해 나가야 할 지에 대한 가이드를 얻을 수 있습니다
                    </p>
                </div>

                <div class="list_content_wrap">
                    <p class="blue_tit">고학년</p>
                    <p>
                        취업을 앞둔 대학 고학년들이 자신의 적성 , 직업진로를 파악하고 이를 종합적으로 고려하여 합격 가능성이 높은 직군을 선택할 수 있도록 도와 드립니다.
                        희망하는 회사나 직무에 적합한 적성 , 인성 또는 역량을 지니고 있는지 파악할 수 있으며 , 부족한 부분이 있다면 사전에 개선 보완 할 수 있도록 도와드립니다.
                    </p>
                </div>

            </div>

        </div>


        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">진로 진단검사(아우란트) 솔루션 이용 방법</div>
            </div>
            <div class="content_basic_txt_wrap">
                <h3>1. 동아대학교 홈페이지 접속</h3>
                <p>1. 동아대학교 홈페이지 접속</p>
                <p>2. 홈페이지 상단 취업 / 커리어에서 '취업지원실'클릭</p>
            </div>
            <div class="content_imgwrap pdt30">
                <img src="/img/sub3040_img01.png" alt="1번">
            </div>

            <div class="content_basic_txt_wrap">
                <h3>2. 동아대학교 취업지원실 홈페이지 로그인</h3>
                <p>1. 취업지원실 홈페이지 접속</p>
                <p>2. 로그인 ( ID : 학번 / 비밀번호 : 학생정보 로그인 비밀번호)</p>
                <p>3. 진로 진단검사 클릭</p>
            </div>
            <div class="content_imgwrap pdt30">
                <img src="/img/sub3040_img02.png" alt="2번">
            </div>

            <div class="content_basic_txt_wrap">
                <h3>3. 에듀스 진로 진단검사( 아우란트) 솔루션 이용</h3>
                <p>1. 에듀스 진로 진단검사 ( 아우란트 ) 솔루션 홈페이지 접속</p>
                <p>2. 에듀스 진로 진단검사 ( 아우란트 ) 솔루션 테스트 무제한 무료 사용</p>
            </div>
            <div class="content_imgwrap pdt30">
                <img src="/img/sub3040_img03.png" alt="3번">
            </div>

            <div class="content_basic_txt_wrap">
                <p>1. 에듀스 진로 진단검사(아우란트) 검사 동영상 안내</p>
                <p>2. 저학년/고학년 2개 영역으로 되어 있으며 각 4강으로 구성되어진 동영상 안내 제공</p>
            </div>

            <div class="content_imgwrap pdt30">
                <img src="/img/sub3040_img04.png" alt="4번">
            </div>

            <div class="content_basic_txt_wrap">
                <p>1. 에듀스 진로 진단검사(아우란트) 진로 진단검사 / 리포트 보기 클릭</p>
            </div>

            <div class="content_imgwrap pdt30">
                <img src="/img/sub3040_img05.png" alt="5번">
            </div>

            <div class="content_basic_txt_wrap">
                <p>1. 에듀스 진로 진단검사(아우란트) 진로 진단검사(아우란트) 응시</p>
                <p>2. 에듀스 진로 진단검사(아우란트)무제한 이용가능</p>
            </div>

            <div class="content_imgwrap pdt30">
                <img src="/img/sub3040_img06.png" alt="6번">
            </div>

            <div class="content_basic_txt_wrap">
                <p>1. 에듀스 진로 진단검사(아우란트) 결과리포트 샘플보기</p>
            </div>

            <div class="content_imgwrap pdt30">
                <img src="/img/sub3040_img07.png" alt="7번">
            </div>

        </div>

    </div>

    <script>
        function EduceLogin(){

            if(__common.isAdminCheck(document.educeForm.dataset.user)) {
                alert('학생으로 로그인하여 이용 부탁드립니다.');
            } else {
                document.educeForm.submit();
            }

        }
        $(document).ready(function(){
           /* var loginCheck = '{{ session()->get('login_check') }}';
            var linkBtns = document.querySelectorAll('.link_blue_button button');
            var linkURL = 'http://u.educe.co.kr/jobdonga';

            for (var i = 0; i < linkBtns.length; i++) {
                linkBtns[i].addEventListener('click', function () {
                    if(loginCheck) {
                        window.open(linkURL); // 링크
                    }else {
                        var loginYes = confirm('로그인 후 이용 가능합니다. 로그인 페이지로 이동하시겠습니까?');

                        if(loginYes) {
                            location.href="/login";
                        }
                    }
                })
            }*/
        });
    </script>
@endsection
