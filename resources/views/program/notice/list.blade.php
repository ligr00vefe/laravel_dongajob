@extends("layouts.layout")

@section("title")
    동아대 취업지원실 프로그램 - 공지사항
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
    <link rel="stylesheet" href="/js/program/notice/list.js">
    <script src="/js/board.js"></script>
    <script>

    </script>
@endpush

@php
    $major_menu = "취업지원실 프로그램";
    $minor_menu = "공지사항";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>공지사항</h1>
        </div>

        <div class="category_button_wrap">
            <ul>
                @foreach($category_list as $key => $val)
                    <li class="@if($category == $key ) on @endif" data-id="{{ $key }}">{{ $val }}</li>
                @endforeach
            </ul>
        </div>

        <div class="board-wrap board-list">

            <form action="" method="get" class="search_form" name="search_form">
            <!------ 검색창 시작 ------>

                <div class="search-box">
                    <select name="search" id="search-cate">
                        <option
                            value="subject" {{ isset($search) && $search['search'] == 'subject' ? 'selected' : '' }}>제목
                        </option>
                    </select>
                    <input type="text" name="term" class="input-search" value="{{ $search['term'] }}">
                    <button type="submit" class="btn-search">검색</button>
                </div>
                <!------ 검색창 끝 ------>

                <div class="table-head">
                    <span class="list-count">
                        {{--진행중인 채용이 총 <strong>{{ $count }}</strong>건 있습니다.--}}
                    </span>
                    <select name="view_count" id="view-item-count">
                        <option value="10" {{ $view_count == 10 ? 'selected' : '' }}>10개씩</option>
                        <option value="20" {{ $view_count == 20 ? 'selected' : '' }}>20개씩</option>
                        <option value="30" {{ $view_count == 30 ? 'selected' : '' }}>30개씩</option>
                    </select>
                </div>
            </form>

            <!------ 테이블 시작 ------>
            <div class="list-warp table01">
                <form action="" method="post" name="memberUpdate">
                @csrf
                @method("put")
                <!---- pc버전 시작 ---->
                    <table class="member-list in-input table-2x-large table_pc">
                        <colgroup>
                            <col width="10%">
                            <col width="54%">
                            <col width="12%">
                            <col class="col_datetime" width="14%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>작성일</th>
                            <th>조회</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($lists as $list)
                            <tr class=" @if(1 <= $list->status_id ) is_notice is_recruitment @endif ">
                                <td class="td_num">
                                    @if(1 <= $list->status_id )
                                        <p>{{ get_notice_status($list->status_id) }}</p>
                                    @else
                                        {{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}
                                    @endif
                                </td>
                                <td class="td_subject">
                                    <a href="/{{ Route::current()->uri . '/'. $list->id }}/view">
                                        <strong>[{{ get_notice_category($list->category_id) }}]</strong> <p>{{ $list->subject }}</p>
                                    </a>
                                </td>
                                <td>{{ $list->name }}</td>
                                <td>{{ date('y-m-d', strtotime($list->created_at)) }}</td>
                                <td>{{ $list->hit }}</td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="100">내역이 존재하지 않습니다.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <!---- pc버전 끝 ---->


                    <!---- 반응형 모바일 시작 ---->
                    <table class="member-list in-input table-2x-large table_m">

                        <tbody>
                        @forelse($lists as $list)
                            <tr>
                                <td class="td_content">
                                    <a href="/{{Route::current()->uri . '/'. $list->id }}/view">
                                        <ul>
                                            <li class="td_subject">
                                                <div class="ellipsis">
                                                    <label class="td_category"> {{ '['. get_notice_category($list->category_id) .']' }}</label>
                                                    <b>{{ $list->subject }}</b>
                                                </div>
                                            </li>
                                            <li>
                                                <p>작성자. {{ $list->name }}</p>
                                            </li>
                                            <li>
                                                <p>작성일. {{ date('y-m-d', strtotime($list->created_at)) }}</p>
                                            </li>
                                            <li>
                                                <p>조회. {{ $list->hit }}</p>
                                            </li>
                                        </ul>
                                    </a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="100">내역이 존재하지 않습니다.</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    <!---- 반응형 모바일 끝 ---->

                </form>
            </div>
            <!------ 테이블 끝 ------>

            <div class="paging-wrap">
                {{ $lists->appends(['category' => $category, 'search' => $search['search'], 'term' => $search['term'], 'view_count' => $view_count ])->links("vendor.pagination.default") }}
            </div><!-- //paging-wrap end -->

        </div>
    </div>

@endsection
