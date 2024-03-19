
@extends("layouts.layout")

@section("title")
    동아대 마이페이지 - 프로그램 접수내역
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
    <script defer src="/js/mypage/mypage.js"></script>
@endpush

@php
    $major_menu = "My Page";
    $minor_menu = "프로그램 접수내역";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>프로그램 접수내역</h1>
        </div>

        <div class="board-wrap board-list">
            <div class="search-box">
                <select name="search_cate" id="search-cate">
                    <option value="sch-all">전체</option>
                    <option value="sch-subject">강좌명</option>
                    <option value="sch-name">수강장소</option>
                </select>
                <input type="text" value="" class="input-search">
                <button class="btn-search">검색</button>
            </div>

        <!------ 테이블 시작 ------>
            <div class="list-warp table01 table-receipt list-receipt">
                <form action="" method="post" name="memberUpdate">
                @csrf
                @method("put")

                <!------ pc버전 시작 ------>
                    <table class="member-list in-input table-2x-large">
                        <colgroup>
                            <col class="visible-pc" width="10%">
                            <col class="invisible-mobile" width="63%">
                            <col class="visible-mobile" width="73%">
                            <col class="invisible-mobile col_datetime" width="15%">
                            <col class="invisible-mobile" width="12%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="visible-pc">번호</th>
                                <th class="invisible-mobile">강좌명</th>
                                <th class="visible-mobile">내용</th>
                                <th class="invisible-mobile">작성일</th>
                                <th class="invisible-mobile">상세보기</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($lists as $list)

                            <tr>
                                <td class="td_num visible-pc">{{ $list->id }}</td>
                                <td class="td_lectureTitle invisible-mobile">
                                    <span href="/program/receipt//{{ $list->program_id }}/view">
                                        <b>{{ $list->subject }}</b>
                                        <small class="visible-mobile">{{ $list->created_at }}</small>
                                    </span>
                                </td>
                                <td class="td_summary visible-mobile">
                                    <a href="/program/receipt/{{ $list->program_id }}/view">
                                        <b>{{ $list->subject }}</b>
                                        <small class="visible-mobile">{{ $list->created_at }}</small>
                                    </a>
                                </td>

                                <td class="td_datetime invisible-mobile">
                                    <p>{{date('y-m-d', strtotime($list->created_at))}}</p>
                                </td>

                                <td class="td_details invisible-mobile">
                                    <a href="/program/receipt/add?id={{ $list->program_id }}" class="btn-details">상세보기</a><td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100">내역이 존재하지 않습니다.</td>
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

            </article><!-- article list_bottom end -->

        </div>
    </div>

@endsection
