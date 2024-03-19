@extends("layouts.layout")

@section("title")
    프로그램 참여 후기
@endsection

@push('scripts')
    <script src="/js/board.js"></script>
    <script defer src="/js/archive.js"></script>
@endpush

@php
    $major_menu = "취업자료실";
    $minor_menu = "프로그램 참여후기";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>프로그램 참여후기</h1>
        </div>

        <div class="board-wrap board-list">
            <form action="" method="get" class="search_form" name="search_form">

                <!------ 검색창 시작 ------>
                <div class="search-box">
                    <select name="search" id="search-cate">
                        <option value="subject" {{ isset($search) && $search['search'] == 'subject' ? 'selected' : '' }}>제목</option>
                        <option value="name" {{ isset($search) && $search['search'] == 'name' ? 'selected' : '' }}>이름</option>
                    </select>
                    <input type="text" name="term" class="input-search" value="{{ $search['term'] }}">
                    <button class="btn-search">검색</button>
                </div>

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
            <div class="list-table table01 list-review">
                <form action="" method="post" name="memberUpdate">
                @csrf
                @method("put")

                <!------ pc버전 시작 ------>
                    <table class="member-list in-input table-2x-large table_pc">
                        <colgroup>
                            <col class="col_num" width="10%">
                            <col class="visible-tablet" width="90%">
                            <col class="visible-pc" width="47%">
                            <col class="visible-pc" width="10%">
                            <col class="visible-pc" width="13%">
                            <col class="visible-pc col_datetime" width="10%">
                            <col class="visible-pc" width="10%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th class="visible-tablet">내용</th>
                            <th class="visible-pc">제목</th>
                            <th class="visible-pc">이름</th>
                            <th class="visible-pc">학과(부)</th>
                            <th class="visible-pc">작성일</th>
                            <th class="visible-pc">조회</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($lists as $list)
                            <tr class="@if(1 <= $list->status_id ) is_notice @endif">
                                <td class="td_num">
                                    @if(1 <= $list->status_id )
                                        <p>{{ get_notice_status($list->status_id) }}</p>
                                    @else
                                        {{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}
                                    @endif
                                </td>
                                <td class="td_summary visible-tablet">
                                    <a href="/{{ Route::current()->uri . '/'. $list -> id }}/view">
                                        <ul>
                                            <li>
                                                <b>{{ $list -> subject }}</b>
                                                <strong class="comment_cnt">{{ $list->comment_cnt ? '(+'.$list->comment_cnt.')' : '' }}</strong>
                                            </li>
                                            <li><p>{{ $list -> name }}</p></li>
                                            <li><p>{{ $list->dpt }}</p></li>
                                            <li><p>{{ date('y-m-d', strtotime( $list -> created_at )) }}</p></li>
                                        </ul>
                                    </a>
                                </td>
                                <td class="td_subject visible-pc">
                                    <a href="/{{Route::current()->uri . '/'. $list->id }}/view">
                                        <b>{{ $list->subject }}</b>
                                        <strong class="comment_cnt">{{ $list->comment_cnt ? '(+'.$list->comment_cnt.')' : '' }}</strong>
                                    </a>
                                </td>
                                <td class="td_writer visible-pc">
                                    <span>{{ $list->name }}</span>
                                </td>
                                <td class="td_major visible-pc">
                                    {{ $list->dpt }}
                                </td>
                                <td class="td_createdAt visible-pc">
                                    <span>{{ date('y-m-d', strtotime($list->created_at)) }}</span>
                                </td>
                                <td class="td_hit visible-pc">
                                    <span>{{ $list->hit }}</span>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="100">내역이 존재하지 않습니다.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!------ pc버전 끝 ------>


                    <!------ 모바일 버전 시작 ------>
                    <table class="member-list in-input table-2x-large table_m">
                        <tbody>
                            @forelse($lists as $list)
                                <tr>
                                    <td class="td_content">
                                        <a href="/{{ Route::current()->uri . '/'. $list -> id }}/view">
                                            <ul>
                                                <li class="td_subject">
                                                    <b>{{ $list -> subject }}</b>
                                                    <strong class="comment_cnt">>{{ $list->comment_cnt ? '(+'.$list->comment_cnt.')' : '' }}</strong>
                                                </li>
                                                <li>
                                                    <p>{{ $list -> name }}</p>
                                                </li>
                                                <li>
                                                    <p>기계공학과</p>
                                                </li>
                                                <li>
                                                    <p>{{ date('y-m-d',strtotime( $list -> created_at )) }}</p>
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
                    <!------ 모바일 버전 끝 ------>

                    <div class="btn-wrap">
                        <div class="btn-left">
                            {{--<a class="btn-selectAll btn01" href="{{ ADMIN_URL }}/notice">전체선택</a>--}}
                            {{--<a class="btn-delete btn01" href="{{ ADMIN_URL }}/notice">선택삭제</a>--}}
                        </div>

                        <div class="btn-right">
                            <?php if(session()->get('login_check') && !isStaffCheck(session()->get('donga_type'))) { ?>
                                <a href="/archive/reviewparticipate/create" class="btn-submit btn01 confirm-link">글쓰기</a>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
            <!------ 테이블 끝 ------>

            <div class="paging-wrap">
                {{ $lists->appends(['search' => $search['search'], 'term' => $search['term'], 'view_count' => $view_count  ])->links("vendor.pagination.default") }}
            </div><!-- //paging-wrap end -->

        </div>
    </div>

@endsection
