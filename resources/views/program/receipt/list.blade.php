@extends("layouts.layout")

@section("title")
    동아대 취업지원실 프로그램 - 프로그램 접수
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
    <script defer src="/js/program/receipt/list.js"></script>
@endpush

@php
    $reception_status = ["접수대기", "접수중", "대기접수중", "접수마감"];

    $major_menu = "취업지원실 프로그램";
    $minor_menu = "프로그램 접수";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>프로그램 접수</h1>
        </div>

        <div class="board-wrap board-list">
            <form action="" name="search">
                <div class="search-box">
                    <select name="search_cate" id="search-cate">
                        <option value="subject" {{ $search_cate == 'subject' ? 'selected':'' }}>강좌명</option>
                    </select>
                    <input type="text" name="term" value="{{ $term }}" class="input-search">
                    <button class="btn-search">검색</button>
                </div>

                <div class="table-head">
                    <span class="list-count"></span>
                    <select name="view_count" id="view-item-count">
                        <option value="10" {{ $view_count == 10 ? 'selected':'' }}>10개씩</option>
                        <option value="30" {{ $view_count == 30 ? 'selected':'' }}>30개씩</option>
                        <option value="60" {{ $view_count == 60 ? 'selected':'' }}>60개씩</option>
                    </select>
                </div>
            </form>
            <!------ 테이블 시작 ------>
            <div class="list-warp table01 table-receipt list-receipt">
                <form action="" method="post" name="forms">
                @csrf
                @method("put")

                <!------ pc버전 시작 ------>
                    <table class="member-list in-input table-2x-large">
                        <colgroup>
                            <col class="visible-pc" width="10%">
                            <col class="visible-pc" width="30%">
                            <col class="visible-pc" width="10%">
                            <col class="visible-pc" width="15%">
                            <col class="visible-pc col_datetime col_receiptDatetime" width="25%">
                            <col class="visible-tablet visible-mobile" width="90%">
                            <col class="invisible-mobile col_status" width="10%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="visible-pc">번호</th>
                            <th class="visible-pc">강좌명</th>
                            <th class="visible-pc">수강정원</th>
                            <th class="visible-pc">수강장소</th>
                            <th class="visible-pc">접수일시</th>
                            <th class="invisible-pc">내용</th>
                            <th class="invisible-mobile">접수상태</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($lists as $list )
                            <tr>
                                <td class="td_num visible-pc">{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</td>
                                <td class="td_lectureTitle visible-pc">
                                    <a href="/{{ Route::current()->uri . '/'. $list->id }}/view">{{ $list->subject }}</a>
                                </td>
                                <td class="td_enrolledCount visible-pc">
                                    <p>{{ $list->number_students }} 명</p>
                                </td>
                                <td class="td_location visible-pc">
                                    <p>{{ $list->location }}</p>
                                </td>
                                <td class="td_receiptionDatetime visible-pc">
                                    <p>{{ date("y-m-d H:i", strtotime($list->start_reception_date." ".$list->start_reception_time)) .' ~ '. date("y-m-d H:i", strtotime($list->end_reception_date." ".$list->end_reception_time)) }}
                                    </p>
                                </td>

                                <td class="td_summary invisible-pc">
                                    <a href="/{{ Route::current()->uri . '/'. $list->id }}/view">
                                        <span class="visible-mobile mobile-status">
                                            @if(is_program_status_auto($list->status_auto))
                                                <p class="status0{{get_status_type($list)}}">{{ get_program_status_lists(get_status_type($list)) }}</p>
                                            @else
                                                <p class="status0{{$list->status}}">{{ get_program_status_lists($list->status) }}</p>
                                            @endif
                                        </span>
                                        <span>
                                            <p>{{ $list->subject }}</p>
                                            <p>{{ $list->location }}</p>
                                            <p>{{ date("y-m-d", strtotime($list->start_reception_date." ".$list->start_reception_time)) .' ~ '. date("y-m-d", strtotime($list->end_reception_date." ".$list->end_reception_time)) }}</p>
                                        </span>
                                    </a>
                                </td>

                                <td class="td_status invisible-mobile">
                                    @if(is_program_status_auto($list->status_auto))
                                        <p class="status0{{get_status_type($list)}}">{{ get_program_status_lists(get_status_type($list)) }}</p>
                                    @else
                                        <p class="status0{{$list->status}}">{{ get_program_status_lists($list->status) }}</p>
                                    @endif
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

                    <div class="btn-wrap">
                        {{-- .btn-wrap 하단 여백 유지때문에 삭제하면 안되는 태그입니다.--}}
                    </div>
                </form>
            </div>
            <!------ 테이블 끝 ------>

            <article id="list_bottom">
                {{ $lists->appends([ 'term' => $term ?? '',
            'search_cate' => $search_cate ?? 'sch-all',
            'view_count' => $view_count ?? '',])->links("vendor.pagination.default") }}
            </article><!-- article list_bottom end -->

        </div>
    </div>

@endsection
