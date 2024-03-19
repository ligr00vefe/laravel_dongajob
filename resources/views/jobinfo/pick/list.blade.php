
@extends("layouts.layout")

@section("title")
    동아대 채용정보 - 취업컨설턴트 PICK 채용정보
@endsection

@push('scripts')
    <script defer src="/js/jobinfo/recommend/list.js"></script>

@endpush

@php
    $major_menu = "채용정보";
    $minor_menu = "취업컨설턴트PICK";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>취업컨설턴트 PICK 채용정보</h1>
        </div>

        <div class="board-wrap board-list">

            <!---- 검색창 시작 ---->
            <form action="" method="get" name="search_form">
                <div class="search_table">
                    <table>
                        <tbody>
                        <tr>
                            <th rowspan="2">키워드</th>
                            <td>
                                <input type="checkbox" name="keyword" id="input-checkbox01" class="input-checkbox"
                                       value="company_name" {{ $keyword == 'company_name' ? 'checked' : '' }}>
                                <label for="input-checkbox01"><span>기업명</span></label>
                                <input type="checkbox" name="keyword" id="input-checkbox02" class="input-checkbox"
                                       value="recruitment_field" {{ $keyword == 'recruitment_field' ? 'checked' : '' }}>
                                <label for="input-checkbox02"><span>채용공고</span></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" value="{{ $term }}" name="term" class="input_search" placeholder="검색어 입력">
                                <button type="submit" class="btn_search">검색</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!---- 검색창 끝 ---->

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
                    <!-------- pc버전 시작 ------>
                    <table class="member-list in-input table-2x-large table_pc">
                        <colgroup>
                            <col width="15%">
                            <col width="58%">
                            <col width="7%">
                            <col width="10%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>기업명</th>
                            <th>채용공고</th>
                            <th>지역</th>
                            <th>마감일</th>
                            <th>조회</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($lists as $list)
                            <tr>
                                <td class="td_company">
                                    <p>{{ $list->company_name }}</p></td>
                                <td class="td_subject">
                                    <a href="/jobinfo/pick/{{ $list->id }}/view">
                                        <b>{{ $list->recruitment_field }}</b></a>
                                </td>
                                <td class="td_area">{{ get_work_area_lists($list->work_area) }}</td>
                                <td class="td_deadline">{{ date('y-m-d', strtotime( $list->receipt_end_date )) }}</td>
                                <td class="td_hit">{{ $list->hit ?? "0" }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100">내역이 존재하지 않습니다.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                        <!------- pc버전 끝 ------>

                    <!---- 모바일 시작 ---->
                    <table class="member-list in-input table-2x-large table_m">
                        <tbody>
                        @forelse($lists as $list)
                            <tr>
                                <td class="td_content">
                                    <a href="/jobinfo/pick/{{ $list->id }}/view">
                                        <ul>
                                            <li class="td_company">
                                                <div class="tit1">기업명 </div>
                                                <p>{{ $list->company_name }}</p>
                                            </li>
                                            <li class="td_subject">
                                                <div class="tit1">채용공고 </div>
                                                <p>{{ $list->recruitment_field }}</p>
                                            </li>
                                            <li class="td_area">
                                                <div class="tit1">지역 </div>
                                                <p>{{ get_work_area_lists( $list->work_area ) }}</p>
                                            </li>
                                            <li class="td_deadline">
                                                <div class="tit1">마감일 </div>
                                                <p>{{ date('y-m-d', strtotime( $list->receipt_end_date )) }}</p>
                                            </li>
                                            <li class="td_hit">
                                                <div class="tit1">조회 </div>
                                                <p>{{ $list->hit }}</p>
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
                    <!---- 모바일 끝 ---->

                </form>
            </div>{{-- //.table01 end --}}
            <!------ 테이블 끝 ------>

            <article id="list_bottom" class="pdt30">
                {{ $lists->appends(['keyword' => $keyword, 'term' => $term, 'view_count' => $view_count ])->links("vendor.pagination.default") }}
            </article> <!-- article list_bottom end -->

        </div>
    </div>

@endsection
