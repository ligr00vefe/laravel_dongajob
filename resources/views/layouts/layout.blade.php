<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>동아대 취업지원실 | @yield("title", "main")</title>


    <meta name="description" content="동아대학교 취업지원실">
    <meta name="keywords" content="동아대학교 취업지원실">
    <meta name="nationality" content="korean">
    <meta property="og:locale" content="ko_KR">
    <meta property="og:site_name" content="동아대학교 취업지원실">
    <meta property="og:url" content="https://job.donga.ac.kr">
    <meta property="og:type" content="website">
    <meta property="og:title" content="동아대학교 취업지원실">
    <meta property="og:description" content="동아대학교 취업지원실">
    <meta property="og:image" content="/images/logo.png">
    <meta name="twitter:title" content="동아대학교 취업지원실">
    <meta name="twitter:description" content="동아대학교 취업지원실">
    <meta name="twitter:image" content="/images/logo.png">


    <link rel="stylesheet" href="/css/import.css">
    <link rel="stylesheet" href="/css/modal.css">
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/slick-theme.css">
    <script src="/lib/jquery-3.5.1.min.js"></script>
    <script defer src="/js/common.js"></script>
    <script src="{{ asset('/lib/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/UploadAdaptor.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    @stack('scripts')
</head>
<body>
@php
    $bri_menu = json_decode(file_get_contents('./lib/bri_menu'), 1);
@endphp

@if(session('status'))
    <script>alert('{{ session('status') }}')</script>
@elseif(session('success'))
    <script>alert('{{ session('success') }}')</script>
@elseif(session('error'))
    <script>alert('{{ session('error') }}')</script>
@endif

