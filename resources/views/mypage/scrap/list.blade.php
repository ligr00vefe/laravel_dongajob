
@extends("layouts.layout")

@section("title")
    동아대 마이페이지 - 스크랩
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
@endpush

@php
    $major_menu = "My Page";
    $minor_menu = "스크랩 내역";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>스크랩 내역</h1>
        </div>

        <div class="board-wrap board-list">
            <div class="search_table scrap-search">
                <form action="" method="get" >
                    <table>
                        <tbody>
                        <tr>
                            <th rowspan="2">카테고리 <br>및 키워드</th>
                            <td>
                                <select name="keyword" id="scrap-cate">
                                    <option value="all" {{ $search['keyword'] == 'all'? 'selected' : '' }}>전체</option>
                                    <option value="title" {{ $search['keyword'] == 'title'? 'selected' : '' }}>게시판명</option>
                                    <option value="subject" {{ $search['keyword'] == 'subject'? 'selected' : '' }}>제목</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="input_search" name="term" value="{{ $search['term'] }}" placeholder="검색어 입력">
                                <button class="btn_search">검색</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>

            {{--<div class="table-head">--}}
                {{--<span class="list-count">--}}
                    {{--총 <strong>290</strong>건의 동아친화기업이 있습니다.--}}
                {{--</span>--}}
                {{--<select name="view-count" id="view-item-count">--}}
                    {{--<option value="10">10개씩</option>--}}
                    {{--<option value="30">30개씩</option>--}}
                    {{--<option value="60">60개씩</option>--}}
                {{--</select>--}}
            {{--</div>--}}

        <!------ 테이블 시작 ------>
            <div class="list-warp table01 table-scrap list-scrap">
                <form action="" method="post" name="memberUpdate">
                @csrf
                @method("put")

                <!------ pc버전 시작 ------>
                    <table class="member-list in-input table-2x-large">
                        <colgroup>
                            <col class="visible-pc" width="12%">
                            <col class="visible-pc" width="20%">
                            <col class="visible-pc" width="55%">
                            <col class="invisible-pc col_datetime" width="87%">
                            <col class="visible-pc visible-tablet" width="13%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="visible-pc">번호</th>
                                <th class="visible-pc">게시판명</th>
                                <th class="visible-pc">제목</th>
                                <th class="invisible-pc">내용</th>
                                <th class="invisible-mobile">작성일</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($lists as $list)
                            <tr>
                                <td class="td_num visible-pc">{{ $list->id }}</td>
                                <td class="td_category visible-pc">{{ $list->board_title }}</td>
                                <td class="td_subject visible-pc">
                                        <a href="{{ $list->url }}">
                                            <b>{{ $list->subject }}</b>
                                        </a>
                                </td>
                                <td class="td_summary invisible-pc">
                                    <a  href="{{ $list->url }}">
                                        <p>{{ $list->board_title }}</p>
                                        <p>{{ $list->subject }}</p>
                                    </a>
                                </td>

                                <td class="td_datetime invisible-mobile">
                                    <p>{{ date('y-m-d', strtotime($list->created_at)) }}</p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100">게시물이 존재하지 않습니다.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <!------ pc버전 끝 ------>

                    <div class="btn-wrap">
                        {{-- .btn-wrap 하단 여백 유지때문에 삭제하면 안되는 태그입니다.--}}
                    </div>
                </form>
            </div>
            <!------ 테이블 끝 ------>

            <article id="list_bottom">
                {{ $lists->appends(['keyword' => $search['keyword'], 'term' => $search['term'] ])->links("vendor.pagination.default") }}
            </article><!-- article list_bottom end -->

        </div>
    </div>

@endsection
