
@extends("layouts.layout")

@section("title")
    동아대 취업지원실 프로그램 - 서류합격자 면접교육 접수
@endsection

@push('scripts')
    <link rel="stylesheet" href="/css/board.css">
@endpush

@php
    $major_menu = "취업지원실 프로그램";
    $minor_menu = "서류합격자 면접교육 접수";
@endphp

@section("content")
    <div class="sub-content">
        <div class="sub-content_title">
            <h1>프로그램 접수</h1>
        </div>

        <div class="board-wrap board-view">
            <div class="table02-view table02 table-receipt first-table">
                <div class="table-title">
                    <h1>강좌정보</h1>
                </div>

                <table>
                    <tbody>
                    <tr>
                        <th class="w167">강좌명</th>
                        <td><p>{{ $list->lecture_title }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">접수상태</th>
                        <td><p>{{ $list->reception_status }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">강사명</th>
                        <td><p>{{ $list->instructor_name }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">접수일시</th>
                        <td><p>{{ $list->reception_datetime }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">수강일시</th>
                        <td><p>{{ $list->lecture_datetime }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">수강장소</th>
                        <td><p>{{ $list->location }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">수강인원</th>
                        <td><p>{{ $list->enrolled_count }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">교육대상</th>
                        <td><p>{{ $list->edu_target }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">재학생</th>
                        <td><p>{{ $list->target_grade }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">교재</th>
                        <td><p>{{ $list->textbook }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">수강료</th>
                        <td><p>{{ $list->tuition }}</p></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="view-content">
                {{ dongaDomainChange(stripslashes($list->content)) ?? "" }}
            </div>{{-- //.view-content end --}}


            <div class="table02-view table02 table-receipt">
                <div class="table-title">
                    <h1>입금수단</h1>
                </div>

                <table>
                    <tbody>
                    <tr>
                        <th class="w167">입금 마감일시</th>
                        <td><p>{{ $list->deposit_deadline }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">은행명</th>
                        <td><p>{{ $list->bank_name }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">예금주</th>
                        <td><p>{{ $list->account_name }}</p></td>
                    </tr>
                    <tr>
                        <th class="w167">계좌번호</th>
                        <td><p>{{ $list->account_number }}</p></td>
                    </tr>
                </table>
            </div>

            <div class="apply-wrap">
                <div class="btn02 btn-application">강좌신청</div>
            </div>

            <div class="view-bottom">
                <div class="btn-others">
                    @if ($prev_list)
                        <a href="/program/interview/{{ $prev_list->id }}/view" class="prev-view switch-view-page">
                            <span class="prev-icon switch-view-icon"><img src="/img/prev_view_icon.png" alt="이전글 아이콘"><b>이전글</b></span>
                            <span class="switch-view-subject">{{ $prev_list->enterprise ?? "" }}</span>
                            <span class="switch-view-datetime">{{ date('y-m-d', strtotime($prev_list->created_at)) ?? "" }}</span>
                        </a>
                    @else
                        <a href="javascript:void(0)" class="prev-view end-view-page">
                            <span class="prev-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>이전글</b></span>
                            <span class="switch-view-subject">작성된 글이 없습니다</span>
                        </a>
                    @endif

                    @if ($next_list)
                        <a href="/program/interview/{{ $next_list->id }}/view" class="next-view switch-view-page">
                            <span class="next-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>다음글</b></span>
                            <span class="switch-view-subject">{{ $next_list->enterprise ?? "" }}</span>
                            <span class="switch-view-datetime">{{ date('y-m-d', strtotime($next_list->created_at)) ?? "" }}</span>
                        </a>
                    @else
                        <a href="javascript:void(0)" class="next-view end-view-page">
                            <span class="next-icon switch-view-icon"><img src="/img/next_view_icon.png" alt="다음글 아이콘"><b>다음글</b></span>
                            <span class="switch-view-subject">작성된 글이 없습니다</span>
                        </a>
                    @endif
                </div>{{-- //.btn-others end --}}

                <div class="btn-wrap">
                    <div class="btn-right">
                        {{--<a href="" class="btn-del btn01">삭제</a>--}}
                        {{--<a href="" class="btn-copy btn01">복사</a>--}}
                        {{--<a href="" class="btn-modify btn01">수정</a>--}}
                        {{--<a href="" class="btn-scrap btn01">스크랩</a>--}}
                        <a href="/program/receipt" class="btn-list btn01">목록</a>
                    </div>
                </div>
            </div>{{-- //.view-bottom end --}}

        </div>{{-- //.board-wrap end --}}
    </div>{{-- //.sub-content end --}}

@endsection
