
@extends("layouts/layout")

@section("title")
    동아대 취업지원실 - 취업프로그램 소개
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/employmentinfo.css">
@endpush

@php
    $major_menu = "취업지원실";
    $minor_menu = "취업프로그램 소개";
@endphp

@section("content")
<div class="sub-content">
    <div class="sub-content_title">
        <h1>취업프로그램 소개</h1>
    </div>

    <div class="subtab_menu_wrap">
        <ul>
            <li class="on"><a href="javascript:void(0)" data-order="0">취업동아리</a></li>
            <li class=""><a href="javascript:void(0)" data-order="1">현장실습</a></li>
            <li class=""><a href="javascript:void(0)" data-order="2">취업교과목</a></li>
            <li class=""><a href="javascript:void(0)" data-order="3">경력개발프로그램</a></li>
            <li class=""><a href="javascript:void(0)" data-order="4">채용박람회/설명회</a></li>
            <li class=""><a href="javascript:void(0)" data-order="5">재직선배초청교육</a></li>
        </ul>
    </div>



    <!------ 취업동아리 시작 ------>

    <div class="sub_section01 sub-view">

        <!-- 상단 탑 배너 -->
        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <h2>학년, 역량별 맞춤식 취업동아리</h2>
                <p>학년, 역량별 맞춤식 취업동아리를 운영합니다.</p>
                <P>'동아일보 평가 학생조직활동 지원 전국 1위' 선정 등 전국 최대 규모의 취업동아리는</P>
                <P>취업에 대한 체계적인 기본 교육과 적극적인 취업스터디 지원을 통해 학생들로부터</P>
                <p>높은 만족도와 취업률을 이끌어내고 있습니다.</p>
            </div>
            <div class="top_tab">
                <h2>학년, 역량별 맞춤식 취업동아리</h2>
                <p>학년, 역량별 맞춤식 취업동아리를 운영합니다.
                    '동아일보 평가 학생조직활동 지원 전국 1위' 선정 등 전국 최대 규모의 취업동아리는
                    취업에 대한 체계적인 기본 교육과 적극적인 취업스터디 지원을 통해 학생들로부터
                    높은 만족도와 취업률을 이끌어내고 있습니다.</p>
            </div>
            <div class="top_m">
                <h2>학년, 역량별 맞춤식 취업동아리</h2>
                <p>학년, 역량별 맞춤식 취업동아리를 운영합니다.</p>
                <P>'동아일보 평가 학생조직활동 지원 전국 1위' 선정 등 전국 최대 규모의
                    취업동아리는 취업에 대한 체계적인 기본 교육과 적극적인 취업스터디 지원을 통해 학생들로부터
                    높은 만족도와 취업률을 이끌어내고 있습니다.</p>
            </div>

        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">Leaders Club (대기업 취업 준비반)</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>
                    2004년부터 운영된 14년 전통의 Leaders Club은 졸업을 앞둔 우수 학생을 선발하여 10개월간 체계적인 관리와 취업스터디를 진행합니다.높은 취업률은 물론 참여학생 대부분 국내유수의 대기업으로 진출하여 다양한 언론 매체와 평가 기관의 우수 사례로 선정되었으며,동아대학교의 자부심으로 입사선배들이 다시 후배교육에 재참여 하는 'DAU 순환형 프로그램 지원체계'의 일등공신으로 자리매김하였습니다.
                </p>
            </div>
        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">Frontiers (중견기업 취업 준비반)</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>
                    동아대학교의 취업률 향상을 이끌어가는 Frontiers는 전국 최초/최다 인원으로 운영되고 있습니다.대기업 못지않은 복지혜택이 있는 우수 중견·중소기업을 목표로 하여 경력 개발과 더불어모의면접, 입사서류 지원 등 취업에 대한 전반적인 사항을 체계적으로 준비할 수 있도록 지원합니다.또한 Leaders Club과 더불어 'DAU 순환형 프로그램 지원체계'의 한 축으로 성장하여 취업에 강한 대학임을 증명하는 중요한 역할을 하고 있습니다.
                </p>
            </div>
        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">공준모 (공기업 취업 준비반)</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>
                    학생들의 늘어나는 공기업 취업 희망 수요에 맞추어 2018년도부터운영된 공준모는 저학년(2, 3학년)부터 졸업을 앞둔 고학년 학생들을 선발하여 10개월간 체계적인 공기업 준비를 진행합니다. 저 학년은 공기업 입사를 위한 스펙위주의 준비, 고학년은 NCS시험 및 면접 준비 위주의 스터디 운영을 하고 있습니다.
                </p>
            </div>
        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">Leaders Club Junior (저학년 취업준비반)</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>
                    다양한 전공의 2·3학년 학생들이 모여 취업정보 공유, 사전 역량개발을 통한 진로를 찾는 과정으로 운영됩니다.저학년부터 체계적인 준비과정 지도를 통해 취업에 대한 관심과 구체적인 계획을 실행하며, 많은 정보를 습득할 기회를 가집니다.
                </p>
            </div>
        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">국가직 지역인재 7급 공무원 준비반</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>
                    학생들의 늘어나는 공기업 취업 희망 수요에 맞추어 2018년도부터운영된 공준모는 저학년(2, 3학년)부터 졸업을 앞둔 고학년 학생들을 선발하여 10개월간 체계적인 공기업 준비를 진행합니다. 저 학년은 공기업 입사를 위한 스펙위주의 준비, 고학년은 NCS시험 및 면접 준비 위주의 스터디 운영을 하고 있습니다.
                </p>
            </div>
        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">취업동아리 선발 및 지원안내</div>
            </div>
            <div class="content_table scroll_table_box pdt30">
                <table class="top_gray_table">
                    <tr>
                        <th class="wd15">동아리</th>
                        <th class="wd25">모집대상</th>
                        <th colspan="2" class="wd60">운영(지원) 내용</th>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">Leaders Club</td>
                        <td class="centertxt">4학년 재·휴학생</td>
                        <td rowspan="4">
                            - 취업분야별 그룹 스터디 <br />
                            - 개별면담 및 취업지도 <br />
                            - 취업캠프 <br />
                            - 스터디룸 지원 <br />
                            - 반별 간담회 <br />
                            - 어학응시료 지원 <br />
                            - 경력개발활동 지원 등
                        </td>
                        <td rowspan="2" class="noneright">
                            - 재직선배 초청 멘토링 <br />
                            - 기업 채용특강/설명회 <br />
                            - 입사선배 멘토링 등
                        </td>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">Frontiers</td>
                        <td class="centertxt">기졸업자 및 졸업예정자</td>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">공준모</td>
                        <td class="centertxt">2, 3, 4학년 재·휴학생</td>
                        <td rowspan="2" class="noneright">
                            - 직무탐색·봉사활동 <br />
                            - 어학·자격증 취득 스터디 <br />
                            - 진로 맞춤형 지도 및 상담
                        </td>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">Leaders Club Junior</td>
                        <td class="centertxt">2, 3학년 재·휴학생</td>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">지역인재 준비반</td>
                        <td class="centertxt">학과 졸업석차 상위 10%이내 한국사능력검정시험 2급 이상 토익 700점이상</td>
                        <td>
                            - 캠퍼스별 그룹 스터디 <br />
                            - 반별 운영비 지원 <br />
                            - PSAT 대비 동영상 강의 지원 <br />
                            - 합격자 정기 간담회
                        </td>
                        <td class="noneright"></td>
                    </tr>

                </table>
            </div>
        </div>

    </div><!-- sub_section01 end -->
    <!------ 취업동아리 끝 ------>


    <!------ 현장실습 시작 ------>
    <div class="sub_section02 sub-hide">

        <!-- 상단 탑 배너 -->
        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <h2>진로탐색의 기회 현장실습</h2>
                <p>재학생과 졸업생에게 진로탐색 기회 제공을 위해 「현장실습 프로그램」을 운영합니다.</p>
                <p>참가학생은 현장실무 및 교육 등 다양한 기업 업무를 체험하고,</p>
                <p>업무에 대한 이해의 폭을 넓혀 취업 준비에 있어 경쟁력을 높힐 수 있도록 지원하고 있습니다.</p>
            </div>
            <div class="top_tab">
                <h2>진로탐색의 기회 현장실습</h2>
                <p>재학생과 졸업생에게 진로탐색 기회 제공을 위해 「현장실습 프로그램」을 운영합니다.
                    참가학생은 현장실무 및 교육 등 다양한 기업 업무를 체험하고,
                    업무에 대한 이해의 폭을 넓혀 취업 준비에 있어 경쟁력을 높힐 수 있도록 지원하고 있습니다.</p>
            </div>
            <div class="top_m">
                <h2>진로탐색의 기회 현장실습</h2>
                <p>재학생과 졸업생에게 진로탐색 기회 제공을 위해 「현장실습 프로그램」을 운영합니다.
                    참가학생은 현장실무 및 교육 등 다양한 기업 업무를 체험하고,
                    업무에 대한 이해의 폭을 넓혀 취업 준비에 있어 경쟁력을 높힐 수 있도록 지원하고 있습니다.
                </p>
            </div>
        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">기업현장체험 프로그램</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>재학생 및 졸업생들에게 현장 실습을 통한 실무 경험 기회 제공으로,</p>
                <p>취업 역량개발을 위한 기업현장체험 프로그램 실시, 신청 시기별 취업지원실 홈페이지 공지</p>
            </div>

            <div class="content_table scroll_table_box pdt30">
                <table class="top_gray_table">
                    <tr>
                        <th>신청대상</th>
                        <th>신청 및 근무기간</th>
                        <th>비고</th>
                    </tr>
                    <tr>
                        <td class="centertxt">졸업자 및 졸업예정자</td>
                        <td>
                            - 하계 : 6월초 (7~8월) <br />
                            - 동계 : 12월초 (1~2월) <br />
                            ※ 향후 변동 가능
                        </td>
                        <td class="noneright">
                            - 학점인정 불가 <br />
                            - 연수지원금 지급 <br />
                            - 취업지원실 홈페이지 공지사항 참조
                        </td>
                    </tr>

                </table>
            </div>

        </div>


        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">학점제 장기 현장실습</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>재학생에게 장기 현장실습을 통한 취업경쟁력 강화 및 학점 인정을 위한 프로그램 운영</p>
                <p>※ 방학 중 진행하는 단기 현장실습은 「현장실습지원센터(051-200-6222 ~ 4)」로 문의바람</p>
                <p>- 신청 및 학점인정 절차</p>
            </div>

            <div class="pdt30 content_imgwrap">
                <img class="top_pc" src="/img/sub104002_img01.png" alt="단계이미지" style="max-width: 1140px;">
                <img class="top_tab" src="/img/sub104002_img01_t.png" alt="단계이미지">
                <img class="top_m" src="/img/sub104002_img01_m.png" alt="단계이미지">
            </div>

            <div class="content_basic_txt_wrap">
                <p>※ 학점인정 가능 이수구분</p>
                <p>- 단일: 전공선택 18학점 / 대체: 18학점 이내 수강신청 가능 교과목</p>
            </div>
        </div>

    </div>
    <!------ 현장실습 끝 ------>



    <!------ 취업교과목 시작 ------>
    <div class="sub_section03 sub-hide">

        <!-- 상단 탑 배너 -->
        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <h2>NCS직업기초능력평가 및 적무적성검사 문제풀이반</h2>
                <p>변화하는 취업 시장에 발빠르게 대응하기 위한 취업교과목을 운영합니다.</p>
                <P>NCS직업기초능력평가와 직무적성검사의 중요도가 점차 증가함에 따라</P>
                <P>효과적인 취업준비를 위하여 각 영역별 실전문제 및 문제풀이방법을 학습할 수 있도록 지원하고 있습니다.</P>
            </div>
            <div class="top_tab">
                <h2>NCS직업기초능력평가 및 적무적성검사 문제풀이반</h2>
                <p>변화하는 취업 시장에 발빠르게 대응하기 위한 취업교과목을 운영합니다.
                    NCS직업기초능력평가와 직무적성검사의 중요도가 점차 증가함에 따라
                    효과적인 취업준비를 위하여 각 영역별 실전문제 및 문제풀이방법을 학습할 수 있도록 지원하고 있습니다.</P>
            </div>
            <div class="top_m">
                <h2>NCS직업기초능력평가 및 적무적성검사 문제풀이반</h2>
                <p>변화하는 취업 시장에 발빠르게 대응하기 위한 취업교과목을 운영합니다.
                    NCS직업기초능력평가와 직무적성검사의 중요도가 점차 증가함에 따라
                    효과적인 취업준비를 위하여 각 영역별 실전문제 및 문제풀이방법을 학습할 수 있도록 지원하고 있습니다.</P>
            </div>

        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">수업 개요</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>재학생 및 졸업생들에게 현장 실습을 통한 실무 경험 기회 제공으로,</p>
                <p>취업 역량개발을 위한 기업현장체험 프로그램 실시, 신청 시기별 취업지원실 홈페이지 공지</p>
            </div>

            <div class="content_table scroll_table_box pdt30">
                <table class="top_gray_table">
                    <tr>
                        <th>교과목명</th>
                        <th>대상</th>
                        <th>장소</th>
                        <th>강의 시간</th>
                        <th>학점</th>
                        <th>이수구분</th>
                    </tr>
                    <tr>
                        <td class="centertxt">취업경력개발 및 진로설정 (FRE008)</td>
                        <td class="centertxt">전체</td>
                        <td class="centertxt">학기별 변동</td>
                        <td class="centertxt">학기별 변동</td>
                        <td class="centertxt">학기별 변동</td>
                        <td class="noneright centertxt">자유선택</td>
                    </tr>

                </table>
            </div>

        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">교육 프로그램 (상세 커리큘럼 변경가능)</div>
            </div>

            <div class="content_table scroll_table_box pdt30">
                <table class="top_gray_table">
                    <tr>
                        <th>주차</th>
                        <th>강의제목</th>
                        <th>주차</th>
                        <th>강의제목</th>
                    </tr>
                    <tr>
                        <td class="centertxt wd15">1</td>
                        <td class="centertxt wd35">오버뷰(기업 필기전형의 이해) 직무적성검사 수리1 유형분석 및 핵심문제풀이</td>
                        <td class="centertxt wd15">9</td>
                        <td class="centertxt wd35 noneright">NCS기반 채용 Process & Overview</td>
                    </tr>
                    <tr>
                        <td class="centertxt wd15">2</td>
                        <td class="centertxt wd35">추석</td>
                        <td class="centertxt wd15">10</td>
                        <td class="centertxt wd35 noneright">수리능력2 유형 분석 및핵심문제 풀이</td>
                    </tr>
                    <tr>
                        <td class="centertxt wd15">3</td>
                        <td class="centertxt wd35">직무적성검사 수리2 유형분석 및 핵심문제풀이</td>
                        <td class="centertxt wd15">11</td>
                        <td class="centertxt wd35 noneright">의사소통능력 유형 분석 및 핵심문제풀이</td>
                    </tr>
                    <tr>
                        <td class="centertxt wd15">4</td>
                        <td class="centertxt wd35">직무적성검사 수리3 유형분석 및 핵심문제풀이</td>
                        <td class="centertxt wd15">12</td>
                        <td class="centertxt wd35 noneright">문제해결능력1 유형 분석 및 핵심문제풀이</td>
                    </tr>
                    <tr>
                        <td class="centertxt wd15">5</td>
                        <td class="centertxt wd35">직무적성검사 공간지각 유형분석 및 핵심문제풀이</td>
                        <td class="centertxt wd15">13</td>
                        <td class="centertxt wd35 noneright">문제해결능력2 유형 분석 및 핵심문제풀이</td>
                    </tr>
                    <tr>
                        <td class="centertxt wd15">6</td>
                        <td class="centertxt wd35">직무적성검사 언어 유형분석 및 핵심문제풀이</td>
                        <td class="centertxt wd15">14</td>
                        <td class="centertxt wd35 noneright">조직이해능력. 대인관계능력 유형 분석 및 핵심문제풀이</td>
                    </tr>
                    <tr>
                        <td class="centertxt wd15">7</td>
                        <td class="centertxt wd35">직무적성검사 추리 유형분석 및 핵심문제풀이</td>
                        <td class="centertxt wd15">15</td>
                        <td class="centertxt wd35 noneright">자원관리능력. 정보. 기술능력 유형 분석 및 핵심문제풀이</td>
                    </tr>

                    <tr>
                        <td class="centertxt wd15">8</td>
                        <td class="centertxt wd35">중간고사 - 대기업 직무적성 진단검사</td>
                        <td class="centertxt wd15">16</td>
                        <td class="centertxt wd35 noneright">기말고사 - NCS직업기초능력평가 진단검사</td>
                    </tr>

                </table>
            </div>


        </div>

    </div>
    <!------ 취업교과목 끝 ------>



    <!------ 경력개발프로그램 시작 ------>
    <div class="sub_section04 sub-hide">

        <!-- 상단 탑 배너 -->
        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <h2>직무별 맞춤형 경력개발 프로그램</h2>
                <p>직무별 맞춤형 경력개발 프로그램을 운영합니다.</P>
                <p>하계, 동계 방학기간을 통해 다양한 실무자 양성과정 및 자격증 취득과정을 개설하여 학업뿐만 아니라</P>
                <p>실질적인 직무에 대한 역량을 기를 수 있도록 단기 집중 교육을 실시하고 있습니다.</P>
            </div>
            <div class="top_tab">
                <h2>직무별 맞춤형 경력개발 프로그램</h2>
                <p>직무별 맞춤형 경력개발 프로그램을 운영합니다.
                    하계, 동계 방학기간을 통해 다양한 실무자 양성과정 및 자격증 취득과정을 개설하여 학업뿐만 아니라
                    실질적인 직무에 대한 역량을 기를 수 있도록 단기 집중 교육을 실시하고 있습니다.</P>
            </div>
            <div class="top_m">
                <h2>직무별 맞춤형 경력개발 프로그램</h2>
                <p>직무별 맞춤형 경력개발 프로그램을 운영합니다.
                    하계, 동계 방학기간을 통해 다양한 실무자 양성과정 및 자격증 취득과정을 개설하여 학업뿐만 아니라
                    실질적인 직무에 대한 역량을 기를 수 있도록 단기 집중 교육을 실시하고 있습니다.</P>
            </div>

        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">실무자 양성과정(방학중 개설)</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>현직 근무자들의 생생한 실무 경험을 간접적으로 체험하고 실습 · 강의를 통해 분야별 업무에 대한 이해도를 높일 수 있습니다.</p>
                <p>수강자에게는 교육 종료 후 교육 수료증을 발급합니다.</p>
            </div>

            <div class="color_bg_box_wrap pdt30">
                <div class="blue_bg_wrap">
                    <div class="head_title">2020학년도 실무자 양성과정</div>
                    <div class="middle_title">연간 1,400명 규모</div>
                </div>
                <div class="gray_bg_wrap">
                    <p>
                        설비기술실무자양성과정 | 품질관리실무자양성과정 | 구글애널리틱스실무자양성과정 | 스마트팩토리실무자양성과정 | 항만물류실무자양성과정 |
                        금융실무자양성과정 | 인사총무실무자양성과정 | 반도체실무자양성과정 | 조선해양플랜트실무자양성과정 | 영업유통실무자양성과정 |
                        품질실무자양성과정 | 생산관리실무자양성과정 | 해외영업실무자양성과정 | 전략마케팅실무자양성과정 | 유튜브실무자양성과정 |
                        서비스매니저양성과정 I 마케팅실무자양성과정 I 재무회계실무자양성과정 I 전략기획실무자양성과정 I 노무관리실무자양성과정 I
                        기업자금관리실무자양성과정 I 연구개발실무자양성과정 I 서비스경영실무자양성과정 I 빅데이터실무자양성과정
                    </p>
                    <br />
                    <p><span class="skyblue_txt">* 재학생 교육수요조사 결과에 따른 개설과정 변경 가능</span></p>
                </div>
            </div>
        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">자격증 취득과정 (방학중 개설)</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>직무별 취업에 필수적인 핵심 자격증 강좌를 수강할 수 있는 기회를 제공합니다.</p>
            </div>

            <div class="color_bg_box_wrap pdt30">
                <div class="blue_bg_wrap">
                    <div class="head_title">2020학년도 자격증 취득과정</div>
                    <div class="middle_title">연간 700명 규모</div>
                </div>
                <div class="gray_bg_wrap">
                    <p>
                        마케팅조사분석사 I 엑셀데이터자격과정 I 6시그마자격과정 I 비즈니스엑셀과정 I 구글관련자격과정 I
                        일반기계기사자격증과정 I 전기기사자격증과정 I 품질경영기사자격증과정 I 산업안전기사자격증과정 I
                        대기환경기사자격증과정 I 건축설비기사자격증과정 I 토목기사자격증과정 I 화공기사자격증과정 I
                        투자자산운용사자격증과정 I 재무위험관리사자격증과정 I 금융투자분석사자격증과정 I AFPK자격증과정 I
                        CFP자격증과정 I ERP정보관리사자격증과정 I 회계 1급 자격증과정 I ERP정보관리사 인사 1급 자격증과정 I
                        종합반 ERP정보관리사 생산 1급 자격증과정 I ERP정보관리사 물류 1급 I
                        IFRS관리사 자격증과정 ADsP(데이터분석준전문가)자격증과정 I PCM Marketing Management 자격증과정 I
                        Google AdWords(Search+Display)자격증 과정
                    </p>
                    <br />
                    <p><span class="skyblue_txt">*재학생 교육수요조사 결과에 따른 개설 과정 변경 가능</span></p>
                </div>
            </div>
        </div>

        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">취업역량 강화 프로그램 (연중상시)</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>자기소개서, 직무적성검사, 면접 등 채용절차별 교육을 통해 학생들의 취업역량강화에 힘쓰고 있습니다.</p>
                <p>그 밖에 유명강사 초청특강 등을 상시로 개최하여 최신 취업정보를 학생들에게 제공하고 있습니다.</p>
            </div>

            <div class="color_bg_box_wrap pdt30">
                <div class="blue_bg_wrap">
                    <div class="head_title">2020학년도 취업역량강화 프로그램</div>
                    <div class="middle_title">연간 1,000명 규모</div>
                </div>
                <div class="gray_bg_wrap">
                    <p>
                        입사지원서 컨설팅 I 직무적성검사 집중교육 I 모의 직무적성검사 I 면접스피치 집중교육 I 스타강사 초청 취업특강
                    </p>
                </div>
            </div>
        </div>


    </div>
    <!------ 경력개발프로그램 끝 ------>


    <!------ 채용박람회 설명회 시작 ------>
    <div class="sub_section05 sub-hide">

        <!-- 상단 탑 배너 -->
        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <h2>동아인을 위한 취업박람회 및 설명회</h2>
                <p>동아인을 위한 취업박람회 및 설명회, 상담회를 운영합니다.</P>
                <p>채용 예정이 있는 기업들을 초청하여 박람회 및 설명회를 개최하여 이를 통한 다양한 채용 정보를 제공하며,</P>
                <p>상담회를 통해 보다 깊이있는 기업 정보 및 채용 정보를 제공하여 보다 효율적인 취업준비를 할 수 있도록 지원하고 있습니다.</P>
            </div>
            <div class="top_tab">
                <h2>동아인을 위한 취업박람회 및 설명회</h2>
                <p>동아인을 위한 취업박람회 및 설명회, 상담회를 운영합니다.
                    채용 예정이 있는 기업들을 초청하여 박람회 및 설명회를 개최하여 이를 통한 다양한 채용 정보를 제공하며,
                    상담회를 통해 보다 깊이있는 기업 정보 및 채용 정보를 제공하여 보다 효율적인 취업준비를 할 수 있도록 지원하고 있습니다.</P>
            </div>
            <div class="top_m">
                <h2>동아인을 위한 취업박람회 및 설명회</h2>
                <p>동아인을 위한 취업박람회 및 설명회, 상담회를 운영합니다.
                    채용 예정이 있는 기업들을 초청하여 박람회 및 설명회를 개최하여 이를 통한 다양한 채용 정보를 제공하며,
                    상담회를 통해 보다 깊이있는 기업 정보 및 채용 정보를 제공하여 보다 효율적인 취업준비를 할 수 있도록 지원하고 있습니다.</P>
            </div>

        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">채용박람회</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>학기마다 개최되는 동아대학교 채용박람회는 실제 채용 예정에 있는 지역의 우수 기업들을 초청하여 현장에서 면접을 진행합니다.</p>
                <p>매년 약 50명의 학생들이 박람회를 통해 사회로 진출하는 최고의 구직 기회인 동아대학교만의 채용박람회에 꼭 참석해보시길 바랍니다.</p>
                <p>매년 1~2회 개최되며, 참가기업 및 세부행사는 개최 2 ~ 3주 전 홈페이지 공지사항을 통해 확인할 수 있습니다.</p>
            </div>

            <div class="content_table scroll_table_box pdt30">
                <p class="blue_txt">- 최근 3년(2015~2017년) 채용박람회 세부내용</p>
                <table class="top_gray_table">
                    <tr>
                        <th>행사명</th>
                        <th>참가인원</th>
                        <th>참가기업 및 행사내용</th>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">채용면접</td>
                        <td class="centertxt">674명</td>
                        <td class="centertxt noneright">화승그룹, 창신INC, 경동건설 등 지역우수기업 10개 참가</td>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">부대행사</td>
                        <td class="centertxt">2,003명</td>
                        <td class="centertxt noneright">증명사진 촬영, 이미지메이킹, 이력서컨설팅 등 5개 행사 실시</td>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">설명회 및 특강</td>
                        <td class="centertxt">1,844명</td>
                        <td class="centertxt noneright">부산은행, 에어부산, 창신INC 등 지역 우수기업 합동설명회 실시</td>
                    </tr>
                </table>
            </div>

        </div>


        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">채용설명회</div>
            </div>
            <div class="content_basic_txt_wrap">
                <p>기업의 채용정보 전달을 위하여 인사담당자 및 재직자들이 직접 학교를 방문하여 동아인을 만납니다.</p>
                <p>매년 상시, 기업의 요청 및 채용일정에 따라 개최 일자가 결정되며, 모든 설명회는 학교 또는 취업지원실 홈페이지 게시판을 통해 공지됩니다.</p>
                <p>대다수의 행사는 별도의 신청 없이 참가할 수 있습니다.</p>
            </div>

        </div>


        <div class="sub_container_wrap pdt50">
            <div class="bullet_content_wrap">
                <div class="bullet_title">채용상담회</div>
            </div>

            <div class="content_basic_txt_wrap">
                <p>채용상담회(리크루팅)는 평소 궁금했던 점과 준비해온 자료를 확인하고 점검받을 수 있는 기회로</p>
                <p>인사담당자 또는 모교를 졸업한 재직 선배에게 1:1 또는 2:1 상담을 받을 수 있습니다.</p>
                <p>공지를 수시로 확인하여 참가하면 희망해온 회사와의 첫 인연을 만드는 자리가 될 수 있을 것입니다.</p>
            </div>

            <div class="content_table scroll_table_box pdt30">
                <p class="blue_txt">- 연간 채용설명회 및 상담회 개최 현황</p>
                <table class="top_gray_table">
                    <tr>
                        <th class="wd15">연도</th>
                        <th class="wd15">개최횟수</th>
                        <th class="wd15">참가인원</th>
                        <th class="wd55">주요 참가기업</th>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">2017년</td>
                        <td class="centertxt ">44회</td>
                        <td class="centertxt ">3,730명</td>
                        <td class="centertxt noneright">삼성전자, 롯데그룹, 기업은행, 대흥알앤티 등 43개 기업</td>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">2018년</td>
                        <td class="centertxt ">46회</td>
                        <td class="centertxt ">3,273명</td>
                        <td class="centertxt noneright">삼성전자, 롯데그룹, 에스엘, 대우조선해양 등 42개 기업</td>
                    </tr>
                    <tr>
                        <td class="centertxt graybg">2019년</td>
                        <td class="centertxt ">45회</td>
                        <td class="centertxt ">3,213명</td>
                        <td class="centertxt noneright">삼성전자, 롯데그룹, 우리은행, 유니클로 등 44개 기업</td>
                    </tr>
                </table>
            </div>


        </div>

    </div>
    <!------ 채용박람회 설명회 끝 ------>




    <!------ 재직선배초청교육 시작 ------>
    <div class="sub_section06 sub-hide">

        <!-- 상단 탑 배너 -->
        <div class="sub_topbanner_wrap">
            <div class="top_pc">
                <h2>재직선배 초청교육</h2>
                <p>다양한 분야에서 근무하는 재직선배를 초청하여 다양한 교육을 운영합니다.</P>
                <p>선배들의 취업준비방법, 실무경험 등 취업에 대한 다양한 경험담을 공유할 수 있도록</P>
                <p>재직중인 선배들을 초청하여 소통할 수 있는 교육을 진행을 진행하고 있습니다.</P>
            </div>
            <div class="top_tab">
                <h2>재직선배 초청교육</h2>
                <p>다양한 분야에서 근무하는 재직선배를 초청하여 다양한 교육을 운영합니다.
                    선배들의 취업준비방법, 실무경험 등 취업에 대한 다양한 경험담을 공유할 수 있도록
                    재직중인 선배들을 초청하여 소통할 수 있는 교육을 진행을 진행하고 있습니다.</P>
            </div>
            <div class="top_m">
                <h2>재직선배 초청교육</h2>
                <p>다양한 분야에서 근무하는 재직선배를 초청하여 다양한 교육을 운영합니다.
                    선배들의 취업준비방법, 실무경험 등 취업에 대한 다양한 경험담을 공유할 수 있도록
                    재직중인 선배들을 초청하여 소통할 수 있는 교육을 진행을 진행하고 있습니다.</P>
            </div>

        </div>

        <div class="sub_container_wrap">
            <div class="bullet_content_wrap">
                <div class="bullet_title">최근 3년간 재직선배 및 서류합격자 면접교육 참가자 현황</div>
            </div>
            <div class="content_right_txt_wrap">
                <ul>
                    <li class="bule_bullet_txt">재직선배 초청교육</li>
                    <li class="black_bullet_txt">서류합격자 면접교육</li>
                </ul>
            </div>

            <div class="content_imgwrap pdt50">
                <div class="top_pc"><img src="/img/sub104006_img01.png" alt="그래프"></div>
                <div class="top_tab"><img src="/img/sub104006_img01_t.png" alt="그래프"></div>
                <div class="top_m"><img src="/img/sub104006_img01_m.png" alt="그래프"></div>
            </div>

        </div>


    </div>
    <!------ 재직선배초청교육 끝 ------>


</div>{{-- //.sub-content end --}}




    <script>
        document.querySelector('.subtab_menu_wrap ul').addEventListener('click', function (e) {
            menuActive(this, e.target.dataset.order);
            menuOpen(e.target.dataset.order);
        });

        function menuActive(t, order) {
            var targets = t.children;
            // console.log( t, order );
            for (var i = 0; i < targets.length; i++) {
                if (i == order) {
                    targets[i].classList.add('on');
                    continue;
                }

                targets[i].classList.remove('on');
            }
        }

        function menuOpen(order) {
            var targets = [
                document.querySelector('.sub_section01'),
                document.querySelector('.sub_section02'),
                document.querySelector('.sub_section03'),
                document.querySelector('.sub_section04'),
                document.querySelector('.sub_section05'),
                document.querySelector('.sub_section06')
            ];

            for (var i = 0; i < targets.length; i++) {
                if (i == order) {
                    targets[i].classList.add('sub-view');
                    continue;
                }

                targets[i].classList.remove('sub-view');
                targets[i].classList.add('sub-hide');
            }
        }
    </script>









@endsection
