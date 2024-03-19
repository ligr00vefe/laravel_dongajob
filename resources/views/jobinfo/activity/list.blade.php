@extends("layouts.layout")

@section("title")
    동아대 채용정보 - 각종 활동
@endsection

@push('scripts')
    <script defer src="/js/archive.js"></script>

@endpush

@php
    $major_menu = "채용정보";
    $minor_menu = "각종활동";
@endphp

@section("content")
    <link rel="stylesheet" href="/css/board.css">

    <div class="sub-content">
        <div class="sub-content_title">
            <h1>각종 활동</h1>
        </div>

        <div class="board-wrap board-list">
            <form action="" method="get" class="search_form" name="search_form">

                <!---- 검색창 시작 ---->
                <div class="search-box">
                    <select name="search" id="search-cate">
                        <option value="company_name" {{ isset($search) && $search['search'] == 'company_name' ? 'selected' : '' }}>기업명</option>
                        <option value="recruitment_field" {{ isset($search) && $search['search'] == 'recruitment_field' ? 'selected' : '' }}>채용공고</option>
                    </select>
                    <input type="text" name="term" class="input-search" value="{{ $search['term'] }}">
                    <button class="btn-search">검색</button>
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
                    <!---- pc버전 시작 ---->
                    <table class="member-list in-input table-2x-large table_pc">
                        <colgroup>
                            <col width="15%">
                            <col width="57%">
                            <col width="13%">
                            <col class="col_datetime" width="8%">
                            <col width="7%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>기업명</th>
                            <th>채용공고</th>
                            <th>성별/나이</th>
                            <th>등록일</th>
                            <th>조회수</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($lists as $list)
                            <tr>
                                <td class="td_company ellipsis">
                                    <p>{{ $list->company_name }}</p>
                                </td>
                                <td class="td_subject ellipsis">
                                    <a href="/jobinfo/activity/{{ $list->id }}/view">
                                        <b>{{ $list->recruitment_field ?? "" }}</b></a>
                                </td>
                                <td class="td_gender_age">
                                    <p>
                                        {{ get_activity_gender_lists($list->gender_field) ?? "" }}
                                        @php
                                            if(isset($list->gender_field) && isset($list->age_field)) {
                                                echo '/';
                                            }
                                        @endphp
                                        {{ $list->age_field ?? "" }}
                                    </p>
                                </td>
                                <td class="td_createdAt">
                                    <p>{{ date("y-m-d", strtotime( $list->created_at )) ?? "" }}</p>
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
                    <!---- pc버전 끝 ---->


                    <!---- 반응형 모바일 시작 ---->
                    <table class="member-list in-input table-2x-large table_m">
                        <tbody>
                        @forelse($lists as $list)
                            <tr>
                                <td class="td_content">
                                    <a href="/jobinfo/activity/{{ $list->id }}/view">
                                        <ul>
                                            <li class="td_company">
                                                <div class="tit1">기업명 </div>
                                                <p>{{ $list->company_name ?? "" }}</p>
                                            </li>
                                            <li class="td_subject">
                                                <div class="tit1">채용공고 </div>
                                                <p>{{ $list->recruitment_field ?? "" }}</p>
                                            </li>
                                            <li class="td_gender_age">
                                                <div class="tit1">성별/나이 </div>
                                                <p>
                                                    {{ get_activity_gender_lists($list->gender_field) ?? "" }}
                                                    @php
                                                        if(isset($list->gender_field) && isset($list->age_field)) {
                                                            echo '/';
                                                        }
                                                    @endphp
                                                    {{ $list->age_field ?? "" }}
                                                </p>
                                            </li>
                                            <li class="td_deadline">
                                                <div class="tit1">마감일 </div>
                                                <p>{{ date('Y-m-d', strtotime( $list->created_at )) }}</p>
                                            </li>
                                            <li class="td_hit">
                                                <div class="tit1">조회 </div>
                                                <p>{{ $list->hit ?? "0" }}</p>
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

            <article id="list_bottom" class="pdt30">
                {{ $lists->appends(['search' =>  $search['search'], 'term' =>  $search['term'], 'view_count' => $view_count ])->links("vendor.pagination.default") }}
            </article> <!-- article list_bottom end -->

        </div>
    </div>

@endsection
