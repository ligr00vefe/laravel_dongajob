
@extends("layouts.layout")

@section("title")
    동아대 마이페이지 - 추천채용 지원내역
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
@endpush

@php
    $major_menu = "My Page";
    $minor_menu = "추천채용 지원내역";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>추천채용 지원내역</h1>
        </div>

        <div class="board-wrap board-list">
            <div class="search-box">
                <form action="" method="get" name="search-form">
                    <select name="category" id="search-cate">
                        <option value="all" {{$search['category'] == 'all' ? 'selected' : '' }}>전체</option>
                        <option value="company_name" {{ $search['category'] == 'company_name' ? 'selected' : '' }}>기업명</option>
                        <option value="recruitment_field" {{ $search['category'] == 'recruitment_field' ? 'selected' : '' }}>채용공고</option>
                    </select>
                    <input type="text" name="term" value="{{ $search['term'] }}" class="input-search">
                    <button type="submit" class="btn-search">검색</button>
            </form>
            </div>


        <!------ 테이블 시작 ------>
            <div class="list-table table01 table-recommend list-recommend">
                <form action="" method="post" name="memberUpdate">
                @csrf
                @method("put")

                <!------ pc버전 시작 ------>
                    <table class="member-list in-input table-2x-large">
                        <colgroup>
                            <col class="visible-pc" width="10%">
                            <col class="visible-pc" width="20%">
                            <col class="visible-pc" width="63%">
                            <col class="invisible-pc" width="73%">
                            <col class="visible-pc col_datetime" width="15%">
                            <col class="invisible-mobile" width="12%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="visible-pc">번호</th>
                                <th class="visible-pc">기업명</th>
                                <th class="visible-pc">채용공고</th>
                                <th class="invisible-pc th_summary">채용공고</th>
                                <th class="visible-pc">작성일</th>
                                <th class="invisible-mobile">상세보기</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($lists as $list)
                            <tr>
                                <td class="td_num visible-pc">{{$list->id}}</td>
                                <td class="td_company visible-pc">{{$list->company_name}}</td>
                                <td class="td_subject visible-pc">
                                    <span>
                                        <b>{{$list->recruitment_field}}</b>
                                    </span>
                                </td>
                                <td class="td_summary invisible-pc">
                                    <a href="javascript:void(0)">
                                        <b>{{$list->company_name}}</b>
                                        <p>{{ $list->recruitment_field }}</p>
                                        <small>{{ $list->created_at }}</small>
                                    </a>
                                </td>
                                <td>{{ date('y-m-d', strtotime($list->created_at)) }}</td>
                                <td class="td_details invisible-mobile">
                                    <a href="/jobinfo/recommend/{{ $list->id }}/edit" class="btn-details">상세보기</a>
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
                {{ $lists->appends(['category' => $search['category'], 'term' => $search['term'] ])->links("vendor.pagination.default") }}
            </article><!-- article list_bottom end -->

        </div>
    </div>

@endsection
