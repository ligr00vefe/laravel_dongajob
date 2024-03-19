'@extends("layouts.layout")

@section("title")
    동아대 채용정보 - 동아 친화 기업 300
@endsection

@push('scripts')
    <script defer src="/js/archive.js"></script>

@endpush

@php
    $major_menu = "채용정보";
    $minor_menu = "동아친화기업300";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>동아친화기업 300</h1>
        </div>

        <div class="board-wrap board-list">

            <form action="" method="get" class="search_form" name="search_form">
                <div class="search-box">
                    <select name="search" id="search-cate">
                        <option value="subject" {{ isset($search) && $search['search'] == 'subject' ? 'selected' : '' }}>제목</option>
                    </select>
                    <input type="text" name="term" class="input-search" value="{{ $search['term'] }}">
                    <button class="btn-search">검색</button>
                </div>

                <div class="table-head">
                    <span class="list-count">
                        진행중인 채용이 총 <strong>{{ $lists->total() }}</strong>건 있습니다.
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

                <!------ pc버전 시작 ------>
                    <table class="member-list in-input table-2x-large table_pc">
                        <colgroup>
                            <col width="8%">
                            <col width="64%">
                            <col width="10%">
                            <col width="10%">
                            <col width="8%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>취업자</th>
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
                                    <a href="/jobinfo/donga300/{{ $list->id }}/view/">
                                        <b>{{ $list->subject ?? "" }}</b>
                                    </a>
                                </td>
                                <td class="td_cntEmployed">
                                    <p>{{ $list->cnt_employed ?? "" }} 명</p>
                                </td>
                                <td class="td_createdAt">
                                    <p>{{ date("y-m-d", strtotime( $list->created_at )) }}</p>
                                </td>
                                <td class="td_hit">
                                    <p>{{ $list->hit ?? "0" }}</p>
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
                                <td class="td_num">{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</td>
                                <td class="td_content">
                                    <ul>
                                        <li class="td_subject">
                                            <a href="/jobinfo/donga300/{{ $list->id }}/view/">
                                               {{ $list->subject ?? "" }}
                                            </a>
                                        </li>
                                        <li>
                                            <span>
                                                <p>취업자. {{ $list->cnt_employed ?? "" }} 명</p>
                                                <p>작성일. {{ date("y-m-d", strtotime( $list->created_at )) }}</p>
                                                <p>조회. {{ $list->hit ?? "0" }}</p>
                                            </span>
                                        </li>
                                    </ul>
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

                </form>
            </div>
            <!------ 테이블 끝 ------>

            <article id="list_bottom" class="pdt30">
                {{ $lists->appends(['search' =>  $search['search'], 'term' =>  $search['term'], 'view_count' => $view_count ])->links("vendor.pagination.default") }}
            </article> <!-- article list_bottom end -->

        </div>
    </div>

@endsection
