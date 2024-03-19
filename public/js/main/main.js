(function () {

    //--- 데이터 불러올동안 로딩바 돌려주기

    // 공지사항
    __common.loadingStart(document.querySelector('.tab-list01'));

    // 취업수기, 프로그램 참여후기
    __common.loadingStart(document.querySelector('.tab-list02'));


    // 채용정보, 추천채용공고, 각종활동
    let wrap = document.querySelectorAll('.list-wrap ul');
    __common.loadingStart(wrap[0]);
    __common.loadingStart(wrap[1]);
    __common.loadingStart(wrap[2]);


    //--- 공지사항 최초 로드시 게시글 불러오기
    __common.getAjax('GET', '/ajax/board/notice', {mode: 'main', category: 100}, function (result) {

        //--- 에러만 아니면 실행
        if (result.status != 404) {

            document.querySelector('.tab-list01').innerHTML = result.lists;
        }
    });

    //--- 게시글 불러오기
    __common.getAjax('GET', '/ajax/board/review', {category: 'reviewlatest'}, function (result) {
        if (result.status == 404)
            return;


        document.querySelector('.tab-list02').innerHTML = result.lists;
    });

    //--- 채용정보 불러오기
    __common.getAjax('GET', '/ajax/board/jobs', {view_count : 3}, function (result) {
        if (result.status == 404)
            return;


        wrap[0].innerHTML = result.lists;
    });


    //---추천채용공고 게시글 불러오기
    __common.getAjax('GET', '/ajax/board/recommend', '', function (result) {
        if (result.status == 404)
            return;


        wrap[1].innerHTML = result.lists;
    });

    //---추천채용공고 게시글 불러오기
    __common.getAjax('GET', '/ajax/board/activity', {view_count : 3}, function (result) {
        if (result.status == 404)
            return;

        wrap[2].innerHTML = result.lists;
    });
})();

$(document).ready(function () {

    //--- 취업지원실 공지사항
    $('.main-list .mlist-tab01 .mlist-tab_re').on('click', function () {
        $('.main-list .mlist-tab01 ul').toggleClass('open');
    });
    $('.main-list .mlist-tab01 li').on('click', function () {
        var selectedTab = $(this).text();

        //--- text 모두 제거
        document.querySelector('.tab-list01').innerHTML = '';

        //--- 로딩시작
        __common.loadingStart(document.querySelector('.tab-list01'));

        //--- 게시글 불러오기
        __common.getAjax('GET', '/ajax/board/notice', {
            mode: 'main',
            category: this.children[0].dataset.id
        }, function (result) {
            if (result.status == 404)
                return;

            __common.loadingEnd(0);
            document.querySelector('.tab-list01').innerHTML = result.lists;
        })

        $('.main-list .mlist-tab01 li').removeClass('on');
        $(this).addClass('on');
        $('.main-list .mlist-tab01 .mlist-tab_re').text(selectedTab);
        $('.main-list .mlist-tab01 ul').removeClass('open');
    });

    //--- 취업수기, 프로그램 참여후기
    $('.main-list .mlist-tab02 .mlist-tab_re').on('click', function () {
        $('.main-list .mlist-tab02 ul').toggleClass('open');
    });
    $('.main-list .mlist-tab02 li').on('click', function () {
        var selectedTab = $(this).text();

        //--- text 모두 제거
        document.querySelector('.tab-list02').innerHTML = '';

        //--- 로딩돌리기
        __common.loadingStart(document.querySelector('.tab-list02'));

        //--- 게시글 불러오기
        __common.getAjax('GET', '/ajax/board/review', {category: this.children[0].dataset.category}, function (result) {
            if (result.status == 404)
                return;

            __common.loadingEnd(1);
            document.querySelector('.tab-list02').innerHTML = result.lists;
        })

        $('.main-list .mlist-tab02 li').removeClass('on');
        $(this).addClass('on');
        $('.main-list .mlist-tab02.mlist-tab_re').text(selectedTab);
        $('.main-list .mlist-tab02 ul').removeClass('open');
    });


    //--- 채용정보, 추천채용공고, 각종활동
    $('.main03 .main03-tab_re ul li:first').addClass('on');
    $('.main03 .main03-tab_re ul li').on('click', function () {
        var indexNum = $(this).index();
        // console.log(indexNum);
        $('.main03 .main03-tab_re ul li').removeClass('on');
        $(this).addClass('on');
        $('.main03 .main-con').css('display', 'none');
        $('.main03 .main-con').eq(indexNum).css('display', 'block');
    });


    var winWidth = $(window).width();
    // console.log(winWidth);

    $('#main04-slider').slick({
        slidesToShow: 7,
        slidesToScroll: 1,
        autoplay: true,
        infinite: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1280,
                settings: {
                    slidesToShow: 4,
                    arrows: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });


});

