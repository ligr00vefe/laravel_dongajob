@extends("layouts.layout")

@section("title")
    동아대 마이페이지 - 학생 알리미
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
    <script defer src="/js/mypage/alimi/list.js"></script>
@endpush

@php
    $major_menu = "My Page";
    $minor_menu = "학생 알리미";
@endphp

@section("content")
    <div class="sub-content alimi-content">
        <div class="sub-content_title">
            <h1>학생 알리미</h1>
        </div>

        <div class="alimi-notice">
            <div class="img-wr">
                <img src="/img/notification.png" alt="알리미 공지 아이콘">
            </div>
            <div class="text-wr">
                <h1>관심분야 학생 알리미</h1>
                <p>관심있는 추천채용, 공지사항을 학생 알리미에 등록 해 두시면 새로 게시되는 글을 확인 하실 수 있습니다.</p>
            </div>
        </div>

        <div class="alimi-option">
            <ul class="option-tab">
                <li class="active" rel="alimi01" data-id="{{ array_search('채용정보', get_admin_menu_list(), true) }}"><a href="javascript:void(0)">추천채용</a></li>
                <li rel="alimi02" data-id="{{ array_search('공지사항', get_admin_menu_list(), true) }}"><a href="javascript:void(0)">공지사항</a>
                </li>
            </ul>

            <div class="option-list">
                <ul class="option-recommend-list" id="alimi01-option">
                    @foreach($alimi_recommend_list as $key=>$list)
                        <li>
                            <input type="checkbox" name="option01" id="op01-{{sprintf('%02d', $key + 1)}}" value="{{ $key }}"
                                {{ array_key_exists(array_search('채용정보', get_admin_menu_list(), true), $alimi_category) && in_array($key, $alimi_category[array_search('채용정보', get_admin_menu_list(), true)]) ? 'checked' : '' }}>
                            <label for="op01-{{sprintf('%02d', $key + 1)}}"><span>{{$list}}</span></label>
                        </li>
                    @endforeach
                </ul>


                <ul class="option-notice-list" id="alimi02-option">
                    @foreach($alimi_notice_list as $key=>$list)
                        <li>
                            <input type="checkbox" name="option02" id="op02-{{sprintf('%02d', $key + 1)}}" value="{{ $key }}"
                                {{ array_key_exists(array_search('공지사항', get_admin_menu_list(), true), $alimi_category) && in_array($key, $alimi_category[array_search('공지사항', get_admin_menu_list(), true)]) ? 'checked' : '' }}>
                            <label for="op02-{{sprintf('%02d', $key + 1)}}"><span>{{$list}}</span></label>
                        </li>
                    @endforeach
                </ul>


                <div class="option-btn">
                    <button type="button" class="btn-setting">
                        설정완료
                    </button>
                </div>

            </div>
        </div>

        <div class="board-wrap board-list alimi-list">

            <div class="list-wrap table01 alimi-recommend-list" id="alimi01-list">
                <form action="/mypage/alimi" method="post" name="forms">
                    @csrf
                    @method("delete")
                    <input type="hidden" name="id" value="">
                    <div class="alimi-table-box">
                    <table class="alimi-talbe alimi-alimi01-table">
                        <colgroup>
                            <col width="4%">
                            <col class="visible-pc" width="20%">
                            <col class="visible-pc" width="">
                            <col class="visible-pc" width="8%">
                            <col class="visible-pc" width="8%">
                            <col class="visible-pc" width="8%">
                            <col class="visible-tablet" width="50%">
                            <col class="col_deadline invisible-mobile" width="8%">
                            <col class="visible-pc" width="8%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="check_all" name="check_all" value="1">
                            </th>
                            <th class="visible-pc">기업명</th>
                            <th class="visible-pc">채용공고</th>
                            <th class="visible-pc">채용형태</th>
                            <th class="visible-pc">접수방법</th>
                            <th class="visible-pc">지역</th>
                            <th class="th_summary visible-tablet">내용</th>
                            <th class="th_deadline invisible-mobile">마감일</th>
                            <th class="visible-pc">조회수</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recommend_list as $list)
                            <tr>
                                <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                                <td class="visible-pc"> {{ $list->company_name }}</td>
                                <td class="visible-pc td_subject">
                                    <a href="/jobinfo/recommend/{{ $list->id }}/view">{{ $list->recruitment_field }}
                                </td>
                                <td class="visible-pc">{{ get_recommend_recruitment_lists($list->category) }}</td>
                                <td class="visible-pc">{{ get_recommend_screening_method_lists($list->screening_method) }}</td>
                                <td class="visible-pc">{{ get_work_area_lists($list->work_area) }}</td>
                                <td class="visible-tablet td_summary">
                                    <p>{{ $list->company_name }}</p>
                                    <p>{{  $list->recruitment_field }}</p>
                                    <p class="visible-mobile">{{ $list->created_at }}</p>
                                </td>
                                <td class="td_deadline invisible-mobile">{{ $list->created_at }}</td>
                                <td class="visible-pc">{{  $list->hit }}</td>

                        @empty
                            <tr>
                                <td colspan="100">내역이 존재하지 않습니다.</td>
                            </tr>

                        @endforelse
                        </tbody>
                    </table>
                    </div>
                    <div class="btn-wrap">
                        <div class="btn-right">
                            <a class="btn-delete btn01" href="javascript:void(0)">선택삭제</a>
                        </div>
                    </div>
                </form>

                <article id="list_bottom">
                        <x-alimiPaging record="{{ count($recommend_cnt) }}" page="{{ $recommend_page }}" keyword=""/>

                </article> <!-- article list_bottom end -->
            </div>{{-- //.table01 end --}}

            <div class="list-wrap table01 alimi-notice-list" id="alimi02-list">
                <form action="/mypage/alimi" method="post" name="forms">
                    @csrf
                    @method("delete")
                    <input type="hidden" name="id" value="">
                    <div class="alimi-table-box">
                    <table class="alimi-table alimi-alimi02-table">
                        <colgroup>
                            <col width="4%">
                            <col class="visible-pc" width="9%">
                            <col class="visible-pc" width="">
                            <col class="visible-pc" width="8%">
                            <col class="visible-tablet" width="50%">
                            <col class="col_datetime invisible-mobile" width="8%">
                            <col class="visible-pc" width="8%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="check_all" name="check_all" value="1">
                            </th>
                            <th class="visible-pc">번호</th>
                            <th class="visible-pc">제목</th>
                            <th class="visible-pc">작성자</th>
                            <th class="th_summary visible-tablet">내용</th>
                            <th class="th_datetime invisible-mobile">작성일</th>
                            <th class="visible-pc">조회수</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($notice_list as $list)
                            <tr>
                                <td><input type="checkbox" name="chk[]" class="_chk" value="{{ $list->id }}"></td>
                                <td class="visible-pc"> {{ $list->id }}</td>
                                <td class="visible-pc td_subject">
                                    <a href="/jobinfo/recommend/{{ $list->id }}/view">{{ $list->subject }}
                                </td>
                                <td class="visible-pc">관리자</td>
                                <td class="visible-tablet td_summary">
                                    <b>{{ get_notice_category($list->category_id) }}</b>
                                    <p>{{ $list->subject }}</p>
                                </td>
                                <td class="td_datetime invisible-mobile">{{ $list->created_at }}</td>
                                <td class="visible-pc">{{ $list->hit }}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="100">내역이 존재하지 않습니다.</td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                    </div>
                    <div class="btn-wrap">
                        <div class="btn-right">
                            <a class="btn-delete btn01" href="javascript:void(0)">선택삭제</a>
                        </div>
                    </div>
                </form>

                <article id="list_bottom">
                    <x-alimiPaging record="{{ count($notice_cnt) }}" page="{{ $notice_page }}" keyword=""/>
                </article> <!-- article list_bottom end -->

            </div>{{-- //.table01 end --}}

        </div>{{-- //.body-reservation end --}}

    </div>{{-- //.sub-content.content-studyroom end --}}

@endsection
