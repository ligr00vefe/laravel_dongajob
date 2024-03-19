@extends("layouts/layout")

@section("title")

@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">

@endpush

@php
    $major_menu = "워크넷 직업/진로정보";
    $minor_menu = "채용정보";
@endphp


@section("content")

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>이전 취업수기</h1>
        </div>

        <div class="board-wrap board-list">
            <form action="" method="get" class="search_form" name="search_form">

                <!------ 검색창 시작 ------>
                <div class="search-box">
                    <select name="search" id="search-cate">
                        <option value="">전체</option>
                        <option value="subject">제목</option>
                        <option value="name">이름</option>
                    </select>
                    <input type="text" name="term" class="input-search" value="">
                    <button class="btn-search">검색</button>
                </div>
                <!------ 검색창 끝 ------>

                <div class="table-head">
                    <span class="list-count">
                        {{--진행중인 채용이 총 <strong>{{ $count }}</strong>건 있습니다.--}}
                    </span>
                    <select name="view_count" id="view-item-count">
                        <option value="10">10개씩</option>
                        <option value="20">20개씩</option>
                        <option value="30">30개씩</option>
                    </select>
                </div>
            </form>

            <!------ 테이블 시작 ------>
            <div class="list-table table01 list-review">
                <iframe id="iframe" style="width: 100%;min-height: 3000px;" scrolling="no" allowTransparency="true"
                        border="no" maginwidth="0" marginheight="0" frameborder="0"
                        src="https://www.work.go.kr/empInfo/empInfoSrch/list/dtlEmpSrchList.do?moreCon=more"
                        frameborder="0"></iframe>
            </div>

            <!------ 테이블 끝 ------>


        </div>
    </div>



    <script>

        window.addEventListener('message', function(e) {
            console.log(e.origin);
            if (e.origin === 'www.work.go.kr') {

            }
        });

        $('#iframe').bind('load', function () {


            var p1 = document.querySelector("#iframe").contentWindow.document.getElementById("header");
            var hz = document.querySelector('#sub_layout_noneleft');
            console.log(p1, hz);
            hz.removeChild(p1); // 부모요소에
        });


    </script>

@endsection
