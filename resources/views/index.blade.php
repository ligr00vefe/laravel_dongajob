@extends("layouts/layout")

@section("title")
    메인
@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript" src="/js/slick.min.js"></script>
    <script defer src="/js/main/main.js"></script>

    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script type="text/javascript">
        if(!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "1306d69ce6a7200";
        if(window.wcs) {
            wcs_do();
        }
    </script>

@endpush
@php
    $major_menu = "";
    $minor_menu = "";
    $category_list = get_main_notice_category();
@endphp

@section("content")
    @include('popup', ['lists' => $popups]);
    <div class="main-contents">
        <div class="main01 container-wrap">
            <div class="main-con con-wider">
                <div class="con-inner main01-link-01">
                    <ul>
                        <li>
                            <a href="https://rapo.donga.ac.kr" target="_blank">
                                <div class="mlink-icon"><img src="/img/main01_icon01.png" alt="메인 링크 아이콘01"></div>
                                <span class="mlink-tit">취업상담 신청</span>
                            </a>
                        </li>
                        <li>
                            <a href="/program/receipt">
                                <div class="mlink-icon"><img src="/img/main01_icon02.png" alt="메인 링크 아이콘02"></div>
                                <span class="mlink-tit">프로그램 접수</span>
                            </a>
                        </li>
                        <li>
                            <a href="/studyroom">
                                <div class="mlink-icon"><img src="/img/main01_icon03.png" alt="메인 링크 아이콘03"></div>
                                <span class="mlink-tit">스터디룸 예약</span>
                            </a>
                        </li>
                        <li>
                            <a href="/online/toeic">
                                <div class="mlink-icon"><img src="/img/main01_icon04.png" alt="메인 링크 아이콘04"></div>
                                <span class="mlink-tit">토익/토익스피킹 할인접수</span>
                            </a>
                        </li>
                        <li>
                            <a href="/online/jobplanet">
                                <div class="mlink-icon"><img src="/img/main01_icon05.png" alt="메인 링크 아이콘05"></div>
                                <span class="mlink-tit">잡플래닛</span>
                            </a>
                        </li>
                        <li>
                            <a href="/online/checkup">
                                <div class="mlink-icon"><img src="/img/main01_icon06.png" alt="메인 링크 아이콘06"></div>
                                <span class="mlink-tit">진로 진단검사 <p>(아우란트/에듀스)</p></span>
                            </a>
                        </li>
                        <li>
                            <a href="/online/onlinelecture">
                                <div class="mlink-icon"><img src="/img/main01_icon07.png" alt="메인 링크 아이콘07"></div>
                                <span class="mlink-tit">기업 인적성 특강 <p>(위포트)</p></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://daitdaa.donga.ac.kr/" target="_blank">
                                <div class="mlink-icon"><img src="/img/main01_icon08.png" alt="메인 링크 아이콘08"></div>
                                <span class="mlink-tit">온라인 멘토링 <p>(다잇다)</p></span>
                            </a>
                        </li>
                        <li>
                            <a href="/online/ai">
                                <div class="mlink-icon"><img src="/img/main01_icon09.png" alt="메인 링크 아이콘09"></div>
                                <span class="mlink-tit">AI 자기소개서 <p>(에듀스)</p></span>
                            </a>
                        </li>
                        <li>
                            <a href="/jobinfo/recommend">
                                <div class="mlink-icon"><img src="/img/main01_icon10.png" alt="메인 링크 아이콘10"></div>
                                <span class="mlink-tit">취업추천 채용</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="con-inner main01-list-01">
                    <div class="main-list list-support_notice">
                        <div class="support-notice-title">
                            <a href="/program/notice">
                            <h1>취업지원실 공지사항</h1>
                            </a>
                        </div>

                        <div class="mlist-tab mlist-tab01">
                            <div class="mlist-tab_re">전체</div>
                            <ul>
                                @foreach($category_list as $key => $val)
                                    <li class="{{ $key == 10 ? 'on' : '' }}">
                                        <a href="javascript:void(0)" data-id="{{ $key }}">{{ $val }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <ol class="tab-list tab-list01">
                        </ol>
                    </div>
                </div>
            </div>{{-- //.con-wider end --}}


            <div class="main-con con-smaller">
                <div class="con-inner main01-link-02">
                    <div class="mlink-banner">
                        <div class="banner-link">
                            <a href="/program/schedule">취업지원실 주요일정 <img class="plus_icon" src="/img/plus_icon.png" alt="링크 플러스 아이콘"></a>
                            <a href="https://www.saramin.co.kr/zf_user/calendar" target="_blank">사람인 공채달력 <img class="plus_icon" src="/img/plus_icon.png" alt="링크 플러스 아이콘"></a>
                        </div>
                    </div>

                    <div class="mlink-btn">
                        <div class="mbtn-tit">워크넷 직업/진로정보</div>
                        <ul class="mbtn-wrap">
                            <li>
                                <a href="/course/employment">
                                    <div class="mbtn-icon">
                                        <img src="/img/main02_icon01.png" alt="메인 링크 아이콘 11">
                                    </div>
                                    <span class="mlink-tit">채용정보</span>
                                </a>
                            </li>
                            <li>
                                <a href="/course/jobsrch">
                                    <div class="mbtn-icon"><img src="/img/main02_icon02.png" alt="메인 링크 아이콘 12"></div>
                                    <span class="mlink-tit">직업정보</span>
                                </a>
                            </li>
                            <li>
                                <a href="/course/majorsrch">
                                    <div class="mbtn-icon"><img src="/img/main02_icon03.png" alt="메인 링크 아이콘 13"></div>
                                    <span class="mlink-tit">학과정보</span>
                                </a>
                            </li>
                            <li>
                                <a href="/course/guide" target="_blank">
                                    <div class="mbtn-icon"><img src="/img/main02_icon04.png" alt="메인 링크 아이콘 14"></div>
                                    <span class="mlink-tit">직무별 자소서가이드</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>{{-- //.con-smaller end --}}
        </div>{{-- //.main01 end --}}

        <div class="main02 container-wrap">

            <div class="main-con con-wider">
                <div class="con-inner main02-list-01">
                    <div class="main-list list-review">
{{--                        <a href="/archive/reviewlatest'" class="more-btn">MORE +</a>--}}
                        <div class="mlist-tab mlist-tab02">
                            <div class="mlist-tab_re">취업수기</div>
                            <ul>
                                <li class="on"><a href="javascript:void(0)" data-category="reviewlatest">취업수기</a></li>
                                <li><a href="javascript:void(0)" data-category="reviewparticipate">프로그램 참여후기</a></li>
                            </ul>
                        </div>

                        <ol class="tab-list tab-list02">
                        </ol>
                    </div>
                </div>{{-- //.con-inner--}}
            </div>{{-- //.con-wider end --}}

            <div class="main-con con-smaller">
                <div class="con-inner main02-link-01" style="background:url(/img/main02_banner_bg.png) no-repeat bottom center / cover;">
                    <a href="/course/jobpsyexam" class="mlink-btn" >
                        <div class="text-wrap">
                            <h2>직업 심리검사</h2>
                            <p>직업적성검사, 직업선호도 검사</p>
                            <p>구직준비도검사, 대학생 진로준비도검사 등</p>
                            <p>취업에 관련된 검사를 진행해보세요</p>
                        </div>
                    </a>
                </div>
            </div>{{-- //.con-smaller end --}}

        </div>{{-- //.main02 end --}}

        <div class="main03 container-wrap">
            <div class="main03-tab_re">
                <ul>
                    <li><a href="javascript:void(0)" rel="con01">채용정보</a></li>
                    <li><a href="javascript:void(0)" rel="con02">추천 채용공고</a></li>
                    <li><a href="javascript:void(0)" rel="con03">각종활동</a></li>
                </ul>
                <div class="under_bar"></div>
            </div>
            <div class="main-con con01">
                <div class="img-wrap">
                    <a href="/jobinfo/normal">
                        <img src="/img/main03_icon01.png" alt="채용정보 아이콘" class="icon-img">
                    </a>
                    <h2>일반정보</h2>
                </div>
                <div class="list-wrap">
                    <ul>
                    </ul>
                </div>
            </div>{{-- //.main-con.con01 end --}}

            <div class="main-con con02">
                <div class="img-wrap">
                    <a href="/jobinfo/recommend">
                        <img src="/img/main03_icon02.png" alt="추천 채용공고 게시판 아이콘" class="icon-img">
                    </a>
                    <h2>추천 채용공고</h2>
                </div>
                <div class="list-wrap">
                    <ul>
                    </ul>
                </div>
            </div>{{-- //.main-con.con02 end --}}

            <div class="main-con con03">
                <div class="img-wrap">
                    <a href="/jobinfo/activity">
                        <img src="/img/main03_icon03.png" alt="각종활동 게시판 아이콘" class="icon-img">
                    </a>
                    <h2>각종활동</h2>
                </div>
                <div class="list-wrap">
                    <ul>
                    </ul>
                </div>
            </div>{{-- //.main-con.con03 end --}}
        </div>{{-- //.main03 end --}}


        <div class="main04 container-wrap">
            <div class="main-con">
                <div id="main04-slider">
                    <div class="slick-slide"><img src="/img/main04_img01.png" alt="협력사 로고 이미지01" class="slide-img"></div>
                    <div class="slick-slide"><img src="/img/main04_img02.png" alt="협력사 로고 이미지02" class="slide-img"></div>
                    <div class="slick-slide"><img src="/img/main04_img03.png" alt="협력사 로고 이미지03" class="slide-img"></div>
                    <div class="slick-slide"><img src="/img/main04_img04.png" alt="협력사 로고 이미지04" class="slide-img"></div>
                    <div class="slick-slide"><img src="/img/main04_img05.png" alt="협력사 로고 이미지05" class="slide-img"></div>
                    <div class="slick-slide"><img src="/img/main04_img06.png" alt="협력사 로고 이미지06" class="slide-img"></div>
                    <div class="slick-slide"><img src="/img/main04_img07.png" alt="협력사 로고 이미지07" class="slide-img"></div>
                    <div class="slick-slide"><img src="/img/main04_img08.png" alt="협력사 로고 이미지08" class="slide-img"></div>
                    <div class="slick-slide"><img src="/img/main04_img09.png" alt="협력사 로고 이미지09" class="slide-img"></div>
                </div>
            </div>
        </div>{{-- //.main04 end --}}

    </div>{{-- //.main-contents end --}}

@endsection




