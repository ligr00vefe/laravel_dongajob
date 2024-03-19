
@extends("layouts.layout")

@section("title")
    동아대 온라인 취업컨텐츠 - AI자기소개서 작성 및 평가(에듀스)
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/ai.css">
@endpush

@php
    $major_menu = "온라인 취업컨텐츠";
    $minor_menu = "AI자기소개서 작성 및 평가(에듀스)";
@endphp

@section("content")

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>AI자기소개서 작성 및 평가</h1>
            <h1><span>에듀스</span></h1>
        </div>

        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <h2>EDUCE<span class="comment_txt"> JOB Solution for College</span></h2>
                <p class="bold_txt_wrap">믿을 수 있는 에듀스</p>
                <p>온, 오프라인을 합쳐 연간 50만명이 넘는 취업준비생들이(주)에듀스 컨텐츠를 이용하고 있습니다.</p>
                <p class="bold_txt_wrap">취업컨텐츠 제공 전문기업</p>
                <p>서류/직무적성검사/면접 채용의 전과정에 맞추어 다양하고 정확한 정보를 담은 컨텐츠를 제공합니다.</p>

                <div class="link_blue_button">
                    <button onclick="AriLogin()"><span>에듀스 바로가기</span></button>
                </div>
            </div>
            <div class="top_tab">
                <h2>EDUCE<span class="comment_txt"> JOB Solution for College</span></h2>
                <p class="bold_txt_wrap">믿을 수 있는 에듀스</p>
                <p>온, 오프라인을 합쳐 연간 50만명이 넘는 취업준비생들이</p>
                <p>(주)에듀스 컨텐츠를 이용하고 있습니다.</p>
                <p class="bold_txt_wrap">취업컨텐츠 제공 전문기업</p>
                <p>서류/직무적성검사/면접 채용의 전과정에 맞추어 </p>
                <p>다양하고 정확한 정보를 담은 컨텐츠를 제공합니다.</p>

                <div class="link_blue_button">
                    <button onclick="AriLogin()"><span>에듀스 바로가기</span></button>
                </div>
            </div>
            <div class="top_m">
                <h2>EDUCE<span class="comment_txt"> JOB Solution for College</span></h2>
                <p class="bold_txt_wrap">믿을 수 있는 에듀스</p>
                <p>온, 오프라인을 합쳐 연간 50만명이 넘는 취업준비생들이(주)에듀스 컨텐츠를 이용하고 있습니다.</p>
                <p class="bold_txt_wrap">취업컨텐츠 제공 전문기업</p>
                <p>서류/직무적성검사/면접 채용의 전과정에 맞추어 다양하고 정확한 정보를 담은 컨텐츠를 제공합니다.</p>

                <div class="link_blue_button">
                    <form method="post" name="educeForm" id="educeForm" action="https://u.educe.co.kr/donga/" data-user="{{ session()->get('donga_type') }}">
                        <input type="hidden" name="SetupNo" value="191" />
                        <input type="hidden" name="UnivNum" value="71" />
                        <input type="hidden" name="UserID" value="{{ session()->get('account') }}" />
                        <input type="hidden" name="UserName" value="{{ session()->get('name') }}" />
                        <button onclick="AriLogin()"><span>에듀스 바로가기</span></button>
                    </form>
                </div>
            </div>

        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">에듀스 온라인 취업 솔루션 접속 방법</div>
            </div>
            <div class="content_basic_txt_wrap">
                <h3>1. 동아대학교 홈페이지 접속</h3>
                <p>1. 동아대학교 홈페이지 접속 </p>
                <p>2. 홈페이지 상단 취업 커리어에서 '취업지원실' 클릭</p>
            </div>
            <div class="content_imgwrap pdt30">
                <img src="/img/sub3030_img02.png" alt="1번">
            </div>

            <div class="content_basic_txt_wrap">
                <h3>2. 동아대학교 취업지원실 홈페이지 접속</h3>
                <p>1. 취업지원실 홈페이지 접속</p>
                <p>2. 로그인 ( ID : 학번 / 비밀번호 : 학생정보 로그인 비밀번호)</p>
                <p>3. AI자기소개서 작성 및 평가 클릭</p>
            </div>
            <div class="content_imgwrap pdt30">
                <img src="/img/sub3030_img03.png" alt="2번">
            </div>

            <div class="content_basic_txt_wrap">
                <h3>3. 에듀스 온라인 취업 솔루션 이용</h3>
                <p>1. 에듀스 온라인 취업 솔루션 홉페이지 접속</p>
                <p>2. 에듀스 온라인 취업 솔루션 모든 콘텐츠 무제한 무료 사용</p>
            </div>
            <div class="content_imgwrap pdt30">
                <img src="/img/sub3030_img04.png" alt="3번">
            </div>

        </div>


        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">온라인 취업 솔루션 콘텐츠 맵</div>
            </div>
            <div class="content_basic_txt_wrap">
                <h3>1. 동아대학교 홈페이지 접속</h3>
                <p>1. 동아대학교 홈페이지 접속 </p>
                <p>2. 홈페이지 상단 취업 커리어에서 '취업지원실' 클릭</p>
            </div>

            <div class="content_map_wrap pdt30">
                <div class="content_map_box">
                    <div class="map_title">취업전략</div>
                    <div class="map_txt">
                        <p>기업별 / 전공별 합격 스펙검색</p>
                        <p>우리학과 선배는 어디에?</p>
                        <p>스펙매칭 서비스</p>
                        <p>나의 지원가능 기업</p>
                        <p>직무정보</p>
                        <p>직무분석 및 직무탐색 강의</p>
                        <p>직무 인터뷰</p>
                        <p>기업분석 자료집</p>
                        <p>HOT 채용정보</p>
                        <p>중소기업정보</p>
                        <p>공공기관 채용 박람회</p>
                        <p>공공기관 입사지원서</p>
                        <p>기업 취업 전략 강의</p>
                    </div>
                </div>
                <div class="content_map_box">
                    <div class="map_title">자기소개서</div>
                    <div class="map_txt">
                        <p>합격자 자기소개서</p>
                        <p class="graytxt">(16,000여건)</p>
                        <p>첨삭 자기소개서</p>
                        <p class="graytxt">(17,000여건)</p>
                        <p>실전 자기소개서 가이드북</p>
                        <p>합격자 인터뷰</p>
                        <p class="graytxt">(716여건)</p>
                        <p>시사상식 자료집</p>
                        <p>자기소개서 준비강의</p>
                        <p class="graytxt">(NCS 자기소개서 추가 예정)</p>
                        <p>취업칼럼</p>
                        <p></p>
                        <p></p>
                    </div>
                </div>
                <div class="content_map_box">
                    <div class="map_title">직무적성검사</div>
                    <div class="map_txt">
                        <p>주요기업 & 공사 / 공기업 모의시험</p>
                        <p class="graytxt">(37종 제공)</p>
                        <p>중기업 & 공사 / 공기업</p>
                        <p>eBOOK 및 해설특강</p>
                        <p class="graytxt">(각 35종 제공)</p>
                        <p>직무적성검사 유형분석 강의</p>
                        <p class="graytxt">19대 그룹, 중견기업, GSAT 유형분석 등</p>
                        <p>직무적성검사 실전문제 강의</p>
                        <p class="graytxt">GSAT, SK, CJ, 두산, LG, 롯데, 한전, 한국남동발전, 한수원 등</p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                    </div>
                </div>
                <div class="content_map_box">
                    <div class="map_title">면접</div>
                    <div class="map_txt2">
                        <p>면접 가이드북</p>
                        <p>면접 준비 강의</p>
                        <p>실시간 면접질문 공유</p>
                        <p>면접 자료실</p>
                        <p>면접후기</p>
                        <p>면접분석 및 기출질문</p>
                        <p>ISSUE DEBATE</p>
                    </div>
                    <div class="map_title">NCS관</div>
                    <div class="map_title">인문학관</div>
                    <div class="map_title">가이드북관</div>
                </div>
                <div class="content_map_box2">
                    <div class="map_title">AI(딥러닝) 자소서 작성 및 평가/분석</div>
                </div>

            </div>

        </div>



        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">에듀스 온라인 취업 솔루션 - 개요</div>
            </div>

            <!---------- 취업전략 시작 ---------->
            <div class="content_basic_txt_wrap pdb30">
                <h3>1. 취업전략</h3>

                <div class="top_line_wrap">
                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">스펙검색엔진</li>
                            <li class="mgl30">에듀스 회원 중 대기업 서류 합격자 스펙데이터를 기업별, 지원분야별, 전공별로 보여드리며, 자신의 스펙과 비교해 볼 수 있습니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">선배는 어디에?</li>
                            <li class="mgl30">2만건이 넘는 합격자스펙 정보를 바탕으로 우리학교, 우리학과 선배들의 서류합격 기업정보 제공.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">기업분석 자료집</li>
                            <li class="mgl30">기업의 최근 정보를 통하여 입사전략을 수립할 수 있도록 구성 채용동향/채용시기/기업정보/서류 가이드를 제공합니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">직무정보</li>
                            <li class="mgl30">기업의 직무 리스트, 해당 직무의 수행 업무 기본 자실, 관련 전공을 확인할 수 있습니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">중소기업 정보</li>
                            <li class="mgl30">쉽게 접근하기 힘든 국내 중소기업들의 기업정보 및 연봉 정보, 채용 동향 등을 제공합니다.</li>
                        </ul>
                    </div>

                </div>

            </div>
            <!---------- 취업전략 끝 ---------->


            <!---------- 자기소개서 시작 ---------->
            <div class="content_basic_txt_wrap pdb30">
                <h3>2, 자기소개서</h3>

                <div class="top_line_wrap">
                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">합격자 자기소개서</li>
                            <li class="mgl30">대기업에 합격한 회원 자기소개서 전문을 제공합니다. 지원자 스펙 포함 / 최근 항목이 반영된 자기소개서를 제공합니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">첨삭 자기소개서</li>
                            <li class="mgl30">전문가의 첨삭을 통한 올바른 자소거 작성 가이드를 제공합니다. 우수 작성자 사례 / 항목별 분류를 통한 맞춤 콘텐츠를 제공합니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">기업분석 자료집</li>
                            <li class="mgl30">실전 지원자들의 유명 첨삭 상사들이 직접 지도한 내용을 공개한 자기 소개사 가이드북 입니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">직무정보</li>
                            <li class="mgl30">실제 대기업에 합격한 회원들의 인터뷰 합격하는 노하우를 전격 공개합니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">중소기업 정보</li>
                            <li class="mgl30">자기소개서 작성법, 면접 노하우 등 취업에 관한 여러 가지 물음에 대한 해답을 제시해 드립니다.</li>
                        </ul>
                    </div>

                </div>

            </div>
            <!---------- 자기소개서 끝 ---------->


            <!---------- 직무적성검사 시작 ---------->
            <div class="content_basic_txt_wrap">
                <h3>3. 직무적성검사</h3>

                <div class="top_line_wrap">
                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box2">주요기업 & 공사 / 공기업 모의시험</li>
                            <li class="mgl30">
                                - 기업 직무적성검사와 공사/공기업 필기 평가를 대비할 수 있는 40여종 기업별 모의시험을 제공합니다.
                                <br />
                                - 별 40여종의 직무 적성검사 eBOOK을 제공하여 학습할 수 있도록 지원합니다.
                            </li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box2">주요기업 & 공사 / 공기업 eBOOK 및 해설특강</li>
                            <li class="mgl30">
                                - 실제 종이 서적과 동일한 내용의 최신의 주요기업과 공사/공기업 eBOOK을 제공하고 있습니다.
                                <br />
                                - 최신의 정보를 바탕으로 각 eBOOK에 대한 해설 특강도 함께 제공하고 있습니다.
                            </li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box2">직무적성검사 유령분석 & 실전문제 강의</li>
                            <li class="mgl30">- 영역별, 기업별 직무 적성검사 유형분석 강의를 제공하고 있으며, 15종 이상의 실전문제풀이 강의를 제공하고 있습니다.</li>
                        </ul>
                    </div>

                </div>

            </div>
            <!---------- 직무적성검사 끝 ---------->


            <!---------- 면접 시작 ---------->
            <div class="content_basic_txt_wrap pdb30">
                <h3>4. 면접</h3>

                <div class="top_line_wrap">
                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">면접 가이드북</li>
                            <li class="mgl30">면접 유형별 접근방법을 분석하여 실전 면접을 효과적으로 준비할 수 있도록 가이드를 제시합니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">실시간 면접질문 공유</li>
                            <li class="mgl30">기업별로 실제 면접을 본 응시자들이 남기는 기출 면접 질문을 만날 수 있습니다, 이러한 면접 질문들을 바탕으로 답변을 준비할 수 있습니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">면접 자료실</li>
                            <li class="mgl30">면접에 앞서 반드시 필요한 전공 / 기술 내용을 정리한 기술 자료를 제공합니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">면접 후기</li>
                            <li class="mgl30">주요기업 면접후기를 통해서 해당기업의 실제 면접시 도움될 정보를 미리 확인하고 대비할 수 있습니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">면접분석 및 기출질문</li>
                            <li class="mgl30">기업별 면접 전에 알아야할 TIP과 면접 분석 자료와 기출질문을 확인할 수 있도록 제공합니다.</li>
                        </ul>
                    </div>

                </div>

            </div>
            <!---------- 면접 끝 ---------->


            <!---------- Theme Section 시작 ---------->
            <div class="content_basic_txt_wrap pdb30">
                <h3>5. Theme Section</h3>

                <div class="top_line_wrap">
                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">NCS관 & 공사 / 공기업관</li>
                            <li class="mgl30">공사/공기업 필기평가 종합 모의시험과 직업기초능력을 대비할 수 있는 강의가 탑재되어 있습니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">인문학관</li>
                            <li class="mgl30">기업 취업에 필요한 한국사 문제를 바탕으로 분석할 수 있는 취업한국사 강의 17강이 탑재되어 있습니다.</li>
                        </ul>
                    </div>

                    <div class="list_content_wrap pdt20">
                        <ul>
                            <li class="title_box">가이드북관</li>
                            <li class="mgl30">진로 설정, 목표설정과 학교 생활을 하면서 키워야할 역량과 준비사항에 대한 가이드를 제시해주는 가이드북 입니다.</li>
                        </ul>
                    </div>

                </div>

            </div>
            <!---------- Theme Section 끝 ---------->



            <!---------- AI(딥러닝) 자기소개서 작성 시작 ---------->
            <div class="content_basic_txt_wrap pdb30">
                <h3>6. AI(딥러닝) 자기소개서 작성</h3>

                <div class="top_line_wrap">
                    <div class="three_icon_wrap">
                        <div class="icon_box_wrap">
                            <li><img src="/img/sub3030_icon01.png" alt="아이콘"></li>
                            <li class="icon_title">자소서 작성</li>
                            <li>
                                본 솔루션에서 제시하는 자기소개서 작성 가이드는 30여개의 주제별 각각의 레이아웃을 제시하고 그에 맞게 합격예시를 제시 해 작성에 도움을 드립니다
                            </li>
                        </div>
                        <div class="icon_box_wrap">
                            <li><img src="/img/sub3030_icon02.png" alt="아이콘"></li>
                            <li class="icon_title">AI평가 / 분석</li>
                            <li>
                                60 만건의 빅데이터로 딥러닝 기술을 활용한 자소서 완성도 점수를 제시합니다 본인의 작성수준을 직관적으로 확인할 수 있습니다
                            </li>
                        </div>
                        <div class="icon_box_wrap">
                            <li><img src="/img/sub3030_icon03.png" alt="아이콘"></li>
                            <li class="icon_title">첨삭</li>
                            <li>
                                부족한 표현에 대한 표시 , 합격자소서의 표절여부 자주 실수하게 되는 맞춤법 서비스 등을 제공 함으로서 실전 제출을 앞두고 최종 점검을 할 수 있는 기회를 제공 합니다
                            </li>
                        </div>
                    </div>
                </div>

            </div>
            <!---------- AI(딥러닝) 자기소개서 작성 끝 ---------->


        </div>


    </div>

    <script>
        function AriLogin(){
            if(__common.isAdminCheck(document.educeForm.dataset.user)) {
                alert('학생으로 로그인하여 이용 부탁드립니다.');
            } else {
                document.educeForm.submit();
            }
        }

        $(document).ready(function(){
            var loginCheck = '{{ session()->get('login_check') }}';
            var linkBtns = document.querySelectorAll('.link_blue_button button');
            var linkURL = 'http://u.educe.co.kr/donga';

     /*       for (var i = 0; i < linkBtns.length; i++) {
                linkBtns[i].addEventListener('click', function () {
                    if(loginCheck) {
                        window.open(linkURL); // 링크
                    }else {
                        var loginYes = confirm('로그인 후 이용 가능합니다. 로그인 페이지로 이동하시겠습니까?');

                        if (loginYes) {
                            location.href = "/login";
                        }
                    }
                })
            }*/
        });
    </script>
@endsection