<div id="app">
    <!--.pop-up-->
    @if(!Cookie::get('pop-reject-time'))
        <div id="top-pop-up">
            <div class="pop-content container__wr_1200">
                <span>해당 사이트는 Chrome에 적합한 사이트입니다. 다른 브라우저 사용시 제한이 있을 수 있습니다.</span>
                <div class="pop-btn">
                    <input type="checkbox" id="pop-reject-time">
                    <label for="pop-reject-time">오늘 하루 열지 않음</label>
                    <img class="pop-close-btn" src="/img/close_btn.gif" alt="">
                </div>
            </div><!-- .pop-content end -->
        </div><!-- #top-pop-up end -->
    @endif

    <!--head-->
    <header id="header">
        <div class="hd-nav">
            <div class="hd-logo">
                <a href="/">
                    <img src="/img/logo.png" alt="동아대 취업지원실 로고">
                </a>
            </div>
            <div class="hd-login">
                <ul>
                    <li>
                        @if(session()->get('login_check'))
                            <a href="/logout">로그아웃</a>
                        @else
                            <a href="/login">로그인</a>
                        @endif
                    </li>

                    @if(isAdminCheck(session()->get('donga_type')))
                        @php
                            $admin_url = session()->get('level') == 1 ? ADMIN_URL  .get_admin_menu_route(explode(',', session()->get('menu'))[0]) : ADMIN_URL;
                        @endphp
                        <li><a href="/{{ $admin_url }}">관리자 접속</a></li>
                    @else
                        <li><a href="/mypage/recommend">MY PAGE</a></li>
                    @endif
                    <li class="login-link link01"><a href="https://www.donga.ac.kr/" target="_blank">동아대학교</a></li>
                    <li class="login-link link02"><a href="https://daitdaa.donga.ac.kr/" target="_blank">다잇다</a></li>
                    <li class="login-link link03"><a href="https://cafe.naver.com/specup" TARGET="_blank">스펙업</a></li>
                    <li class="login-link_re">
                        <div class="">관련사이트 <img src="/img/site_arrow.png" alt="관련사이트 화살표"></div>
                        <ol>
                            <li><a href="https://www.donga.ac.kr/" target="_blank">동아대학교</a></li>
                            <li><a href="https://daitdaa.donga.ac.kr/" target="_blank">다잇다</a></li>
                            <li><a href="https://cafe.naver.com/specup" target="_blank">스펙업</a></li>
                        </ol>
                    </li>
                </ul>
            </div>

            <div class="hd-menu">
                <ul>
                    <li>
                        <a href="/support/introduce"><b>취업지원실</b></a>
                        <div class="sub-menu">
                            <ol>
                                <li style="background:url(/img/emblem.png) no-repeat right bottom / 170px;">
                                    <div class="sub_menu_tit">취업지원실</div>
                                </li>
                                <li>
                                    <a href="/support/introduce" class="on">구성원소개 <img src="/img/sub_menu_arrow.png"
                                                                                       alt="서브메뉴 active-arrow"></a>
                                    <a href="/support/employmentinfo">취업프로그램 소개 <img src="/img/sub_menu_arrow.png"
                                                                                     alt="서브메뉴 active-arrow"></a>
                                </li>
                                <li>
                                    <a href="/support/location">찾아오시는 길 <img src="/img/sub_menu_arrow.png"
                                                                             alt="서브메뉴 active-arrow"></a>
                                    <a href="/support/qna">Q&A <img src="/img/sub_menu_arrow.png"
                                                                    alt="서브메뉴 active-arrow"></a>
                                </li>
                                <li>
                                    <a href="/support/educash">취업교육기금 <img src="/img/sub_menu_arrow.png"
                                                                           alt="서브메뉴 active-arrow"></a>
                                </li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <a href="/jobinfo/recommend"><b>채용정보</b></a>
                        <div class="sub-menu">
                            <ol>
                                <li style="background:url(/img/emblem.png) no-repeat right bottom / 170px;">
                                    <div class="sub_menu_tit">채용정보</div>
                                </li>
                                <li>
                                    <a href="/jobinfo/recommend">추천채용 <img src="/img/sub_menu_arrow.png"
                                                                           alt="서브메뉴 active-arrow"></a>
                                    <a href="/jobinfo/activity">각종활동 <img src="/img/sub_menu_arrow.png"
                                                                          alt="서브메뉴 active-arrow"></a>
                                </li>
                                <li>
                                    <a href="/jobinfo/donga300">동아친화기업 300 <img src="/img/sub_menu_arrow.png"
                                                                                alt="서브메뉴 active-arrow"></a>
                                    <a href="/jobinfo/pick">취업컨설턴트 PICK <img src="/img/sub_menu_arrow.png"
                                                                             alt="서브메뉴 active-arrow"></a>
                                </li>
                                <li>
                                    <a href="/jobinfo/normal">일반채용 <img src="/img/sub_menu_arrow.png"
                                                                        alt="서브메뉴 active-arrow"></a>
                                </li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <a href="/online/toeic"><b>온라인 취업컨텐츠</b></a>
                        <div class="sub-menu">
                            <ol>
                                <li style="background:url(/img/emblem.png) no-repeat right bottom / 170px;">
                                    <div class="sub_menu_tit">온라인 취업컨텐츠</div>
                                </li>
                                <li>
                                    <a href="/online/toeic">토익/토익스피킹 할인접수 <img src="/img/sub_menu_arrow.png"
                                                                               alt="서브메뉴 active-arrow"></a>
                                    <a href="/online/checkup">취업진로진단 검사(에듀스) <img src="/img/sub_menu_arrow.png"
                                                                                  alt="서브메뉴 active-arrow"></a>
                                </li>
                                <li>
                                    <a href="/online/onlinelecture">기업/직무/산업분석&인강(위포트) <img
                                            src="/img/sub_menu_arrow.png" alt="서브메뉴 active-arrow"></a>
                                    <a href="/online/jobplanet">잡플래닛 <img src="/img/sub_menu_arrow.png"
                                                                          alt="서브메뉴 active-arrow"></a>
                                </li>
                                <li>
                                    <a href="/online/ai">AI자기소개서 작성 및 평가(에듀스) <img src="/img/sub_menu_arrow.png"
                                                                                   alt="서브메뉴 active-arrow"></a>
                                </li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <a href="/program/notice"><b>취업지원실 프로그램</b></a>
                        <div class="sub-menu">
                            <ol>
                                <li style="background:url(/img/emblem.png) no-repeat right bottom / 170px;">
                                    <div class="sub_menu_tit">취업지원실 프로그램</div>
                                </li>
                                <li>
                                    <a href="/program/notice">공지사항 <img src="/img/sub_menu_arrow.png"
                                                                        alt="서브메뉴 active-arrow"></a>
                                    <a href="/program/schedule">주요일정 <img src="/img/sub_menu_arrow.png"
                                                                          alt="서브메뉴 active-arrow"></a>
                                </li>
                                <li>
                                    <a href="/program/receipt">프로그램 접수 <img src="/img/sub_menu_arrow.png"
                                                                            alt="서브메뉴 active-arrow"></a>
                                </li>
                                <li>
                                    <a href="/program/interview">서류합격자 면접교육 접수 <img src="/img/sub_menu_arrow.png"
                                                                                    alt="서브메뉴 active-arrow"></a>
                                </li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <a href="/archive/reviewlatest"><b>취업자료실</b></a>
                        <div class="sub-menu">
                            <ol>
                                <li style="background:url(/img/emblem.png) no-repeat right bottom / 170px;">
                                    <div class="sub_menu_tit">취업자료실</div>
                                </li>
                                <li><a href="/archive/reviewlatest">최신 취업수기 <img src="/img/sub_menu_arrow.png"
                                                                                 alt="서브메뉴 active-arrow"></a></li>
                                <li><a href="/archive/reviewbefore">이전 취업수기 <img src="/img/sub_menu_arrow.png"
                                                                                 alt="서브메뉴 active-arrow"></a></li>
                                <li><a href="/archive/reviewparticipate">프로그램 참여 후기 <img src="/img/sub_menu_arrow.png"
                                                                                         alt="서브메뉴 active-arrow"></a>
                                </li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <a href="https://rapo.donga.ac.kr" target="_blank"><b>취업상담</b></a>
                        <div class="sub-menu">
                            <ol>
                                <li style="background:url(/img/emblem.png) no-repeat right bottom / 170px;">
                                    <div class="sub_menu_tit">취업상담</div>
                                </li>
                                <li><a href="https://rapo.donga.ac.kr" target="_blank">취업상담 신청 <img
                                            src="/img/sub_menu_arrow.png" alt="서브메뉴 active-arrow"></a></li>
                                <li><a href="https://daitdaa.donga.ac.kr/" target="_blank">다잇다 <img
                                            src="/img/sub_menu_arrow.png" alt="서브메뉴 active-arrow"></a></li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <a href="/studyroom"><b>스터디룸 예약</b></a>
                        <div class="sub-menu">
                            <ol>
                                <li style="background:url(/img/emblem.png) no-repeat right bottom / 170px;">
                                    <div class="sub_menu_tit">스터디룸 예약</div>
                                </li>
                                <li><a href="/studyroom">스터디룸 예약 <img src="/img/sub_menu_arrow.png"
                                                                      alt="서브메뉴 active-arrow"></a></li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <a href=""><b>워크넷 직업/진로정보</b></a>
                        <div class="sub-menu">
                            <ol>
                                <li style="background:url(/img/emblem.png) no-repeat right bottom / 170px;">
                                    <div class="sub_menu_tit">워크넷 직업/진로정보</div>
                                </li>
                                <li>
                                    <a href="/course/employment">채용정보 <img src="/img/sub_menu_arrow.png" alt="서브메뉴 active-arrow"></a>
                                    <a href="/course/guide" target="_blank">직무별 자소서 가이드 <img src="/img/sub_menu_arrow.png" alt="서브메뉴 active-arrow"></a>
                                </li>
                                <li>
                                    <a href="/course/jobsrch">직업정보 <img src="/img/sub_menu_arrow.png" alt="서브메뉴 active-arrow"></a>
                                    <a href="/course/jobpsyexam">직업심리검사 <img src="/img/sub_menu_arrow.png" alt="서브메뉴 active-arrow"></a>
                                </li>
                                <li>
                                    <a href="/course/majorsrch">학과정보 <img src="/img/sub_menu_arrow.png" alt="서브메뉴 active-arrow"></a>
                                </li>
                            </ol>
                        </div>
                    </li>
                </ul>
                <div class="bar"></div>
            </div>{{-- //.hd-menu end --}}

            <div class="hd-btn">
                <a href="javascript:void(0)" class="menu-btn">
                    <div class="btn-bar bar01"></div>
                    <div class="btn-bar bar02"></div>
                    <div class="btn-bar bar03"></div>
                </a>
            </div><!-- .hd-btn end -->
        </div>{{-- //.hd-nav end --}}
    </header>

    <div class="hd-menu_re">
        <ul class="menu-1dp">
            @php
                for ($i = 0; $i < count($bri_menu['menu']); $i++) {
                    $var1 = $bri_menu['menu'][$i];

                    echo '<li>';
                    echo '<span class="menu-name">' . $var1['name'] . '<img src="/img/re_sub_menu_arrow.png" class="sub-menu_arrow" alt="서브메뉴 화살표"></span>';

                    if ($var1['sub']) {
                        echo '<ol class="menu-2dp">';

                        for ($k = 0; $k < count($var1['sub']); $k++) {
                            $var2 = $var1['sub'][$k];
                            echo '<li><a href="' . $var2['link'] . '">' . $var2['name'] . '</a></li>';
                        }/* for $var2 end */
                        echo '</ol>';/* .menu-2dp end */

                    } else {
                        echo '<div class="menu-name"><a href="' . $var1['link'] . '">' . $var1['name'] . '</a></div>';
                    }/* if $var['sub'] end */

                    echo '</li>';

                }/* for $var1 end */
            @endphp
        </ul><!-- //.menu_1dp end -->
    </div><!-- //.hd_menu_re end -->

    <main id="main">
        @if($_SERVER['REQUEST_URI'] !== '/')
            <div id="sub-page-nav">
                <div class="sub-nav-wrap">
                    <a href="/" class="btn-home">
                        <img src="/img/home_icon.png" alt="홈 아이콘">
                    </a>

                    <div class="major-menu">
                        <span class="selected-major">{{ $major_menu }}</span>
                        <img src="/img/menu_arrow_icon.png" alt="메뉴 선택 화살표" class="selected-arrow">

                        <ul>
                            <?php
                            for ($i = 0; $i < count($bri_menu['menu']); $i++) {
                                $var1 = $bri_menu['menu'][$i];
                                if ($var1['sub']) {
                                    echo '<li class="sub_menu_1dp" data-major="major_' . $i . '"><a href="' . $var1['link'] . '">' . $var1['name'] . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="minor-menu">
                        <span class="selected-minor">{{ $minor_menu  }}</span>
                        <img src="/img/menu_arrow_icon.png" alt="메뉴 선택 화살표2" class="selected-arrow minor-arrow">

                        <ol>
                            <?php
                            for ($i = 0; $i < count($bri_menu['menu']); $i++) {
                                $var1 = $bri_menu['menu'][$i];
                                if ($var1['name'] == $major_menu) {
                                    for ($j = 0; $j < count($var1['sub']); $j++) {
                                        $var2 = $var1['sub'][$j];
                                        echo '<li class="sub_menu_2dp" data-major="minor_' . $i . '"><a href="' . $var2['link'] . '">' . $var2['name'] . '</a></li>';
                                    }
                                }
                            }
                            ?>
                        </ol>
                    </div>
                </div>
            </div>{{-- //#sub-page-nav end --}}
    @endif
    <!-- body -->
        <div class="content-body">
            @yield('content')
        </div>
    </main>
    <!-- end main -->

    {{--footer--}}
    <footer id="footer">
        <div class="ft-wrap">
            <div class="ft-top">
                <ul>
                    <li><a href="/">홈</a></li>
                    <li><a href="https://www.donga.ac.kr/gzSub_014.aspx" class="btn-privacy"
                           target="_blank">개인정보처리방침</a></li>
                    <li><a href="mailto:jka723@dau.ac.kr">관리자에게 메일 보내기</a></li>
                </ul>
            </div>{{-- //.ft-wrap end --}}
            <div class="ft-mid">
                <ol>
                    <li>
                        <div class="ft-logo">
                            <img src="/img/ft_logo.png" alt="푸터 로고 이미지">
                        </div>
                    </li>

                    <li>
                        <h5>승학캠퍼스</h5>
                        <p>
                            <span>(49315) 부산광역시 사하구 낙동대로 550번길</span>
                            <span>37(하단동) S08(교수회관) 0201</span>
                            <span>전화 051-200-6222~4</span>
                            <span>팩스 051-200-6225</span>
                        </p>
                        <p class="copyright">Copyright ⓒ DONG-A UNIVERSITY. All rights reserved</p>
                    </li>

                    <li>
                        <h5>부민캠퍼스</h5>
                        <p>
                            <span>(49236)부산광역시 서구 구덕로 225(부민동</span>
                            <span>2가) B04(사회과학대학) BC-0116</span>
                            <span>전화 051-200-8771~2 </span>
                            <span>팩스 051-200-8773</span>
                        </p>
                    </li>
                </ol>
            </div>
        </div>
    </footer>
</div>{{-- //#app end --}}

<div class="top_btn">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>

<script>
    $(document).ready(function () {
        var loginCheck = '{{ session()->get('login_check') }}';
        var loginYes = "";

        /*헤더메뉴 비로그인시 링크 막기*/
        $('.hd-menu ul li a').on('click', function (e) {
            var aPos = $(this).parent().parent().parent().attr('class');

            // console.log(aPos);
            if(aPos == "hd-menu") {
                var parentIndex = $(this).parent().index();

                //메뉴가 취업지원실, 온라인취업컨텐츠, 취업상담이 아닌경우만 실행
                if(parentIndex !== 0 && parentIndex !== 2 && parentIndex !== 5) {
                    if(!loginCheck) {
                        e.preventDefault();
                        loginYes = confirm('로그인 후 이용 가능합니다. 로그인 페이지로 이동하시겠습니까?');

                        if (loginYes) {
                            location.href = "/login";
                        }
                    }
                }
            }

            if(aPos == "sub-menu") {
                var ancestorIndex = $(this).parent().parent().parent().parent().index();

                //메뉴가 취업지원실, 온라인취업컨텐츠, 취업상담이 아닌경우만 실행
                if(ancestorIndex !== 0 && ancestorIndex !== 2 && ancestorIndex !== 5) {
                    if(!loginCheck) {
                        e.preventDefault();
                        loginYes = confirm('로그인 후 이용 가능합니다. 로그인 페이지로 이동하시겠습니까?');

                        if (loginYes) {
                            location.href = "/login";
                        }
                    }
                }
            }
        });

        /*상단 움직이는 메뉴바*/
        $('.hd-menu > ul > li').on('mouseenter', function() {
            var a = $(this).position().left;
            var b = $(this).innerWidth();

            $('.hd-menu .bar').css('width', b).css('margin-left', a + 'px').css('opacity', '1');
        });

        $('.hd-menu > ul > li').on('mouseleave', function() {
            $('.hd-menu .bar').css('opacity', '0');
        });


        var winWidth = $(window).innerWidth();
        var isMenuInside = false;
        // console.log('isMenuInside : ', isMenuInside);

        /*메인 메뉴*/
        $('#header .hd-menu > ul > li').on('mouseenter', function () {
            if(isMenuInside == true) {
                // 메뉴간 이동
                $('#header .hd-menu > ul > li > div').hide();
                $(this).children('div').stop().show();
                // console.log('isMenuInside : ', isMenuInside);
            }
            if(isMenuInside == false){
                isMenuInside = true;
                // 메뉴를 처음 열때 모션
                // console.log('isMenuInside : ', isMenuInside);
                $('#header .hd-menu > ul > li > div').hide();
                $(this).children('div').stop().slideDown(300);
            }
        });
        $('#header .hd-menu > ul').on('mouseleave', function () {
            $(this).children('li').children('div').stop().slideUp(200);
            isMenuInside = false;
            // console.log('isMenuInside : ', isMenuInside);
        });


        /* 반응형 메뉴 */
        $('.menu-btn').on('click', function () {
            $(this).toggleClass('open');
            if ($(this).hasClass('open')) {
                $('.hd-nav, .hd-menu_re').addClass('open');
                $('html, body').addClass('hidden');
            } else {
                $('.hd-nav, .hd-menu_re').removeClass('open');
                $('html, body').removeClass('hidden');
            }
        });

        $('.menu-1dp li:first').addClass('open');
        $('.menu-1dp li').on('click', function () {
            // console.log($(this).find('.menu_2dp_mo').hasClass('open'));
            $(this).siblings().removeClass('open');
            $(this).toggleClass('open');
        });

        /*관련사이트 노출*/
        $('.login-link_re div').on('click', function () {
            $(this).next('ol').toggleClass('open');
        });


        /*서브 페이지 메뉴*/
        if(winWidth > 1280) {
            var majorText = '';
            var minorText = '';
            //1dp - 주메뉴 mouseenter시 드롭다운메뉴 노출 / mouseleave 시 드롭다운 숨김
            $('.major-menu').on('mouseenter', function () {
                $(this).children('ul').addClass('open');

                $('.minor-menu ol').removeClass('open');
            });
            $('.major-menu').on('mouseleave', function () {
                $(this).children('ul').removeClass('open');
            });

            // 주메뉴 중 하나 클릭시 주메뉴명을 majorText 변수에 저장하고 해당 변수를 바탕으로 하위메뉴 호출방식
            // $('.major-menu ul li').on('click', function(){
            //     majorText = $(this).children('span').text();
            //     // console.log(majorText);
            //
            //     $('.major-menu .selected-major').text(majorText);
            //
            //     minorMenuSetting(majorText);
            // });

            //2dp - 보조메뉴 mouseenter시 드롭다운메뉴 노출 / mouseleave 시 드롭다운 숨김
            $('.minor-menu').on('mouseenter', function () {
                $(this).children('ol').addClass('open');
                $('.major-menu ul').removeClass('open');
                // minorMenuSetting(majorText);
            });
            $('.minor-menu').on('mouseleave', function () {
                $(this).children('ol').removeClass('open');
            });
        }else {
            // 태블릿, 모바일에서는 hover -> click으로 변경
            $('.major-menu').on('click', function () {
                $(this).children('ul').toggleClass('open');
                $('.minor-menu ol').toggleClass('open');
            });

            $('.minor-menu').on('click', function () {
                $(this).children('ul').toggleClass('open');
                $('.minor-menu ol').toggleClass('open');
            });
        }
        // $('.minor-menu ol li').on('click', function() {
        //     minorText = $(this).children('a').text();
        //     // console.log(majorText);
        //
        //     $('.minor-menu .selected-minor').text(minorText);
        // });

        $('.major-menu ul li').on('click', function(e){
            var thisIndex = $(this).index();


            // alert(thisIndex);
            if(thisIndex !== 0 && thisIndex !== 2 && thisIndex !== 5) {
                if(!loginCheck) {
                    e.preventDefault();
                    loginYes = confirm('로그인 후 이용 가능합니다. 로그인 페이지로 이동하시겠습니까?');

                    if (loginYes) {
                        location.href = "/login";
                    }
                }
            }
        });

    });

    // 보조메뉴 리스트 불러오기(파라미터로 주메뉴명을 가져옴)
    function minorMenuSetting(majorText) {
        if (!majorText) {
            var majorText = '{{ $major_menu }}';
        }
        // console.log(majorText);

        $('.minor-menu ol').empty();

        // bri_menu에 저장된 json 파일 가져오기
        $.getJSON('/lib/bri_menu', function (bri_menu) {
            // console.log(bri_menu['menu'].length);

            for (var $i = 0; $i < bri_menu['menu'].length; $i++) {
                var $var1 = bri_menu['menu'][$i];
                // console.log($var1);
                // console.log(majorText);

                // 주메뉴명을 가져와 일치하는 하위메뉴만 불러오기
                if ($var1['name'] == majorText) {
                    for (var $j = 0; $j < $var1['sub'].length; $j++) {
                        var $var2 = $var1['sub'][$j];
                        // console.log($var2);

                        //주메뉴에 해당하는 첫번째 하위메뉴명을 minor_menu 이름으로 치환
                        if ($j == 0) {
                            // console.log('firstMinorText: ', $var2['name']);
                            $('.minor-menu .selected-minor').text($var2['name']);
                        }

                        var html = '';
                        html = '<li><a href="' + $var2['link'] + '">' + $var2['name'] + '</a></li>';
                        // console.log(html);
                        $('.minor-menu ol').append(html);
                    }
                }
            }
        });
    }
</script>
</body>
</html>

