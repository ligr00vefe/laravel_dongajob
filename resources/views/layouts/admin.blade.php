<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <?php if (!!(FALSE !==strstr(strtolower($_SERVER['HTTP_USER_AGENT']),'mobile')) != 1) { ?>
    {{--PC 브라우저--}}
     <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <?php }else { ?>
    {{--모바일 브라우저--}}
    <meta name="viewport"
          content="width=1920px, user-scalable=no">
    <?php } ?>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>관리자 | @yield("title", "main")</title>

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/font/font.css">
    <link rel="stylesheet" href="/css/compile/fontawesome.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <script async src="/lib/jquery-3.5.1.min.js"></script>
    <script defer src="/js/app.js"></script>
    <script defer src="/js/common.js"></script>
    <script defer src="/js/admin/admin.js"></script>

   {{-- <script src="{{ asset('/lib/ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/UploadAdaptor.js') }}"></script>--}}

    @stack('scripts')
</head>
<body>
<div class="loading_box">
    <div class="dim"></div>
    <div class="circle"></div>
</div>
<div id="app">

    <!--head-->
    <header>
        <a href="/" class="head-logo-box">
            <img src="/img/admin_logo.png" alt="">
        </a>
        <ul class="head-login-info">
            <li class="introduce">
                <p class=""><span class="hd-login-name">{{ session()->get('name') }}</span> 님 환영합니다.</p>
            </li>
            <li>
                <a href="/" class="hd-info-btn modify-btn">홈으로</a>
                <a href="javascript:void(0)" class="hd-info-btn logout-btn">로그아웃</a>
            </li>
        </ul>
    </header>

    @include("admin.menu")

    <main id="main">

        <nav class="main-navi">
            {{--관리자 main 여백용--}}
        </nav>

        <!-- body -->
        <div class="content-body">
            @yield("content")
        </div>
    </main>
    <!-- end main -->

    <footer>
        <div>COPYRIGHT 2021 동아대학교 ALL RIGHTS RESERVED.</div>
    </footer>
</div>
<!-- end app -->

<div class="top_btn">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>

<script type="text/javascript">
    window.addEventListener('DOMContentLoaded', function () {
        // 관리자 헤더 레이아웃 재정렬 (페이지가 로드되기 전에 호출)
        adminTopLayout();
    });
</script>
</body>
</html>
