<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>로그인</title>


    <script src="/lib/jquery-3.5.1.min.js"></script>
    <script defer src="/lib/jquery-confirm-v3.3.4/js/jquery-confirm.js"></script>
    <link rel="stylesheet" href="/lib/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="/css/compile/fontawesome.css">

    <script defer src="/js/common.js"></script>

</head>
<body>
@if(session('status'))
    <script>alert('{{ session('status') }}')</script>
@elseif(session('success'))
    <script>alert('{{ session('success') }}')</script>
@elseif(session('error'))
    <script>alert('{{ session('error') }}')</script>
@endif

@php
    $action =  isDongaServer() ? AUTH_SERVER_NAME : '/login';
    $redirect = '/';
@endphp

<div class="login-container">
    <div class="login-box">

        <!-- start box-logo -->
        <div class="box-logo">
            <a href="/"><img src="/img/login_logo.png" alt="로고"/></a>
        </div>
        <!-- end box-logo -->

        <form id="spLoginFrm" name="spLoginFrm" action="{{ $action }}" method="post">
            @csrf
            <input type="hidden" name="redirect" value="{{ $redirect }}">
            <input type="hidden" name="RelayState" value="/exsignon/sso/sso_loginuser.php">
            <input type="hidden" name="id" value="newJob">
            <input type="hidden" name="check" value="{{ isDongaServer() }}">

            <div class="box-content">
                <div>
                    <input type="text" name="user_id" id="login_id" required="" class="frm_input input-text"
                           placeholder="아이디">
                </div>
                <div>
                    <input type="password" name="user_password" id="login_pw" required="" class="frm_input input-text"
                           placeholder="비밀번호">
                </div>
                <!-- start content-guide -->
                <div class="content-guide">
                    <button type="button" class="btn_submit">로그인</button>
                </div>
                <!-- end content-guide -->
            </div>
        </form>
    </div>


    <section class="guidance-container">
        <div class="guidance_box">
            <div class="img_box">
                <img src="/img/guid_img.png" alt="">
            </div>
            <div class="meta">
                <h1>학생정보시스템 계정으로 로그인이 안되는 경우</h1>
                <p><a href="https://student.donga.ac.kr/Login.aspx?ReturnUrl=%2f">학생정보시스템에서 비밀번호를 변경하시기 바랍니다.</a></p>
            </div>
            <div class="arrow_box">
                <a href="https://student.donga.ac.kr/Login.aspx?ReturnUrl=%2f">
                    <img src="/img/login_right_arrow.png" alt="">
                </a>
            </div>
        </div>
    </section>

    <section class="notification-container">
        <div class="noti_box">
            <header>
                <h1>안내사항</h1>
            </header>
            <div class="contents">
                <ul>
                    <li>학생은 학생정보시스템에서 사용하는 아이디와 패스워드를 입력하십시오.</li>
                    <li> 교직원은 교직원정보시스템에서 사용하는 아이디와 패스워드를 입력하십시오.</li>
                    <li>로그인을 클릭해도 넘어가지 않는 경우, Ctrl+Shift+R 을 통해 캐시를 삭제해주시기 바랍니다.</li>
                    <li> 계정분실</li>
                    <ul>
                        <li>- 학생 : 학생정보시스템에서 확인</li>
                        <li>- 교직원 : 교직원정보시스템에서 확인</li>
                        <li>- 외부이용자 : 신분증 지참 후 대출 데스크 방문 및 전화를 통해 계정확인</li>
                    </ul>
                </ul>
            </div>
        </div>
    </section>
</div>
</div>
<script src="/js/login/login.js"></script>
</body>
</html>
